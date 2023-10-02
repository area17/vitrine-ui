@props([
    'sources' => null,
    'aspectRatio' => '16/9',
    'controlMute' => false,
])

@isset($sources)
    <div {{ $attributes->class(['relative', 'overflow-hidden', 'w-full', 'h-full', 'aspect-' . $aspectRatio]) }}>
        <div class="relative h-full w-full"
             data-behavior="VideoBackground"
             data-VideoBackground-text-pause="{{ __('vitrine-ui::fe.pause') }}"
             data-VideoBackground-text-play="{{ __('vitrine-ui::fe.play') }}"
             data-VideoBackground-text-mute="{{ __('vitrine-ui::fe.mute') }}"
             data-VideoBackground-text-unmute="{{ __('vitrine-ui::fe.unmute') }}">
            <div class="absolute bottom-12 right-12 z-10 flex">
                @if ($controlMute)
                    <x-vui-button class="flex"
                                  data-VideoBackground-mute=""
                                  aria-label="{{ __('vitrine-ui::fe.unmute') }}"
                                  icon-only>
                        <x-vui-icon class="hidden"
                                    name="speaker-24"
                                    data-VideoBackground-icon-mute="" />
                        <x-vui-icon name="speaker-off-24"
                                    data-VideoBackground-icon-unmute="" />
                    </x-vui-button>
                @endif

                <x-vui-button class="ml-8 flex"
                                   icon-only
                                   data-VideoBackground-pause=""
                                   aria-label="{{ __('vitrine-ui::fe.pause') }}">
                    <x-vui-icon class="hidden"
                                name="play-24"
                                data-VideoBackground-icon-play />
                    <x-vui-icon name="pause-24"
                                data-VideoBackground-icon-pause />
                </x-vui-button>
            </div>

            <div class="relative h-full w-full">
                <video class="video-js absolute inset-0 h-full w-full object-cover"
                       data-VideoBackground-player=""
                       playsinline
                       autoplay
                       loop
                       muted>
                    @foreach ($sources as $source)
                        <source src="{{ $source['src'] }}"
                                type="{{ $source['type'] }}" />
                    @endforeach
                </video>
            </div>

            {{ $slot ?? null }}
        </div>
    </div>
@endisset
