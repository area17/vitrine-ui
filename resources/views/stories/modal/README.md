The modal component allows you to wrap any content in a centered overlay or side-revealing panel. When opening the modal the body scroll will be locked using [body-scroll-lock](https://www.npmjs.com/package/body-scroll-lock) and traps focus to the modal content using [focus-trap](https://www.npmjs.com/package/focus-trap).

The only required props are the `id` and the `title` (unless the `title` is defined in the modal content and in which case the `title` prop is not required). This `id` is used to reference the modal when opening and closing and is also used for aria attributes within the modal.

The modal component requires a `h1` element which can be implemented as an off-screen heading by using the `title` prop or it can be included in the `slot` content. Note that if the `h1` is being included in the slot content make sure it meets the requirements of the checklist below and includes the `data-Modal-initial-focus` attribute and an `id` following the pattern `{{ $id }}_title` where the `$id` matches the `id` prop for the modal.

By default the modal component includes a close button using the `vui-button-icon` component. You can also use a custom close button using the `closeButton` slot. Note that if using a custom button it must meet the requirements below and also include teh `data-Modal-close-trigger` attribute.

The layout of the modal can be changed between a centered overlay or a side-revealing panel using the `panel` prop. Setting it to `true` enables the panel layout. It defaults to `false`.

## Usage

```
<button data-modal-target="#modalDemo">
    Open Modal
</button>

<x-organisms.modal id="modalDemo" title="Modal Component Demo">
    ...
</x-organisms.modal>
```

### Opening

To open the modal component use a `button` with the `data-modal-target="$modalId"` where `$modalId` is the `id` prop on the modal you want to open. The modal can also be opened by triggering the `Modal:open` or `Modal:toggle` (when closed) events on the modal node.

### Closing

To close the modal use a `button` with the `data-Modal-close-trigger` attribute inside the modal component (supports multiple close buttons). The modal can also be closed by triggering the `Modal:close` event on the modal node, `Modal:closeAll` event on the `document` or by pressing the escape key. If the modal is set to the panel layout you can also click outside the content area to close the modal.

## Customization

The modal uses custom css to handle the layout and transitions. It can be found in `resources/frontend/styles/organisms/modal.css`.

## Modal Accessibility Checklist

​
Despite there being many ways to implement a modal dialog component in code, the accessibility requirements remain constant. All of the following must be met:
`

-   The control to open/invoke the modal (the modal trigger) must be marked up as a `button` or otherwise have an accessible role of button with all expected button behavior.
-   When the modal is invoked, **focus must be managed so that users are aware of the new content** and don’t have to navigate through the page to find it. In short, this means either placing keyboard focus on the dialog’s top close button, a title heading inside the modal (which should be marked up as an `h1` with `tabindex="-1"`), or another interactive control such as the first `input` on a form.
-   Users must be able to dismiss the modal using at least one (but preferably two) in-dialog close buttons. That is, a close button at the top and another at the bottom. They must also be able to dismiss it via the `esc` key. In this context, “dismissal” implies cancellation and no data persistence or other unexpected actions.
-   When the dialog is no longer displayed, be that via dismissal or some form of data submission, **keyboard focus must be automatically placed back on the triggering button** (or a sensible control close to the original trigger if it no longer exists in the DOM for some reason). This should happen before the modal and its elements are hidden/removed from the DOM.
-   If a modal is invoked automatically (which is not recommended), the user’s keyboard focus position must be stored prior to invocation, and then restored once the dialog has been dismissed. Again, this should happen before the dialog itself is removed from the DOM.
-   Modal dialogs **must have an accessible name and a title**. This is most easily achieved by rendering an `h1` at the top of the dialog content, giving it a unique ID and then using that ID as the value of an aria-labelledby attribute on the modal container.
-   The modal container **must include a role of “dialog” and an aria-modal attribute set to “true”**.
-   While the modal is open, **a keyboard user’s interaction must be confined to the contents of the modal**. This means implementing a “focus trap”, whereby pressing Tab and Shift+Tab will always cycle keyboard focus when the first or last element currently has focus. In other words, a user should be able to endlessly press Tab to move through all focusable elements of the dialog in a ring, without moving out of the modal and into the parent page or browser’s chrome area. If a dialog only contains zero or one focusable elements, Tab and Shift+Tab should do nothing.

In addition to the above, **all content inside the modal must be accessible in all of the ways which are true for content on the parent page**. Of note is that as a modal is a distinct context from the parent document, and as such the heading hierarchy should reset back to level 1 but otherwise follow standard heading-related practices.
