The Datepicker component provides a flexible and accessible way to select dates or date ranges within your application. It supports single-date and date-range selection, with options for minimum and maximum dates to constrain the date selection. Additionally, the component allows for alignment control and integration with external inputs via a target selector.

## Usage

The Datepicker component relies on the wc-datepicker and focus-trap libraries. To install these, run the following command:

```bash
npm install wc-datepicker focus-trap
```

To use the Datepicker component in your Blade templates:

```html
<x-vui-datepicker
    :target="$target ?? null"
    :class="$class ?? null"
    :align="$align ?? null"
    :range="$range ?? null"
    :min-date="$minDate ?? null"
    :max-date="$maxDate ?? null"
/>
```

### Single Date Example :

```html
<x-vui-datepicker :range="false" />
```

### Date Range Example :

```html
<x-vui-datepicker
    :range="true"
    :min-date="'2023-01-01'"
    :max-date="'2023-12-31'"
/>
```

### Accessibility :

The Datepicker is designed with accessibility in mind. It uses ARIA attributes such as `aria-modal` and `aria-hidden` to ensure proper announcement by screen readers. The `button that triggers the Datepicker has a visually hidden label when `showLabel`is set to`false`, ensuring that screen readers can still provide context to users.
