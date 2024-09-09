<div data-behavior="AudioPlayer"
     {{ $attributes->twMerge(VitrineUI::setPrefixedClass(['audio-player', 'audio--' . $variant => $variant])) }}>

    @if ($title)
        {{--     tbd: is sr-only class with :$nbsp; mandatory? --}}
        <span class="{{ VitrineUI::setPrefixedClass('audio-player-title') }}">{{ $title }}<span
                  class="sr-only">:&nbsp;</span></span>
    @endif

    @if ($subtitle)
        <span class="{{ VitrineUI::setPrefixedClass('audio-player-subtitle') }}">{{ $subtitle }}</span>
    @endif

    <div class="{{ $ui('button', 'base') }} o-audio mt-24"
         role="region"
         aria-label="{{ 'Audio Player - ' . $title }}">
        <div class="o-audio__controls flex w-full flex-col md:flex-row md:flex-wrap">
            <div class="-mx-8 flex flex-row flex-wrap items-center">
                <button class="text-inherit relative m-0 flex h-40 w-40 shrink-0 cursor-pointer appearance-none items-center justify-center whitespace-nowrap rounded-full border-none bg-transparent p-0"
                        data-AudioPlayer-rewind
                        aria-label="Rewind"
                        ref="rewind">
                    <svg class="m-0 block"
                         aria-hidden="true"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24">
                        <g>
                            <path d="M10.5 19.5V12V4.5L0 12L10.5 19.5ZM21 19.5L10.5 12L21 4.5V19.5Z"
                                  fill="currentColor"></path>
                        </g>
                    </svg>
                    <span class="sr-only">Rewind</span>
                </button>

                <button class="text-inherit a-gui-audio__btn--play relative m-0 flex h-40 w-40 shrink-0 cursor-pointer appearance-none items-center justify-center whitespace-nowrap rounded-full border border-primary bg-transparent p-0"
                        name="playToggle"
                        data-AudioPlayer-playToggle
                        aria-label="Play"
                        ref="playToggle">
                    <svg class="m-0"
                         data-AudioPlayer-playIcon
                         aria-hidden="true"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 16 16">
                        <g size="24">
                            <path d="M3 2V14L15 8L3 2Z"
                                  fill="currentColor"></path>
                        </g>
                    </svg>
                    <svg class="m-0 hidden"
                         data-AudioPlayer-pauseIcon
                         aria-hidden="true"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24">
                        <g size="24">
                            <path d="M9 3H4.5V21H9V3Z"
                                  fill="currentColor"></path>
                            <path d="M19.5 3H15V21H19.5V3Z"
                                  fill="currentColor"></path>
                        </g>
                    </svg>
                    <span class="sr-only">Play</span>
                </button>

                <button class="text-inherit relative m-0 flex h-40 w-40 shrink-0 cursor-pointer appearance-none items-center justify-center whitespace-nowrap rounded-full border-none bg-transparent p-0"
                        data-AudioPlayer-forward
                        aria-label="Fast-forward"
                        ref="forward">
                    <svg class="m-0 block"
                         aria-hidden="true"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24">
                        <g>
                            <path d="M13.5 19.5V12V4.5L24 12L13.5 19.5ZM3 19.5L13.5 12L3 4.5V19.5Z"
                                  fill="currentColor">
                            </path>
                        </g>
                    </svg>
                    <span class="sr-only">Fast-forward</span>
                </button>
            </div>

            <div class="relative mt-12 flex flex-grow flex-row flex-wrap items-center self-stretch md:ml-24 md:mt-0">
                <div class="absolute left-0 right-0 top-full flex flex-row flex-wrap content-between text-xs md:right-auto md:top-0"
                     aria-hidden="true">
                    <span class="block text-left after:px-4 after:opacity-50 after:content-['|'/'']"
                          data-AudioPlayer-currentTime>0:00</span>
                    <span data-AudioPlayer-duration></span>
                </div>

                <div class="o-audio__range relative z-10 flex w-full flex-row flex-wrap">
                    <audio class="hidden"
                           data-AudioPlayer-player
                           aria-hidden="true"
                           preload
                           controls>
                        @foreach ($sources as $source)
                            <source src="{{ $source['src'] }}"
                                    type="{{ $source['type'] ?? null }}">
                        @endforeach
                    </audio>
                    <input class="-mx-8 h-24 w-[calc(100%_+_16px)] appearance-none bg-transparent"
                           data-chromatic="ignore"
                           data-AudioPlayer-progressBar
                           type="range"
                           value="0"
                           aria-label="Progress Bar"
                           style="--backgroundVal:calc(1% * var(--value) + 1px + 0.5%);"
                           ref="progress"
                           min="0"
                           max="100" />
                </div>
            </div>

            <div class="o-audio__volume relative -mr-24 w-64 cursor-pointer items-center justify-center xs:hidden md:flex"
                 data-AudioPlayer-volumewrapper>
                <div class="o-audio__range">
                    <input class="w-54 m-0 h-full origin-left -translate-x-1/2 rotate-[270deg] transform cursor-pointer"
                           data-AudioPlayer-volumeslider
                           type="range"
                           value="100"
                           aria-valuetext="100"
                           aria-label="Volume"
                           style="--backgroundVal:calc(1% * var(--value) + 1px + 0.5%);--value:100"
                           min="0"
                           max="100" />
                </div>

                <button class="text-inherit relative m-0 flex h-40 w-40 shrink-0 cursor-pointer appearance-none items-center justify-center whitespace-nowrap rounded-none border-none bg-transparent p-0"
                        data-AudioPlayer-muteBtn
                        aria-label="Mute">
                    <span>
                        <svg data-AudioPlayer-muteIcon
                             aria-hidden="true"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg"
                             width="16"
                             height="16"
                             viewBox="0 0 16 16">
                            <g>
                                <path d="M0 5V11H4L8 15V1L4 5H0Z"
                                      fill="currentColor"></path>
                                <path d="M9 1V2.5C12.0376 2.5 14.5 4.96243 14.5 8C14.5 11.0376 12.0376 13.5 9 13.5V15C12.866 15 16 11.866 16 8C16 4.134 12.866 1 9 1Z"
                                      fill="currentColor"></path>
                                <path d="M13 8C13 5.79086 11.2091 4 9 4V5.5C10.3807 5.5 11.5 6.61929 11.5 8C11.5 9.38071 10.3807 10.5 9 10.5V12C11.2091 12 13 10.2091 13 8Z"
                                      fill="currentColor"></path>
                            </g>
                        </svg>
                        <svg class="hidden"
                             data-AudioPlayer-UnmuteIcon
                             aria-hidden="true"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg"
                             width="16"
                             height="16"
                             viewBox="0 0 16 16">
                            <g>
                                <path d="M0 11V5H4L8 1V15L4 11H0Z"
                                      fill="currentColor"></path>
                                <path d="M15.5303 9.96973L13.5605 8L15.5303 6.03027L14.4697 4.96973L12.5 6.93945L10.5303 4.96973L9.46973 6.03027L11.4395 8L9.46973 9.96973L10.5303 11.0303L12.5 9.06055L14.4697 11.0303L15.5303 9.96973Z"
                                      fill="currentColor"></path>
                            </g>
                        </svg>
                    </span>

                </button>
            </div>
        </div>

        <div class="mt-36 flex flex-wrap justify-between xs:flex-col xs:items-start sm:flex-row sm:items-center">
            @if ($downloadUrl)
                <a class="mr-24 underline xs:mb-16 sm:mb-0"
                   href="{{ $downloadUrl }}"
                   aria-label="Download file: {{ $title }}"
                   download>
                    Download
                </a>
            @endif

            @if ($playbackRates)
                <div class="o-audio__rate relative"
                     data-AudioPlayer-rate>

                    <button class="o-audio__rate-btn relative flex min-w-[220px] max-w-full items-center border border-primary px-12 py-8 text-left"
                            id="rateBtn"
                            name="rateBtn"
                            data-AudioPlayer-rateBtn
                            type="button"
                            aria-haspopup="true"
                            aria-label="Playback Speed: 1X">
                        <span>Playback Speed:&nbsp;</span>
                        <span data-AudioPlayer-currentRate>1</span>
                        <span>&#215;</span>
                        <svg class="ml-auto rotate-180 transform transition-none"
                             aria-hidden="true"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg"
                             width="16"
                             height="16"
                             viewBox="0 0 16 16">
                            <g>
                                <path d="M4 10H12L8 6L4 10Z"
                                      fill="currentColor"></path>
                            </g>
                        </svg>

                    </button>

                    <ul class="invisible absolute bottom-full top-auto z-50 -mt-1 w-full border border-b-0 border-primary bg-primary pb-8 pt-8 opacity-0 transition-opacity duration-300"
                        data-AudioPlayer-rateMenu
                        role="menu"
                        aria-activedescendant="speed{{ array_search(1, $playbackRates) }}"
                        aria-label="Playback Rate Options">

                        @foreach ($playbackRates as $rate)
                            <li class="o-audio__speed {{ $rate === 1 ? 'selected' : '' }} relative flex cursor-pointer flex-row flex-wrap rounded-none py-4 pl-36 pr-12 text-left text-sm hover:bg-quaternary focus:outline-none"
                                id="speed{{ $loop->index }}"
                                data-AudioPlayer-speed
                                role="menuitemradio"
                                aria-checked="{{ $rate === 1 ? 'true' : 'false' }}">
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
