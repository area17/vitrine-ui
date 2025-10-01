This is the simplest pagination component. It renders a pagination navigation interface with previous and next buttons and the list of pages depending on the props (see below) passed to the component. Contrary to the other Pagination component this is not displaying any Select.

Any additional attributes are merged with the component's existing attributes to allow you to add IDs, behaviors, data attributes, etc., to the component.

## Usage

```html
<x-vui-pagination-numbered
    :pages="$pages"
    :currentPage="$currentPage"
    :lastPage="$lastPage"
/>
```

To generate the PHP pages object with ellipsis :

```php
function toPaginationNumberedArr(LengthAwarePaginator $paginator): array
{
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $length  = 5; // number of pages to show
    $pages = [];

    // Always show first page
    $pages[1] = ['url' => $paginator->url(1)];

    $half = floor($length / 2);
    $start = max(2, $current - $half);
    $end = min($last - 1, $current + $half);

    // Adjust so we always get $length pages when possible
    if ($end - $start + 1 < $length - 2) {
        if ($start == 2) {
            $end = min($last - 1, $start + $length - 3);
        } elseif ($end == $last - 1) {
            $start = max(2, $end - $length + 3);
        }
    }

    // Add ellipsis if needed after first page
    if ($start > 2) $pages[2] = ['url' => null];
    // Add middle range
    for ($i = $start; $i <= $end; $i++) $pages[$i] = ['url' => $paginator->url($i)];
    // Add ellipsis if needed before last page
    if ($end < $last - 1) $pages[$last - 1] = ['url' => null];
    //last page
    if ($last > 1) $pages[$last] = ['url' => $paginator->url($last)];

    return [
        'current_page' => $current,
        'pages' => $pages,
        'last_page' => $last,
    ];
}
```

## Accessibility

The "Previous" and "Next" buttons include aria-label attributes to describe their function, ensuring they are accessible to screen readers. When these buttons are disabled, they should also include aria-disabled="true" to indicate their inactive state. Current page has aria-current="page" attribute.

## Theming

### Config

```json
{
    "base": "container mt-space-9 pt-space-4 border-t",
    "wrapper": "flex w-full items-center justify-between gap-x-24",
    "pages" : "hidden md:flex flex-row items-center gap-x-space-2",
    "action-disabled": "pointer-events-none opacity-30",
    "current" : "f-ui-1",
    "ellipsis": "f-ui-1",
    "link": "f-ui-1 underline",
    "message" : "f-ui-1 text-center pt-space-2 block md:hidden"
}
```

`base`:
Styling of the main div

`wrapper`:
Styling of the nav div that is around both the buttons and the pages

`action-disabled`:
Styling of the disabled prev/next button if any

`pages`:
Styling of the div around the page links (by default : hidden on mobile)

`current`:
Styling of the current page number span

`ellipsis`:
Styling of the ellipsis span

`link`:
Styling of the page links a:href

`message`:
Styling the message showing under the buttons displaying "Page 5 of 10" (by default : display only on mobile)
