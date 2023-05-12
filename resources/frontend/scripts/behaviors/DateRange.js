import { createBehavior } from '@area17/a17-behaviors'

import formatDate from '../utils/formatDate'

const DateRange = createBehavior(
    'DateRange',
    {
        updatePickersMinMax() {
            this.$inputTo.dispatchEvent(
                new CustomEvent('DateInput:PickerMinUpdate', {
                    detail: this.from
                })
            )

            this.$inputFrom.dispatchEvent(
                new CustomEvent('DateInput:PickerMaxUpdate', {
                    detail: this.to
                })
            )
        },
        selectDate(event) {
            let dates = event.detail
            if (Array.isArray(dates)) {
                dates.forEach((date, index) => {
                    if (index === 0) {
                        this.from = date
                        this.$inputFrom.dispatchEvent(
                            new CustomEvent('DateInput:SelectDate', {
                                detail: date
                            })
                        )
                    }
                    if (index === 1) {
                        this.to = date
                        this.$inputTo.dispatchEvent(
                            new CustomEvent('DateInput:SelectDate', {
                                detail: date
                            })
                        )
                    }
                })
            } else {
                this.from = undefined
                this.to = undefined

                this.$inputFrom.dispatchEvent(
                    new CustomEvent('DateInput:SelectDate', {
                        detail: ''
                    })
                )
                this.$inputTo.dispatchEvent(
                    new CustomEvent('DateInput:SelectDate', {
                        detail: ''
                    })
                )
            }

            this.updatePickersMinMax()
        },
        clearValidationMessages() {
            this.$inputFrom.dispatchEvent(
                new CustomEvent('DateInput:RangeValidation', {
                    detail: ''
                })
            )
            this.$inputTo.dispatchEvent(
                new CustomEvent('DateInput:RangeValidation', {
                    detail: ''
                })
            )
        },
        valueChange(event) {
            // get date
            if (event.detail?.date) {
                let date = new Date(event.detail.date)
                if (date instanceof Date && !isNaN(date)) {
                    if (event.srcElement === this.$inputFrom) {
                        this.from = formatDate(date, 'iso')
                    }
                    if (event.srcElement === this.$inputTo) {
                        this.to = formatDate(date, 'iso')
                    }
                } else {
                    if (event.srcElement === this.$inputFrom) {
                        this.from = undefined
                    }
                    if (event.srcElement === this.$inputTo) {
                        this.to = undefined
                    }
                }
            } else {
                if (event.srcElement === this.$inputFrom) {
                    this.from = undefined
                }
                if (event.srcElement === this.$inputTo) {
                    this.to = undefined
                }
            }

            // update date picker
            if (
                event.detail?.date &&
                event.detail?.originalEventType !== 'DateInput:SelectDate'
            ) {
                this.$node.dispatchEvent(
                    new CustomEvent('DatePicker:Change', {
                        detail: {
                            from: this.from,
                            to: this.to
                        }
                    })
                )
            }

            // check values and update validation messages
            if (
                this.from &&
                this.to &&
                (this.from > this.to || this.to < this.from)
            ) {
                if (
                    this.from > this.to &&
                    event.srcElement === this.$inputFrom
                ) {
                    this.$inputFrom.dispatchEvent(
                        new CustomEvent('DateInput:RangeValidation', {
                            detail:
                                this.labels.from_date_after_to_date ||
                                'Start date should be before end date'
                        })
                    )
                } else if (this.from <= this.to) {
                    this.clearValidationMessages()
                }

                if (this.to < this.from && event.srcElement === this.$inputTo) {
                    this.$inputTo.dispatchEvent(
                        new CustomEvent('DateInput:RangeValidation', {
                            detail:
                                this.labels.to_date_before_from_date ||
                                'End date should be after start date'
                        })
                    )
                } else if (this.to >= this.from) {
                    this.clearValidationMessages()
                }
            } else {
                this.clearValidationMessages()
            }

            this.updatePickersMinMax()
        }
    },
    {
        init() {
            this.labels = window.A17?.translations?.form?.datepicker
            this.from = undefined
            this.to = undefined

            this.$inputFrom = this.getChild('from')
            this.$inputTo = this.getChild('to')
            this.$minDateA11yDisplay = this.getChild('minDateA11yDisplay')
            this.$maxDateA11yDisplay = this.getChild('maxDateA11yDisplay')

            // update the A11y min max date display to a human friendly date format
            if (this.$minDateA11yDisplay && this.options.mindate) {
                this.$minDateA11yDisplay.textContent = `${
                    window.A17.translations.form.datepicker.minimum_date
                }: ${formatDate(this.options.mindate, 'human')}`
            }
            if (this.$maxDateA11yDisplay && this.options.maxdate) {
                this.$maxDateA11yDisplay.textContent = `${
                    window.A17.translations.form.datepicker.maximum_date
                }: ${formatDate(this.options.maxdate, 'human')}`
            }

            this.$node.addEventListener(
                'DateInput:SelectDate',
                this.selectDate,
                false
            )
            this.$inputFrom.addEventListener(
                'DatePicker:Change',
                this.valueChange,
                false
            )
            this.$inputTo.addEventListener(
                'DatePicker:Change',
                this.valueChange,
                false
            )
        },
        destroy() {
            this.$node.removeEventListener(
                'DateInput:SelectDate',
                this.selectDate
            )
            this.$inputFrom.removeEventListener(
                'DatePicker:Change',
                this.valueChange
            )
            this.$inputTo.removeEventListener(
                'DatePicker:Change',
                this.valueChange
            )
        }
    }
)

export default DateRange
