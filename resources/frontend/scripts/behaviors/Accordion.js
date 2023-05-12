import { createBehavior } from '@area17/a17-behaviors'

const Accordion = createBehavior(
    'Accordion',
    {
        toggle(e) {
            e.preventDefault()

            const index = e.currentTarget.getAttribute('data-Accordion-index')

            if (this._data.activeIndexes.includes(index)) {
                this.close(index)

                this._data.activeIndexes = this._data.activeIndexes.filter(
                    (item) => {
                        return item !== index
                    }
                )
            } else {
                this.open(index)
                this._data.activeIndexes.push(index)
            }
        },

        close(index) {
            const activeTrigger = this.$triggers[index]
            const activeIcon = this.$triggerIcons[index]
            const activeIconSwap = activeTrigger.querySelector(
                '[data-accordion-trigger-icon-active]'
            )
            const activeContent = this.$contents[index]
            const contentHeight = activeContent.offsetHeight

            activeContent.style.height = `${contentHeight}px`

            setTimeout(() => {
                activeContent.style.height = '0px'
            }, 1)

            activeTrigger.setAttribute('aria-expanded', 'false')
            activeContent.setAttribute('aria-hidden', 'true')

            if (activeIconSwap) {
                activeIcon.classList.remove('opacity-0')
                activeIconSwap.classList.add('opacity-0')
            } else {
                const iconRotate =
                    activeTrigger.dataset.accordionIconRotate || 45
                const iconRotateClass = `rotate-${iconRotate || 45}`
                activeIcon.classList.remove(iconRotateClass)
            }
        },

        open(index) {
            const activeTrigger = this.$triggers[index]
            const activeIcon = this.$triggerIcons[index]
            const activeIconSwap = activeTrigger.querySelector(
                '[data-accordion-trigger-icon-active]'
            )
            const activeContent = this.$contents[index]
            const activeContentInner = this.$contentInners[index]

            activeContent.classList.remove('hidden')

            setTimeout(() => {
                const contentHeight = activeContentInner.offsetHeight
                activeContent.style.height = `${contentHeight}px`

                activeTrigger.setAttribute('aria-expanded', 'true')
                activeContent.setAttribute('aria-hidden', 'false')

                if (activeIconSwap) {
                    activeIcon.classList.add('opacity-0')
                    activeIconSwap.classList.remove('opacity-0')
                } else {
                    const iconRotate =
                        activeTrigger.dataset.accordionIconRotate || 45
                    const iconRotateClass = `rotate-${iconRotate || 45}`

                    activeIcon.classList.add(iconRotateClass)
                }
            }, 1)
        },

        handleTransitionEnd(e) {
            e.stopPropagation()

            if (e.currentTarget) {
                if (e.currentTarget.clientHeight === 0) {
                    e.currentTarget.classList.add('hidden')
                } else {
                    if (e.currentTarget.dataset.setFixedHeight == 'false') {
                        e.currentTarget.style.height = 'auto'
                    }
                    if (this.scrollOnOpen) {
                        this.$scrollElement.scrollTo({
                            top: e.currentTarget.parentElement.offsetTop,
                            behavior: 'smooth'
                        })
                    }
                }
            }
        }
    },
    {
        init() {
            this._data.activeIndexes = []
            this.scrollOnOpen = this.options['scroll-open']
                ? JSON.parse(this.options['scroll-open']) === 'true'
                : false
            this.$initOpen = this.getChildren('init-open')
            this.$triggers = this.getChildren('trigger')
            this.$triggerIcons = this.getChildren('trigger-icon')
            this.$contents = this.getChildren('content')
            this.$contentInners = this.getChildren('content-inner')

            if (this.scrollOnOpen) {
                this.$scrollElement = this.$node.closest(
                    '.overflow-y-auto, .overflow-y-scroll, .o-modal__wrapper'
                )
            }

            this.$triggers.forEach((trigger) => {
                trigger.addEventListener('click', this.toggle, false)
            })
            this.$contents.forEach((content) => {
                content.addEventListener(
                    'transitionend',
                    this.handleTransitionEnd,
                    false
                )
            })

            this.$initOpen.forEach((trigger) => {
                trigger.click()
            })
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.$triggers.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })
        }
    }
)

export default Accordion
