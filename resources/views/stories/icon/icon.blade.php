@storybook([
'status' => 'stable',
'layout' => 'fullscreen',
'preset' => 'icons.all'
])

<div class="container">
    <div class="wysiwyg">
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
</div>
