import { createBehavior } from '@area17/a17-behaviors'

const ERROR_CSS = 's-error'

const Input = createBehavior(
    'Input',
    {
        resetErrorState() {
            this.$error.textContent = ''
            this.$error.style.display = 'none'
            this.$node.classList.remove(ERROR_CSS)
        },
        showErrorState(msg) {
            if (msg) {
                this.$error.textContent = msg
            }
            this.$error.style.display = ''
            this.$node.classList.add(ERROR_CSS)
        },
        validated(event) {
            let validityMsg = event?.detail
                ? event.detail
                : this.$input.validationMessage

            if (validityMsg.length) {
                this.showErrorState(validityMsg)
            } else {
                this.resetErrorState()
            }
        }
    },
    {
        init() {
            this.$input = this.getChild('input')
            this.$error = this.getChild('error')

            this.$input.addEventListener(
                'Input:Validated',
                this.validated,
                false
            )
            this.$input.addEventListener(
                'Input:Reset',
                this.resetErrorState,
                false
            )

            if (this.$error.textContent.trim().length > 0) {
                this.showErrorState()
            }
        },
        destroy() {
            this.$input.removeEventListener('Input:Validated', this.validated)
            this.$input.removeEventListener('Input:Reset', this.resetErrorState)
        }
    }
)

export default Input
