<div {{ $attributes->class('group') }}>
    @isset($href)
        <a
            href="{{ $href }}"
            target="{{ $isExternalUrl ? '_blank' : '' }}"
            class="block"
        >
    @endisset
        <div class="flex flex-col-reverse">
            <div class="mt-8 lg:mt-12">
                @isset($title)
                    <x-vui-heading
                        :level="$headingLevel"
                        class="{{ Arr::toCssClasses([
                            'f-subhead-1',
                            'underline underline-thickness-1 underline-transparent group-hover:underline-inherit transition-text-decoration' => isset($href) && !empty($href)
                        ]) }}"
                    >
                        {!! $title !!}
                    </x-vui-heading>
                @endisset

                @isset($description)
                    <p class="mt-2 lg:mt-4 f-ui-2 text-primary">
                        {{ $description }}
                    </p>
                @endisset
            </div>

            @if(isset($media) && !empty($media))
                <x-vui-media
                    :image="$media['image']"
                    :image-preset="$imagePreset"
                />
            @endif
        </div>
    @isset($href)
        </a>
    @endisset
</div>
