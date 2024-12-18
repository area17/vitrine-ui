This is a basic checkbox component. It allows the user to select or deselect an option in a form. The checkbox component can be customized with various attributes to control its appearance and behavior.

Any additional attributes are merged with the component's existing attributes to allow you to add IDs, behaviors, data attributes, etc., to the component.

## Usage

```html
<x-vui-form-checkbox
    label="Accept Terms"
    name="terms"
    id="terms"
    value="accepted"
    :disabled="false"
    :required="true"
    :selected="true"
    :error="'This field is required.'"
    hint="Please accept the terms and conditions."
    note="You can unsubscribe at any time."
    :inputAttr="'data-custom-attr=true'"
    :autofocus="true"
    form="registration"
/>
```

## Accessibility

Checkboxes should always have an accessible name. The label provided is used as the accessible name for the checkbox. Additionally, if the checkbox is required, selected, or has an error, the relevant attributes are automatically added to enhance accessibility.

If there are errors or additional notes (hints) associated with the checkbox, they are linked to the checkbox using `aria-describedby` for screen readers.

## Theming

### Config

```json
{
    "rules": {
        "merge": ["input"]
    },
    "base": ["m-form-checkbox cursor-pointer"],
    "wrapper": ["m-form-checkbox-wrap", "flex items-center space-x-8"],
    "label": ["m-form-checkbox-label", "f-body-1 inline-flex relative"],
    "required": "sr-only",
    "check": [
        "m-form-checkbox-check",
        "peer",
        "w-24 h-24 rounded-sm relative",
        "shadow-[0_0px_0px_1px_rgba(0,0,0,1)]",
        "transition-colors duration-300 ease-out",
        "peer-checked:bg-[black]",
        "peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2"
    ],
    "checkmark": [
        "checkmark",
        "absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2",
        "text-[white]"
    ],
    "input": [
        "absolute w-1 h-1",
        "border-0 p-0 -m-1",
        "overflow-hidden whitespace-nowrap",
        "peer",
        "focus:outline-none",
        "[clip:rect(0,0,0,0)]"
    ],
    "hint": ["m-form-checkbox-hint", "f-ui-2 text-secondary"]
}
```

`base`:
Applied to the main container of the Checkbox component.

`wrapper`:
Applied to the direct container of the checkbox and its label.

`label`:
Applied to the label element that describes the checkbox.

`required`:
Applied to the children of the label element added if field is required.

`check`:
Applied to the visual checkbox element itself.

`checkmark`:
Applied to the checkmark icon inside the checkbox.

`input`:
Applied to the actual HTML input element linked to the checkbox.

`hint`:
Applied to the text element that provides additional information about the checkbox.
