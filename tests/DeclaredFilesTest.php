<?php

namespace A17\VitrineUI\Tests;

use Orchestra\Testbench\TestCase;
use A17\VitrineUI\VitrineUIServiceProvider;

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

        $this->manifest = require __DIR__ . '/../resources/manifest.php';
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
        $resources = __DIR__ . '/../resources/views/';

        foreach ($this->manifest as $alias => $entry) {
            $this->assertDirectoryExists($resources . 'components/' . $entry['view'], "View folder of [$alias]");

            if ($entry['stories'] !== null) {
                $this->assertDirectoryExists($resources . 'stories/' . $entry['stories'], "Stories folder of [$alias]");
            }
        }
    }

    public function test_manifest_assets_exist(): void
    {
        $base = __DIR__ . '/../resources/frontend/';
        $count = 0;

        foreach ($this->manifest as $alias => $entry) {
            $sets = [$entry['assets'], ...array_values($entry['assets']['optional'] ?? [])];

            foreach ($sets as $set) {
                foreach (['js' => 'scripts/', 'css' => 'css/'] as $type => $folder) {
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
}
