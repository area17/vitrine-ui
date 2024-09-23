The `RadioGroup` component organizes a set of radio buttons, allowing users to select one option from the group. It includes a legend for labeling the group and supports optional hint and note texts.

## Usage

```html
<x-vui-form-radio-group
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

The `RadioGroup` component uses a `fieldset` and `legend` to group related radio buttons, improving accessibility. It includes `ARIA` attributes such as `aria-describedby` to associate hint and note texts with the group. Each radio button should have a clear label and the same name attribute to ensure proper form submission and user interaction.

## Theming

### Config

```json
{
    "rules": {
        "merge": ["input"]
    },
    "base": ["m-input"],
    "wrapper": [
        "flex flex-row flex-nowrap justify-between items-baseline gap-gutter"
    ],
    "list": ["space-y-24"],
    "list-item": "",
    "hint": ["f-ui-2 text-secondary"],
    "note": ["f-ui-2 text-secondary mt-12"]
}
```

`base`:
Applied to the main `fieldset` element of the radio group.

`wrapper`:
Applied to the container holding the legend and hint elements.

`list`:
Applied to the `ol` element that contains the list of radio buttons.

`list-item`:
Applied to each `li` element containing a radio button.

`hint`:
Applied to the hint text element associated with the radio group.

`note`:
Applied to the note text element below the radio group.
