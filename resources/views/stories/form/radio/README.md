This is a basic radio component that enables users to choose a single option from a list within a form. The component can be customized with various attributes to adjust its appearance and functionality. To group radio buttons together, they should share the same name attribute, ensuring only one option can be selected at a time.

Any additional attributes are merged with the component's existing attributes to allow you to add IDs, behaviors, data attributes, etc., to the component.

## Usage

```html
<x-vui-form-radio
    label="Yes"
    name="subscribe"
    id="yes"
    value="yes"
    :disabled="false"
    :selected="true"
    :inputAttr="'data-custom-attr=true'"
    :autofocus="true"
    form="registration"
/>
```

## Accessibility
Radio buttons should always have an accessible name. The label provided is used as the accessible name for the radio button. Additionally, if the radio button is required, selected, or has an error, the relevant attributes are automatically added to enhance accessibility.

If there are errors or additional notes (hints) associated with the radio button, they are linked to the radio element using `aria-describedby` for screen readers.

## Theming

### Config

```json
{
  "rules": {
    "merge": ["input"]
  },
  "base":  [
    "m-form-radio cursor-pointer group"
  ],
  "wrapper": [
    "m-form-radio-wrap",
    "flex items-center space-x-8"
  ],
  "label": [
    "m-form-radio-label",
    "f-body-1 inline-flex relative"
  ],
  "check": [
    "m-form-radio-check",
    "w-24 h-24 rounded-full relative",
    "before:absolute before:content-['']",
    "before:w-12 before:h-12 before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2",
    "before:rounded-full",
    "before:transition-colors before:duration-300 before:ease--out",
    "before:border-[1px] before:border-[#989EA3]",
    "peer-checked:before:bg-[black] peer-checked:before:border-[black]",
    "group-hover:before:border-[black]",
    "peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2"
  ],
  "input": [
    "absolute w-1 h-1",
    "border-0 p-0 -m-1",
    "overflow-hidden whitespace-nowrap",
    "peer",
    "focus:outline-none",
    "[clip:rect(0,0,0,0)]"
  ],
  "hint": [
    "m-form-radio-hint",
    "f-ui-2 text-secondary"
  ]
}
```

`base`:
Applied to the main container of the radio component.

`wrapper`:
Applied to the direct container of the radio button and its label.

`label`:
Applied to the label element that describes the radio button.

`check`:
Applied to the visual radio button element itself.

`input`:
Applied to the actual HTML input element linked to the radio button.

`hint`:
Applied to the text element that provides additional information about the radio button.