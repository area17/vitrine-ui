The tabs component that is based on the Swiper JS library. It renders a list of carousel slides depending on the props passed to the component.

The `component` prop is mandatory to set the markup for each slides by loading a dynamic component. The dynamic component must have an `item` prop to properly load data for each slide.

Custom configuration object can setup globally to the `window.A17.sliderConfigurations` JS object.
Additionnal props are present to deactivate controls or pagination.

## Usage

```html
<x-vui-tabs 
    :title="$title" 
    :name="$name" 
    :tabs-names="$tabsNames" 
    :title-level="$titleLevel"
    />
```

## Accessibility

Markup and JS behavior is based on https://www.w3.org/WAI/ARIA/apg/patterns/tabs/examples/tabs-manual/

## Theming

### Config

```json
{
  "base": "container",
  "title": "f-heading-03 w-full",
  "tabList": ""
}
```

`title`:
Style of the main tab component title

`tabList`:
Visual styling for the wraper element for the list of tab buttons
