This is a basic pagination component. It renders a pagination navigation interface with previous and next buttons, a current page display, and a dropdown for selecting specific pages, depending on the props (see below) passed to the component.

Any additional attributes are merged with the component's existing attributes to allow you to add IDs, behaviors, data attributes, etc., to the component.

## Usage

```php
<x-vui-pagination
    :pages="$pages"
    :currentPage="$currentPage"
    :currentPageCount="$currentPageCount"
    :lastPage="$lastPage"
    :total="$total"
/>
```

## Accessibility

The "Previous" and "Next" buttons include aria-label attributes to describe their function, ensuring they are accessible to screen readers. When these buttons are disabled, they should also include aria-disabled="true" to indicate their inactive state.

## Theming

### Config

``` json
{
"base": "mb-140",
"wrapper": "md:flex w-full items-center gap-x-24",
"show-message": "hidden md:block f-ui-01",
"dropdown-wrapper": "md:flex items-center ml-auto mt-10 md:mt-0",
"dropdown": "pointer-events-none md:pointer-events-auto",
"select": {}
}
```
The pagination component uses the select Vitrine UI styles, defined in the [select.json](resources/frontend/theme/components/select.json) configuration.

To customize these styles for pagination, you can provide a select object in the pagination’s configuration. Any keys you include (e.g., wrapper, base) will override the corresponding values in select.json. If a key is missing, the default value from select.json will be used instead.
