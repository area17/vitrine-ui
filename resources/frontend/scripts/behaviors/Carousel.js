import { createBehavior } from '@area17/a17-behaviors'

import { customEvents } from '../constants/customEvents'

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
                            el: '.swiper-pagination',
                            type: 'fraction'
                        }
                    })),
                ...this.opts,
                modules,
                ...configuration
            })
        }
    },
    {
        init() {
            this.swiper = null
            this.configuration = this.options.configuration

            // options
            this.opts = {
                on: {
                    slideChange: () => {
                        document.dispatchEvent(
                            new CustomEvent(customEvents.CAROUSEL_CHANGE, {
                                detail: { sliderEl: this.$node }
                            })
                        )
                    }
                },
                navigation: {
                    nextEl: '.swiper-next-btn',
                    prevEl: '.swiper-prev-btn'
                }
            }
        },
        enabled() {
            void this.initCarousel()
        },
        disabled() {
            this.swiper?.destroy()
            this.swiper = null
        }
    }
)

export default Carousel
