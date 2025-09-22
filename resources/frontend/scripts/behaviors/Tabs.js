import { createBehavior } from '@area17/a17-behaviors'

import { customEvents } from '../constants/customEvents'

/*
    Markup and JS taken from:
    https://www.w3.org/WAI/ARIA/apg/patterns/tabs/examples/tabs-manual/
*/

const DEFAULT_TRANSITION_TIME = 200
/*
    Example of CSS to create transitions for tab panels :
    [data-behavior*='tabs'] {
        --tab-transition-time: 200ms;
    }
    [data-behavior*='tabs'][data-tabs-immediate='true'] {
        --tab-transition-time: 0ms;
    }
    [data-behavior*='tabs'] [role='tabpanel'] {
        opacity: 1;
        transition: opacity var(--tab-transition-time) ease-in;
    }
    [data-behavior*='tabs'] [role='tabpanel'][inert] {
        opacity: 0;
    }
*/

const Tabs = createBehavior(
    'Tabs',
    {
        scrollToSelectedTab() {
            // center the selected tab in the tablist if possible
            const tablistWidth = this.tablistNode.offsetWidth
            const tabWidth = this.current.tab.offsetWidth
            const tabCenter = this.current.tab.offsetLeft + tabWidth / 2
            const scrollLeft = Math.max(
                0,
                Math.min(
                    tabCenter - tablistWidth / 2,
                    this.tablistNode.scrollWidth - tablistWidth
                )
            )
            this.tablistNode.scrollLeft = scrollLeft
        },
        setSelectedTab(selectedTab, avoidScroll, forceImmediate) {
            if (this.current.tab === selectedTab && !forceImmediate) {
                return
            }

            let transitionTime = this.transitionTime
            const nextCurrentTab = {
                tab: selectedTab,
                tabpanel: document.getElementById(
                    selectedTab.getAttribute('aria-controls')
                )
            }

            if (
                this.$node.dataset.tabsImmediate === true ||
                this.$node.dataset.tabsImmediate === 'true'
            ) {
                transitionTime = 0
            }

            // on page load, if the current tab is not set
            if (forceImmediate) {
                transitionTime = 0
            }

            this.current.tab.setAttribute('aria-selected', 'false')
            this.current.tab.tabIndex = -1
            this.current.tabpanel.inert = true
            this.current.tabpanel.dispatchEvent(
                new CustomEvent(customEvents.TABS_HIDDEN)
            )
            document.dispatchEvent(new CustomEvent(customEvents.TABS_HIDDEN))
            if (!avoidScroll && this.options.scrollonclick) {
                this.$node.scrollIntoView(true)
            }

            setTimeout(() => {
                this.current.tabpanel.hidden = true

                nextCurrentTab.tab.setAttribute('aria-selected', 'true')
                nextCurrentTab.tab.removeAttribute('tabindex')
                nextCurrentTab.tabpanel.hidden = false
                setTimeout(() => {
                    nextCurrentTab.tabpanel.inert = false
                    nextCurrentTab.tabpanel.dispatchEvent(
                        new CustomEvent(customEvents.TABS_SHOWN)
                    )
                    document.dispatchEvent(
                        new CustomEvent(customEvents.TABS_SHOWN, {
                            detail: this.current
                        })
                    )
                }, 16) // allow time for the display to be set to block before removing inert

                this.current = nextCurrentTab
                if (!avoidScroll) {
                    document.dispatchEvent(
                        new CustomEvent(customEvents.TABS_OPENED, {
                            detail: this.current
                        })
                    )

                    // horizontal scroll the tablist to the active tab if needed
                    this.scrollToSelectedTab()
                }
            }, transitionTime)
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
            this.setSelectedTab(event.currentTarget, false, false)
        },
        selectTab(event) {
            let forceImmediate = false
            if (event && event.detail && event.detail.immediate === true) {
                forceImmediate = true
            }
            this.setSelectedTab(event.currentTarget, true, forceImmediate)
        }
    },
    {
        init() {
            this.transitionTime =
                16 +
                parseInt(
                    window
                        .getComputedStyle(this.$node)
                        .getPropertyValue('--tab-transition-time') ||
                        DEFAULT_TRANSITION_TIME
                )
            this.options.scrollonclick = this.options.scrollonclick === 'true'

            this.tablistNode = this.getChild('tablist') || this.$node

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

            // init state
            this.setSelectedTab(this.current.tab, true, true)
            this.scrollToSelectedTab()
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
