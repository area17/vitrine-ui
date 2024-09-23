import { createBehavior } from '@area17/a17-behaviors'
import { queryStringHandler } from '@area17/a17-helpers'

import { customEvents } from '../constants/customEvents'
import { PARAM_VIMEO, PARAM_YOUTUBE } from '../constants/videoParam'

// Show Youtuve/Vimeo video player
const ShowVideo = createBehavior(
    'ShowVideo',
    {
        handleClick(event) {
            event.preventDefault()
            event.stopPropagation()

            this.$videoPlayer.classList.remove('hidden')
            this.playVideo()
        },

        playVideo() {
            const type = this.options.type
            const id = this.options.id

            if (this.videoInitialized) return
            if (!type || !id)
                return console.warn('ShowVideo: missing type or id')

            const params = this.handleParams(type)

            let src = ''
            if (type === 'youtube') {
                src = `https://www.youtube.com/embed/${id}${params}`
            } else if (type === 'vimeo') {
                src = `https://player.vimeo.com/video/${id}${params}`
            }

            this.$videoPlayer.classList.remove('hidden')
            this.$videoPlayer.innerHTML = `<iframe data-video-player title="Video Player" src="${src}" mozallowfullscreen webkitallowfullscreen allowfullscreen allow="autoplay" class="w-full h-full"></iframe>`
            this.$node.classList.add('is-active')
            this.videoInitialized = true

            const iframe = this.$videoPlayer.querySelector('iframe')

            if (iframe) {
                iframe.onload = () => {
                    iframe.classList.add('is-loaded')
                }
            }

            this.$node.dispatchEvent(new CustomEvent(customEvents.VIDEO_PLAYED))
        },

        resetVideo() {
            this.destroyVideo()
            this.$node.classList.remove('is-active')
            this.videoInitialized = false
        },

        destroyVideo() {
            if (!this.videoInitialized) return

            this.$videoPlayer.classList.add('hidden')
            this.$videoPlayer.innerHTML = ''
        },

        checkParams() {
            if (window.location.search.indexOf('playvideo') > -1) {
                this.playVideo()
            }
        },

        handleParams(embed_service) {
            let videoparams = {}

            if (embed_service == 'youtube') videoparams = PARAM_YOUTUBE
            if (embed_service == 'vimeo') videoparams = PARAM_VIMEO

            // force autoplay
            videoparams.autoplay = this.autoplay ? 1 : 0

            let queryString = queryStringHandler.fromObject(videoparams)
            return queryString
        }
    },
    {
        init() {
            // State
            this.videoInitialized = false
            this.autoplay = Boolean(
                this.options.autoplay && this.options.autoplay !== '0'
            )

            // Elements
            this.$videoPlayer = this.getChild('player')
            this.$trigger = this.getChild('media-container')

            // Events
            this.$trigger.addEventListener('click', this.handleClick, false)
            this.$videoPlayer.innerHTML = ''
            this.$node.addEventListener(
                customEvents.VIDEO_RESET,
                this.resetVideo,
                false
            )
            this.$videoPlayer.addEventListener(
                customEvents.VIDEO_DESTROY,
                this.destroyVideo,
                false
            )

            // TODO IF RELIABLE : detect autoplay is forbidden on Youtube/Vimeo embed (ie : iOS/Android) to launch player on init
            // to avoid double clicks to launch videos

            // Launch video player if playvideo query string in the current url
            this.checkParams()
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.$trigger.removeEventListener('click', this.handleClick)
            this.$node.removeEventListener(
                customEvents.VIDEO_RESET,
                this.resetVideo,
                false
            )
            this.$videoPlayer.removeEventListener(
                customEvents.VIDEO_DESTROY,
                this.destroyVideo
            )
        }
    }
)

export default ShowVideo
