import { createBehavior } from '@area17/a17-behaviors'

import { customEvents } from '../constants/customEvents'
import formatDate from '../utils/formatDate'

const DateRange = createBehavior(
    'DateRange',
    {
        updatePickersMinMax() {
            this.$inputTo.dispatchEvent(
                new CustomEvent(customEvents.DATE_PICKER_MIN_UPDATE, {
                    detail: this.from
                })
            )

            this.$inputFrom.dispatchEvent(
                new CustomEvent(customEvents.DATE_PICKER_MAX_UPDATE, {
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
                            new CustomEvent(
                                customEvents.DATE_INPUT_SELECT_DATE,
                                {
                                    detail: date
                                }
                            )
                        )
                    }
                    if (index === 1) {
                        this.to = date
                        this.$inputTo.dispatchEvent(
                            new CustomEvent(
                                customEvents.DATE_INPUT_SELECT_DATE,
                                {
                                    detail: date
                                }
                            )
                        )
                    }
                })
            } else {
                this.from = undefined
                this.to = undefined

                this.$inputFrom.dispatchEvent(
                    new CustomEvent(customEvents.DATE_INPUT_SELECT_DATE, {
                        detail: ''
                    })
                )
                this.$inputTo.dispatchEvent(
                    new CustomEvent(customEvents.DATE_INPUT_SELECT_DATE, {
                        detail: ''
                    })
                )
            }

            this.updatePickersMinMax()
        },
        clearValidationMessages() {
            this.$inputFrom.dispatchEvent(
                new CustomEvent(customEvents.DATE_INPUT_RANGE_VALIDATION, {
                    detail: ''
                })
            )
            this.$inputTo.dispatchEvent(
                new CustomEvent(customEvents.DATE_INPUT_RANGE_VALIDATION, {
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
                event.detail?.originalEventType !==
                    customEvents.DATE_INPUT_SELECT_DATE
            ) {
                this.$node.dispatchEvent(
                    new CustomEvent(customEvents.DATE_PICKER_CHANGE, {
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
                        new CustomEvent(
                            customEvents.DATE_INPUT_RANGE_VALIDATION,
                            {
                                detail:
                                    this.labels.from_date_after_to_date ||
                                    'Start date should be before end date'
                            }
                        )
                    )
                } else if (this.from <= this.to) {
                    this.clearValidationMessages()
                }

                if (this.to < this.from && event.srcElement === this.$inputTo) {
                    this.$inputTo.dispatchEvent(
                        new CustomEvent(
                            customEvents.DATE_INPUT_RANGE_VALIDATION,
                            {
                                detail:
                                    this.labels.to_date_before_from_date ||
                                    'End date should be after start date'
                            }
                        )
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
                customEvents.DATE_INPUT_SELECT_DATE,
                this.selectDate,
                false
            )
            this.$inputFrom.addEventListener(
                customEvents.DATE_PICKER_CHANGE,
                this.valueChange,
                false
            )
            this.$inputTo.addEventListener(
                customEvents.DATE_PICKER_CHANGE,
                this.valueChange,
                false
            )
        },
        destroy() {
            this.$node.removeEventListener(
                customEvents.DATE_INPUT_SELECT_DATE,
                this.selectDate
            )
            this.$inputFrom.removeEventListener(
                customEvents.DATE_PICKER_CHANGE,
                this.valueChange
            )
            this.$inputTo.removeEventListener(
                customEvents.DATE_PICKER_CHANGE,
                this.valueChange
            )
        }
    }
)

export default DateRange
