The `Date` component provides a flexible way to input dates using either manual input or a date picker. It supports both strict and fuzzy date input processing, which allows for parsing various date formats manually entered by users.

-   Optional Date Picker: The date picker popup can be enabled or disabled using the picker prop.
-   Validation: The component supports minimum and maximum date validation through the `minDate` and `maxDate` props.

## Usage

```html
<x-vui-form-date
    label="Birth date"
    name="date"
    id="date"
    :disabled="false"
    :required="true"
    error="This field is required"
    note="You must be over 21 years old"
    :fuzzy="true"
    :picker="true"
    :autofocus="true"
    form="registration"
    :readonly="false"
    :hideA11yLabels="false"
/>
```

### Fuzzy

In fuzzy mode, users can input dates in various formats (e.g., `YYYY-MM-D`, `YYYY-M-DD`) which are interpreted using the `area17/parse-numeric-date` library. This is helpful when you want to give users flexibility in entering dates without enforcing strict formatting.

### Strict

Strict mode requires users to manually enter a date in the `YYYY-MM-DD` format. Any deviation will trigger a validation error. This mode is typically used when strict date validation is required, such as for official forms or systems.

## Accessibility

-   The label element provides an accessible description of the date input field, which is critical for screen readers.
-   The name prop ensures that the label is properly linked to the input field using the for attribute.
-   If an error is present, an error message is displayed for visual feedback, helping users correct any issues.
-   The readonly and disabled attributes ensure that non-interactive fields are announced correctly by assistive technologies.
