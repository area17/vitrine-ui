@storybook([
    'status' => 'stable',
    'layout' => 'fullscreen',
    'preset' => 'icons.all'
])

<x-docs-page title="Icons" description="Examples of the icons used within the project.">
    <div class="wysiwyg">
        <p>The icon component can be used to render an svg. The first time an icon is used it adds the icon to a sprite and then each usage renders the SVG reference inline.</p>

        <p>The icons are hidden from screen readers by default as in the majority of use-cases icons are decorative. If the icon is not decorative setting the <code>aria-label</code> attribute will remove <code>aria-hidden</code> and add a label to the icon.</p>

        <p>Below are examples of all of the icons included in the project along with the names to use to render them:</p>
    </div>

    @if(isset($icons) && !empty($icons))
        <ul class="grid gap-x-gutter gap-y-gutter grid-cols-1 md:grid-cols-3 xl:grid-cols-4 py-gutter mt-20">
            @foreach ($icons as $icon)
                <li class="flex flex-col justify-between items-center p-24 border border-primary">
                    <div class=" justify-center items-center">
                        <x-vui-icon :name="$icon" />
                    </div>

                    <code class="block mt-24">{{ $icon }}</code>
                </li>
            @endforeach
        </ul>
    @else
        <p>No Icons defined.</p>
    @endif
</x-docs-page>
