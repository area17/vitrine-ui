The Icon component is used to render SVG icons within the project. The first time an icon is used, it adds the icon to a sprite, and subsequent uses render the SVG reference inline.

## Usage

```html
<x-vui-icon
    :name="'icon-name'"
    :aria-label="'Description of icon'"
/>
```

## Accessibility
The icons are hidden from screen readers by default as in the majority of use-cases icons are decorative. If the icon is not decorative setting the <code>aria-label</code> attribute will remove <code>aria-hidden</code> and add a label to the icon.


## Theming
You can customize the appearance of icons through the `class` attribute. Additionally, you can configure the path where the icons are stored in your Laravel application by updating 'icons_view_path' key set in [vitrine-ui config](config/vitrine-ui.php)  