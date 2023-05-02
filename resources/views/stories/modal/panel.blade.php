@storybook([
])

<x-vui-button-primary
    data-modal-target="#modalDemo"
>
    Open Modal
</x-vui-button-primary>

<x-vui-modal
    id="modalDemo"
    :panel="true"
>
    <div class="container">
        <h1 tabindex="-1" data-Modal-initial-focus>Modal Demo Component</h1>

        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod.</p>

        <div class="mt-12">
            <button>Focusable Element 1</button>
        </div>

        <div class="mt-12">
            <button>Focusable Element 2</button>
        </div>
    </div>
</x-vui-modal>
