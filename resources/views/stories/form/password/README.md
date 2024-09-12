The `PasswordInput` component allows users to securely input passwords into a form. It includes a button to toggle password visibility and supports various customization options for attributes like placeholders, autocomplete, and error handling.

## Usage

```html
<x-vui-form-password
    label="Password"
    name="password"
    id="password"
    value=""
    placeholder="Enter your password"
    :disabled="false"
    :readonly="false"
    :required="true"
    :autofocus="true"
    hint="Your password must be 8-20 characters long."
    note="Make sure your password is strong."
    :error="'Please provide a valid password.'"
/>
```

## Accessibility
The `Password` component uses ARIA attributes to enhance accessibility. The `aria-describedby` attribute is used to associate the input field with its hint, note, or error messages. A toggle button is provided to show or hide the password, and this action is accompanied by visually hidden text (`sr-only`) for screen readers to indicate the state change.

Labeling and live error updates are handled through `aria-live` regions to ensure that users are informed of any issues with the input in real-time.