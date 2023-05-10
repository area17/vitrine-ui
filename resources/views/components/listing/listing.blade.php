@isset($items)

<div
    {{ $attributes->class($wrapperClasses()) }}
>
    <div class="{{ $scroll ? '-mx-outer-gutter px-outer-gutter overflow-x-auto' : '' }}">
        <ul
            class="{{ $listClasses() }}"
            {!! count($items) === 1 ? 'role="presentation"' : '' !!}
            data-list
        >
            @if ($slot->isNotEmpty())
                {!! $slot !!}
            @else
                @foreach ($items as $item)
                    <li
                        class="{{ $itemClasses($loop->index) }}"
                        {!! isset($id) ? 'id="List'. $id .'Item'. $loop->index .'"' : '' !!}
                        {!! count($items) === 1 ? 'role="presentation"' : '' !!}
                        data-list-item
                    >
                        @switch($cardType)
                            @case('inline')
                                <x-vui-card-inline
                                    :title="$item['title'] ?? null"
                                    :description="$item['description'] ?? null"
                                    :intro="$item['intro'] ?? null"
                                    :date="$item['date'] ?? null"
                                    :media="$item['media'] ?? null"
                                    :href="$item['href'] ?? null"
                                    :heading-level="$headingLevel + 1"
                                />
                            @break

                            @case('primary')
                                <x-vui-card-primary
                                    :title="$item['title'] ?? null"
                                    :description="$item['description'] ?? null"
                                    :media="$item['media'] ?? null"
                                    :href="$item['href'] ?? null"
                                    :heading-level="$headingLevel + 1"
                                    :image-preset="$imagePreset($loop->index)"
                                />
                            @break

                            @default
                                <!-- No CardType Set -->
                        @endswitch
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
@endisset
