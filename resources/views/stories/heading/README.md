This is a basic heading component. You pass the heading level as a value between `1` and `6` to render a `h1` through `h6` and any value outside of that range will render a `span`. Any attribute added to the component will be passed to the rendered element.

But why do we need a dynamic component to handle headings? Writing `<h1>` is much simpler than writing `<x-vui-heading :level="1">`, right? Using a dynamic heading component allows components to control their own hierarchy. The idea is that every component supports a `headingLevel` prop and this prop is used within the component to define the heading level within it and then passed to any child components either by incrementing it by `+1` or by passing the original prop. This allows us to set a heading level at the highest level (usually the page layout) and then it all trickles down through the components, resulting in a valid heading hierarchy.

This is important for accessibility because screen readers can use heading hierarchy to scan through a document by jumping between the sibling heading levels and then drilling down by heading level into a section of the page to find the content they're interested in. This means that if your heading level is off, the page becomes very difficult for screen reader users to navigate as well as other non-a11y related issues.

## Usage

```html
<x-vui-heading :level="2">
    Some Heading Text
</x-vui-heading>
```
