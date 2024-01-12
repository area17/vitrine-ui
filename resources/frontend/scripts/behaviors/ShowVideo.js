import { createBehavior } from '@area17/a17-behaviors'
import { queryStringHandler } from '@area17/a17-helpers'

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
            const type = this.options.videotype
            const id = this.options.videoid
            this._data.params = this._handleParams(type)

            if (type === 'youtube') {
                this._data.source = `https://www.youtube.com/embed/${id}${this._data.params}`
            } else if (type === 'vimeo') {
                this._data.source = `https://player.vimeo.com/video/${id}${this._data.params}`
            }

            this._data.videoiFrame = `<iframe data-video-player title="Video Player" src="${this._data.source}" mozallowfullscreen webkitallowfullscreen allowfullscreen allow="autoplay" class="w-full h-full"></iframe>`
            this.$videoPlayer.innerHTML = this._data.videoiFrame
            this._data.videoInitialized = true

            const iframe = this.$videoPlayer.querySelector('iframe')

            if (iframe) {
                iframe.onload = () => {
                    iframe.classList.add('is-loaded')
                }
            }
        },

        _showIframe() {
            if (this._data.videoInitialized) {
                return
            }

            this.$videoPlayer.classList.remove('hidden')

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
            if (
                this.options.autoplay !== false &&
                window.location.search.indexOf('playvideo') > -1
            ) {
                this.$node.classList.add('is-active')
                this._playVideo()
            }
        },

        _handleParams(embed_service) {
            let videoparams = {}

            if (embed_service == 'youtube') {
                videoparams['rel'] = 0
                videoparams['fs'] = 1
                videoparams['modestbranding'] = 1
                videoparams['playsinline'] = 1
                videoparams['showinfo'] = 0
                videoparams['enablejsapi'] = 1
                videoparams['autoplay'] = 1
            }

            if (embed_service == 'vimeo') {
                videoparams['color'] = '05d192'
                videoparams['title'] = 0
                videoparams['byline'] = 0
                videoparams['portrait'] = 0
                videoparams['autoplay'] = 1
            }

            let queryString = queryStringHandler.fromObject(videoparams)
            return queryString
        },

        _init() {
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

            if (['xs', 'sm'].includes(window.A17.currentMediaQuery)) {
                this._showIframe()
            }
        }
    },
    {
        init() {
            this._init()
            this._checkParams()
        },
        enabled() {},
        resized() {
            if (['xs', 'sm'].includes(window.A17.currentMediaQuery)) {
                this._showIframe()
            }
        },
        mediaQueryUpdated() {
            // current media query is: A17.currentMediaQuery
        },
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
