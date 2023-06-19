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

            const activeContent = this.$contents[index]
            const contentHeight = activeContent.offsetHeight

            activeContent.style.height = `${contentHeight}px`

            setTimeout(() => {
                activeContent.style.height = '0px'
            }, 16)

            activeTrigger.setAttribute('aria-expanded', 'false')
            activeContent.setAttribute('aria-hidden', 'true')
        },

        open(index) {
            const activeTrigger = this.$triggers[index]

            const activeContent = this.$contents[index]
            const activeContentInner = this.$contentInners[index]

            activeContent.classList.remove('hidden')

            setTimeout(() => {
                const contentHeight = activeContentInner.offsetHeight
                activeContent.style.height = `${contentHeight}px`

                activeTrigger.setAttribute('aria-expanded', 'true')
                activeContent.setAttribute('aria-hidden', 'false')
            }, 16)
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

            this.$initOpen = this.getChildren('init-open')
            this.$triggers = this.getChildren('trigger')
            this.$contents = this.getChildren('content')
            this.$contentInners = this.getChildren('content-inner')
        },
        enabled() {
            if (this.scrollOnOpen) {
                this.$scrollElement = this.$node.closest('[data-accordion-scroll-wrapper]')
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
        disabled() {
            this.$triggers.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })
        }
    }
)

export default Accordion
