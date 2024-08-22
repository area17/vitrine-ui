The `CheckboxGroup` component is a container for a group of checkboxes, allowing users to select multiple options from a list. It includes a legend for the group, and handles optional hint and note texts.

## Usage

```html
<x-vui-form-checkbox-group
    legend="Sizes"
    :options="[
        ['label' => 'Small', 'name' => 'small', 'value' => 'small'],
        ['label' => 'Medium', 'name' => 'medium', 'value' => 'medium'],
        ['label' => 'Large', 'name' => 'large', 'value' => 'large']
    ]"
    :disabled="false"
    :required="true"
    hint="Select one or more sizes"
    note="Required field"
/>
```

## Accessibility
The CheckboxGroup component uses a `fieldset` with a `legend` to group and label related checkboxes, enhancing accessibility. It manages accessibility through `ARIA` attributes, such as `aria-describedby`, for hint and note texts. Ensure that each checkbox within the group has a meaningful label and appropriate name for form submission and user interaction.

## Theming

### Config

```json
{
  "rules": {
    "merge": [
      "input"
    ]
  },
  "base": [
    "m-input"
  ],
  "wrapper": [
    "flex flex-row flex-nowrap justify-between items-baseline gap-gutter"
  ],
  "list": [
    "space-y-24"
  ],
  "list-item": "",
  "hint": ["f-ui-2 text-secondary"],
  "note": ["f-ui-2 text-secondary mt-12"]
}
```
`base`: 
Applied to the main `fieldset` element of the checkbox group.

`wrapper`: 
Applied to the container holding the legend and hint elements.

`list`: 
Applied to the `ol` element that contains the list of checkboxes.

`list-item`: 
Applied to each `li` element containing a checkbox.

`hint`: 
Applied to the hint text element associated with the checkbox group.

`note`: 
Applied to the note text element below the checkbox group.