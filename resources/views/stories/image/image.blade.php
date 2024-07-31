@storybook([
    'name' => 'Image',
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            '_static' => [
                'file' => '/static/placeholder_16x9.jpg',
                'alt' => 'Dummy Alt Text'
            ],
        ]
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
