The `Label` component provides a way to associate text with a form field. It ensures that form fields have clear labels, improving both user experience and accessibility. The label can display an optional "required" marker.

## Usage

```html
<x-vui-form-label name="username" required="true"> Username </x-vui-form-label>
```

## Accessibility

This component uses the `for` attribute to associate the label with a form element. It's important for screen readers and other assistive technologies, allowing users to understand which input the label refers to. Therefore, always ensure the `name` prop is set to a value that matches the ID of the corresponding form element.

If the field is required, the component appends a "required" indicator to the label, providing visual feedback to users.

## Theming

### Config

```json
{
    "label": "block f-body-1 font-medium"
}
```

`label`:
Applied to the label element.
