import { createBehavior } from '@area17/a17-behaviors'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'
import * as focusTrap from 'focus-trap'

const Modal = createBehavior(
    'Modal',
    {
        toggle(e) {
            e.preventDefault()
            e.stopPropagation()

            if (this._data.isActive) {
                this.close()
            } else {
                this.open()
            }
        },

        close() {
            if (this._data.isActive) {
                this.$node.classList.remove(...this._data.activeClasses)
                this._data.focusTrap.deactivate()
                this._data.isActive = false

                setTimeout(() => {
                    enableBodyScroll(this.$focusTrap)
                }, 200)

                this.$node.dispatchEvent(new CustomEvent('Modal:closed'))
                document.dispatchEvent(new CustomEvent('Modal:hasClosed'))
            }
        },

        open() {
            document.dispatchEvent(new CustomEvent('Modal:closeAll'))
            document.dispatchEvent(new CustomEvent('Modal:hasOpened'))
            this.$node.dispatchEvent(new CustomEvent('Modal:opened'))

            disableBodyScroll(this.$focusTrap, {
                reserveScrollBarGap: true
            })

            this.$node.classList.add(...this._data.activeClasses)
            this._data.isActive = true

            setTimeout(() => {
                this._data.focusTrap.activate()
            }, 300)
        },

        handleEsc(e) {
            if (e.key === 'Escape') {
                this.close()
            }
        },

        handleClickOutside(e) {
            if (this._data.isActive) {
                this.close(e)
            }
        },

        handleCloseInside(e) {
            e.stopPropagation()
        }
    },
    {
        init() {
            this.$focusTrap = this.getChild('focus-trap')
            this.$closeButtons = this.getChildren('close-trigger')
            this.$initialFocus = this.getChild('initial-focus')

            if (!this.$initialFocus) {
                console.warn(
                    'No initial focus element found. Add a `h1` with the attribute `data-Modal-initial-focus`. The `h1` should also have an id that matches the modal id with `_title` appended'
                )
            }

            this._data.focusTrap = focusTrap.createFocusTrap(this.$focusTrap, {
                initialFocus: this.$initialFocus,
                clickOutsideDeactivates: this.options['panel']
            })

            this._data.isActive = false
            this._data.activeClasses = ['o-modal-active']

            if (this.$closeButtons) {
                this.$closeButtons.forEach((closeButton) => {
                    closeButton.addEventListener('click', this.close, false)
                })
            }

            this.$node.addEventListener('Modal:toggle', this.toggle, false)
            this.$node.addEventListener('Modal:open', this.open, false)
            this.$node.addEventListener('Modal:close', this.close, false)
            document.addEventListener('Modal:closeAll', this.close, false)
            document.addEventListener('keyup', this.handleEsc, false)

            // add listener to modal toggle buttons
            const modalId = this.$node.getAttribute('id')
            this.$triggers = document.querySelectorAll(
                `[data-modal-target="#${modalId}"]`
            )

            this.$triggers.forEach((trigger) => {
                trigger.addEventListener('click', this.toggle, false)
            })

            if (this.options['panel']) {
                this.$focusTrap.addEventListener(
                    'click',
                    this.handleCloseInside,
                    false
                )
                document.addEventListener(
                    'click',
                    this.handleClickOutside,
                    false
                )
                this.$node.addEventListener(
                    'click',
                    this.handleClickOutside,
                    false
                )
            }
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {
            // current media query is: A17.currentMediaQuery
        },
        disabled() {},
        destroy() {
            this.close()

            if (this.$closeButtons) {
                this.$closeButtons.forEach((closeButton) => {
                    closeButton.removeEventListener('click', this.close)
                })
            }

            this.$node.removeEventListener('Modal:toggle', this.toggle)
            this.$node.removeEventListener('Modal:open', this.open)
            this.$node.removeEventListener('Modal:close', this.close)
            this.$node.removeEventListener('click', this.handleClickOutside)
            document.removeEventListener('Modal:closeAll', this.close)

            document.removeEventListener('keyup', this.handleEsc)

            this.$triggers.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })

            if (this.options['panel']) {
                this.$focusTrap.removeEventListener(
                    'click',
                    this.handleCloseInside,
                    false
                )
                document.removeEventListener(
                    'click',
                    this.handleClickOutside,
                    false
                )
                this.$node.removeEventListener(
                    'click',
                    this.handleClickOutside,
                    false
                )
            }
        }
    }
)

export default Modal
