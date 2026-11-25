<?php

namespace A17\VitrineUI\Tests;

use A17\VitrineUI\VitrineUI;
use Orchestra\Testbench\TestCase;
use A17\VitrineUI\VitrineUIServiceProvider;
use A17\VitrineUI\Commands\PublishComponent;

/**
 * resources/manifest.php must stay in line with the config and with the files of the package
 */
class DeclaredFilesTest extends TestCase
{
    protected array $manifest;

    protected function getPackageProviders($app): array
    {
        return [VitrineUIServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->manifest = require VitrineUI::resourcesPath('manifest.php');
    }

    protected function assertFileExistsCaseSensitive(string $path, string $message): void
    {
        // is_file alone is case insensitive on macOS, so `MapboxMaps.js` would pass there
        $this->assertTrue(is_file($path) && in_array(basename($path), scandir(dirname($path)), true), $message);
    }

    public function test_manifest_lists_every_configured_component(): void
    {
        $aliases = array_merge(
            array_keys(config('vitrine-ui.components')),
            array_keys(config('vitrine-ui.blade-components')),
        );

        $this->assertEqualsCanonicalizing($aliases, array_keys($this->manifest));
    }

    public function test_manifest_classes_match_the_config(): void
    {
        foreach (config('vitrine-ui.components') as $alias => $class) {
            $this->assertSame($class, $this->manifest[$alias]['class'], "Class of [$alias]");
        }

        foreach (config('vitrine-ui.blade-components') as $alias => $view) {
            $this->assertNull($this->manifest[$alias]['class'], "[$alias] has no class");
            $this->assertTrue(view()->exists("vitrine-ui::$view"), "No view for [$alias]: $view");
        }
    }

    public function test_manifest_views_and_stories_folders_exist(): void
    {
        $resources = VitrineUI::resourcesPath('views') . '/';

        foreach ($this->manifest as $alias => $entry) {
            $this->assertDirectoryExists($resources . 'components/' . $entry['view'], "View folder of [$alias]");

            if ($entry['stories'] !== null) {
                $this->assertDirectoryExists($resources . 'stories/' . $entry['stories'], "Stories folder of [$alias]");
            }
        }
    }

    public function test_manifest_assets_exist(): void
    {
        $base = VitrineUI::resourcesPath() . '/';
        $count = 0;

        foreach ($this->manifest as $alias => $entry) {
            $sets = [$entry['assets'], ...array_values($entry['assets']['optional'] ?? [])];

            foreach ($sets as $set) {
                foreach (PublishComponent::ASSET_FOLDERS as $type => $folder) {
                    $folder .= '/';
                    foreach ((array) ($set[$type] ?? []) as $file) {
                        $this->assertFileExistsCaseSensitive(
                            $base . $folder . $file,
                            "Declared asset of [$alias]: $type $file",
                        );
                        $count++;
                    }
                }
            }
        }

        $this->assertGreaterThan(0, $count);
    }

    public function test_manifest_behaviors_are_exported_by_the_barrel_with_their_registered_name(): void
    {
        $scripts = VitrineUI::resourcesPath(PublishComponent::ASSET_FOLDERS['js'] . '/behaviors') . '/';
        preg_match_all(
            "/export \{ default as (\w+) \} from '\.\/(\w+)'/",
            file_get_contents($scripts . 'index.js'),
            $m,
        );
        $barrel = array_combine($m[2], $m[1]);

        foreach ($this->manifest as $alias => $entry) {
            $sets = [$entry['assets'], ...array_values($entry['assets']['optional'] ?? [])];

            foreach ($sets as $set) {
                foreach ($set['js'] ?? [] as $js) {
                    if (!str_starts_with($js, 'behaviors/')) {
                        continue;
                    }

                    $file = basename($js, '.js');
                    $this->assertArrayHasKey($file, $barrel, "[$alias] $js is not exported by behaviors/index.js");

                    // data-behavior and the generated export use this name
                    $this->assertMatchesRegularExpression(
                        "/(createBehavior\(\s*|extendBehavior\(\s*\w+,\s*)'{$barrel[$file]}'/",
                        file_get_contents($scripts . $file . '.js'),
                        "$js does not register the behavior [{$barrel[$file]}]",
                    );
                }
            }
        }
    }
}
