import { createBehavior } from '@area17/a17-behaviors'

/*
    SelectSizer

    Description :
    Resize select based on the current select value
*/
const SelectSizer = createBehavior(
    'SelectSizer',
    {
        handleChange() {
            this.$textSizer.textContent =
                this.$select.options[this.$select.selectedIndex].text
            this.$select.style.width = `${this.$textSizer.offsetWidth}px`
        }
    },
    {
        init() {
            this.$node.classList.add('relative')
            this.$select =
                this.$node.tagName === 'SELECT'
                    ? this.$node
                    : this.$node.querySelector('select')

            if (this.$select) {
                // text sizer
                const cssClass = [
                    'absolute',
                    'invisible',
                    'whitespace-nowrap',
                    'pointer-events-none'
                ]
                const optionsCSSArr = this.options.css
                    ? this.options.css.split(' ')
                    : []
                const extraCSSClass = optionsCSSArr.length
                    ? optionsCSSArr.concat(cssClass)
                    : cssClass

                this.$textSizer = document.createElement('span')
                this.$textSizer.setAttribute('inert', 'true')
                this.$textSizer.classList.add(...extraCSSClass)
                this.$select.parentNode.appendChild(this.$textSizer)

                this.$select.addEventListener('change', this.handleChange)
                this.handleChange()
            }
        },
        destroy() {
            if (this.$select) {
                this.$select.removeEventListener('change', this.handleChange)
            }
        }
    }
)

export default SelectSizer
