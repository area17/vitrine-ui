import { createBehavior } from '@area17/a17-behaviors'

const TIMEOUT = 16

const Accordion = createBehavior(
    'Accordion',
    {
        getTriggerIndex(trigger) {
            return trigger.getAttribute('data-Accordion-index')
        },
        triggerClose(index) {
            this.close(index)
            this._data.activeIndexes = this._data.activeIndexes.filter(
                (item) => item !== index
            )
        },
        triggerOpen(index) {
            this.open(index)
            this._data.activeIndexes.push(index)

            // exclusive mode : close other opened accordion items
            if (this.exclusive) {
                setTimeout(() => {
                    this.$triggers.forEach((trigger) => {
                        const triggerIndex = this.getTriggerIndex(trigger)

                        // closed opened accordion items
                        if (
                            this._data.activeIndexes.includes(triggerIndex) &&
                            triggerIndex !== index
                        ) {
                            this.triggerClose(triggerIndex)
                        }
                    })
                }, TIMEOUT + 1)
            }
        },
        toggle(e) {
            e.preventDefault()

            const index = this.getTriggerIndex(e.currentTarget)

            if (this._data.activeIndexes.includes(index)) {
                this.triggerClose(index)
            } else {
                this.triggerOpen(index)
            }
        },

        close(index) {
            const activeTrigger = this.$triggers[index]
            const activeContent = this.$contents[index]

            const contentHeight = activeContent.offsetHeight

            activeContent.style.height = `${contentHeight}px`

            setTimeout(() => {
                activeContent.style.height = '0px'
            }, TIMEOUT)

            activeTrigger.setAttribute('aria-expanded', 'false')
            activeTrigger.setAttribute(`data-${this.name}-open`, 'false')
            activeContent.setAttribute('aria-hidden', 'true')
            activeContent.setAttribute(`data-${this.name}-open`, 'false')
        },

        open(index) {
            const activeTrigger = this.$triggers[index]

            const activeContent = this.$contents[index]
            const activeContentInner = this.$contentInners[index]

            activeContent.classList.remove('hidden')

            // Start Animation
            setTimeout(() => {
                const contentHeight = activeContentInner.offsetHeight
                activeContent.style.height = `${contentHeight}px`
                activeTrigger.setAttribute('aria-expanded', 'true')
                activeTrigger.setAttribute(`data-${this.name}-open`, 'true')
            }, TIMEOUT)
        },

        handleTransitionEnd(e) {
            e.stopPropagation()

            if (e.currentTarget) {
                if (e.currentTarget.clientHeight === 0) {
                    e.currentTarget.classList.add('hidden')
                } else {
                    if (e.currentTarget.dataset.setFixedHeight === 'false') {
                        e.currentTarget.style.height = 'auto'
                    }

                    // set overflow unset after animation to avoid content to overflow while animating
                    e.currentTarget.setAttribute('aria-hidden', 'false')
                    e.currentTarget.setAttribute(
                        `data-${this.name}-open`,
                        'true'
                    )

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
            this.scrollOnOpen = this.options['scroll-open'] === 'true'
            this.exclusive = this.options['exclusive'] === 'true'

            this.$initOpen = this.getChildren('init-open')
            this.$triggers = this.getChildren('trigger')
            this.$contents = this.getChildren('content')
            this.$contentInners = this.getChildren('content-inner')
        },
        enabled() {
            if (this.scrollOnOpen) {
                this.$scrollElement = this.$node.closest(
                    '[data-accordion-scroll-wrapper]'
                )
            }

            this.$triggers.forEach((trigger) => {
                const index = this.getTriggerIndex(trigger)

                trigger.addEventListener('click', this.toggle, false)

                // closed opened accordion items
                // to make sure content is not re-opened when resizing the window
                if (this._data.activeIndexes.includes(index)) {
                    this.triggerClose(index)
                }

                // check if the accordion item should be opened by default
                const isOpen =
                    trigger.getAttribute(`data-${this.name}-open`) === 'true'
                if (isOpen) {
                    this.triggerOpen(index)
                }
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
        disabled() {
            this.$triggers.forEach((trigger) => {
                const index = this.getTriggerIndex(trigger)

                trigger.removeEventListener('click', this.toggle)

                // Reopen closed accordion items :
                // to make sure content is not hidden in certain breakpoints
                if (!this._data.activeIndexes.includes(index)) {
                    this.triggerOpen(index)
                }
            })

            // reset height to auto for opened contents
            setTimeout(() => {
                if (!this.$contents) return
                this.$contents.forEach((content) => {
                    content.style.height = ''
                })
            }, TIMEOUT + 1)
        }
    }
)

export default Accordion
