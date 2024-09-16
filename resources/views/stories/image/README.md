This is the main component to display an image. Output will be an img or a picture tag depending if multiple sources are provided.

The component accept primarly the image object as a Twill-Image array. The component accept custom css class.

*To display an image with a caption : please consider using the media component instead*

```html
<!-- Image asTwill-Image array -->
<x-vui-image :image="$image" />

<!-- Static image -->
<x-vui-image :image="[
    'src' => 'https://placehold.co/600x400.png',
    'alt' => 'Sample Alt Text',
]" />
```

## Theming

Theming can be achieved with the media.json theme file with `image` and `image-placeholder` keys.