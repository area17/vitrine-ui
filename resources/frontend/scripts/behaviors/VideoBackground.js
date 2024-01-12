import { createBehavior } from '@area17/a17-behaviors'

export const VideoBackground = createBehavior(
    'VideoBackground',
    {
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
            this.$player.play()
            this.updatePlayButton(true)
        },

        pause() {
            this.$player.pause()
            this.updatePlayButton(false)
        },

        mute() {
            if (!this.isMuted) {
                this.$player.muted = true
                this.updateMuteButton(true)
            }
        },

        unmute() {
            if (this.isMuted) {
                this.muteAll()
                this.$player.muted = false
                this.updateMuteButton(false)
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
        },

        updatePlayButton(playing) {
            this.$pauseIcon.classList.toggle('hidden', !playing)
            this.$playIcon.classList.toggle('hidden', playing)
            this.$pauseButton.setAttribute('aria-label', playing ? this.buttonText.pause : this.buttonText.play)
            this.isPlaying = playing
        },

        updateMuteButton(muted) {
            this.isMuted = muted
            this.$muteIcon.classList.toggle('hidden', muted)
            this.$unmuteIcon.classList.toggle('hidden', !muted)
            this.$muteButton.setAttribute(
                'aria-label',
                muted ? this.buttonText.unmute : this.buttonText.mute
            )
        },

        muteAll() {
            // mute all players
            document.dispatchEvent(
                new CustomEvent('VideoBackground:muteAll')
            )
        },

        initState() {
            this.isPlaying = true
            this.isMuted = true
            this.buttonText = {
                play: this.options['text-play'],
                pause: this.options['text-pause'],
                mute: this.options['text-mute'],
                unmute: this.options['text-unmute']
            }
        },

        initEvents() {
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
        }
    },
    {
        init() {
            // state
            this.initState()

            // elems
            this.$player = this.getChild('player')
            this.$muteButton = this.getChild('mute')
            this.$pauseButton = this.getChild('pause')
            this.$muteIcon = this.getChild('icon-mute')
            this.$unmuteIcon = this.getChild('icon-unmute')
            this.$playIcon = this.getChild('icon-play')
            this.$pauseIcon = this.getChild('icon-pause')

            this.initEvents()
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
