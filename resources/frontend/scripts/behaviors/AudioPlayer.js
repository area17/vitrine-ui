import { createBehavior } from '@area17/a17-behaviors'

const MENU_OPEN_CLASS = 'o-audio__rate--active'
const MUTE_LABEL = 'Mute'
const UNMUTE_LABEL = 'Unmute'
const HIDDEN_CLASS = 'hidden'

const AudioPlayer = createBehavior(
    'AudioPlayer',
    {
        closeMenu() {
            if (this.menuOpen) {
                this.menuOpen = false
                this.rate.classList.remove(MENU_OPEN_CLASS)
                this.rateBtn.focus()
                this.speedBtns.forEach((btn) => {
                    btn.removeAttribute('tabindex')
                })
            }
        },

        formatTime(secs) {
            const minutes = Math.floor(secs / 60) || 0
            const seconds = Math.floor(secs - minutes * 60) || 0
            return minutes + ':' + (seconds < 10 ? '0' : '') + seconds
        },

        handleFocusout(e) {
            if (
                document.documentElement.contains(e.relatedTarget) &&
                !this.getChild('rate').contains(e.relatedTarget)
            ) {
                this.menuOpen = false
            }
        },

        handleKeyPress(e) {
            if (this.getChild('volumewrapper').contains(e.target)) {
                switch (e.keyCode) {
                    case 35:
                        // End
                        e.preventDefault()
                        this.volume = 100
                        break
                    case 36:
                        // Home
                        e.preventDefault()
                        this.volume = 0
                        break
                    case 33:
                        // Page up
                        e.preventDefault()
                        this.volume = Math.min(
                            Math.max((this.volume -= 10), 0),
                            100
                        )
                        break
                    case 34:
                        // Page down
                        e.preventDefault()
                        this.volume = Math.min(
                            Math.max((this.volume += 10), 0),
                            100
                        )
                        break
                }
            } else {
                switch (e.keyCode) {
                    case 35:
                        // End
                        e.preventDefault()
                        this.currentSeconds = this.durationSeconds
                        this.audioPlayer.currentTime = this.currentSeconds
                        break
                    case 36:
                        // Home
                        e.preventDefault()
                        this.currentSeconds = 0
                        this.audioPlayer.currentTime = this.currentSeconds
                        break
                    case 33:
                        // Page up
                        e.preventDefault()
                        this.skip('back', 5)
                        break
                    case 34:
                        // Page down
                        e.preventDefault()
                        this.skip('forward', 5)
                        break
                }
            }

            switch (e.keyCode) {
                case 38:
                    // Up
                    e.preventDefault()
                    this.volume = Math.min(Math.max((this.volume += 5), 0), 100)
                    break
                case 40:
                    // Down
                    e.preventDefault()
                    this.volume = Math.min(Math.max((this.volume -= 5), 0), 100)
                    break
                case 37:
                    // Left
                    e.preventDefault()
                    this.skip('back')
                    break
                case 39:
                    // Right
                    e.preventDefault()
                    this.skip()
                    break
                case 32:
                    // Space
                    if (!['BUTTON', 'LI'].includes(e.target.tagName)) {
                        this.toggleAudio()
                    }
                    break
            }

            this.setVolume(this.volume)
        },

        load() {
            if (this.audioPlayer.readyState >= 2) {
                this.isLoaded = true
                this.durationSeconds = parseInt(this.audioPlayer.duration)
                this.duration.innerHTML = this.formatTime(this.durationSeconds)
                this.progressBar.setAttribute('max', this.durationSeconds)
                this.progressBar.setAttribute(
                    'aria-valuetext',
                    `${this.formatTime(
                        this.currentSeconds
                    )} of ${this.formatTime(this.durationSeconds)}`
                )
            } else {
                throw new Error('Failed to load audio file.')
            }
        },

        nextItem(e) {
            const currentItem = e.target
            const itemIndex = Array.from(this.speedBtns).indexOf(currentItem)
            const { 0: first, [this.speedBtns.length - 1]: last } =
                this.speedBtns

            if (e.keyCode == 38) {
                if (currentItem !== first) {
                    this.speedBtns[itemIndex - 1].focus()
                } else {
                    last.focus()
                }
            } else if (e.keyCode == 40) {
                if (currentItem !== last) {
                    this.speedBtns[itemIndex + 1].focus()
                } else {
                    first.focus()
                }
            }
        },

        seek(e) {
            if (!this.isLoaded) return

            this.currentSeconds = e.target.value
            this.audioPlayer.currentTime = e.target.value
        },

        setVolume(e) {
            let value

            if (typeof e == 'number') {
                value = e
            } else if (e.target) {
                value = e.target.value
            }

            if (value <= 0) {
                this.isMuted = false
                this.toggleMute()
            } else if (value > 0) {
                this.isMuted = false
                this.getChild('muteIcon').classList.remove(HIDDEN_CLASS)
                this.getChild('unmuteIcon').classList.add(HIDDEN_CLASS)
            }

            this.volume = value
            this.audioPlayer.volume = value / 100
            this.volumeSlider.value = value
            this.volumeSlider.setAttribute('aria-valuetext', this.volume)
            this.volumeSlider.style.setProperty('--value', `${value}`)
        },

        skip(direction = null, seek = null) {
            const seekAmount = seek ? seek : this.seekPercentage
            const percentage =
                (direction === 'back' ? -1 * seekAmount : seekAmount) * 0.01
            const increment = percentage * this.audioPlayer.duration

            this.audioPlayer.currentTime += Math.round(increment)
        },

        toggleAudio() {
            if (this.audioPlayer.paused) {
                this.audioPlayer.play()
                this.isPlaying = true
                this.pauseIcon.classList.remove(HIDDEN_CLASS)
                this.playIcon.classList.add(HIDDEN_CLASS)
                this.playToggle.setAttribute('aria-label', 'Pause')
                this.playToggle.querySelector('span').innerHTML = 'Pause'
            } else {
                this.audioPlayer.pause()
                this.isPlaying = false
                this.pauseIcon.classList.add(HIDDEN_CLASS)
                this.playIcon.classList.remove(HIDDEN_CLASS)
                this.playToggle.setAttribute('aria-label', 'Play')
                this.playToggle.querySelector('span').innerHTML = 'Play'
            }
        },

        toggleMenu() {
            this.menuOpen = !this.menuOpen

            if (this.menuOpen) {
                this.rate.classList.add(MENU_OPEN_CLASS)
                this.speedBtns.forEach((btn) => {
                    btn.setAttribute('tabindex', 0)

                    if (btn.classList.contains('selected')) {
                        setTimeout(() => {
                            btn.focus()
                        }, 5)
                    }
                })
            } else {
                this.rate.classList.remove(MENU_OPEN_CLASS)
                this.speedBtns.forEach((btn) => {
                    btn.removeAttribute('tabindex')
                })
            }
        },

        toggleMute() {
            this.isMuted = !this.isMuted

            if (this.isMuted) {
                this.previousVolume = this.volumeSlider.value
                this.volume = 0

                this.volumeSlider.style.setProperty('--value', '0')
                this.getChild('muteIcon').classList.add(HIDDEN_CLASS)
                this.getChild('unmuteIcon').classList.remove(HIDDEN_CLASS)
                this.muteBtn.setAttribute('aria-label', UNMUTE_LABEL)
                this.volumeSlider.setAttribute('aria-valuetext', 0)
                this.volumeSlider.style.setProperty('--value', `0`)
                this.volumeSlider.value = 0
            } else {
                this.volume = this.previousVolume

                this.getChild('muteIcon').classList.remove(HIDDEN_CLASS)
                this.getChild('unmuteIcon').classList.add(HIDDEN_CLASS)
                this.muteBtn.setAttribute('aria-label', MUTE_LABEL)
                this.volumeSlider.setAttribute('aria-valuetext', this.volume)
                this.volumeSlider.style.setProperty('--value', `${this.volume}`)
                this.volumeSlider.value = this.volume
            }

            this.audioPlayer.volume = this.volume / 100
        },

        updateTime() {
            this.currentSeconds = parseInt(this.audioPlayer.currentTime)
            this.currentTime.innerHTML = this.formatTime(this.currentSeconds)
            this.progressBar.value = this.currentSeconds
            this.progressBar.setAttribute(
                'aria-valuetext',
                `${this.formatTime(this.currentSeconds)} of ${this.formatTime(
                    this.durationSeconds
                )}`
            )

            const percentComplete = parseInt(
                (this.currentSeconds / this.durationSeconds) * 100
            )

            this.progressBar.style.setProperty(
                '--value',
                isNaN(percentComplete) ? 0 : percentComplete
            )
        },

        updateRate(i) {
            const rate = this.playbackRates[i]

            this.audioPlayer.playbackRate = rate
            this.playbackRate = rate
            this.currentRate.innerHTML = rate
            this.rateMenu.setAttribute('aria-activedescendant', `speed${i}`)
            this.rateBtn.setAttribute('aria-label', `Playback Speed: ${rate}X`)
            this.speedBtns.forEach((btn) => {
                btn.classList.remove('selected')
                btn.setAttribute('aria-checked', 'false')
            })
            this.speedBtns[i].classList.add('selected')
            this.speedBtns[i].setAttribute('aria-checked', 'true')
            this.closeMenu()
        }
    },
    {
        init() {
            this.audioPlayer = this.getChild('player')
            this.backgroundVal = 0
            this.currentSeconds = 0
            this.currentRate = this.getChild('currentRate')
            this.currentTime = this.getChild('currentTime')
            this.duration = this.getChild('duration')
            this.durationSeconds = 0
            this.forward = this.getChild('forward')
            this.hoverValue = 0
            this.isLoaded = false
            this.isMuted = false
            this.isPlaying = false
            this.loadedAmount = 0
            this.menuOpen = false
            this.muteBtn = this.getChild('muteBtn')
            this.playIcon = this.getChild('playIcon')
            this.playbackRate = 1
            this.playbackRates = [
                0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 2.25, 2.5, 2.75, 3
            ]
            this.playToggle = this.getChild('playToggle')
            this.previousVolume = 35
            this.progressBar = this.getChild('progressBar')
            this.pauseIcon = this.getChild('pauseIcon')
            this.rewind = this.getChild('rewind')
            this.rate = this.getChild('rate')
            this.rateBtn = this.getChild('rateBtn')
            this.rateMenu = this.getChild('rateMenu')
            this.seekPercentage = 1
            this.speedBtns = this.getChildren('speed')
            this.volume = 100
            this.volumeSlider = this.getChild('volumeslider')

            this.audioPlayer.load()

            this.$node.addEventListener('keydown', (e) => {
                this.handleKeyPress(e)
            })

            this.audioPlayer.addEventListener('loadeddata', () => {
                this.load()
            })

            this.audioPlayer.addEventListener('pause', () => {
                this.isPlaying = false
            })

            this.audioPlayer.addEventListener('play', () => {
                this.isPlaying = true
            })

            this.audioPlayer.addEventListener('timeupdate', () => {
                this.updateTime()
            })

            this.volumeSlider.addEventListener('change', (e) => {
                this.setVolume(e)
            })

            this.volumeSlider.addEventListener('click', (e) => {
                this.setVolume(e)
            })

            this.muteBtn.addEventListener('click', () => {
                this.toggleMute()
            })

            this.rate.addEventListener('focusout', (e) => {
                this.handleFocusout(e)
            })

            this.rate.addEventListener('keyup', (e) => {
                if (e.key === 'Escape') {
                    this.closeMenu()
                }
            })

            this.rateBtn.addEventListener('click', () => {
                this.toggleMenu()
            })

            this.rewind.addEventListener('click', () => {
                this.skip('back')
            })

            this.playToggle.addEventListener('click', () => {
                this.toggleAudio()
            })

            this.forward.addEventListener('click', () => {
                this.skip()
            })

            this.progressBar.addEventListener('change', (e) => {
                this.seek(e)
            })

            this.speedBtns.forEach((btn, i) => {
                btn.addEventListener('click', () => {
                    this.updateRate(i)
                })
                btn.addEventListener('keydown', (e) => {
                    if (e.key == 'Enter') {
                        setTimeout(() => {
                            this.updateRate(i)
                        }, 100)
                    } else {
                        this.nextItem(e)
                    }
                })
            })
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {}
    }
)

export default AudioPlayer
