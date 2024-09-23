@storybook([
    'status' => 'stable',
    'layout' => 'fullscreen',
    'preset' => 'icons.all',
])

<div class="container">
    <div class="wysiwyg">
        <p>Below are examples of all of the icons included in the project along with the names to use to render them:
        </p>
    </div>

    @if (isset($icons) && !empty($icons))
        <ul class="mt-20 grid grid-cols-1 gap-x-gutter gap-y-gutter py-gutter md:grid-cols-3 xl:grid-cols-4">
            @foreach ($icons as $icon)
                <li class="flex flex-col items-center justify-between border border-primary p-24">
                    <div class="items-center justify-center">
                        <x-vui-icon :name="$icon" />
                    </div>
                    <code class="mt-24 block">{{ $icon }}</code>
                </li>
            @endforeach
        </ul>
    @else
        <p>No Icons defined.</p>
    @endif
</div>
