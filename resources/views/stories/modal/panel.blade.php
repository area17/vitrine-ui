@storybook([])

<x-vui-button data-modal-target="#modalDemo"
              variant="primary">
    Open Modal
</x-vui-button>

<x-vui-modal id="modalDemo"
             :panel="true">
    <div class="container">
        <h1 data-Modal-initial-focus
            tabindex="-1">Modal Demo Component</h1>

        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui. Nulla vitae elit libero, a
            pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus
            varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod.</p>

        <div class="mt-12">
            <button>Focusable Element 1</button>
        </div>

        <div class="mt-12">
            <button>Focusable Element 2</button>
        </div>
    </div>
</x-vui-modal>
