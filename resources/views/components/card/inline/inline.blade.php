<div {{ $attributes->class('pt-space-5 border-t border-tertiary') }}>
    @isset($href)
        <a
            href="{{ $href }}"
            target="{{ $isExternalUrl($href) ? '_blank' : '' }}"
            class="block group"
        >
    @endisset
        <div class="cols-container">
            <div class="flex flex-col w-6-cols md:w-8-cols xl:w-7-cols">
                @isset($title)
                    <x-vui-heading
                        :level="$headingLevel"
                        class="f-subhead-3 transition-all"
                    >
                        {!! $title !!}
                    </x-vui-heading>
                @endisset

                @isset($description)
                    <div class="mt-space-3 f-ui-2 text-primary">
                        {!! $description !!}
                    </div>
                @endisset

                @isset($date)
                    <p class="mt-space-3 f-ui-2 text-secondary">
                        {{ $date }}
                    </p>
                @endisset

                <div class="mt-auto pt-space-3">
                    <x-vui-link variant="secondary"
                        :static="true"
                    >
                        {{ __('vitrine-ui::fe.read_more') }}
                    </x-vui-link>
                </div>
            </div>

            @if(isset($media) && !empty($media))
                <div class="w-6-cols md:w-4-cols mt-32 md:mt-0 xl:ml-1-cols">
                    <x-vui-media
                        :image="$media['image']"
                        image-preset="card_inline"
                    />
                </div>
            @endif
        </div>
    @isset($href)
        </a>
    @endisset
</div>
