The `DateRange` component allows users to select a date range using two date inputs, paired together within a parent element that synchronizes them. This component also includes optional fuzzy date input parsing and can display date picker popups for easier selection.

### Features
- **Fuzzy Input Parsing**: The component supports fuzzy input parsing, allowing users to enter dates in various formats, which are then interpreted correctly.
- **Optional Date Picker**: Each input can optionally display a date picker popup. This can be toggled via the `picker` prop.
- **Date Synchronization**: The "From" and "To" inputs are synchronized to ensure that the selected range is valid.
- **Accessibility**: The `legend` prop provides a descriptive label for screen readers, and both inputs are fully accessible with support for error states, hints, and notes.

## Usage

```html
<x-vui-form-date-range
    legend="Select date range"
    :disabled="false"
    :minDate="''"
    :maxDate="''"
    :picker="false"
    :from="{
        label: 'From',
        name: 'from',
        type: 'text',
        value: '',
        disabled: false,
        error: '',
        minDate: '',
        maxDate: '',
        fuzzy: false,
        picker: true,
        hint: '',
        note: '',
    }"
    :to="{
        label: 'To',
        name: 'to',
        type: 'text',
        value: '',
        disabled: false,
        error: '',
        minDate: '',
        maxDate: '',
        fuzzy: false,
        picker: true,
        hint: '',
        note: '',
    }"
/>
```

## Accessibility
- **Legend**: The legend provides context for assistive technologies to understand the grouped nature of the "From" and "To" inputs.
- **Error Handling**: Errors are announced to assistive technologies, helping users correct any issues with their input.
- **Hints and Notes**: Both inputs support additional hints and notes for further guidance.