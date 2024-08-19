The Breadcrumbs component renders a breadcrumb navigation trail, which helps users understand their location within the hierarchy of a website or application. The component is flexible, allowing you to specify the tag used to wrap the breadcrumbs and pass in a list of items representing the breadcrumb trail.

Each breadcrumb item can be either a link (when href or url is provided) or plain text (when no href or url is provided). The last item in the list is automatically marked as the current page.

## Usage

```php
<x-vui-breadcrumbs
    :items="[
        ['href' => '#', 'text' => 'Bread'],
        ['href' => false, 'text' => 'Crumbs'],
    ]"
/>
```

### Accessibility
The breadcrumb navigation is wrapped with an element that has the aria-label="breadcrumbs" attribute, ensuring it is announced correctly by screen readers. The last breadcrumb item is automatically marked with aria-current="page" to indicate the current page in the trail.

## Theming

### Config

``` json
{
  "base": "flex items-center f-ui-3 gap-x-24",
  "item": "relative after:content-[''] after:absolute after:inset-y-0 after:w-px after:-right-12 after:rotate-12 after:border-r last:after:content-[none]",
  "link": "underline underline-offset-4 hover:no-underline hover:underline-offset-0"
}
```

### View