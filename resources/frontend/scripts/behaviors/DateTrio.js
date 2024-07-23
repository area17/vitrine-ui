import { createBehavior } from '@area17/a17-behaviors'
import { customEvents } from '../constants/customEvents'
import formatDate from '../utils/formatDate'

const DateTrio = createBehavior(
    'DateTrio',
    {
        make4DigitYear(y) {
            if (y.toString().length === 2) {
                let today = new Date().setHours(0, 0, 0, 0)
                let thisYear = new Date(today).getFullYear()
                let twoDigitCutoffYear = 50
                let century = Math.floor(thisYear / 1000) * 1000
                let year = century + y
                let diff = Math.abs(year - (thisYear + twoDigitCutoffYear))
                return year < thisYear + twoDigitCutoffYear || diff > 100
                    ? year
                    : year - 100
            }
            return y
        },
        daysInMonth(m, y) {
            // Month in JavaScript is 0-indexed (January is 0, February is 1, etc),
            // but by using 0 as the day it will give us the last day of the prior
            // month. So passing in 1 as the month number will return the last day
            // of January, not February
            return new Date(y, m, 0).getDate()
        },
        parseInputs() {
            let y = parseInt(this.$year.value, 10)
            let m = parseInt(this.$month.value, 10)
            let d = parseInt(this.$day.value, 10)

            // make year 4 digits
            y = this.make4DigitYear(y)

            // stop months being over 12
            m = m > 12 ? 12 : m

            // stop day being over how many days are in the month
            let totalDaysInMonth = this.daysInMonth(m, y)
            d = d > totalDaysInMonth ? totalDaysInMonth : d

            // pad
            m = m < 10 ? `0${m}` : m
            d = d < 10 ? `0${d}` : d

            return new Date(`${y}-${m}-${d}T00:00:00.000+00:00`)
        },
        handleChange(event) {
            this.validityMsg = ''
            let date = this.parseInputs()
            let validDate = false

            // test for valid date
            if (date instanceof Date && !isNaN(date)) {
                validDate = true
            }

            if (validDate) {
                // update the isoinput value
                this.$isoinput.value = formatDate(date, 'iso')
            } else {
                // if no date understood remove the iso input value (the value submitted with form)
                this.$isoinput.value = ''
                // if the input is required and nothing selected, inform
                if (this.$isoinput.required) {
                    // update validity message
                    this.validityMsg =
                        this.$year.value === '' ||
                        this.$month.value === '' ||
                        this.$day.value === ''
                            ? this.labels.no_date_selected
                            : this.labels.invalid_date_selected
                }
            }

            if (validDate && this.minDate) {
                // check for a date before the minimum date
                // and update validation message
                if (date < this.minDate) {
                    let msg = `${
                        this.labels.minimum_date || 'Minimum date'
                    } ${formatDate(this.minDate, 'human')}`
                    this.validityMsg += msg
                }
            }

            if (validDate && this.maxDate) {
                // check for a date after the minimum date
                // and update validation message
                if (date > this.maxDate) {
                    let msg = `${
                        this.labels.maximum_date || 'Maximum date'
                    } ${formatDate(this.maxDate, 'human')}`
                    this.validityMsg += msg
                }
            }

            if (event.type !== 'init' || (event.type === 'init' && validDate)) {
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

            if (event.type !== 'init' && validDate) {
                this.$year.value = date.getFullYear()
                this.$month.value = date.getMonth() + 1
                this.$day.value = date.getDate()
            }

            // set a custom validity message for form validation
            this.$isoinput.setCustomValidity(this.validityMsg)
        },
        selectDate(event) {
            if (event && typeof event.detail) {
                const date = new Date(`${event.detail}T00:00:00.000+00:00`)
                this.$year.value = date.getFullYear()
                this.$month.value = date.getMonth() + 1
                this.$day.value = date.getDate()
                this.$isoinput.value = event.detail
                this.handleChange(event)
            }
        },
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
        validated(event) {
            let validityMsg = event?.detail ? event.detail : this.validityMsg

            if (validityMsg.length) {
                this.showErrorState(validityMsg)
            } else {
                this.resetErrorState()
            }
        }
    },
    {
        init() {
            this.$day = this.getChild('day')
            this.$month = this.getChild('month')
            this.$year = this.getChild('year')
            this.$isoinput = this.getChild('isoinput')
            this.$error = this.getChild('error')
            this.$minDateA11yDisplay = this.getChild('minDateA11yDisplay')
            this.$maxDateA11yDisplay = this.getChild('maxDateA11yDisplay')

            this.labels = window.A17?.translations?.form?.datepicker
            this.validityMsg = ''

            this.minDate = this.$isoinput.min
                ? new Date(`${this.$isoinput.min}T00:00:00.000+00:00`)
                : undefined
            this.maxDate = this.$isoinput.max
                ? new Date(`${this.$isoinput.max}T00:00:00.000+00:00`)
                : undefined

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

            this.$day.addEventListener('change', this.handleChange)
            this.$month.addEventListener('change', this.handleChange)
            this.$year.addEventListener('change', this.handleChange)

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

            if (this.$isoinput.value) {
                const date = new Date(
                    `${this.$isoinput.value}T00:00:00.000+00:00`
                )
                this.$year.value = date.getFullYear()
                this.$month.value = date.getMonth() + 1
                this.$day.value = date.getDate()
            }

            this.handleChange({ type: 'init' })
        },
        destroy() {
            this.$day.removeEventListener('change', this.handleChange)
            this.$month.removeEventListener('change', this.handleChange)
            this.$year.removeEventListener('change', this.handleChange)

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

export default DateTrio
