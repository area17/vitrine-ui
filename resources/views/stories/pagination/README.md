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

## Theming

### Config
``` json
{
"base": "mb-140",
"wrapper": "md:flex w-full items-center gap-x-24",
"show-message": "hidden md:block f-ui-01",
"dropdown-wrapper": "md:flex items-center ml-auto mt-10 md:mt-0",
"dropdown": "pointer-events-none md:pointer-events-auto"
}
```
### View
