import { createBehavior } from '@area17/a17-behaviors'
import videojs from 'video.js'

const VideoBackground = createBehavior(
    'VideoBackground',
    {
        initPlayer() {
            if (!this.$player) return

            if (this.$player.player) {
                this.$videojs = this.$player.player
            } else {
                this.$videojs = videojs(this.$player, this.playerOptions)
            }
        },

        togglePlay(e) {
            e.preventDefault()

            if (this.isPlaying) {
                this.pause()
            } else {
                this.play()
            }
        },

        toggleMute(e) {
            if (e) {
                e.preventDefault()
            }

            if (this.isMuted) {
                this.unmute()
            } else {
                this.mute()
            }
        },

        play() {
            this.$videojs.play()
            this.$pauseIcon.classList.remove('hidden')
            this.$playIcon.classList.add('hidden')
            this.$pauseButton.setAttribute('aria-label', this.buttonText.pause)
            this.isPlaying = true
        },

        pause() {
            this.$videojs.pause()
            this.$pauseIcon.classList.add('hidden')
            this.$playIcon.classList.remove('hidden')
            this.$pauseButton.setAttribute('aria-label', this.buttonText.play)
            this.isPlaying = false
        },

        mute() {
            if (!this.isMuted) {
                this.$videojs.muted(true)
                this.isMuted = true
                this.$muteIcon.classList.add('hidden')
                this.$unmuteIcon.classList.remove('hidden')
                this.$muteButton.setAttribute(
                    'aria-label',
                    this.buttonText.unmute
                )
            }
        },

        unmute() {
            if (this.isMuted) {
                document.dispatchEvent(
                    new CustomEvent('VideoBackground:muteAll')
                )

                this.$videojs.muted(false)
                this.isMuted = false
                this.$muteIcon.classList.remove('hidden')
                this.$unmuteIcon.classList.add('hidden')
                this.$muteButton.setAttribute(
                    'aria-label',
                    this.buttonText.mute
                )
            }
        },

        handlePlay() {
            this.isPlaying = true
        },
        handlePause() {
            this.isPlaying = false
        },

        startIntersectionObserver() {
            const options = {
                threshold: [0.25, 0.75]
            }

            this.observer = new IntersectionObserver(
                this.handleObserver,
                options
            )

            this.observer.observe(this.$player)
        },

        handleObserver(entries) {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    this.play()
                } else {
                    if (this.isPlaying && this.isMuted) {
                        this.pause()
                    }
                }
            })
        }
    },
    {
        init() {
            // state
            this.isPlaying = true
            this.isMuted = true
            this.buttonText = {
                play: this.options['text-play'],
                pause: this.options['text-pause'],
                mute: this.options['text-mute'],
                unmute: this.options['text-unmute']
            }

            // elems
            this.$player = this.getChild('player')
            this.$muteButton = this.getChild('mute')
            this.$pauseButton = this.getChild('pause')
            this.$muteIcon = this.getChild('icon-mute')
            this.$unmuteIcon = this.getChild('icon-unmute')
            this.$playIcon = this.getChild('icon-play')
            this.$pauseIcon = this.getChild('icon-pause')
            this.playerOptions = {
                controls: false,
                autoPlay: true,
                html5: {
                    vhs: {
                        overrideNative: false
                    }
                }
            }

            this.initPlayer()

            this.$player.addEventListener('play', this.handlePlay, false)
            this.$player.addEventListener('pause', this.handlePause, false)

            document.addEventListener(
                'VideoBackground:muteAll',
                this.mute,
                false
            )

            if (this.$pauseButton) {
                this.$pauseButton.addEventListener(
                    'click',
                    this.togglePlay,
                    false
                )
            }

            if (this.$muteButton) {
                this.$muteButton.addEventListener(
                    'click',
                    this.toggleMute,
                    false
                )
            }

            if (window.A17.reduceMotion) {
                this.pause()
            } else {
                this.startIntersectionObserver()
            }
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.$player.removeEventListener('play', this.handlePlay)
            this.$player.removeEventListener('pause', this.handlePause)
            document.removeEventListener('VideoBackground:muteAll', this.mute)

            if (this.$pauseButton) {
                this.$pauseButton.removeEventListener('click', this.togglePlay)
            }

            if (this.$muteButton) {
                this.$muteButton.removeEventListener('click', this.toggleMute)
            }

            this.observer.disconnect()
        }
    }
)

export default VideoBackground
