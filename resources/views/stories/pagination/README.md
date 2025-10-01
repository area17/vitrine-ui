This is a basic pagination component. It renders a pagination navigation interface with previous and next buttons, a current page display, and a dropdown for selecting specific pages, depending on the props (see below) passed to the component.

Any additional attributes are merged with the component's existing attributes to allow you to add IDs, behaviors, data attributes, etc., to the component.

## Usage

```html
<x-vui-pagination
    :pages="$pages"
    :currentPage="$currentPage"
    :currentPageCount="$currentPageCount"
    :labelUnderActions="false"
    :lastPage="$lastPage"
    :total="$total"
/>
```

## Accessibility

The "Previous" and "Next" buttons include aria-label attributes to describe their function, ensuring they are accessible to screen readers. When these buttons are disabled, they should also include aria-disabled="true" to indicate their inactive state.

## Theming

### Config

```json
{
    "base": "container mt-space-9 pt-space-4 border-t",
    "wrapper": "flex w-full items-center gap-x-24",
    "actions": "flex items-start justify-end gap-x-8",
    "show-message": "hidden sm:block f-ui-1",
    "action-disabled": "pointer-events-none opacity-30",
    "dropdown-wrapper": "hidden md:flex items-center ml-auto",
    "dropdown-message": "ml-12 f-ui-1",
    "under-message": "flex md:hidden f-ui-1",
    "dropdown": "",
    "select": {}
}
```
`base`:
Styling of the main div

`wrapper`:
Styling of the wrapper div that is around both the actions, the message and the dropdown

`actions`:
Styling of the div that is around the prev/next buttons

`show-message`:
Styling of the message "Showing 10 of 25 items" displaying between the action and the dropdown

`action-disabled`:
Styling the Prev button when on the first page. Styling the Next button on the last page.

`under-message`:
Style for "Page 1 of 10" message showing after action if `labelUnderActions` prop is true

The pagination component uses the select Vitrine UI styles, defined in the [select.json](resources/frontend/theme/components/select.json) configuration.

To customize these styles for pagination, you can provide a select object in the pagination’s configuration. Any keys you include (e.g., wrapper, base) will override the corresponding values in select.json. If a key is missing, the default value from select.json will be used instead.
