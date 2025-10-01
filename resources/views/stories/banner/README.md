The Banner component displays a message bar at the top of the website, typically used for important announcements. Users can dismiss the banner via a close button, which sets a cookie to prevent it from reappearing on subsequent visits.

You can disable the close button entirely by setting the `showClose` prop to `false`.

The `id` prop determines the cookie name. Changing the `id` forces the banner to appear again. You can control how long the cookie persists using the `cookieTimeout` prop.

For styling, the component exposes a CSS custom property at the document level: `--banner-height`. This allows other parts of the site to adapt dynamically to the banner’s height (e.g., pushing down UI elements).

Banner content is provided via a `slot`.

## Usage

```html
    <x-vui-banner 
        class="extra css classes"
        id="idbasedoncontent"
        :show-close="true"
        close-button-variant="icon-secondary"
        close-button-size="md">
        <div>
            Custom Banner Content
        </div>
    </x-vui-banner>
```

## Theming

### Config

```json
{
    "base": "py-40",
    "wrapper": "container pr-40 relative",
    "close": "absolute top-0 right-0",
    "close-icon": "close-32"
}
```
`base`:
Styling of the main div

`wrapper`:
Styling of the wrapper div that is around both the slot and the close button

`close`:
Additional styling for the close button to handle positioning.

`close-icon`:
Icon used for the close button
