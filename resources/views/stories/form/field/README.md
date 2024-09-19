The `Field` component create a form field. It supports customization with various attributes to control its appearance, behavior, and selection options.

Any additional attributes are merged with the component's existing attributes, allowing you to add IDs, behaviors, data attributes, etc.

## Usage

```html
 <x-vui-form-field
    label="Full Name"
    type="text"
    name="name"
    id="name"
    :disabled="false"
    :required="true"
    placeholder="John Doe"
    error="This field is required."
    hint="Please enter your full name"
    note="Required field"
    form="registration"
    :autocomplete="false"
    :readonly="false"
/>
```

## Accessibility
If the input element is required or contains an error, the appropriate attributes (e.g., aria-required, aria-invalid) are added for accessibility.

Hint and note texts are associated with the input using aria-describedby, ensuring screen readers convey the necessary information to users. Additionally, `aria-live` may be used to dynamically inform users of changes in available options.

## Theming

### Config

```json
{
  "rules": {
    "merge": ["input"]
  },
  "base": "m-input [inert]:opacity-25 [inert]:cursor-not-allowed [inert]:pointer-events-none [&.s-disabled]:pointer-events-none [&.s-disabled]:opacity-25 [&.s-disabled]:cursor-not-allowed",
  "header": "flex flex-row flex-nowrap justify-between items-baseline gap-gutter",
  "legend": "f-subhead-3",
  "wrapper": "relative mt-4 border [.s-readonly_&]:border-quaternary [.s-error_&]:border-error [.s-readonly_&]:bg-quaternary",
  "input": "p-12 w-full f-body-1 [.s-readonly_&]:bg-transparent",
  "input-icon-right": "pr-40",
  "hint": "f-ui-2 text-secondary",
  "note": "f-ui-2 text-secondary mt-4",
  "link": "",
  "error": "mt-4 f-body-1 text-error flex items-center gap-4",
  "error-icon-name": "warning"
}
```

`base`:
Applied to the main container of the field component.

`header`:
Applied to the div that precedes the input element, containing the label and hint text.

`wrapper`:
Applied to the container that wraps both the input element and its label.

`input`:
Applied to the visual input element itself.

`input-icon-right`:
Additionnal style applied to the input element if withIconRight boolean is true

`hint`:
Applied to the text element that provides additional guidance or clarification about the input element.

`note`:
Applied to the text element that provides supplementary information about the input element.

`error`:
Applied to the text element that displays error messages related to the input element.

`error-icon-name`:
Defines the icon displayed within the error message.