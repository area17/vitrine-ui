@props([
    'sources' => null,
    'aspectRatio' => '16/9',
    'controlMute' => false,
])

@isset($sources)
    <div
        {{ $attributes->class(['relative', 'overflow-hidden', 'w-full', 'h-full', 'aspect-'. $aspectRatio]) }}
    >
        <div
            class="relative w-full h-full"
            data-behavior="VideoBackground"
            data-VideoBackground-text-pause="{{ __('vitrine-ui::fe.pause') }}"
            data-VideoBackground-text-play="{{ __('vitrine-ui::fe.play') }}"
            data-VideoBackground-text-mute="{{ __('vitrine-ui::fe.mute') }}"
            data-VideoBackground-text-unmute="{{ __('vitrine-ui::fe.unmute') }}"
        >
            <div class="absolute z-10 bottom-12 right-12 flex">
                @if($controlMute)
                    <x-vui-button-icon
                        class="flex"
                        aria-label="{{ __('vitrine-ui::fe.unmute') }}"
                        data-VideoBackground-mute=""
                    >
                        <x-vui-icon name="speaker-24" class="hidden" data-VideoBackground-icon-mute="" />
                        <x-vui-icon name="speaker-off-24" data-VideoBackground-icon-unmute="" />
                    </x-vui-button-icon>
                @endif

                <x-vui-button-icon
                    class="flex ml-8"
                    aria-label="{{ __('vitrine-ui::fe.pause') }}"
                    data-VideoBackground-pause=""
                >
                    <x-vui-icon name="play-24" class="hidden" data-VideoBackground-icon-play />
                    <x-vui-icon name="pause-24" data-VideoBackground-icon-pause />
                </x-vui-button-icon>
            </div>

            <div
                class="relative w-full h-full"
            >
                <video
                    playsinline
                    autoplay
                    loop
                    muted
                    class="absolute inset-0 w-full h-full object-cover video-js"
                    data-VideoBackground-player=""
                >
                    @foreach ($sources as $source)
                        <source
                            type="{{ $source['type'] }}"
                            src="{{ $source['src'] }}"
                        />
                    @endforeach
                </video>
            </div>
        </div>
    </div>
@endisset
