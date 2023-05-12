import 'range-slider-input/dist/style.css'

import { createBehavior } from '@area17/a17-behaviors'
import rangeSlider from 'range-slider-input'

const RangeInput = createBehavior(
    'RangeInput',
    {
        _initRange() {
            // if disabled overwrite value to disable both thumbs
            if (this.options.disabled) {
                this.options.thumbsDisabled = [true, true]
            }

            // set initial value
            const initialValueAray = this.config.value
                ? this.config.value
                : [0, 0]

            // pass initial value array to value update fn
            this._updateValue(initialValueAray)

            this.config.onInput = (value) => {
                this._updateValue(value)
            }

            rangeSlider(this.getChild('slider'), this.config)
        },

        _updateValue(value) {
            // check if value outexists if not no need ot do it
            if (!this.valueOutput) return

            if (this.options.hidelower) {
                this.valueOutput.textContent = value[1]
            } else {
                this.valueOutput.textContent = `${value[0]} - ${value[1]}`
            }
        }
    },
    {
        init() {
            // if options config is empty serve an empty array to add to flatpickr
            this.config = this.options.config
                ? JSON.parse(this.options.config)
                : {}

            this.valueOutput = this.getChild('value')

            this._initRange()
        },
        destroy() {}
    }
)

export default RangeInput
