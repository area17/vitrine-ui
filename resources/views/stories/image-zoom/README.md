The Image Zoom Component is a powerful tool for displaying high-resolution images. This component is intended to be used within a modal or other wrapping component and utilizes the openseadragon library for zooming and panning functionality.

## Supported Image Types

The Image Zoom Component supports two types of images: static images (using Twill Image or a single image `src`) and IIIF image objects. It's preferred to use IIIF images where possible as they will render higher quality images when zooming as static images will zoom in on the original image and will become pixellated when zooming.

## Single or Multiple Images

The Image Zoom Component can be used to display a single image or multiple images at once. When multiple images are used, they are rendered as separate pages and can be navigated between using the previous and next buttons. This allows for easy browsing of a collection of high-resolution images.

## Usage

```php
// Static image using `src`
$sources = [
    [
        'image' => [
            'src' => '/static/work-nike.jpg',
        ]
    ]
];

// Static image using static Twill Image
$sources = [
    [
        'image' => [
            '_static' => [
                'file' => '/static/work-nike.jpg',
                'alt' => 'Example Alt Text'
            ],
        ],
    ]
];

// Static image using Twill Image
$sources = [
    [
        'image' => TwillImage::make($object, $role, $media)
    ]
];

<x-vui-image-zoom
    :sources="$sources ?? null"
/>
```
