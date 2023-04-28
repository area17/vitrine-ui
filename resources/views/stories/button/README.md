This is a basic button component. It renders an `a`, `span` or `button` depending on the props (see below) passed to the component.

Any additional attributes are merged with the component's existing attributes to allow you to add ids, behaviors, data attributes, etc to the component.

The default component slot is used for the label text within the button. It can be left blank and used with the `icon` prop to render an 'icon-only' button.

## Accessibility

Buttons should always have an accessible name. For most buttons this will be the label text but for buttons without label text they should have an `aria-label` or `aria-labelledby` attribute.

External links must open in a new window/tab and the element must have an `aria-label` with the link text + '. Opens in a new tab' as the value. eg:

```html
<x-vui-button-primary
    href="https://area17.com"
    target="_blank"
    aria-label="Site by AREA 17. Opens in a new tab."
>
    Site by AREA 17
</x-vui-button-primary>
```

## Usage

```html
<x-vui-button-primary
    href="https://example.url"
    icon="chevron-right"
    icon-position="after"
    :static="false"
    :disabled="false"
    :active="false"
>
    Label Text
</x-vui-button-primary>
```
