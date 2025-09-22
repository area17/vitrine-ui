@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'args' => [
        'title' => 'Tabs',
        'name' => 'faq',
        'tabsNames' => ['Tab label 01', 'Tab label 02', 'Testing Longer Tab label 03'],
        'titleLevel' => 3,
        'contents' => ['<p>Content 1: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur officiis ex! Reprehenderit, sunt accusamus.</p>', '<p>Content 2: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur officiis ex! Reprehenderit, sunt accusamus.</p>', '<p>Content 3: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur officiis ex! Reprehenderit, sunt accusamus.</p>'],
    ],
])

<x-vui-tabs :title="$title"
            :name="$name"
            :tabs-names="$tabsNames"
            :title-level="$titleLevel">
    @foreach ($contents as $content)
        <x-vui-tabs-panel :name="$name"
                          :index="$loop->index"
                          :selected="$loop->first">
            {!! $content !!}
        </x-vui-tabs-panel>
    @endforeach
</x-vui-tabs>
