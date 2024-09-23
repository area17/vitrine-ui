import { extendBehavior } from '@area17/a17-behaviors'
import videojs from 'video.js'

import { VideoBackground } from './VideoBackground'

const VIDEO_JS_PAYER_OPTIONS = {
    controls: false,
    autoPlay: true,
    html5: {
        vhs: {
            overrideNative: false
        }
    }
}

/*
  Same as VideoBackground but this is using videoJS to play/pause
  (only useful if your source support HLS streaming)
*/
export const VideoBackgroundVideoJs = extendBehavior(
    VideoBackground,
    'VideoBackgroundVideoJs',
    {
        initPlayer() {
            if (!this.$player) return

            if (this.$player.player) {
                this.$videojs = this.$player.player
            } else {
                this.$videojs = videojs(this.$player, VIDEO_JS_PAYER_OPTIONS)
            }
        },

        play() {
            this.$videojs.play()
            this.updatePlayButton(true)
        },

        pause() {
            this.$videojs.pause()
            this.updatePlayButton(false)
        },

        mute() {
            if (!this.isMuted) {
                this.$videojs.muted(true)
                this.updateMuteButton(true)
            }
        },

        unmute() {
            if (this.isMuted) {
                this.muteAll()
                this.$videojs.muted(false)
                this.updateMuteButton(false)
            }
        }
    },
    {
        init() {
            // state
            this.initState()

            const getChildFromParent = (selector) => {
                const parentBehaviorName = 'VideoBackground'
                return this.$node.querySelector(
                    '[data-' +
                        parentBehaviorName.toLowerCase() +
                        '-' +
                        selector.toLowerCase() +
                        ']'
                )
            }

            // elems
            this.$player = getChildFromParent('player')
            this.$muteButton = getChildFromParent('mute')
            this.$pauseButton = getChildFromParent('pause')
            this.$muteIcon = getChildFromParent('icon-mute')
            this.$unmuteIcon = getChildFromParent('icon-unmute')
            this.$playIcon = getChildFromParent('icon-play')
            this.$pauseIcon = getChildFromParent('icon-pause')

            // init Video JS player
            this.initPlayer()

            this.$player.addEventListener('play', this.handlePlay, false)
            this.$player.addEventListener('pause', this.handlePause, false)

            this.initEvents()
        }
    }
)

export default VideoBackgroundVideoJs
