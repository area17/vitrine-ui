import { createBehavior } from '@area17/a17-behaviors'
import { cookieHandler } from '@area17/a17-helpers'

import { customEvents } from '../constants/customEvents'

// export useful constants and functions
// to be used in other files
export const BANNER_COOKIE_NAME = 'banner_closed'
export const setBannerHeight = (bannerH) => {
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
            this.id = this.options.id || '1'
            this.cookieTimeout = this.options.cookietimeout || 3
            this.resizeObserver = null

            // check if cookie exist before showing the banner
            if (!cookieHandler.read(BANNER_COOKIE_NAME + this.id)) {
                this.$node.removeAttribute('hidden')
                this.setResize()
                setBannerHeight(this.$node.offsetHeight)
                this.$close = this.getChild('close-trigger')

                if (this.$close) {
                    this.$close.addEventListener('click', this.handleClose)
                }

                document.dispatchEvent(
                    new CustomEvent(customEvents.BANNER_OPENED)
                )
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
