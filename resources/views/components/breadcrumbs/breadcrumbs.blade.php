@if(filled($items))
    <div class="flex items-center mb-8">
        @foreach ($items as $item)
            @if ($item['href'] ?? null)
                <x-vui-link-secondary
                    :href="$item['href'] ?? null"
                >
                    {{ $item['text'] ?? '' }}
                </x-vui-link-secondary>
            @else
                <span class="f-ui-3 text-primary">
                    {{ $item['text'] ?? '' }}
                </span>
            @endif

            @if(!$loop->last)
                <span class="f-ui-3 text-primary mx-6">
                    /
                </span>
            @endif
        @endforeach
    </div>
@endif
