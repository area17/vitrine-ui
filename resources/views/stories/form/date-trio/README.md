The `DateTrio` component allows users to input a date by splitting the day, month, and year into separate input fields. This is useful in scenarios where manual date entry is required, and users may not have access to a date picker.

### Features
- **Three Separate Inputs**: Users input the day, month, and year individually for a more structured date entry experience.
- **Date Picker Integration**: An optional date picker can be added for easier date selection.
- **Minimum and Maximum Date Validation**: Supports setting `minDate` and `maxDate` to enforce date constraints.

## Usage

```html
 <x-vui-form-date-trio
    legend="Date"
    name="date"
    id=""
    value=""
    error="This field is required"
    :disabled="false"
    :required="true"
    :picker="true"
    :autofocus="false"
    :readonly="false"
/>
```

## Accessibility

- **ARIA Attributes**: The component uses `aria-describedby` to link to hint, note, format, and min/max date elements, ensuring that screen readers provide all necessary information to users.
- **Error Handling**: The error message uses `aria-live="assertive"` to alert users when an error occurs.
- **Semantic HTML**: The use of `fieldset`, `legend`, and other native HTML elements improves the component’s accessibility, making it easy for assistive technology to interpret.