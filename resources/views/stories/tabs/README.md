The tabs component renders a list with button to show/hide an active content defined into the slot.
Each component must be defined using the tabs-panel component with the same $name so ids are matching between panels and buttons.

In the example below, the `$tabNames` array will define the label for each buttons and the `$contents` Array will define the iner content of each panel.

## Usage

```html
<x-vui-tabs 
    :title="$title" 
    :name="$name" 
    :tabs-names="$tabsNames" 
    :title-level="$titleLevel"
>
    @foreach ($contents as $content)
        <x-vui-tabs-panel :name="$name"
                          :index="$loop->index"
                          :selected="$loop->first">
            {{ $content }}
        </x-vui-tabs-panel>
    @endforeach
</x-vui-tabs>
```

## Accessibility

The markup and the JS behavior are based on https://www.w3.org/WAI/ARIA/apg/patterns/tabs/examples/tabs-manual/
Hidden panels are not focusable, when selecting a tab the content is getting focused.

You can navigate using keyboard :

`Right Arrow`:
When a tab has focus: Moves focus to the next tab.
If focus is on the last tab, moves focus to the first tab.

`Left Arrow`:
When a tab has focus:
Moves focus to the previous tab.
If focus is on the first tab, moves focus to the last tab.

## Theming

### Config

```json
{
  "base": "container",
  "title": "f-heading-03 w-full",
  "tabList": ""
}
```

`title`:
Style of the main tab component title

`tabList`:
Visual styling for the wraper element for the list of tab buttons

### Config for tab panel

```json
{
  "base": ""
}
```

You can also set some default styling for the tab panels wrapper div.
