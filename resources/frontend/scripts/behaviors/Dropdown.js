import { createBehavior } from '@area17/a17-behaviors'
import { getFocusableElements } from '@area17/a17-helpers'

const Dropdown = createBehavior(
    'Dropdown',
    {
        toggleList() {
            if (this.isOpen) {
                this.closeDropdown()
            } else {
                this.openDropdown()
            }
        },
        openDropdown() {
            // Timing
            const mediaQueryReducedMotion = window.matchMedia(
                '(prefers-reduced-motion: reduce)'
            )
            let TIMING = 500
            mediaQueryReducedMotion.matches && (TIMING = 100)

            this.isOpen = true
            this.$node.setAttribute('data-is-open', 'true')
            this.$btn.setAttribute('aria-expanded', 'true')
            this.initOutClick()
            this.timeout = window.setTimeout(() => {
                this.$focusableItems = this.$list
                    ? getFocusableElements(this.$list)
                    : []
                this.$focusIndex = 0
                this.focusItem()
            }, TIMING) // wait for potential reveal animations
        },
        focusAndCloseDropdown() {
            this.$btn.focus()
            this.closeDropdown()
        },
        closeDropdown() {
            this.isOpen = false
            this.$node.removeAttribute('data-is-open')
            this.$btn.setAttribute('aria-expanded', 'false')
            this.disabledOutClick(this.$node)
            window.clearTimeout(this.timeout)
        },
        initOutClick() {
            document.addEventListener('click', this.clickOutside)
            window.addEventListener('keydown', this.checkKey)
        },
        disabledOutClick() {
            document.removeEventListener('click', this.clickOutside)
            window.removeEventListener('keydown', this.checkKey)
        },
        focusItem() {
            this.$focusableItems[this.$focusIndex]?.focus()
        },
        checkKey(e) {
            const key = e.key
            switch (key) {
                case 'Tab':
                    e.preventDefault()
                    e.stopPropagation()

                    // shift + tab
                    if (e.shiftKey) {
                        this.$focusIndex--
                        if (this.$focusIndex < 0) {
                            this.$focusIndex = 0
                            this.focusAndCloseDropdown()
                        } else {
                            this.focusItem()
                        }
                        return
                    } else {
                        this.$focusIndex++
                        if (this.$focusIndex >= this.$focusableItems.length) {
                            this.focusAndCloseDropdown()
                        } else {
                            this.focusItem()
                        }
                    }

                    break
                case 'Up':
                case 'ArrowUp':
                    e.preventDefault()
                    this.$focusIndex--
                    if (this.$focusIndex < 0) {
                        this.$focusIndex = 0
                    }
                    this.focusItem()
                    break
                case 'Down':
                case 'ArrowDown':
                    e.preventDefault()
                    this.$focusIndex++
                    if (this.$focusIndex >= this.$focusableItems.length) {
                        this.$focusIndex = this.$focusableItems.length - 1
                    }
                    this.focusItem()
                    break
            }
        },
        clickOutside(e) {
            const isClickInside = this.$node.contains(e.target)
            if (!isClickInside) {
                this.toggleList()
            }
        }
    },
    {
        init() {
            // state
            this.isOpen = false

            // elems
            this.$btn = this.getChild('btn')
            this.$list = this.getChild('list')
            this.$focusableItems = this.$list
                ? getFocusableElements(this.$list)
                : []
            this.timeout = null
            this.$focusIndex = 0
            this.$btn.addEventListener('click', this.toggleList)
        },
        destroy() {
            this.$btn.removeEventListener('click', this.toggleList)
            this.disabledOutClick()
        }
    }
)

export default Dropdown
