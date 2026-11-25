<?php

namespace A17\VitrineUI\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use A17\VitrineUI\VitrineUIServiceProvider;

class PublishCommandTest extends TestCase
{
    protected string $appPath;

    protected function getPackageProviders($app): array
    {
        return [VitrineUIServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Publish into a throwaway app folder, with a copy of the package config like a consumer would have
        $this->appPath = sys_get_temp_dir() . '/vitrine-ui-test-' . uniqid();
        mkdir($this->appPath . '/config', 0777, true);
        copy(__DIR__ . '/../config/vitrine-ui.php', $this->appPath . '/config/vitrine-ui.php');

        $this->app->setBasePath($this->appPath);
        $this->app->useConfigPath($this->appPath . '/config');

        // These are computed from resource_path() when the config is loaded, before the base path is changed
        config([
            'vitrine-ui.js_path' => $this->appPath . '/resources/frontend/scripts/vendor',
            'vitrine-ui.css_path' => $this->appPath . '/resources/frontend/styles/vendor',
        ]);
    }

    protected function tearDown(): void
    {
        (new Filesystem())->deleteDirectory($this->appPath);

        parent::tearDown();
    }

    public function test_publishes_views_stories_and_classes_once_for_shared_folders(): void
    {
        $this->artisan('vitrine-ui:publish', [
            'components' => ['link', 'card-link', 'tabs-list', 'tabs-panel'],
        ])->assertExitCode(0);

        $views = $this->appPath . '/resources/views/vendor/vitrine-ui/components';
        $this->assertFileExists("$views/button/default.blade.php");
        $this->assertFileExists("$views/card/link.blade.php");
        $this->assertFileExists("$views/tabs/tabs.blade.php");

        $stories = $this->appPath . '/resources/views/stories/vitrine';
        $this->assertFileExists("$stories/link/primary.blade.php");
        $this->assertFileExists("$stories/tabs/tabs.blade.php");

        $this->assertFileExists($this->appPath . '/app/View/Components/VitrineUI/TabPanel.php');
    }

    public function test_publishing_a_class_only_rewrites_its_own_config_entry(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['card'], '--class' => true])->assertExitCode(0);

        $config = file_get_contents($this->appPath . '/config/vitrine-ui.php');
        $this->assertStringContainsString("'card' => App\\View\\Components\\VitrineUI\\Card::class", $config);
        $this->assertStringContainsString("'card-link' => A17\\VitrineUI\\Components\\CardLink::class", $config);
    }

    public function test_existing_files_are_skipped_unless_forced(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['tag'], '--view' => true])->assertExitCode(0);

        $view = $this->appPath . '/resources/views/vendor/vitrine-ui/components/tag/tag.blade.php';
        file_put_contents($view, 'custom');

        $this->artisan('vitrine-ui:publish', ['components' => ['tag'], '--view' => true])->assertExitCode(0);
        $this->assertSame('custom', file_get_contents($view));

        $this->artisan('vitrine-ui:publish', [
            'components' => ['tag'],
            '--view' => true,
            '--force' => true,
        ])->assertExitCode(0);
        $this->assertNotSame('custom', file_get_contents($view));
    }

    public function test_blade_only_components_can_be_published(): void
    {
        $this->artisan('vitrine-ui:publish', [
            'components' => ['banner', 'filters-panel', 'modal-close'],
        ])->assertExitCode(0);

        $views = $this->appPath . '/resources/views/vendor/vitrine-ui/components';
        $this->assertFileExists("$views/banner/banner.blade.php");
        $this->assertFileExists("$views/filters/panel.blade.php");
        // modal-close shares the modal folder
        $this->assertFileExists("$views/modal/close.blade.php");
        $this->assertDirectoryExists($this->appPath . '/resources/views/stories/vitrine/banner');

        // no class for Blade-only components
        $this->assertDirectoryDoesNotExist($this->appPath . '/app/View/Components/VitrineUI');
        $this->assertStringContainsString(
            'behaviors/Banner',
            file_get_contents($this->appPath . '/resources/frontend/scripts/vendor/vitrine-ui.js'),
        );
    }

    public function test_dry_run_lists_what_would_be_written_without_touching_files(): void
    {
        $config = file_get_contents($this->appPath . '/config/vitrine-ui.php');

        $this->artisan('vitrine-ui:publish', ['components' => ['card', 'banner'], '--dry-run' => true])
            ->expectsOutputToContain('[dry-run] Would publish view')
            ->expectsOutputToContain('[dry-run] Would publish class')
            ->expectsOutputToContain('Card::class')
            ->expectsOutputToContain('[dry-run] Would update')
            ->expectsOutputToContain('Dry run, no file was written.')
            ->assertExitCode(0);

        $this->assertSame($config, file_get_contents($this->appPath . '/config/vitrine-ui.php'));
        $this->assertDirectoryDoesNotExist($this->appPath . '/resources');
        $this->assertDirectoryDoesNotExist($this->appPath . '/app');
    }

    public function test_list_shows_components_without_writing_anything(): void
    {
        $this->assertSame(0, Artisan::call('vitrine-ui:publish', ['--list' => true]));

        $output = Artisan::output();
        $this->assertStringContainsString('card-link', $output);
        $this->assertStringContainsString('blade', $output);
        $this->assertStringContainsString('Banner.js', $output);

        $this->assertDirectoryDoesNotExist($this->appPath . '/resources');
        $this->assertDirectoryDoesNotExist($this->appPath . '/app');
    }

    public function test_unknown_component_fails(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['nope']])->assertExitCode(1);
    }

    public function test_assets_generate_import_files_and_list_optional_ones(): void
    {
        $this->artisan('vitrine-ui:publish', ['--all' => true, '--assets' => true])
            ->expectsOutputToContain('npm i')
            ->expectsOutputToContain('Optional, only for [video-background: video.js]')
            ->assertExitCode(0);

        $js = file_get_contents($this->appPath . '/resources/frontend/scripts/vendor/vitrine-ui.js');

        // Blade-only components are included, the name is the one used by data-behavior (not the file name)
        $this->assertStringContainsString("export { default as Banner } from '", $js);
        $this->assertStringContainsString("export { default as FilterPanel } from '", $js);
        $this->assertStringContainsString("export { default as DatePicker } from '", $js);
        $this->assertStringContainsString("from './behaviors/Banner'", $js);
        $this->assertStringNotContainsString('vendor/area17', $js);
        // Optional behaviors and utils are not exported
        $this->assertStringNotContainsString('VideoBackgroundVideoJs', $js);
        $this->assertStringNotContainsString('formatDate', $js);

        // Files are copied into the app with the files they import, and the optional ones are not
        $scripts = $this->appPath . '/resources/frontend/scripts/vendor';
        $this->assertFileExists("$scripts/behaviors/Banner.js");
        $this->assertFileExists("$scripts/behaviors/DateInputFuzzy.js");
        $this->assertFileExists("$scripts/behaviors/DateInput.js"); // imported as './DateInput'
        $this->assertFileExists("$scripts/utils/formatDate.js"); // imported as '../utils/formatDate'
        $this->assertFileExists("$scripts/constants/customEvents.js");
        $this->assertFileDoesNotExist("$scripts/behaviors/VideoBackgroundVideoJs.js");

        $css = file_get_contents($this->appPath . '/resources/frontend/styles/vendor/vitrine-ui.css');
        $this->assertStringContainsString('@import "', $css);
        $this->assertStringContainsString('@import "./components/datepicker.css";', $css);
        $this->assertStringNotContainsString('vendor/area17', $css);
        $this->assertFileExists($this->appPath . '/resources/frontend/styles/vendor/components/datepicker.css');
    }

    public function test_copied_assets_are_kept_unless_forced_and_vendor_imports_are_replaced_only_when_published(): void
    {
        $dir = $this->appPath . '/resources/frontend/scripts/vendor';
        mkdir($dir, 0777, true);
        file_put_contents(
            "$dir/vitrine-ui.js",
            "export { default as Old } from '../../../../vendor/area17/vitrine-ui/resources/frontend/scripts/behaviors/Old'\n" .
                "export { default as Accordion } from '../../../../vendor/area17/vitrine-ui/resources/frontend/scripts/behaviors/Accordion'\n",
        );

        $this->artisan('vitrine-ui:publish', ['components' => ['accordion'], '--assets' => true])->assertExitCode(0);

        $js = file_get_contents("$dir/vitrine-ui.js");
        // Unrelated vendor imports are kept, the published component is switched to its local copy
        $this->assertStringContainsString('vendor/area17/vitrine-ui/resources/frontend/scripts/behaviors/Old', $js);
        $this->assertStringContainsString("as Accordion } from './behaviors/Accordion'", $js);
        $this->assertSame(1, substr_count($js, 'as Accordion'));

        file_put_contents("$dir/behaviors/Accordion.js", 'edited');
        $this->artisan('vitrine-ui:publish', ['components' => ['accordion'], '--assets' => true])
            ->expectsOutputToContain('already exists')
            ->assertExitCode(0);
        $this->assertSame('edited', file_get_contents("$dir/behaviors/Accordion.js"));

        $this->artisan('vitrine-ui:publish', [
            'components' => ['accordion'],
            '--assets' => true,
            '--force' => true,
        ])->assertExitCode(0);
        $this->assertNotSame('edited', file_get_contents("$dir/behaviors/Accordion.js"));
    }

    public function test_import_files_keep_the_components_published_earlier(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['accordion'], '--assets' => true])->assertExitCode(0);
        $this->artisan('vitrine-ui:publish', ['components' => ['carousel'], '--assets' => true])->assertExitCode(0);

        $js = file_get_contents($this->appPath . '/resources/frontend/scripts/vendor/vitrine-ui.js');
        $this->assertStringContainsString('as Accordion }', $js);
        $this->assertStringContainsString('as Carousel }', $js);
        $this->assertSame(1, substr_count($js, 'as Accordion }'));
    }

    public function test_assets_of_the_components_rendered_by_the_view_are_included(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['filters-panel'], '--assets' => true])->assertExitCode(
            0,
        );

        $js = file_get_contents($this->appPath . '/resources/frontend/scripts/vendor/vitrine-ui.js');
        foreach (['Modal', 'Accordion', 'Input'] as $name) {
            $this->assertStringContainsString("as $name }", $js);
        }

        $this->artisan('vitrine-ui:publish', [
            'components' => ['form-date-range'],
            '--assets' => true,
            '--force' => true,
        ])
            ->expectsOutputToContain('wc-datepicker')
            ->assertExitCode(0);
    }
}
