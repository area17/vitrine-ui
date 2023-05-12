import { createBehavior } from '@area17/a17-behaviors'
import OpenSeadragon from 'openseadragon'

const ImageZoom = createBehavior(
    'ImageZoom',
    {
        initViewer() {
            if (!this.isActive) {
                this.viewer = OpenSeadragon(this.viewerOptions)
                this.viewer.goToPage(0)
                this.isActive = true

                this.viewer.addHandler('open', () => {
                    // remove the OSD hard-coded inline styles from the buttons on init because there's no other way to customize it
                    Object.values(this.buttonIds).forEach((id) => {
                        const button = this.$node.querySelector(`#${id}`)

                        if (button) {
                            button.style.display = ''
                            button.style.opacity = ''
                        }
                    })
                })
            }
        },

        updateViewer(e) {
            if (this.isActive) {
                const index = e.detail.index
                if (index > -1) {
                    this.viewer.goToPage(index)
                    this.viewer.viewport.goHome()
                }
            }
        }
    },
    {
        init() {
            const iiifBaseURL = 'https://base-iiif-url'
            this.isActive = false
            this.autoInit = this.options['auto-init'] === 'true'
            this.sources = JSON.parse(this.options.sources)
            this.$canvas = this.getChild('canvas')
            this.id = this.$canvas.id

            const tileSources = this.sources.map(function (source) {
                if (typeof source === 'string') {
                    return {
                        url: source,
                        type: 'image'
                    }
                } else {
                    return {
                        '@context': 'http://iiif.io/api/image/2/context.json',
                        '@id': iiifBaseURL + source['iiifId'],
                        width: source['width'],
                        height: source['height'],
                        profile: ['http://iiif.io/api/image/2/level2.json'],
                        protocol: 'http://iiif.io/api/image'
                    }
                }
            })

            this.buttonIds = {
                zoomIn: this.id + '-image-zoom-zoom-in',
                zoomOut: this.id + '-image-zoom-zoom-out',
                previous: this.id + '-image-zoom-nav-prev',
                next: this.id + '-image-zoom-nav-next'
            }

            this.viewerOptions = {
                id: this.id,
                prefixUrl:
                    window.location.protocol +
                    '//openseadragon.github.io/openseadragon/images/',
                preserveViewport: true,
                springStiffness: 15,
                visibilityRatio: 1,
                zoomPerScroll: 1.2,
                zoomPerClick: 1.3,
                immediateRender: false,
                constrainDuringPan: true,
                animationTime: 1.5,
                minZoomLevel: 0,
                minZoomImageRatio: 0.8,
                maxZoomPixelRatio: 5,
                defaultZoomLevel: 0,
                gestureSettingsMouse: {
                    scrollToZoom: false // disabled so slideshow doesn't work if zoomable is enabled on full width media
                },
                zoomInButton: this.buttonIds.zoomIn,
                zoomOutButton: this.buttonIds.zoomOut,
                previousButton: this.buttonIds.previous,
                nextButton: this.buttonIds.next,
                showZoomControl: true,
                showHomeControl: false,
                showFullPageControl: false,
                showRotationControl: false,
                showSequenceControl: true,
                tileSources,
                sequenceMode: true,
                navPrevNextWrap: true
            }

            if (this.autoInit) {
                this.initViewer()
            } else {
                const modal = this.$node.closest('[data-behavior="Modal"]')

                if (modal) {
                    modal.addEventListener(
                        'Modal:opened',
                        this.initViewer,
                        false
                    )
                }

                this.$node.addEventListener(
                    'image-zoom:init',
                    this.initViewer,
                    false
                )
            }

            document.addEventListener(
                'image-zoom:update',
                this.updateViewer,
                false
            )
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.viewer.destroy()
            document.removeEventListener(
                'image-zoom:update',
                this.updateViewer,
                false
            )

            if (!this.autoInit) {
                const modal = this.$node.closest('[data-behavior="Modal"]')

                if (modal) {
                    modal.removeEventListener('Modal:open', this.initViewer)
                }

                this.$node.removeEventListener(
                    'image-zoom:init',
                    this.initViewer
                )
            }
        }
    }
)

export default ImageZoom
