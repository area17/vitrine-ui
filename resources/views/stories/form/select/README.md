The `Select` component allows users to choose an option from a dropdown list. It supports customization with various attributes to control its appearance, behavior, and selection options.

Any additional attributes are merged with the component's existing attributes, allowing you to add IDs, behaviors, data attributes, etc.

## Usage

```html
<x-vui-form-select
    label="Choose a city"
    name="city"
    id="city"
    :disabled="false"
    :required="true"
    :options="[
        ['value' => 'New York'],
        ['value' => 'Paris'],
        ['value' => 'Other']
    ]"
    placeholder="New York"
    error="This field is required."
    hint="Please select an option"
    note="Required field"
    form="registration"
    :autocomplete="false"
    :autofocus="false"
    :multiple="false"
    :readonly="false"
/>
```

## Accessibility

The `Select` component ensures that each dropdown has an accessible name provided by the label. If the select element is required or contains an error, the appropriate attributes (e.g., aria-required, aria-invalid) are added for accessibility.

Hint and note texts are associated with the dropdown using aria-describedby, ensuring screen readers convey the necessary information to users. Additionally, `aria-live` may be used to dynamically inform users of changes in available options.

## Theming

### Config

```json
{
    "rules": {
        "merge": ["select"]
    },
    "base": "[inert]:opacity-25 [inert]:cursor-not-allowed [inert]:pointer-events-none [&.s-disabled]:pointer-events-none [&.s-disabled]:opacity-25 [&.s-disabled]:cursor-not-allowed",
    "header": "flex flex-row flex-nowrap justify-between items-baseline gap-gutter",
    "wrapper": "relative mt-4 border [.s-readonly_&]:border-quaternary [.s-error_&]:border-error [.s-readonly_&]:bg-quaternary",
    "select": "p-12 pr-36 w-full f-body-1 appearance-none [.s-readonly_&]:bg-transparent",
    "icon": "absolute top-1/2 right-[8px] -translate-y-1/2 pointer-events-none",
    "icon-name": "chevron-down-24",
    "hint": "f-ui-2 text-secondary",
    "note": "f-ui-2 text-secondary mt-4",
    "error": "mt-4 f-body-1 text-error flex items-center gap-4",
    "error-icon-name": "warning"
}
```

`base`:
Applied to the main container of the select component.

`header`:
Applied to the div that precedes the select element, containing the label and hint text.

`wrapper`:
Applied to the container that wraps both the select element and its label.

`select`:
Applied to the visual select element itself.

`icon`:
Applied to the icon used as a visual indicator for the dropdown.

`icon-name`:
Defines the icon displayed within the select component.

`hint`:
Applied to the text element that provides additional guidance or clarification about the select element.

`note`:
Applied to the text element that provides supplementary information about the select element.

`error`:
Applied to the text element that displays error messages related to the select element.

`error-icon-name`:
Defines the icon displayed within the error message.
