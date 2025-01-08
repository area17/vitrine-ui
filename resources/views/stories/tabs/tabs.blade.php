@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'args' => [
        'title' => 'Tabs',
        'name' => 'tab',
        'tabsNames' => ['Tab 1', 'Tab 2', 'Tab 3'],
        'titleLevel' => 3,
    ],
])

<x-vui-tabs :title="$title"
            :name="$name"
            :tabs-names="$tabsNames"
            :title-level="$titleLevel">
    <div id="tab-panel-0">
        <p>Content 1: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus
            exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur
            officiis ex! Reprehenderit, sunt accusamus.</p>
    </div>
    <div id="tab-panel-1">
        <p>Content 2: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus
            exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur
            officiis ex! Reprehenderit, sunt accusamus.</p>
    </div>
    <div id="tab-panel-2">
        <p>Content 3: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo autem cum voluptatibus
            exercitationem ea explicabo eum deleniti repudiandae alias delectus nam minima, vel totam consectetur
            officiis ex! Reprehenderit, sunt accusamus.</p>
    </div>
</x-vui-tabs>
