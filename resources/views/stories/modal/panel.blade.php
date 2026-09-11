@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'args' => [
        'showClose' => true,
        'title' => 'Modal Demo Component',
    ],
])

<x-vui-button data-modal-target="#modalDemo"
              variant="primary">
    Open Modal
</x-vui-button>

<x-vui-modal id="modalDemo"
             :title="$title"
             :panel="true"
             :show-close="$showClose">
    <div class="px-gutter wysiwyg py-60">
        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui. Nulla vitae elit
            libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed
            diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod.</p>

        <div class="mt-12">
            <button>Focusable Element 1</button>
        </div>

        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui. Nulla vitae elit
            libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed
            diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod.</p>

        <div class="mt-12">
            <button>Focusable Element 2</button>
        </div>

        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui. Nulla vitae elit
            libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed
            diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod.</p>
    </div>
</x-vui-modal>
