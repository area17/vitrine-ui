import { createBehavior } from '@area17/a17-behaviors'
import Swiper from 'swiper'
import { A11y, EffectFade, Navigation, Pagination } from 'swiper/modules'

import { customEvents } from '../constants/customEvents'

const Carousel = createBehavior(
    'Carousel',
    {
        async initCarousel() {
            if (this.swiper) return

            // const { Swiper } = await import('swiper')

            this.swiper = new Swiper(this.$node, {
                ...this.opts
            })
        }
    },
    {
        init() {
            this.swiper = null
            const modules = [Navigation, A11y, Pagination]
            if (this.options.effect === 'fade') {
                modules.push(EffectFade)
            }

            this.configuration = this.options.configuration
            let configuration = {}
            if (
                this.configuration &&
                window.A17?.sliderConfigurations &&
                this.configuration in window.A17.sliderConfigurations
            ) {
                configuration =
                    window.A17.sliderConfigurations[this.configuration]
            }

            this.opts = {
                loop:
                    'loop' in this.options
                        ? this.options.loop === 'true'
                        : true,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'fraction'
                },
                ...(this.options.effect === 'fade' && {
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    }
                }),
                modules,
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
                },
                ...configuration
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
