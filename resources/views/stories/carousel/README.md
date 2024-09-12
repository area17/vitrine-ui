This is a basic button component. It renders an `a`, `span` or `button` depending on the props (see below) passed to the component.

Any additional attributes are merged with the component's existing attributes to allow you to add ids, behaviors, data attributes, etc to the component.

The default component slot is used for the label text within the button. It can be left blank and used with the `icon` prop to render an 'icon-only' button.

## Usage

```html
<x-vui-button
    href="https://example.url"
    icon="chevron-right"
    icon-position="after"
    :static="false"
    :disabled="false"
    :active="false"
>
    Label Text
</x-vui-button>
```


## Accessibility

Buttons should always have an accessible name. For most buttons this will be the label text but for buttons without label text they should have an `aria-label` or `aria-labelledby` attribute.

External links must open in a new window/tab and the element must have an `aria-label` with the link text + '. Opens in a new tab' as the value. eg:

```html
<x-vui-button
    variant="primary"
    size="small"
    href="https://area17.com"
    target="_blank"
    aria-label="Site by AREA 17. Opens in a new tab."
>
    Site by AREA 17
</x-vui-button>
```

## Theming

### Config

```json
{
  "base": "focus:outline-none focus-visible:outline-0 disabled:cursor-not-allowed disabled:opacity-75 flex-shrink-0",
  "size": {
    "sm": "p-4",
    "md": "p-8"
  },
  "variant": {
    "primary": "bg-primary",
    "secondary": "bg-secondary text-inverse",
    "outline": ""
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
    "size": "sm",
    "variant": "primary"
  },
  "label": "text-inherit"
}

```

`size`:
Defines the size variations of the button, typically adjusting the padding around the text or icon. The available options (sm, md, etc.) allow you to choose different levels of button compactness.

`variant`:
Controls the visual style of the button, such as background colors, text colors, and borders. You can define multiple variants (primary, secondary, outline, etc.) to suit different use cases of the button in the interface.

`icon_only`:
Indicates whether the button is used without text, only with an icon. This can alter how spacing around the icon is handled, allowing for a more compact appearance in icon-only buttons.

`icon_position`:
Determines the position of the icon relative to the button’s text. The options (before, after) allow you to place the icon before or after the button label.

`default`:
Specifies default values for the size and variant properties when they are not explicitly set.
