import { createBehavior } from '@area17/a17-behaviors'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock-upgrade'
import * as focusTrap from 'focus-trap'

import { customEvents } from '../constants/customEvents'

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
                    enableBodyScroll(this.$scroller)
                }, 200)

                this.$node.dispatchEvent(
                    new CustomEvent(customEvents.MODAL_NODE_CLOSED)
                )
                document.dispatchEvent(
                    new CustomEvent(customEvents.MODAL_CLOSED)
                )
                this.disposeOpenEvents()
            }
        },
        openFromOutside(e) {
            if (e.detail?.modalId === this.$modalId && !this._data.isActive) {
                e.preventDefault()
                e.stopPropagation()
                this.open()
            }
        },
        open() {
            document.dispatchEvent(
                new CustomEvent(customEvents.MODAL_CLOSE_ALL)
            )
            document.dispatchEvent(new CustomEvent(customEvents.MODAL_OPENED))
            this.$node.dispatchEvent(
                new CustomEvent(customEvents.MODAL_NODE_OPENED)
            )

            disableBodyScroll(this.$scroller, {
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
            this.$scroller = this.getChild('scroller')
                ? this.getChild('scroller')
                : this.$focusTrap
            this.$closeButtons = this.getChildren('close-trigger')
            this.$initialFocus = this.getChild('initial-focus')
            this.$clickOutside =
                this.options['panel'] || this.options['clickoutside']

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

            this.$node.addEventListener(
                customEvents.MODAL_NODE_OPEN,
                this.open,
                false
            )
            this.$node.addEventListener(
                customEvents.MODAL_NODE_TOGGLE,
                this.toggle,
                false
            )
            this.$node.addEventListener(
                customEvents.MODAL_NODE_CLOSE,
                this.close,
                false
            )

            document.addEventListener(
                customEvents.MODAL_OPEN_BY_ID,
                this.openFromOutside,
                false
            )
            document.addEventListener(
                customEvents.MODAL_CLOSE_ALL,
                this.close,
                false
            )
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

            this.$node.removeEventListener(
                customEvents.MODAL_NODE_OPEN,
                this.open
            )
            this.$node.removeEventListener(
                customEvents.MODAL_NODE_TOGGLE,
                this.toggle
            )
            this.$node.removeEventListener(
                customEvents.MODAL_NODE_CLOSE,
                this.close
            )
            this.$node.removeEventListener('click', this.handleClickOutside)

            document.removeEventListener(
                customEvents.MODAL_OPEN_BY_ID,
                this.openFromOutside
            )
            document.removeEventListener(
                customEvents.MODAL_CLOSE_ALL,
                this.close
            )
            document.removeEventListener('keyup', this.handleEsc)

            this.$triggers?.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })

            this.disposeOpenEvents()
        }
    }
)

export default Modal
