import { createBehavior } from '@area17/a17-behaviors'

const ACTIVE_LIST_CLASS = 'trans-show-hide--active'
const ACTIVE_NODE_CLASS = 'is-active'
const ACTIVE_ROTATE_CLASS = 'rotate-180'

const Dropdown = createBehavior(
    'Dropdown',
    {
        _toggleList() {
            this.isOpen = !this.isOpen
            if (this.isOpen) {
                this.$node.classList.add(ACTIVE_NODE_CLASS)
                this.$list.classList.add(ACTIVE_LIST_CLASS)
                this.$chevron.classList.add(ACTIVE_ROTATE_CLASS)

                this._initOutClick()
            } else {
                this.$node.classList.remove(ACTIVE_NODE_CLASS)
                this.$list.classList.remove(ACTIVE_LIST_CLASS)
                this.$chevron.classList.remove(ACTIVE_ROTATE_CLASS)

                this._disabledOutClick(this.$node)
            }
        },

        _initOutClick() {
            document.addEventListener('click', this._clickOutside)
            window.addEventListener('keydown', this._checkKey)
        },

        _disabledOutClick() {
            document.removeEventListener('click', this._clickOutside)
            window.removeEventListener('keydown', this._checkKey)
        },

        _checkKey(e) {
            if (e.keyCode == 27) {
                this.$list.classList.remove(ACTIVE_LIST_CLASS)
                this._disabledOutClick(this.$node)
            }
        },

        _clickOutside(e) {
            const isClickInside = this.$node.contains(e.target)
            if (!isClickInside) {
                this._toggleList()
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
            this.$chevron = this.getChild('chevron')
            this.$btn.addEventListener('click', this._toggleList)
        },
        destroy() {
            this.$btn.addEventListener('remove', this._toggleList)
            this._disabledOutClick()
        }
    }
)

export default Dropdown
