This is the main component to display an image. Output will be an img or a picture tag depending if multiple sources are provided. The component accept custom css class.

The component accept primarly the image object as a TwillImage array. 

_To display an image with a caption : please consider using the media component instead_

Example of helper code to retrieve the correct format using TwillImage :

```php
if (!function_exists('getImage')) {
    function getImage(
        Model|Block|null $model,
        string $role,
        ?array $opts = [
            'crop' => 'default',
            'preset' => null,
            'media' => null,
        ],
    ): array|null {
        if (!$role) {
            return null;
        }

        $crop = $opts['crop'] ?? 'default';
        $preset = $opts['preset'] ?? null;
        $media = $opts['media'] ?? null;

        if (is_object($model) && method_exists($model, 'hasImage') && $model->hasImage($role, $crop)) {
            try {
                $image = TwillImage::make($model, $role, $media);

                if ($preset) {
                    $image->preset($preset);
                } else {
                    $image->crop($crop);
                }

                $arrImage = $image->toArray();

                $flattenImage = $arrImage['image'] ?? [];

                if ($arrImage['sizes'] ?? null) {
                    $flattenImage['sizes'] = $arrImage['sizes'];
                }

                if ($arrImage['sources'] ?? null) {
                    $flattenImage['sources'] = array_map(function ($source) {
                        return $source['image'] + [
                            'media' => $source['mediaQuery'],
                        ];
                    }, $arrImage['sources']);
                }

                return $flattenImage;
            } catch (\Exception $e) {
                // do nothing
            }
        }

        return null;
    }
}
```

```html
<!-- Image as an array -->
<x-vui-image :image="$image" />

<!-- Static image -->
<x-vui-image
    :image="[
    'src' => 'https://placehold.co/600x400.png',
    'alt' => 'Sample Alt Text',
]"
/>
```

## Theming

Theming can be achieved with the media.json theme file with `image` keys.
