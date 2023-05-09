@storybook([
    'status' => 'readyForQA',
    'args' => [
        'items' => [
            [
                'title' => 'Cras justo odio, dapibus ac facilisis in',
                'wysiwyg' => '<p>Donec suscipit, ligula et maximus viverra, diam lectus tempor eros, quis ultrices lorem tortor at augue. Praesent ornare eleifend mauris. Mauris lectus tortor, ultricies vitae justo vitae, porta aliquam est. Donec sagittis id leo at finibus. Sed at tincidunt nisi. Cras nec justo lorem. Pellentesque lobortis vulputate ante ac accumsan. Nullam mollis, ligula ac elementum gravida, urna lacus vestibulum dui, sed rutrum tellus felis efficitur nisl. Vestibulum aliquet, eros sed ullamcorper cursus, metus ligula accumsan purus, sit amet vulputate libero justo et nunc.</p>',
                'cta' => [
                    'href' => '#',
                    'text' => 'Learn more'
                ]
            ],
            [
                'title' => 'Nulla vitae elit libero, a pharetra augue',
                'wysiwyg' => '<p>Rhoncus at tincidunt euismod sed aliquet habitasse at. Convallis fermentum nunc malesuada donec. Mattis ligula viverra proin egestas. Nisl faucibus amet, integer quam cursus amet tellus neque scelerisque.</p><h4>Varius metus cursus</h4><p>Eget maecenas montes, sagittis est. Phasellus ullamcorper eu in tortor nullam nulla at. Pharetra, dictum netus lorem fermentum faucibus ornare. Volutpat consequat congue amet at donec pellentesque neque. Sit sed feugiat tristique in.</p><h4>Ligula Viverra amet</h4><p>Et aliquam condimentum ut mauris, enim ut. Adipiscing aliquet ullamcorper suspendisse id ut tortor. Nisl et vel purus enim blandit interdum nunc congue. Et massa aliquet ultricies in aliquet.</p>',
                'cta' => [
                    'href' => '#',
                    'text' => 'Learn more'
                ]
            ],
            [
                'title' => 'Donec ullamcorper nulla non metus',
                'wysiwyg' => '
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget <em>lacinia odio</em> sem nec elit. Nullam quis risus eget <strong>urna mollis</strong> ornare vel eu leo. Donec sed odio dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras <a href="#">mattis consectetur</a> purus sit amet fermentum.</p><p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur.</p><p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae\, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p><ul><li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li><li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li><li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li><li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li></ul><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><h2>Header Level 2</h2><ol><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li><li>Vestibulum auctor dapibus neque.</li></ol><h3>Header Level 3</h3><p>Maecenas sed diam eget risus varius blandit sit amet non magna. Curabitur blandit tempus porttitor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p><h4>Header Level 4</h4><p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p><h5>Header Level 5</h5><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec ullamcorper nulla non metus auctor fringilla. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Etiam porta sem malesuada magna mollis euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Nullam id dolor id nibh ultricies vehicula ut id elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>',
                'cta' => [
                    'href' => '#',
                    'text' => 'Learn more'
                ]
            ]
        ]
    ]
])

<div class="w-screen" style="margin-left: -1rem">
    <div class="container pt-32 md:pt-64">
        <div class="w-6-cols md:w-12-cols">
            <x-vui-accordion>
                @foreach ($items as $item)
                    <x-vui-accordion-item
                        :title="$item['title'] ?? null"
                        :index="$loop->index"
                        :set-fixed-height="false"
                    >
                        <x-vui-wysiwyg>
                            {!! $item['wysiwyg'] !!}
                        </x-vui-wysiwyg>

                        <x-vui-link-primary
                            :href="$item['cta']['href']"
                            class="mt-space-5"
                        >
                            {{ $item['cta']['text'] ?? 'Learn more' }}
                        </x-vui-link-primary>
                    </x-vui-accordion-item>
                @endforeach
            </x-vui-accordion>
        </div>
    </div>
</div>
