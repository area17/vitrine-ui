This is a global component to display media UI. It can render an image, a video or a video-background depending on the props (see below) passed to the component.

Each media can have caption attached.

Video is setup with an array containing the video `id` from the video URL, the `type` ( `youtube` or `vimeo` are the only providers supported at the moment), and a boolean for `autoplay`.

Default slot can de used to display any content on top of the media.

*To display a simple image : please use the dedicated image component instead*

## Usage

```html
<!-- Image with caption -->
<x-vui-media
    :image="[
        'src' => 'https://placehold.co/600x400.png',
        'alt' => 'Sample Alt Text',
    ]"
    caption="Plain text image caption."
    :cover="true"
/>

<!-- Video Background -->
<x-vui-media
    class="aspect-16/9"
    :background-video="[
        'sources' => [
            [
                "type" => "video/mp4",
                "src" => "https://ia600106.us.archive.org/25/items/archive-video-files/test.mp4"
            ]
        ],
    ]"
/>

<!-- Video Player with an image -->
<x-vui-media
    :video="[
        'id' => 'CouF-tNHV3g',
        'type' => 'youtube',
        'autoplay' => true,
    ]"
    caption="Plain text video caption."
>
    <x-vui-image :image="[
        'src' => 'https://placehold.co/600x400.png',
        'alt' => 'Sample Alt Text',
    ]" />
</x-vui-media>
```

## Accessibility

It will generate figure element if a figcaption is present.

## Theming

### Config

``` json
{
  "base": "",
  "cover": {
    "true": "w-full h-full object-cover",
    "false": ""
  },
  "video-wrapper": "group relative h-full cursor-pointer overflow-hidden",
  "image-wrapper": "relative flex h-full overflow-hidden",
  "image-placeholder": "",
  "image": "",
  "video-player": "absolute inset-0 z-30 hidden h-full w-full",
  "video-play-button": "absolute left-1/2 top-1/2 z-10 -translate-x-1/2 -translate-y-1/2 transform",
  "caption": "f-ui-1 mt-12 text-primary lg:mt-16"
}

```

`base`:
Controls the visual style the media wrapper element : this is the element that contains the media (image, video, video-background) and the optional caption element.

`image-wrapper`:
Style of the image parent element.

`image-placeholder`:
Style of the image placeholder if any.

`image`:
Generic style for images : style is applied on the img tag.

`video-wrapper`:
Controls the style of the main video container : this is the parent of the video player and the video button.

`video-player`:
Set the style for the container where the video iframe (Youtube or Vimeo player) is appended.

`video-play-button`:
Determine the position of the video play button relative to the video's wrapper element.

`caption` :
Set the style of the caption text displaying under the media