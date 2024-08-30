@if(isset($src) || isset($sources))
    <div {{ $attributes->class([$ui('video-background', 'base', [
            'variant' => $variant
        ])]) }}
         data-behavior="{{ $behaviorName }}"
            {!! 'data-'.$behaviorName.'-text-pause="'.__('vitrine-ui::fe.pause').'"
            data-'.$behaviorName.'-text-play="'.__('vitrine-ui::fe.play').'"
            data-'.$behaviorName.'-text-mute="'.__('vitrine-ui::fe.mute').'"
            data-'.$behaviorName.'-text-unmute="'.__('vitrine-ui::fe.unmute').'"' !!}
    >
        <div class="{{$ui('video-background', 'wrapper')}}">
            <div class="{{$ui('video-background', 'controls')}}">
                @if ($controlMute)
                    <x-vui-button class="{{$ui('video-background', 'button')}}"
                                  :variant="$buttonVariant ?? null"
                                  data-VideoBackground-mute=""
                                  aria-label="{{ __('vitrine-ui::fe.unmute') }}"
                                  icon-only>
                        <x-vui-icon class="hidden"
                                    name="{{ $ui('video-background', 'unmute-icon-name') }}"
                                    data-VideoBackground-icon-mute=""/>
                        <x-vui-icon name="{{ $ui('video-background', 'mute-icon-name') }}"
                                    data-VideoBackground-icon-unmute=""/>
                    </x-vui-button>
                @endif

                <x-vui-button class="{{$ui('video-background', 'button')}}"
                              :variant="$buttonVariant ?? null"
                              icon-only
                              data-VideoBackground-pause=""
                              aria-label="{{ __('vitrine-ui::fe.pause') }}">
                    <x-vui-icon class="hidden"
                                name="{{ $ui('video-background', 'play-icon-name') }}"
                                data-VideoBackground-icon-play/>
                    <x-vui-icon name="{{ $ui('video-background', 'pause-icon-name') }}"
                                data-VideoBackground-icon-pause/>
                </x-vui-button>
            </div>

            <video class="{{ $native ? '' : 'video-js' }} {{$ui('video-background', 'video')}}"
               data-VideoBackground-player=""
               playsinline
               autoplay
               loop
               muted>
            @if(count($sources ?? []) > 0)
                @foreach ($sources as $source)
                    <source src="{{ $source['src'] }}" 
                                @isset($source['type']) type="{{ $source['type'] }}"@endisset />
                @endforeach
            @elseif(isset($src))
                <source src="{{ $src }}">
            @endif
        </video>
        </div>
        {{ $slot ?? null }}
    </div>
@endif
