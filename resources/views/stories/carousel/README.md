The carousel component that is based on the Swiper JS library. It renders a list of carousel slides depending on the props passed to the component.

The `component` prop is mandatory to set the markup for each slides by loading a dynamic component. The dynamic component must have an `item` prop to properly load data for each slide.

Custom configuration object can setup globally to the `window.A17.sliderConfigurations` JS object.
Additionnal props are present to deactivate controls or pagination.

## Usage

```html
@php
    $MEDIA_CAROUSEL = [
        'slidesPerView' => 'auto',
        'freeMode' => false,
        'allowTouchMove' => true,
        'loop' => false,
        'spaceBetween' => 10,
    ];
@endphp
<script>
    window.A17 = window.A17 || {};
    window.A17.sliderConfigurations = {
        'media-carousel': {
            ...@json($MEDIA_CAROUSEL)
        }
    };
</script>

<x-vui-carousel class="h-[320px] px-outer-gutter"
    :items="$items"
    component="cards.media-carousel-item"
    configuration="media-carousel"
    :with-controls="false"
    item-class="flex"
    />
```

## Accessibility

Carousel is using A11y modules from Swiper JS by default.

## Theming

### Config

```json
{
  "base": "container",
  "wrapper": "flex flex-nowrap",
  "item": "",
  "controls": "flex items-center gap-4",
  "controls-button": "flex items-center",
  "controls-icon-left": "arrow-left-24",
  "controls-icon-right": "arrow-right-24",
  "footer": "flex justify-between items-center mt-16 relative",
  "pagination": "ml-auto f-ui-01 relative"
}
```

`wrapper`:
Styling of the Swiper wrapper div

`item`:
Additional styling for each slides (li or div element) that is wrapping the dynamic component.

`controls`:
Visual styling for the wrapper of the controls

`controls-button`:
Additional styling applied for the Previous/Next buttons (using Vitrine UI Button with icon-only mode)

`controls-icon-left`:
Icon used for the Previous button

`controls-icon-right`:
Icon used for the Next button

`footer`:
Styling for the wrapper of the pagination and the controls if pagination of controls are setup

`pagination`:
Control the styling of the pagination wrapper div if any pagination must show
