import { createBehavior } from '@area17/a17-behaviors'

const Pagination = createBehavior(
    'Pagination',
    {
        handlePagingDropdown() {
            window.location = this.$pagingDropdown.value
        }
    },
    {
        init() {
            this.$pagingDropdownWrapper = this.getChild('paging-dropdown')
            this.$pagingDropdown = this.$pagingDropdownWrapper
                ? this.$pagingDropdownWrapper.querySelector('select')
                : null

            if (this.$pagingDropdown) {
                this.$pagingDropdown.addEventListener(
                    'change',
                    this.handlePagingDropdown,
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
            this.$pagingDropdown.removeEventListener(
                'change',
                this.handlePagingDropdown
            )
        }
    }
)

export default Pagination
