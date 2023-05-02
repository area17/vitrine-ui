<?php

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

$filesystem = new Filesystem;
$files = $filesystem->files(base_path('vendor/area17/vitrine-ui/resources/views/components/icon/_icons'));

// $files = Storage::disk('views')->files('components/atoms/icon/_icons');
$icons = [];

foreach ($files as $file) {
    $icons[] = Str::of($file)->after('_icons/')->remove('.blade.php');
}

return [
    'all' => [
        'args' => [
            'icons' => $icons,
        ],
    ],
];
