import { createBehavior } from '@area17/a17-behaviors'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock-upgrade'
import * as focusTrap from 'focus-trap'

const Modal = createBehavior(
    'Modal',
    {
        toggle(e) {
            e.preventDefault()
            e.stopPropagation()

            if (this._data.isActive) {
                this.close(e)
            } else {
                this.open(e)
            }
        },
        close(e) {
            e?.preventDefault()
            e?.stopPropagation()
            if (this._data.isActive) {
                this.$node.removeAttribute('data-active')
                this._data.focusTrap.deactivate()
                this._data.isActive = false

                setTimeout(() => {
                    enableBodyScroll(this.$focusTrap)
                }, 200)

                this.$node.dispatchEvent(new CustomEvent('Modal:closed'))
                document.dispatchEvent(new CustomEvent('Modal:hasClosed'))
                this.disposeOpenEvents()
            }
        },
        openFromOutside(e) {
            if(e.detail?.modalId === this.$modalId && !this._data.isActive) {
                e.preventDefault()
                e.stopPropagation()
                this.open()
            }
        },
        open() {
            document.dispatchEvent(new CustomEvent('Modal:closeAll'))
            document.dispatchEvent(new CustomEvent('Modal:hasOpened'))
            this.$node.dispatchEvent(new CustomEvent('Modal:opened'))

            disableBodyScroll(this.$focusTrap, {
                reserveScrollBarGap: true
            })

            this.$node.setAttribute('data-active', 'true')
            this._data.isActive = true

            this.registerOpenEvents()

            this._data.focusTrap.activate()
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
        },
        registerOpenEvents() {
            if (this.$clickOutside) {
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
        disposeOpenEvents() {
            if (this.$clickOutside) {
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
    },
    {
        init() {
            this.$focusTrap = this.getChild('focus-trap')
            this.$closeButtons = this.getChildren('close-trigger')
            this.$initialFocus = this.getChild('initial-focus')
            this.$clickOutside = this.options['panel'] || this.options['clickoutside']

            if (!this.$initialFocus) {
                console.warn(
                    'No initial focus element found. Add a `h1` with the attribute `data-Modal-initial-focus`. The `h1` should also have an id that matches the modal id with `_title` appended'
                )
            }

            this._data.focusTrap = focusTrap.createFocusTrap(this.$focusTrap, {
                initialFocus: this.$initialFocus,
                fallbackFocus: this.$node,
                clickOutsideDeactivates: this.$clickOutside
            })

            this._data.isActive = false

            if (this.$closeButtons) {
                this.$closeButtons.forEach((closeButton) => {
                    closeButton.addEventListener('click', this.close, false)
                })
            }

            this.$node.addEventListener('Modal:open', this.open, false)
            this.$node.addEventListener('Modal:toggle', this.toggle, false)
            this.$node.addEventListener('Modal:close', this.close, false)

            document.addEventListener('Modal:openById', this.openFromOutside, false)
            document.addEventListener('Modal:closeAll', this.close, false)
            document.addEventListener('keyup', this.handleEsc, false)

            // add listener to modal toggle buttons
            this.$modalId = this.$node.getAttribute('id')

            this.$triggers = document.querySelectorAll(
                `[data-modal-target="#${this.$modalId}"]`
            )

            this.$triggers?.forEach((trigger) => {
                trigger.addEventListener('click', this.toggle)
            })

        },
        destroy() {
            this.close()

            if (this.$closeButtons) {
                this.$closeButtons.forEach((closeButton) => {
                    closeButton.removeEventListener('click', this.close)
                })
            }

            this.$node.removeEventListener('Modal:open', this.open)
            this.$node.removeEventListener('Modal:toggle', this.toggle)
            this.$node.removeEventListener('Modal:close', this.close)
            this.$node.removeEventListener('click', this.handleClickOutside)

            document.removeEventListener('Modal:openById', this.openFromOutside)
            document.removeEventListener('Modal:closeAll', this.close)
            document.removeEventListener('keyup', this.handleEsc)

            this.$triggers?.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })

            this.disposeOpenEvents()
        }
    }
)

export default Modal
