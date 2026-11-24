<?php

namespace A17\VitrineUI\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Filesystem\Filesystem;
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

    public function test_unknown_component_fails(): void
    {
        $this->artisan('vitrine-ui:publish', ['components' => ['nope']])->assertExitCode(1);
    }

    public function test_assets_list_blade_only_and_optional_assets(): void
    {
        $this->artisan('vitrine-ui:publish', ['--all' => true, '--assets' => true])
            ->expectsOutputToContain('behaviors/Banner.js')
            ->expectsOutputToContain('behaviors/FilterPanel.js')
            ->expectsOutputToContain('Optional, only for [video-background: video.js]')
            ->assertExitCode(0);
    }
}
