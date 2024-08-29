import { createBehavior } from '@area17/a17-behaviors'

/*
    Markup and JS taken from:
    https://www.w3.org/WAI/ARIA/apg/patterns/tabs/examples/tabs-manual/
*/

const Tabs = createBehavior(
    'Tabs',
    {
        setSelectedTab(selectedTab, init) {
            if (this.current.tab === selectedTab) {
                return
            }

            let nextCurrentTab = {
                tab: selectedTab,
                tabpanel: document.getElementById(
                    selectedTab.getAttribute('aria-controls')
                )
            }

            this.transitionTime =
                16 +
                parseInt(
                    window
                        .getComputedStyle(this.$node)
                        .getPropertyValue('--tab-transition-time') || 200
                )

            if (
                this.$node.dataset.tabsImmediate === true ||
                this.$node.dataset.tabsImmediate === 'true'
            ) {
                this.transitionTime = 0
            }

            this.current.tab.setAttribute('aria-selected', 'false')
            this.current.tab.tabIndex = -1
            this.current.tabpanel.inert = true
            this.current.tabpanel.dispatchEvent(new CustomEvent('Tab:hidden'))

            if (!init && this.options.scrollonclick) {
                this.$node.scrollIntoView(true)
            }

            setTimeout(() => {
                this.current.tabpanel.hidden = true

                nextCurrentTab.tab.setAttribute('aria-selected', 'true')
                nextCurrentTab.tab.removeAttribute('tabindex')
                nextCurrentTab.tabpanel.hidden = false
                window.requestAnimationFrame(() => {
                    nextCurrentTab.tabpanel.inert = false
                    nextCurrentTab.tabpanel.dispatchEvent(
                        new CustomEvent('Tab:shown')
                    )
                })

                this.current = nextCurrentTab
                this.$node.dataset.tabsImmediate = false
                if (!init) {
                    document.dispatchEvent(
                        new CustomEvent('tabs:opened', { detail: this.current })
                    )
                }
            }, this.transitionTime)
        },
        moveFocusToTab(currentTab) {
            currentTab.focus()
        },
        moveFocusToPreviousTab(currentTab) {
            if (currentTab === this.firstTab) {
                this.moveFocusToTab(this.lastTab)
            } else {
                const index = this.tabs.indexOf(currentTab)
                this.moveFocusToTab(this.tabs[index - 1])
            }
        },
        moveFocusToNextTab(currentTab) {
            if (currentTab === this.lastTab) {
                this.moveFocusToTab(this.firstTab)
            } else {
                const index = this.tabs.indexOf(currentTab)
                this.moveFocusToTab(this.tabs[index + 1])
            }
        },
        onKeydown(event) {
            const tgt = event.currentTarget
            let flag = false

            switch (event.key) {
                case 'ArrowLeft':
                    this.moveFocusToPreviousTab(tgt)
                    flag = true
                    break

                case 'ArrowRight':
                    this.moveFocusToNextTab(tgt)
                    flag = true
                    break

                case 'Home':
                    this.moveFocusToTab(this.firstTab)
                    flag = true
                    break

                case 'End':
                    this.moveFocusToTab(this.lastTab)
                    flag = true
                    break

                default:
                    break
            }

            if (flag) {
                event.stopPropagation()
                event.preventDefault()
            }
        },
        onClick(event) {
            event.preventDefault()
            event.stopPropagation()
            this.setSelectedTab(event.currentTarget, false)
        },
        selectTab(event) {
            if (event && event.detail && event.detail.immediate === true) {
                this.$node.dataset.tabsImmediate = true
            }
            this.setSelectedTab(event.currentTarget, true)
        }
    },
    {
        init() {
            this.transitionTime = 216
            this.options.scrollonclick = this.options.scrollonclick === 'true'

            this.tablistNode = this.$node

            this.tabs = []

            this.firstTab = null
            this.lastTab = null

            this.firstTabPanel = null

            this.tabs = Array.from(
                this.tablistNode.querySelectorAll('[role=tab]')
            )
            this.tabpanels = []

            this.tabs?.forEach((tab) => {
                const tabpanel = document.getElementById(
                    tab.getAttribute('aria-controls')
                )

                if (!tab.getAttribute('aria-selected')) {
                    tab.setAttribute('aria-selected', 'false')
                }

                this.tabpanels.push(tabpanel)

                tab.addEventListener('keydown', this.onKeydown)
                tab.addEventListener('click', this.onClick)
                tab.addEventListener('tabs:select', this.selectTab)

                if (!this.firstTab) {
                    this.firstTab = tab
                    this.firstTabPanel = tabpanel
                }
                this.lastTab = tab

                if (tab.getAttribute('aria-selected') === 'true') {
                    this.current = {
                        tab: tab,
                        tabpanel: tabpanel
                    }
                } else {
                    tabpanel.hidden = true
                    tabpanel.inert = true
                }
            })

            if (!this.current) {
                this.current = {
                    tab: this.firstTab,
                    tabpanel: this.firstTabPanel
                }
            }

            this.$node.dataset.tabsImmediate = true
            this.setSelectedTab(this.current.tab, true)
        },
        destroy() {
            this.tabs?.forEach((tab) => {
                tab.removeEventListener('keydown', this.onKeydown)
                tab.removeEventListener('click', this.onClick)
                tab.removeEventListener('tabs:select', this.selectTab)
            })
        }
    }
)

export default Tabs
