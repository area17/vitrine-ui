import { createBehavior } from '@area17/a17-behaviors'
import { queryStringHandler } from '@area17/a17-helpers'

const PARAM_YOUTUBE = {
    rel: 0,
    fs: 1,
    modestbranding: 1,
    playsinline: 1,
    showinfo: 0,
    enablejsapi: 1,
    autoplay: 1,
}

const PARAM_VIMEO = {
    color: '05d192',
    title: 0,
    byline: 0,
    portrait: 0
}

const ShowVideo = createBehavior(
    'ShowVideo',
    {
        _handleClicks(event) {
            event.preventDefault()
            event.stopPropagation()

            this.$videoPlayer.classList.remove('hidden')
            this._playVideo()
        },

        _playVideo() {
            if (this._data.videoInitialized) {
                return
            }

            const type = this.options.type
            const id = this.options.id
            this._data.params = this._handleParams(type)

            if (type === 'youtube') {
                this._data.source = `https://www.youtube.com/embed/${id}${this._data.params}`
            } else if (type === 'vimeo') {
                this._data.source = `https://player.vimeo.com/video/${id}${this._data.params}`
            }

            this.$videoPlayer.classList.remove('hidden')
            this._data.videoiFrame = `<iframe data-video-player title="Video Player" src="${this._data.source}" mozallowfullscreen webkitallowfullscreen allowfullscreen allow="autoplay" class="w-full h-full"></iframe>`
            this.$videoPlayer.innerHTML = this._data.videoiFrame
            this.$node.classList.add('is-active')
            this._data.videoInitialized = true

            const iframe = this.$videoPlayer.querySelector('iframe')

            if (iframe) {
                iframe.onload = () => {
                    iframe.classList.add('is-loaded')
                }
            }
        },

        _showIframe() {
            this._playVideo()
        },

        _removeIframe() {
            if (!this._data.videoInitialized) {
                return
            }

            this.$videoPlayer.classList.add('hidden')
            this.$videoPlayer.innerHTML = ''
        },

        _checkParams() {
            // Autoplay video if playvideo query string in the current url
            if (
                this._autoplay &&
                window.location.search.indexOf('playvideo') > -1
            ) {
                this._playVideo()
            }
        },

        _handleParams(embed_service) {
            let videoparams = {}

            if (embed_service == 'youtube') videoparams = PARAM_YOUTUBE
            if (embed_service == 'vimeo') videoparams = PARAM_VIMEO

            // force autoplay
            videoparams.autoplay = this._autoplay ? 1 : 0

            let queryString = queryStringHandler.fromObject(videoparams)
            return queryString
        },

        _init() {
            this._autoplay = Boolean(this.options.autoplay && this.options.autoplay !== '0')
            this.$videoPlayer = this.getChild('player')
            this.$trigger = this.getChild('media-container')
            this._data.source
            this._data.params
            this._data.videoiFrame
            this._data.videoInitialized = false

            this.$trigger.addEventListener('click', this._handleClicks, false)
            this.$videoPlayer.innerHTML = ''

            this.$videoPlayer.addEventListener(
                'video:destroy',
                this._removeIframe,
                false
            )

            // TODO IF RELIABLE : detect autoplay is forbidden on Youtube/Vimeo embed (ie : iOS/Android) to launch player on init
            // to avoid double clicks to launch videos
        }
    },
    {
        init() {
            this._init()
            this._checkParams()
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.$trigger.removeEventListener('click', this._handleClicks)
            this.$videoPlayer.removeEventListener(
                'video:destroy',
                this._removeIframe
            )
        }
    }
)

export default ShowVideo
