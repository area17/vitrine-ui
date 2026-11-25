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
                // Closed content must not be tabbable nor exposed to assistive technologies
                this.$node.setAttribute('inert', '')
                this._data.focusTrap.deactivate()
                this._data.isActive = false

                // Tracked, so reopening before it fires does not unlock the scroll of an open modal
                this._data.scrollTimeout = setTimeout(() => {
                    if (this.$scroller) {
                        enableBodyScroll(this.$scroller)
                    }
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

            clearTimeout(this._data.scrollTimeout)
            disableBodyScroll(this.$scroller, {
                reserveScrollBarGap: true
            })

            this.$node.removeAttribute('inert')
            this.$node.setAttribute('data-init', 'true')
            this.$node.setAttribute('data-active', 'true')
            this._data.isActive = true

            this.registerOpenEvents()

            this._data.focusTrap.activate()
        },
        handleEsc(e) {
            // A nested picker or dropdown that used the key has already prevented it
            if (e.key === 'Escape' && !e.defaultPrevented) {
                this.close()
            }
        },
        handleClickOutside(e) {
            if (this._data.isActive && !this.$focusTrap.contains(e.target)) {
                this.close(e)
            }
        },
        registerOpenEvents() {
            if (this.$clickOutside) {
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

            // `setInitialFocus` is false on the component: the modal itself takes the focus
            const wantsInitialFocus =
                String(this.options['initialfocus']) !== 'false'

            if (!this.$initialFocus && wantsInitialFocus) {
                console.warn(
                    'No initial focus element found. Add a `h1` with the attribute `data-Modal-initial-focus`. The `h1` should also have an id that matches the modal id with `_title` appended'
                )
            }

            // Label the dialog with a title passed in the slot (the component handles the `title` prop)
            this.$modalId = this.$node.getAttribute('id')
            if (
                !this.$node.hasAttribute('aria-labelledby') &&
                this.$modalId &&
                this.$node.querySelector(`[id="${this.$modalId}_title"]`)
            ) {
                this.$node.setAttribute(
                    'aria-labelledby',
                    `${this.$modalId}_title`
                )
            }

            this._data.focusTrap = focusTrap.createFocusTrap(this.$focusTrap, {
                // focus-trap throws on `null`, `undefined` falls back to the first tabbable or `fallbackFocus`
                initialFocus: this.$initialFocus || undefined,
                fallbackFocus: this.$node,
                clickOutsideDeactivates: this.$clickOutside,
                // `handleEsc` closes the modal, and focus-trap would prevent the key and hide it from `handleEsc`
                escapeDeactivates: false
            })

            this._data.isActive = false
            this.$node.setAttribute('inert', '')

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
            window.addEventListener('keydown', this.handleEsc, false)

            // add listener to modal toggle buttons
            this.$triggers = document.querySelectorAll(
                `[data-modal-target="#${this.$modalId}"]`
            )

            this.$triggers?.forEach((trigger) => {
                trigger.addEventListener('click', this.toggle)
            })

            // open on page load
            if (this.options['open']) {
                this.open()
            }
        },
        destroy() {
            this.close()

            // Unlock the scroll now, the pending timeout would run on a destroyed behavior
            clearTimeout(this._data.scrollTimeout)
            if (this.$scroller) {
                enableBodyScroll(this.$scroller)
            }

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
            window.removeEventListener('keydown', this.handleEsc)

            this.$triggers?.forEach((trigger) => {
                trigger.removeEventListener('click', this.toggle)
            })

            this.disposeOpenEvents()
        }
    }
)

export default Modal
