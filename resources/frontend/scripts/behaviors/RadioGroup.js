import { createBehavior } from '@area17/a17-behaviors'

const RadioGroup = createBehavior(
    'RadioGroup',
    {
        resetErrorState() {
            this.$error.textContent = ''
            this.$error.style.display = 'none'
            this.$node.classList.remove('s-error')
        },
        showErrorState(msg) {
            if (msg) {
                this.$error.textContent = msg
            }
            this.$error.style.display = ''
            this.$node.classList.add('s-error')
        },
        validate(event) {
            let $input = this.$node.querySelector('input:not(:disabled)')
            let validityMsg = event?.detail
                ? event.detail
                : $input.validationMessage

            if (validityMsg.length) {
                this.showErrorState(validityMsg)
            } else {
                this.resetErrorState()
            }
        }
    },
    {
        init() {
            this.$error = this.getChild('error')

            this.$node.addEventListener(
                'RadioGroup:Validated',
                this.validate,
                false
            )

            if (this.$error.textContent.trim().length > 0) {
                this.showErrorState()
            }
        },
        destroy() {
            this.$node.removeEventListener(
                'RadioGroup:Validated',
                this.validate
            )
        }
    }
)

export default RadioGroup
