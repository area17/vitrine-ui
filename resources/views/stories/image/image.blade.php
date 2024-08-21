@storybook([
    'name' => 'Image',
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
    ],
    'argTypes' => [
        'image' => [
            'description' =>
                'Twill Image object or a `_static` image array containing a file path and alt text',
            'defaultValue' => ['summary' => ''],
        ],
    ]
])
<x-vui-image
    :image="$image"
    :image-options="[
         'wrapperClass' => '',
         'imageClass' => '',
         'loading' => 'lazy',
     ]"
/>
