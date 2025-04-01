import { createBehavior } from '@area17/a17-behaviors'
import { cookieHandler } from '@area17/a17-helpers'

import { customEvents } from '../constants/customEvents'

const BANNER_COOKIE_NAME = 'banner_closed'
const setBannerHeight = (bannerH) => {
    document.documentElement.style.setProperty(
        '--banner-height',
        `${bannerH}px`
    )
}

const Banner = createBehavior(
    'Banner',
    {
        unsetResize() {
            setBannerHeight(0)
            if (this.resizeObserver) {
                this.resizeObserver.disconnect()
            }
        },
        setResize() {
            if (this.$node) {
                this.resizeObserver = new ResizeObserver((entries) => {
                    let bannerH = 0
                    for (const entry of entries) {
                        const target = entry.target
                        bannerH += target.offsetHeight
                    }
                    setBannerHeight(bannerH)
                })
                this.resizeObserver.observe(this.$node)
            }
        },
        handleClose() {
            // set cookie / local storage
            cookieHandler.create(
                BANNER_COOKIE_NAME + this.id,
                'suppressed',
                this.cookieTimeout
            )
            this.$node.setAttribute('hidden', '')
            this.unsetResize()

            document.dispatchEvent(new CustomEvent(customEvents.BANNER_CLOSED))
        }
    },
    {
        init() {
            this.id = this.options.id || Math.random().toString(36).substring(7)
            this.cookieTimeout = this.options.cookietimeout || 3
            this.resizeObserver = null

            // check if cookie exist to hide banner
            if (cookieHandler.read(BANNER_COOKIE_NAME + this.id)) {
                this.handleClose()
            } else {
                this.$node.removeAttribute('hidden')
                this.setResize()
                this.$close = this.getChild('close-trigger')

                if (this.$close) {
                    this.$close.addEventListener('click', this.handleClose)
                }
            }
        },
        destroy() {
            this.unsetResize()
            if (this.$close) {
                this.$close.removeEventListener('click', this.handleClose)
            }
        }
    }
)

export default Banner
