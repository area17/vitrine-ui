<div {{ $attributes->class(VitrineUI::setPrefixedClass(['audio-player', 'audio--'.$variant => $variant])) }} data-behavior="AudioPlayer">

    @if ($title)
{{--     tbd: is sr-only class with :$nbsp; mandatory?--}}
        <span class="{{VitrineUI::setPrefixedClass('audio-player-title')}}">{{ $title }}<span class="sr-only">:&nbsp;</span></span>
    @endif

    @if ($subtitle)
        <span class="{{VitrineUI::setPrefixedClass('audio-player-subtitle')}}">{{ $subtitle }}</span>
    @endif

    <div aria-label="{{ 'Audio Player - ' . $title }}" class="o-audio mt-24" role="region">
        <div class="o-audio__controls w-full flex flex-col md:flex-row md:flex-wrap">
            <div class="flex flex-row flex-wrap items-center -mx-8">
                <button aria-label="Rewind"
                    class="appearance-none m-0 p-0 border-none rounded-full whitespace-nowrap cursor-pointer flex relative shrink-0 items-center justify-center w-40 h-40 bg-transparent text-inherit"
                    ref="rewind" data-AudioPlayer-rewind>
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" class="block m-0" aria-hidden="true">
                        <g>
                            <path d="M10.5 19.5V12V4.5L0 12L10.5 19.5ZM21 19.5L10.5 12L21 4.5V19.5Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <span class="sr-only">Rewind</span>
                </button>

                <button aria-label="Play"
                    class="appearance-none m-0 p-0 border border-primary rounded-full whitespace-nowrap cursor-pointer flex relative shrink-0 items-center justify-center w-40 h-40 bg-transparent text-inherit a-gui-audio__btn--play"
                    name="playToggle" ref="playToggle" data-AudioPlayer-playToggle>
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 16 16" class="m-0" aria-hidden="true" data-AudioPlayer-playIcon>
                        <g size="24">
                            <path d="M3 2V14L15 8L3 2Z" fill="currentColor"></path>
                        </g>
                    </svg>
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" class="m-0 hidden" aria-hidden="true" data-AudioPlayer-pauseIcon>
                        <g size="24">
                            <path d="M9 3H4.5V21H9V3Z" fill="currentColor"></path>
                            <path d="M19.5 3H15V21H19.5V3Z" fill="currentColor"></path>
                        </g>
                    </svg>
                    <span class="sr-only">Play</span>
                </button>

                <button aria-label="Fast-forward"
                    class="appearance-none m-0 p-0 border-none rounded-full whitespace-nowrap cursor-pointer flex relative shrink-0 items-center justify-center w-40 h-40 bg-transparent text-inherit"
                    ref="forward" data-AudioPlayer-forward>
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" class="block m-0" aria-hidden="true">
                        <g>
                            <path d="M13.5 19.5V12V4.5L24 12L13.5 19.5ZM3 19.5L13.5 12L3 4.5V19.5Z" fill="currentColor">
                            </path>
                        </g>
                    </svg>
                    <span class="sr-only">Fast-forward</span>
                </button>
            </div>

            <div class="flex relative flex-row flex-wrap flex-grow items-center self-stretch mt-12 md:mt-0 md:ml-24">
                <div class="text-xs flex absolute top-full left-0 right-0 flex-row flex-wrap content-between md:top-0 md:right-auto"
                    aria-hidden="true">
                    <span class="block text-left after:content-['|'/''] after:px-4 after:opacity-50"
                        data-AudioPlayer-currentTime>0:00</span>
                    <span data-AudioPlayer-duration></span>
                </div>

                <div class="o-audio__range flex relative z-10 w-full flex-row flex-wrap">
                    <audio aria-hidden="true" data-AudioPlayer-player class="hidden" preload controls>
                      @foreach ($sources as $source)
                          <source src="{{ $source['src'] }}" type="{{ $source['type'] ?? null }}">
                      @endforeach
                    </audio>
                    <input aria-label="Progress Bar" data-chromatic="ignore" ref="progress" type="range"
                        class="w-[calc(100%_+_16px)] h-24 -mx-8 bg-transparent appearance-none" value="0"
                        min="0" max="100" style="--backgroundVal:calc(1% * var(--value) + 1px + 0.5%);"
                        data-AudioPlayer-progressBar />
                </div>
            </div>

            <div class="o-audio__volume xs:hidden md:flex relative items-center justify-center w-64 -mr-24 cursor-pointer"
                data-AudioPlayer-volumewrapper>
                <div class="o-audio__range">
                    <input aria-valuetext="100" aria-label="Volume" min="0" max="100"
                        data-AudioPlayer-volumeslider type="range" value="100"
                        class="w-54 h-full m-0 cursor-pointer transform rotate-[270deg] -translate-x-1/2 origin-left"
                        style="--backgroundVal:calc(1% * var(--value) + 1px + 0.5%);--value:100" />
                </div>

                <button aria-label="Mute"
                    class="appearance-none m-0 p-0 border-none rounded-none whitespace-nowrap cursor-pointer flex relative shrink-0 items-center justify-center w-40 h-40 bg-transparent text-inherit"
                    data-AudioPlayer-muteBtn>
                    <span>
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" aria-hidden="true" data-AudioPlayer-muteIcon>
                            <g>
                                <path d="M0 5V11H4L8 15V1L4 5H0Z" fill="currentColor"></path>
                                <path
                                    d="M9 1V2.5C12.0376 2.5 14.5 4.96243 14.5 8C14.5 11.0376 12.0376 13.5 9 13.5V15C12.866 15 16 11.866 16 8C16 4.134 12.866 1 9 1Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M13 8C13 5.79086 11.2091 4 9 4V5.5C10.3807 5.5 11.5 6.61929 11.5 8C11.5 9.38071 10.3807 10.5 9 10.5V12C11.2091 12 13 10.2091 13 8Z"
                                    fill="currentColor"></path>
                            </g>
                        </svg>
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" class="hidden" aria-hidden="true" data-AudioPlayer-UnmuteIcon>
                            <g>
                                <path d="M0 11V5H4L8 1V15L4 11H0Z" fill="currentColor"></path>
                                <path
                                    d="M15.5303 9.96973L13.5605 8L15.5303 6.03027L14.4697 4.96973L12.5 6.93945L10.5303 4.96973L9.46973 6.03027L11.4395 8L9.46973 9.96973L10.5303 11.0303L12.5 9.06055L14.4697 11.0303L15.5303 9.96973Z"
                                    fill="currentColor"></path>
                            </g>
                        </svg>
                    </span>

                </button>
            </div>
        </div>

        <div class="flex xs:flex-col sm:flex-row xs:items-start flex-wrap sm:items-center justify-between mt-36">
            @if ($downloadUrl)
                <a aria-label="Download file: {{ $title }}" href="{{ $downloadUrl }}" download
                    class="underline mr-24 xs:mb-16 sm:mb-0">
                    Download
                </a>
            @endif

            @if ($playbackRates)
                <div class="o-audio__rate relative" data-AudioPlayer-rate>

                    <button aria-haspopup="true" aria-label="Playback Speed: 1X" id="rateBtn" name="rateBtn"
                        data-AudioPlayer-rateBtn type="button"
                        class="o-audio__rate-btn flex relative py-8 px-12 items-center max-w-full min-w-[220px] text-left border border-primary">
                        <span>Playback Speed:&nbsp;</span>
                        <span data-AudioPlayer-currentRate>1</span>
                        <span>&#215;</span>
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" class="ml-auto transform rotate-180 transition-none"
                            aria-hidden="true">
                            <g>
                                <path d="M4 10H12L8 6L4 10Z" fill="currentColor"></path>
                            </g>
                        </svg>

                    </button>

                    <ul aria-activedescendant="speed{{ array_search(1, $playbackRates) }}"
                        aria-label="Playback Rate Options"
                        class="z-50 absolute invisible opacity-0 transition-opacity duration-300 top-auto bottom-full w-full -mt-1 pt-8 pb-8 border border-primary border-b-0 bg-primary"
                        data-AudioPlayer-rateMenu role="menu">

                        @foreach ($playbackRates as $rate)
                            <li aria-checked="{{ $rate === 1 ? 'true' : 'false' }}"
                                class="o-audio__speed rounded-none focus:outline-none flex relative flex-row flex-wrap py-4 pr-12 pl-36 text-left cursor-pointer text-sm hover:bg-quaternary {{ $rate === 1 ? 'selected' : '' }}"
                                id="speed{{ $loop->index }}" role="menuitemradio" data-AudioPlayer-speed>
                                <span>
                                    {{ $rate }}<span class="sr-only">X</span><span
                                        aria-hidden="true">&#215;</span>
                                    @if ($rate === 1)
                                        <span>&nbsp;(Normal)</span>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
