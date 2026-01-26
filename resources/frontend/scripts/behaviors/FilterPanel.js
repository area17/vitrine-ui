import { createBehavior } from '@area17/a17-behaviors'

import { customEvents } from '../constants/customEvents'

const FilterPanel = createBehavior(
    'FilterPanel',
    {
        handleCheckbox(e) {
            const input = e.target

            if (
                input.checked ||
                (!['radio', 'checkbox'].includes(input.type) && input.value)
            ) {
                if (this.values[input.name]) {
                    if (input.type == 'radio') {
                        this.values[input.name] = input.value
                    } else if (input.type == 'hidden') {
                        this.values[input.name] = [input.value]
                    } else {
                        this.values[input.name].push(input.value)
                    }
                } else {
                    this.values[input.name] = [input.value]
                }
            } else {
                const index = this.values[input.name].indexOf(input.value)
                if (index > -1) {
                    this.values[input.name].splice(index, 1)
                }
            }

            if (
                !this.values[input.name] ||
                this.values[input.name].length === 0
            ) {
                this.searchParams.delete(input.name)
            } else {
                this.searchParams.set(input.name, this.values[input.name])
            }

            if (
                input.closest('[data-filterpanel-checkbox]').dataset.omit !==
                'true'
            ) {
                this.totalSelected += input.checked ? 1 : -1
            }

            this.updateButtonState()
            this.updateCount()
            this.updateChips()
        },

        updateButtonState() {
            // Set aria-disabled instead of disabled to allow focus
            if (this.totalSelected === 0) {
                this.$applyButton.setAttribute('aria-disabled', 'true')
            } else {
                this.$applyButton.removeAttribute('aria-disabled')
            }
        },

        updateCount() {
            if (this.values && this.totalSelected > 0) {
                this.$count.removeAttribute('hidden')
                this.$count.innerHTML = `(${this.totalSelected})`
            } else {
                this.$count.innerHTML = null
                this.$count.hidden = true
            }
        },

        updateChips() {
            if (!this.filtersApplied) {
                return
            }

            this.$chipsContainer.querySelector('ul').innerHTML = ''
            let chipCount = 0

            Object.entries(this.values).forEach(([name, values]) => {
                if (Array.isArray(values)) {
                    values.forEach((val) => {
                        const input = Array.from(this.$checkboxes)
                            .map((cb) => cb.querySelector('input'))
                            .find(
                                (input) =>
                                    input &&
                                    input.name === name &&
                                    input.value === val
                            )

                        if (
                            input &&
                            input.closest('[data-filterpanel-checkbox]').dataset
                                .omit !== 'true'
                        ) {
                            this.createChip(
                                input.parentNode.textContent.trim(),
                                name,
                                val
                            )
                            chipCount++
                        }
                    })
                } else if (values) {
                    // radio value case
                    const input = Array.from(this.$checkboxes)
                        .map((cb) => cb.querySelector('input'))
                        .find(
                            (input) =>
                                input &&
                                input.name === name &&
                                input.value === values
                        )

                    if (
                        input &&
                        input.closest('[data-filterpanel-checkbox]').dataset
                            .omit !== 'true'
                    ) {
                        this.createChip(
                            input.parentNode.textContent.trim(),
                            name,
                            values
                        )
                        chipCount++
                    }
                }
            })

            if (chipCount > 0) {
                this.$chipsContainer.removeAttribute('hidden')
            } else {
                this.$chipsContainer.hidden = true
            }
        },

        createChip(label, key, value) {
            const chip = this.$chipTemplate.cloneNode(true)
            const btn = chip.querySelector('button')

            if (!btn) return

            chip.removeAttribute('hidden')
            btn.setAttribute('data-filter-key', key ?? null)
            btn.setAttribute('data-filter-value', value ?? null)

            if (btn.querySelector('span')) {
                btn.querySelector('span').innerText = label
            } else {
                btn.childNodes[0].textContent = label
            }

            btn.addEventListener('click', (e) => {
                e.preventDefault()
                e.stopPropagation()
                this.handleChipClick(key, value)

                if (
                    this.$chipsContainer &&
                    this.$chipsHeading &&
                    !this.$chipsContainer.hasAttribute('hidden')
                ) {
                    this.$chipsHeading.focus()
                } else if (this.$node.querySelectorAll('a, button')[0]) {
                    this.$node.querySelectorAll('a, button')[0].focus()
                }
            })

            this.$chipsContainer.querySelector('ul').appendChild(chip)
        },

        handleChipClick(key, value) {
            const input = Array.from(this.$checkboxes)
                .map((cb) => cb.querySelector('input'))
                .find(
                    (input) =>
                        input && input.name === key && input.value === value
                )

            if (input) {
                input.checked = false
                input.dispatchEvent(new Event('change', { bubbles: true }))
            }
        },

        setCheckboxValues() {
            this.values = {}
            this.totalSelected = 0

            this.$checkboxes.forEach((checkbox) => {
                const input = checkbox.querySelector('input')
                if (!input) return

                if (input.checked) {
                    if (input.type === 'radio') {
                        this.values[input.name] = input.value
                    } else {
                        if (!this.values[input.name]) {
                            this.values[input.name] = []
                        }
                        this.values[input.name].push(input.value)
                    }

                    if (
                        input.closest('[data-filterpanel-checkbox]').dataset
                            .omit !== 'true'
                    ) {
                        this.totalSelected++
                    }
                }
            })

            this.filtersApplied = this.totalSelected > 0
            this.updateCount()
            this.updateChips()
        },

        applyFilters() {
            this.searchParams.delete('page')

            if (this.useSwup) {
                const event = new CustomEvent(customEvents.SWUP_NAVIGATE, {
                    detail: {
                        url: this.baseUrl + '?' + this.searchParams.toString()
                    }
                })
                document.dispatchEvent(event)

                if (this.closeOnButtonClick) {
                    document.dispatchEvent(
                        new CustomEvent(customEvents.MODAL_CLOSE_ALL)
                    )
                }
            } else {
                window.location =
                    this.baseUrl + '?' + this.searchParams.toString()
            }
        },

        resetFilters() {
            this.values = {}
            this.totalSelected = 0

            this.$checkboxes.forEach((checkbox) => {
                const input = checkbox.querySelector('input')
                input.checked = false
            })

            this.updateCount()

            if (this.useSwup) {
                const event = new CustomEvent(customEvents.SWUP_NAVIGATE, {
                    detail: {
                        url: this.baseUrl
                    }
                })
                document.dispatchEvent(event)

                if (this.closeOnButtonClick) {
                    document.dispatchEvent(
                        new CustomEvent(customEvents.MODAL_CLOSE_ALL)
                    )
                }
            } else {
                window.location = this.baseUrl
            }
        },

        initCheckboxes() {
            if (this.$checkboxes) {
                this.baseUrl = window.location.origin + window.location.pathname
                this.searchParams = new URLSearchParams(window.location.search)

                this.$checkboxes.forEach((checkbox) => {
                    const input = checkbox.querySelector('input')

                    if (input) {
                        this.values[input.name] = []

                        input.addEventListener(
                            'change',
                            this.handleCheckbox,
                            false
                        )
                    }
                })

                this.setCheckboxValues()
            }
        }
    },
    {
        init() {
            this.values = {}
            this.$resetbutton = this.getChild('reset')
            this.$applyButton = this.getChild('apply')
            this.$checkboxes = this.getChildren('checkbox')
            this.$count = this.getChild('count')
            this.totalSelected = 0
            this.$chipsContainer = this.getChild('chips')
            this.$chipTemplate = this.getChild('chipTemplate')
            this.useSwup = this.options.useswup === 'true'
            this.$chipsHeading = this.getChild('chipsHeading')
            this.closeOnButtonClick =
                this.options.closeonbuttonclick !== 'false'

            this.$applyButton &&
                this.$applyButton.addEventListener(
                    'click',
                    this.applyFilters,
                    false
                )
            this.$resetbutton &&
                this.$resetbutton.addEventListener(
                    'click',
                    this.resetFilters,
                    false
                )

            this.initCheckboxes()

            this.originalValues = JSON.parse(JSON.stringify(this.values))
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {},
        disabled() {},
        destroy() {
            this.$resetbutton &&
                this.$resetbutton.removeEventListener(
                    'click',
                    this.resetFilters
                )
            this.$applyButton &&
                this.$applyButton.removeEventListener(
                    'click',
                    this.applyFilters
                )

            if (this.$checkboxes) {
                this.$checkboxes.forEach((checkbox) => {
                    const input = checkbox.querySelector('input')

                    input.removeEventListener('change', this.handleCheckbox)
                })
            }
        }
    }
)

export default FilterPanel
