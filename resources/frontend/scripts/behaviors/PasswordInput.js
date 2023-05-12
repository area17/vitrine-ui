import { createBehavior } from '@area17/a17-behaviors'

const PasswordInput = createBehavior(
    'PasswordInput',
    {
        toggleInputType(event) {
            event.preventDefault()
            event.stopPropagation()

            if (this.$input.type.toLowerCase() === 'password') {
                this.$iconHidden.style.display = 'none'
                this.$iconShown.style.display = ''
                this.$input.type = 'text'
            } else {
                this.$iconHidden.style.display = ''
                this.$iconShown.style.display = 'none'
                this.$input.type = 'password'
            }
        }
    },
    {
        init() {
            this.$input = this.getChild('input')
            this.$toggle = this.getChild('toggle')
            this.$iconHidden = this.getChild('iconhidden')
            this.$iconShown = this.getChild('iconshown')

            this.$toggle.addEventListener('click', this.toggleInputType, false)
        },
        destroy() {
            this.$toggle.removeEventListener('click', this.toggleInputType)
        }
    }
)

export default PasswordInput
