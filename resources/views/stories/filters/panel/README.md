The Filters Panel component provides a flexible, accessible interface for displaying and applying multiple filter groups. It supports checkbox and radio inputs, custom theming, and integration with Swup.

Please note that the current selected filters functionality does not work with the Storybook demo.

## Usage

```html
  <x-vui-filters-panel
      :title="$title"
      :filters="$filters"
      :show-chips="true"
  />
```

### Filter Item Format

Each filter item should be an associative array with the following structure:

- `title` (string): The display title of the filter group.
- `name` (string): The unique identifier for the filter group.
- `type` (string): The type of input for the filter group. Accepted values are:
    - 'checkbox'
    - 'radio'
- `open` (boolean): Determines whether the filter group accordion is open by default.
- `items` (array): An array of filter options, where each option is an associative array with:
    - `label` (string): The display label for the option.
    - `value` (string): The value associated with the option.

Example:
```
[
    'title' => 'Example Filter',
    'name' => 'example',
    'type' => 'checkbox', // or 'radio'
    'open' => false,
    'items' => [
        [
            'label' => 'Option 1',
            'value' => 'option1',
        ],
        // ...
    ],
]
```

### Named slots

- `header`- Use this slot to override the component's default header content. Make sure the modal contains a close button.
- `footer`- Use this slot to override the component's default footer content. Make sure the modal contains reset and apply buttons.

Example:

```html
<x-vui-filters-panel :filters="$filters">
    <x-slot name="header">
        <h2>Header content</h2>
        <button data-Modal-close-trigger>Close modal</button>
    </x-slot>
    <x-slot name="footer">
        <h2>Footer content</h2>
        <button data-FilterPanel-reset>Reset filters</button>
        <button data-FilterPanel-apply>Apply filters</button>
    </x-slot>
</x-vui-filters-panel>
```


### Usage with Swup

To support Swup page transitions, set the `use-swup` attribute to `true`:

```html
<x-vui-filters-panel
    :title="$title"
    :filters="$filters"
    use-swup="true"
/>
```

Then, add the following custom event listener in your Swup setup file (e.g., `pjax.js`):

```javascript
document.addEventListener('Swup:navigate', (event) => {
        const { url, opts } = event.detail || {}
        if (url) {
            navigate(url, opts || {})
        }
    })
```

## Accessibility

- Focus is trapped within the panel once opened
- Focus is initially set on the heading. If you replace the header with a named slot, include an element with `[data-Modal-initial-focus]`. 
- When no filters are selected, the `aria-disabled` attribute is applied to the Apply button. Avoid using the `disabled` attribute so that the button can still receive focus.


## Theming

### Config

```json
{
 "accordion-item-inner": "flex flex-col gap-y-16 pt-4 pb-28",
 "chips-list": "mt-16 flex flex-row flex-wrap gap-8",
 "chips-title": "f-ui-1 font-bold",
 "chips": "peer w-full pt-24 pb-32",
 "footer-button": "w-full shrink justify-center",
 "footer": "border-default mt-auto w-full shrink-0 border-t py-16 md:py-24 px-gutter flex justify-between gap-x-gutter",
 "header": "border-default w-full shrink-0 border-b flex items-center justify-between py-12 md:py-24 px-gutter",
 "modal": "bg-overlay",
 "panel": "bg-primary flex h-full flex-col",
 "scroll-area": "relative h-full overflow-auto px-gutter",
 "title": "f-subhead-2"
}
```

`accordion-item-inner`:
Styling of the div that wraps the accordion item content

`chips-list`:
Styling of the ul that contains the chips

`chips-title`:
Styling of the chips heading

`chips`:
Styling of the chips container

`footer-button`:
Styling of buttons inside the panel's footer

`footer`:
Styling of the panel's footer area

`header`:
Styling of the panels header area

`modal`:
Styling of the modal containing the panel

`panel`:
Styling of the panel itself

`scroll-area`:
Styling of the scrollable area between the header and footer areas in the panel

`title`:
Styling of the panel title