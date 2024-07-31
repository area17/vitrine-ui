import { createBehavior } from '@area17/a17-behaviors'
import { customEvents } from '../constants/customEvents'
import formatDate from '../utils/formatDate'

const DateInput = createBehavior(
    'DateInput',
    {
        patternifyWord(word) {
            return word
                .toLowerCase()
                .split('')
                .map((letter) => `[${letter.toUpperCase()}${letter}]`)
                .join('')
        },
        parseInput() {
            if (
                this.options.parseInput &&
                typeof this.options.parseInput === 'function'
            ) {
                try {
                    return this.options.parseInput(this)
                } catch (err) {
                    return NaN
                }
            }
            let value = this.$input.value.toLowerCase().trim()
            let regex = new RegExp(
                // eslint-disable-next-line
                `[0-9]{4}[^0-9]{1}[0-9]{1,2}[^0-9]{1}[0-9]{1,2}|${this.labels.today}|${this.labels.tomorrow}`,
                'gi'
            )
            let matches = value.match(regex) || []

            // process for "today" and "tomorrow"
            matches = matches.map((match) => {
                if (match.toLowerCase() === this.labels.today.toLowerCase()) {
                    match = formatDate(new Date().setHours(0, 0, 0, 0))
                } else if (
                    match.toLowerCase() === this.labels.tomorrow.toLowerCase()
                ) {
                    match = new Date(new Date().setHours(0, 0, 0, 0))
                    match = formatDate(match.setDate(match.getDate() + 1))
                } else {
                    match = match.replace(
                        /([0-9]{1,4})[^0-9]{0,1}([0-9]{1,4})[^0-9]{0,1}([0-9]{1,4})/g,
                        (match, p1, p2, p3) => {
                            // following date format of YYYY-MM-DD
                            let y = p1
                            let m = p2
                            let d = p3

                            return `${y}-${m}-${d}`
                        }
                    )
                }
                return match
            })

            if (matches.length) {
                return new Date(new Date(matches[0]).setHours(0, 0, 0, 0))
            }
            return NaN
        },
        handleChange(event) {
            this.outputMsg = ''
            this.validityMsg = ''
            let date = NaN
            let validDate = false

            if (this.$input.value) {
                // parse in the input and make date obj
                date = this.parseInput()
            }

            // test for valid date
            if (date instanceof Date && !isNaN(date)) {
                validDate = true
            }

            if (validDate) {
                // output human friendly date
                this.outputMsg = `${
                    this.labels.selected || 'Selected'
                } ${formatDate(date, 'human')}`
                // update the input value
                // as we may have fixed this with date parsing
                // if no date understood, leave original input
                this.$input.value = formatDate(date, 'display')
                this.$isoinput.value = formatDate(date, 'iso')
            } else {
                // if no date understood, leave original input
                // but remove the iso input value (the value submitted with form)
                this.$isoinput.value = ''
                // nothing selected, inform screen reader user
                this.outputMsg =
                    this.$input.value === ''
                        ? this.labels.no_date_selected
                        : this.labels.invalid_date_selected

                // if the input is required and its empty
                // or
                // if the input is just invalid
                // update validity message to fail a form validation
                if (
                    (this.$input.required && this.$input.value === '') ||
                    this.$input.value !== ''
                ) {
                    // update validity message
                    this.validityMsg = this.outputMsg
                }
            }

            if (validDate && this.minDate) {
                // check for a date before the minimum date
                // update output to screenreader
                // and update validation message
                if (date < this.minDate) {
                    let msg = `${
                        this.labels.minimum_date || 'Minimum date'
                    } ${formatDate(this.minDate, 'human')}`
                    this.validityMsg += msg
                    this.outputMsg += ` - ${msg}`
                }
            }

            if (validDate && this.maxDate) {
                // check for a date after the minimum date
                // update output to screenreader
                // and update validation message
                if (date > this.maxDate) {
                    let msg = `${
                        this.labels.maximum_date || 'Maximum date'
                    } ${formatDate(this.maxDate, 'human')}`
                    this.validityMsg += msg
                    this.outputMsg += ` - ${msg}`
                }
            }

            if (
                (event.type !== 'minMaxUpdate' && event.type !== 'init') ||
                (event.type === 'init' && validDate)
            ) {
                // update picker value
                window.requestAnimationFrame(() => {
                    // waiting a frame to allow Datepicker behavior time to init
                    this.$node.dispatchEvent(
                        new CustomEvent(customEvents.DATE_PICKER_CHANGE, {
                            detail: {
                                date: validDate
                                    ? formatDate(date, 'iso')
                                    : undefined, // formatDate(new Date(), 'iso')
                                originalEventType: event?.type
                            }
                        })
                    )
                })
            }
            // tell user what the understood date is in a human friendly way
            this.$output.value = this.outputMsg
            // set a custom validity message for form validation
            this.$input.setCustomValidity(this.validityMsg)
        },
        selectDate(event) {
            if (event && typeof event.detail) {
                this.$input.value = event.detail
                this.handleChange(event)
            }
        },
        setMinMax(event) {
            this.minDate = this.$input.min
                ? new Date(this.$input.min).setHours(0, 0, 0, 0)
                : undefined
            this.maxDate = this.$input.max
                ? new Date(this.$input.max).setHours(0, 0, 0, 0)
                : undefined

            if (
                event.type !== 'init' ||
                (event.type === 'init' && (this.minDate || this.maxDate))
            ) {
                // update picker min/max
                window.requestAnimationFrame(() => {
                    // waiting a frame to allow Datepicker behavior time to init
                    this.$node.dispatchEvent(
                        new CustomEvent(customEvents.DATE_PICKER_UPDATE, {
                            detail: {
                                min: this.$input.min || undefined,
                                max: this.$input.max || undefined
                            }
                        })
                    )
                })
                this.handleChange({ type: 'minMaxUpdate' })
            }
        },
        watchForMinMaxChanges() {
            this.minMaxObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (
                        mutation.type === 'attributes' &&
                        (mutation.attributeName === 'min' ||
                            mutation.attributeName === 'max')
                    ) {
                        this.setMinMax({ type: 'watch' })
                    }
                })
            })

            this.minMaxObserver.observe(this.$input, {
                attributes: true
            })
        },
        pickerMinUpdate(event) {
            // update picker min/max
            window.requestAnimationFrame(() => {
                // waiting a frame to allow Datepicker behavior time to init
                this.$node.dispatchEvent(
                    new CustomEvent(customEvents.DATE_PICKER_UPDATE, {
                        detail: {
                            min: event?.detail || this.minDate,
                            max: this.maxDate
                        }
                    })
                )
            })
        },
        pickerMaxUpdate(event) {
            // update picker min/max
            window.requestAnimationFrame(() => {
                // waiting a frame to allow Datepicker behavior time to init
                this.$node.dispatchEvent(
                    new CustomEvent(customEvents.DATE_PICKER_UPDATE, {
                        detail: {
                            min: this.minDate,
                            max: event?.detail || this.maxDate
                        }
                    })
                )
            })
        },
        rangeValidation(event) {
            if (event && typeof event.detail) {
                this.rangeValidationMsg = event.detail
                if (this.rangeValidationMsg.length) {
                    this.$input.setCustomValidity(
                        `${this.validityMsg}${
                            this.validityMsg.length > 0 ? ' - ' : ''
                        }${this.rangeValidationMsg}`
                    )
                    this.$output.value = `${event.detail} - ${this.outputMsg}`
                } else {
                    this.$input.setCustomValidity(this.rangeValidationMsg)
                    this.$output.value = this.outputMsg
                }
            }
        },
        validated(event) {
            this.$input.dispatchEvent(
                new CustomEvent(customEvents.INPUT_VALIDATED, {
                    detail: event.detail
                })
            )
        }
    },
    {
        init() {
            this.$input = this.getChild('input')
            this.$isoinput = this.getChild('isoinput')
            this.$output = this.getChild('output')
            this.$minDateA11yDisplay = this.getChild('minDateA11yDisplay')
            this.$maxDateA11yDisplay = this.getChild('maxDateA11yDisplay')

            this.minDate = undefined
            this.maxDate = undefined

            this.labels = window.A17?.translations?.form?.datepicker
            this.outputMsg = ''
            this.validityMsg = ''
            this.rangeValidationMsg = ''

            // set and watch for changes to the min/max values
            // for if a range picker is used
            this.minMaxObserver = null
            this.setMinMax({ type: 'init' })
            this.watchForMinMaxChanges()

            // set up the $isoinput name (hidden input)
            // it is the $isoinput that is submitted
            // this swap is required incase user has javascript disabled
            this.$isoinput.setAttribute('name', this.$input.name)
            this.$input.removeAttribute('name')
            this.$input.setAttribute(
                'pattern',
                // eslint-disable-next-line
                `[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}|${
                    this.patternifyWord(this.labels.today) ||
                    this.patternifyWord('Today')
                }|${
                    this.patternifyWord(this.labels.tomorrow) ||
                    this.patternifyWord('Tomorrow')
                }`
            )
            // pattern: \d{4}-\d{1,2}-\d{1,2} - should work
            // but JS removes the \ from \d - making the pattern useless

            // update the A11y min max date display to a human friendly date format
            if (this.$minDateA11yDisplay && this.minDate) {
                this.$minDateA11yDisplay.textContent = `${
                    window.A17.translations.form.datepicker.minimum_date
                }: ${formatDate(this.minDate, 'human')}`
            }
            if (this.$maxDateA11yDisplay && this.maxDate) {
                this.$maxDateA11yDisplay.textContent = `${
                    window.A17.translations.form.datepicker.maximum_date
                }: ${formatDate(this.maxDate, 'human')}`
            }

            this.$input.addEventListener('change', this.handleChange, false)
            this.$isoinput.addEventListener(
                customEvents.INPUT_VALIDATED,
                this.validated,
                false
            )
            this.$node.addEventListener(
                customEvents.DATE_INPUT_SELECT_DATE,
                this.selectDate,
                false
            )
            this.$node.addEventListener(
                customEvents.DATE_PICKER_MIN_UPDATE,
                this.pickerMinUpdate,
                false
            )
            this.$node.addEventListener(
                customEvents.DATE_PICKER_MAX_UPDATE,
                this.pickerMaxUpdate,
                false
            )
            this.$node.addEventListener(
                customEvents.DATE_INPUT_RANGE_VALIDATION,
                this.rangeValidation,
                false
            )

            this.handleChange({ type: 'init' })
        },
        destroy() {
            this.$input.removeEventListener('change', this.handleChange)
            this.$isoinput.removeEventListener(
                customEvents.INPUT_VALIDATED,
                this.validated
            )
            this.$node.removeEventListener(
                customEvents.DATE_INPUT_SELECT_DATE,
                this.selectDate
            )

            if (this.minMaxObserver) {
                this.minMaxObserver.disconnect()
            }
        }
    }
)

export default DateInput
