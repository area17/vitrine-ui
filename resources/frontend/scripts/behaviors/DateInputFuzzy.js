import { createBehavior } from '@area17/a17-behaviors'
import parseNumericDate from '@area17/parse-numeric-date'

import formatDate from '../utils/formatDate'
import DateInput from './DateInput'

const DateInputFuzzy = createBehavior(
    'DateInputFuzzy',
    {
        // DateInputFuzzy uses @area17/parse-numeric-date
        // to parse the user input, see:
        // https://github.com/area17/parse-numeric-date
        // The default parseInput looks for strict YYYY-MM-DD
        // this fuzzy parseInput will accept any numeric input
    },
    {
        init() {
            this.addSubBehavior(DateInput, this.$node, {
                options: {
                    parseInput(parentBehavior) {
                        let value = parentBehavior.$input.value
                            .toLowerCase()
                            .trim()
                        let regex = new RegExp(
                            // eslint-disable-next-line
                            `[0-9]{1,4}[^0-9]{0,1}[0-9]{1,4}[^0-9]{0,1}[0-9]{1,4}|${parentBehavior.labels.today}|${parentBehavior.labels.tomorrow}`,
                            'gi'
                        )
                        let matches = value.match(regex) || []

                        // process for "today" and "tomorrow"
                        matches = matches.map((match) => {
                            if (
                                match.toLowerCase() ===
                                parentBehavior.labels.today.toLowerCase()
                            ) {
                                match = formatDate(
                                    new Date().setHours(0, 0, 0, 0)
                                )
                            } else if (
                                match.toLowerCase() ===
                                parentBehavior.labels.tomorrow.toLowerCase()
                            ) {
                                match = new Date(
                                    new Date().setHours(0, 0, 0, 0)
                                )
                                match = formatDate(
                                    match.setDate(match.getDate() + 1)
                                )
                            } else {
                                match = parseNumericDate(match)
                            }
                            return match
                        })

                        if (matches.length) {
                            return new Date(
                                new Date(matches[0]).setHours(0, 0, 0, 0)
                            )
                        }
                        return NaN
                    }
                }
            })
        }
    }
)

export default DateInputFuzzy
