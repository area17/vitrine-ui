import { createBehavior } from '@area17/a17-behaviors'
import * as focusTrap from 'focus-trap'
import { WcDatepicker } from 'wc-datepicker/dist/components/wc-datepicker'

const DatePicker = createBehavior(
    'DatePicker',
    {
        openPicker(event) {
            if (!this.picker || this.$picker.style.visibility !== 'hidden') {
                return
            }
            this.$picker.setAttribute('aria-hidden', 'false')
            this.$picker.removeAttribute('inert')
            this.$picker.style.opacity = ''
            this.$picker.style.visibility = ''
            this.focusTrap.activate()
            event.preventDefault()
            event.stopPropagation()
        },
        closePicker(event) {
            if (!this.picker || this.$picker.style.visibility === 'hidden') {
                return
            }
            this.$picker.setAttribute('aria-hidden', 'true')
            this.$picker.setAttribute('inert', 'true')
            this.$picker.style.opacity = '0'
            this.$picker.style.visibility = 'hidden'
            this.focusTrap.deactivate()
            if (event) {
                event.preventDefault()
                event.stopPropagation()
            }
        },
        handleEsc(event) {
            if (this.picker && event.key === 'Escape') {
                this.closePicker()
            }
        },
        pickerDateSelected(event) {
            this.$target.dispatchEvent(
                new CustomEvent('DateInput:SelectDate', {
                    detail: event.detail ? event.detail : ''
                })
            )
            if (
                !this.picker.range ||
                (this.picker.range && event.detail?.length > 1)
            ) {
                this.closePicker()
            }
        },
        initDatepicker() {
            if (window.customElements.get('wc-datepicker') === undefined) {
                window.customElements.define('wc-datepicker', WcDatepicker)
            }
            this.picker = this.$node.querySelector('wc-datepicker')

            // see options: https://sqrrl.github.io/wc-datepicker/#options
            this.picker.locale = this.lang

            // setup picker min/max
            this.minMaxUpdate()

            if (this.options.range === 'true' || this.options.range === true) {
                this.picker.range = true
            }

            this.picker.labels = {
                clearButton: this.labels.clear_button || 'Clear value',
                monthSelect: this.labels.month_select || 'Select month',
                nextMonthButton: this.labels.next_month_button || 'Next month',
                nextYearButton: this.labels.next_year_button || 'Next year',
                picker: this.labels.picker || 'Choose date',
                previousMonthButton:
                    this.labels.previous_month_button || 'Previous month',
                previousYearButton:
                    this.labels.previous_year_button || 'Previous year',
                todayButton: this.labels.today_button || 'Show today',
                yearSelect: this.labels.year_select || 'Select year'
            }

            this.$pickerTrigger.style.visibility = ''

            this.focusTrap = focusTrap.createFocusTrap(this.$picker, {
                initialFocus:
                    this.picker.querySelector('wc-datepicker') || this.picker
            })

            this.picker.addEventListener(
                'selectDate',
                this.pickerDateSelected,
                false
            )
        },
        valueChange(event) {
            if (
                this.picker &&
                !this.picker.range &&
                event.detail?.date &&
                event.detail?.originalEventType !== 'DateInput:SelectDate'
            ) {
                // make dates
                let date = new Date(
                    new Date(event.detail.date).setHours(0, 0, 0, 0)
                )
                let curr = this.picker.value
                    ? new Date(this.picker.value.setHours(0, 0, 0, 0))
                    : 0
                // check values and update if required
                if (date instanceof Date && !isNaN(date) && date !== curr) {
                    this.picker.value = date
                }
            }
        },
        minMaxUpdate(event) {
            if (event?.detail?.min || event?.detail?.max) {
                this.minDate = event?.detail?.min || undefined
                this.maxDate = event?.detail?.max || undefined
            }

            this.minDate = this.minDate
                ? new Date(this.minDate).setHours(0, 0, 0, 0)
                : undefined
            this.maxDate = this.maxDate
                ? new Date(this.maxDate).setHours(0, 0, 0, 0)
                : undefined

            if (this.picker && (this.minDate || this.maxDate)) {
                this.picker.disableDate = (date) => {
                    date = new Date(date).setHours(0, 0, 0, 0)
                    if (this.minDate && date < this.minDate) {
                        return true
                    }
                    if (this.maxDate && date > this.maxDate) {
                        return true
                    }
                    return false
                }
            } else {
                delete this.picker.disableDate
            }

            this.picker.startDate = this.minDate
                ? new Date(this.minDate)
                : new Date()
        },
        rangeChange(event) {
            if (!this.picker || !event) {
                return
            }

            let from =
                this.picker.value &&
                this.picker.value.length &&
                this.picker.value[0]
                    ? this.picker.value[0]
                    : undefined
            let to =
                this.picker.value &&
                this.picker.value.length &&
                this.picker.value[1]
                    ? this.picker.value[1]
                    : undefined

            if (event.detail?.from) {
                let date = new Date(
                    new Date(event.detail.from).setHours(0, 0, 0, 0)
                )
                let curr = from
                    ? new Date(from.setHours(0, 0, 0, 0))
                    : undefined
                // check values and update if required
                if (date instanceof Date && !isNaN(date) && date !== curr) {
                    from = date
                    // if we now have 2 values, set
                    if (to) {
                        this.picker.value = [from, to]
                    } else {
                        // if not, then update the picker to show this month
                        // as end date > start date
                        this.picker.startDate = from
                    }
                }
            }

            if (event.detail?.to) {
                let date = new Date(
                    new Date(event.detail.to).setHours(0, 0, 0, 0)
                )
                let curr = to ? new Date(to.setHours(0, 0, 0, 0)) : undefined
                // check values and update if required
                if (date instanceof Date && !isNaN(date) && date !== curr) {
                    to = date
                    // if we now have 2 values, set
                    if (from) {
                        this.picker.value = [from, to]
                    }
                    // if not, then leave the picker set to display this month
                }
            }

            if (
                (this.minDate && from < this.minDate) ||
                (this.maxDate && to > this.maxDate)
            ) {
                this.picker.value = undefined
                this.picker.startDate = this.minDate
                    ? new Date(this.minDate)
                    : new Date()
            }
        }
    },
    {
        init() {
            this.$target = this.options.target
                ? document.querySelector(
                      `[data-DatePicker-el="${this.options.target}"]`
                  )
                : this.$node

            if (!this.$target) {
                this.$target = this.$node
            }

            this.minDate = this.options.min
            this.maxDate = this.options.max

            this.$picker = this.getChild('picker')
            this.$pickerTrigger = this.getChild('trigger')
            this.$pickerClose = this.getChild('close')
            this.$pickerMask = this.getChild('mask')

            this.picker = null
            this.lang = new Intl.NumberFormat().resolvedOptions().locale
            this.labels = window.A17.translations.form.datepicker

            this.$pickerTrigger.addEventListener(
                'click',
                this.openPicker,
                false
            )
            this.$pickerClose.addEventListener('click', this.closePicker, false)
            this.$pickerMask.addEventListener('click', this.closePicker, false)
            document.addEventListener('keyup', this.handleEsc, false)
            this.$target.addEventListener(
                'DatePicker:Change',
                this.valueChange,
                false
            )
            this.$target.addEventListener(
                'DatePicker:MinMaxUpdate',
                this.minMaxUpdate,
                false
            )
            this.$target.addEventListener(
                'DatePicker:Change',
                this.rangeChange,
                false
            )

            this.initDatepicker()
        },
        destroy() {
            if (this.picker) {
                this.picker.removeEventListener(
                    'selectDate',
                    this.pickerDateSelected
                )
                this.$pickerTrigger.removeEventListener(
                    'click',
                    this.openPicker
                )
                this.$pickerClose.removeEventListener('click', this.closePicker)
                this.$pickerMask.removeEventListener('click', this.closePicker)
                document.removeEventListener('keyup', this.handleEsc)
                this.$target.removeEventListener('change', this.valueChange)
                this.$target.removeEventListener(
                    'DateRange:Change',
                    this.rangeChange
                )
            }
        }
    }
)

export default DatePicker
