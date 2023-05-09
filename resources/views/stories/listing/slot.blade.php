@storybook([
    'status' => 'readyForQA',
    'layout' => 'fullscreen',
    'preset' => 'listing.base',
])

@php
    switch($layout){
        case '1up':
            $listItemCount = 1;
        break;

        case '2up':
            $listItemCount = 2;
        break;

        case '2up-left':
        case '2up-right':
            $listItemCount = 4;
        break;

        case '3up':
        case '3up-portait':
            $listItemCount = 3;
        break;

        case '4up':
            $listItemCount = 4;
        break;

        default:
            $listItemCount = 6;
        break;
    }

    $items = array_slice(array_merge($items, $items, $items), 0, $listItemCount);
@endphp

<div class="w-screen max-w-full max-auto">
    <x-vui-listing
        :layout="$layout ?? null"
        :items="$items ?? null"
    >
        @foreach ($items as $item)
            <li
                class="{{ $component->itemClasses($loop->index) }}"
            >
                <div class="p-12 bg-quaternary">
                <x-vui-heading :level="3">{{ $item['title'] ?? null }}</x-vui-heading>
            </li>
        @endforeach
    </x-vui-listing>
</div>
