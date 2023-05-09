The accordion renders a list of titles and their respective expanding contents. The accordion is made up of 2 components, the parent and the child `item` component.

The parent accordion acts as a wrapper to set up the accordion behavior and set the heading level and a11y label. The `a11yLabel` prop populates an off screen heading tag and adds an `aria-labelledby` attribute to the accordion `ul`. It should contain a descriptive label for the accordion. The only child of the accordion component should be the `accordion.item` component.

The `accordion.item` renders text passed to the `title` prop, used in the button to open/close the item, and content passed to the `slot`.

### Accessibility

If using a `ul` around the accordion items it must be labelled by a heading element and if there's only one item in the accordion, both the `ul` and `li` need `role="presentation"`

```html
<h2 id="accordionLabel">Item Information</h2>

<ul aria-labelledby="accordionLabel" role="presentation">
    <li role="presentation">...</li>
</ul>
```

Each accordion item `button` trigger is wrapped by a heading one level higher than the main accordion label heading (above).

Can tab between items. Hidden body content in accordion items is ignored by tab & screen readers when closed

Set `aria-expanded=""` to `true` on the button when the content is expanded and `false` when closed.

For more info check out https://www.w3.org/WAI/ARIA/apg/patterns/accordion/
