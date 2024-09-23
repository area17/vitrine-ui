The `Upload` component allows users to upload files via a form. It supports customization options for accepted file types, maximum file size, and various behaviors such as enabling multiple file selection, validation messages, and more.

## Usage

```html
<x-vui-form-upload
    label="Upload File"
    name="file-upload"
    id="file-upload"
    :fileSize="5"
    :allowed="'image/png, image/jpeg'"
    :disabled="false"
    :readonly="false"
    :required="true"
    hint="Select a file to upload"
    note="Only PNG and JPEG files are allowed."
    :multiple="true"
    :autofocus="true"
    :error="'Please upload a valid file.'"
/>
```

## Accessibility

The `Upload` component uses ARIA attributes to enhance accessibility. It includes `aria-describedby` to associate any hint, error, or note texts with the file input. If an error occurs or additional information is needed, screen readers will convey these details to the user.

The label provides an accessible name for the file input, and `aria-live` is used to notify users of any dynamic updates related to selected files, errors, or successful uploads.
