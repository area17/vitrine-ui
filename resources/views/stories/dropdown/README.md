The Dropdown component provides a flexible way to present a list of selectable options.

Each dropdown item can be a simple text link or a more complex HTML structure, depending on your needs.

## Usage

```html
<x-vui-dropdown
    :heading-level="3"
    aria-label="Select an option"
    label="Options"
/>
```

## Accessibility

The component includes ARIA attributes like aria-label and supports keyboard navigation through arrow keys, Tab, and Escape.

## Theming

### Config

```json
{
    "base": "relative group",
    "trigger": "flex text-primary border p-12 w-full f-body-1 justify-between",
    "icon": "group-data-[is-open]:rotate-180 transition",
    "icon-name": "chevron-down-24",
    "list": "absolute z-10 bg-white border rounded shadow-lg w-full mt-4 hidden group-data-[is-open]:block"
}
```
