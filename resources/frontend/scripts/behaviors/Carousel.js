import { createBehavior } from '@area17/a17-behaviors'

import { customEvents } from '../constants/customEvents'

const SELECTORS = {
    PAGINATION: '.swiper-pagination',
    NEXT_BTN: '.swiper-next-btn',
    PREV_BTN: '.swiper-prev-btn'
}

const Carousel = createBehavior(
    'Carousel',
    {
        async initCarousel() {
            if (this.swiper) return

            // import swiper and modules only when initializing the carousel
            const { Swiper } = await import('swiper')
            const { A11y, Autoplay, EffectFade, Navigation, Pagination } =
                await import('swiper/modules')

            // extra configuration
            let configuration = {}
            if (
                this.configuration &&
                window.A17?.sliderConfigurations &&
                this.configuration in window.A17.sliderConfigurations
            ) {
                configuration =
                    window.A17.sliderConfigurations[this.configuration]
            }

            // Default modules
            const modules = [Navigation, A11y]

            if (this.options.pagination || configuration.pagination) {
                modules.push(Pagination)
            }
            if (this.options.effect === 'fade' || configuration.effect) {
                modules.push(EffectFade)
            }
            if (this.options.autoplay || configuration.autoplay) {
                modules.push(Autoplay)
            }

            // init swiper
            this.swiper = new Swiper(this.$node, {
                initialSlide: this.options.initialslide || 0,
                loop:
                    'loop' in this.options
                        ? this.options.loop === 'true'
                        : true,
                ...(this.options.effect === 'fade' ||
                    (configuration.effect && {
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        }
                    })),
                ...(this.options.pagination ||
                    (configuration.pagination && {
                        pagination: {
                            el: this.$node.querySelector(SELECTORS.PAGINATION),
                            type: 'fraction'
                        }
                    })),
                ...this.opts,
                modules,
                ...configuration
            })

            this.$node.dispatchEvent(
                new CustomEvent(customEvents.CAROUSEL_INIT, {
                    detail: { swiper: this.swiper }
                })
            )
        }
    },
    {
        init() {
            this.swiper = null
            this.configuration = this.options.configuration

            // options
            this.opts = {
                on: {
                    slideChange: (swiper) => {
                        document.dispatchEvent(
                            new CustomEvent(customEvents.CAROUSEL_CHANGE, {
                                detail: { sliderEl: this.$node, swiper }
                            })
                        )
                    }
                },
                navigation: {
                    nextEl: this.$node.querySelector(SELECTORS.NEXT_BTN),
                    prevEl: this.$node.querySelector(SELECTORS.PREV_BTN)
                }
            }
        },
        enabled() {
            void this.initCarousel()
        },
        disabled() {
            this.swiper?.destroy()
            this.swiper = null

            this.$node.dispatchEvent(
                new CustomEvent(customEvents.CAROUSEL_DESTROY)
            )
        }
    }
)

export default Carousel
