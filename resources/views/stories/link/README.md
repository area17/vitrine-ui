This is a basic link component. It uses the same base component as the button so can render an `a`, `span` or `button` depending on the props (see below) passed to the component.

Any additional attributes are merged with the component's existing attributes to allow you to add ids, behaviors, data attributes, etc to the component.

The default component slot is used for the label text within the link. It can be left blank and used with the `icon` prop to render an 'icon-only' link.

## Usage

```html
<x-vui-link
    href="https://example.url"
    icon="arrow-right-24"
    icon-position="after"
    variant="primary"
    :static="false"
>
    Label Text
</x-vui-link>
```

Props: `href`, `icon`, `icon-position` (`before` or `after`, default `after`), `icon-only`, `variant` (`primary` or `secondary`, see theming), `static` (renders a `span`), `target` and `tag` (force the element). External URLs automatically get `target="_blank"`.

Any other attribute is passed through to the element. `disabled` is a native attribute so it only has an effect when the link renders as a `button` (no `href`).

## Accessibility

Links should always have an accessible name. For most links this will be the label text but for links without label text they should have an `aria-label` or `aria-labelledby` attribute.

External links must open in a new window/tab and the element must have an `aria-label` with the link text + '. Opens in a new tab' as the value. eg:

```html
<x-vui-link
    href="https://area17.com"
    target="_blank"
    aria-label="Site by AREA 17. Opens in a new tab."
>
    Site by AREA 17
</x-vui-link>
```

## Theming

### Config

```json
{
    "base": "f-ui-3 underline-thickness-1 underline underline-inherit underline-offset-4 hover:no-underline active:underline-transparent disabled:cursor-not-allowed disabled:opacity-30 inline-flex items-center gap-4",
    "variant": {
        "primary": "text-primary",
        "secondary": "text-inverse"
    },
    "icon_only": {
        "true": "",
        "false": ""
    },
    "icon_position": {
        "before": "",
        "after": ""
    },
    "default": {
        "variant": "primary"
    },
    "label": "text-inherit"
}
```

`variant`:
Controls the visual style of the link. You can define multiple variants (primary, secondary, etc.) to suit different use cases of the link in the interface.

`icon_only`:
Determines how the link behaves when it only contains an icon, ensuring proper spacing and alignment.

`icon_position`:
Specifies where the icon should be placed relative to the link text. The options before and after allow for flexible positioning of the icon.

`default`:
Sets the default values for variant, ensuring that the link uses the primary variant if none is specified.
