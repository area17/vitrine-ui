The `Textarea` component is designed to provide a multi-line text input field, allowing users to enter longer pieces of text. It offers various customization options to control its appearance and behavior, including attributes for validation, accessibility, and user interaction.

## Usage

```html
<x-vui-form-textarea
    label="Questions"
    name="questions"
    id="questions"
    value="Enter your questions here"
    disabled="false"
    required="true"
    placeholder="Type here..."
    error="This field is required."
    hint="Please provide your detailed questions."
    note="You can ask multiple questions if needed."
    autocomplete="on"
    autofocus="true"
    form="feedback-form"
    maxlength="500"
    minlength="10"
    readonly="false"
    spellcheck="true"
    wrap="soft"
/>
```

## Accessibility
The `Textarea` component uses the `label` and `name` attributes to associate the label with the text area, improving accessibility for screen readers and other assistive technologies. 

If the field is required, an appropriate indicator is added to the label, and if there are errors or hints, they are linked to the textarea using `aria-describedby`.

## Theming

### Config

```json
{
  "textarea": ""
}
```

`textarea`:
Applied to the textarea element.