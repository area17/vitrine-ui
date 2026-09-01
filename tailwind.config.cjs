// A17 tailwind plugins
const {
    Setup,
    ApplyColorVariables,
    ColorTokens,
    Container,
    DevTools,
    FullBleedScroller,
    GridGap,
    GridLayout,
    GridLine,
    InteractionMediaQueries,
    Keyline,
    Layout,
    PseudoElements,
    Scrollbar,
    Spacing,
    Typography,
    Underline
} = require('@area17/a17-tailwind-plugins')

// conf
const feConfig = require('./frontend.config.json')

/** @type {import('tailwindcss').Config} */
module.exports = {
    plugins: [
        Setup,
        ColorTokens,
        Container,
        DevTools,
        FullBleedScroller,
        GridGap,
        GridLayout,
        GridLine,
        InteractionMediaQueries,
        Keyline,
        Layout,
        PseudoElements,
        Scrollbar,
        Spacing,
        Typography,
        Underline
    ],
    theme: {
        screens: feConfig.structure.breakpoints,
        mainColWidths: feConfig.structure.container,
        innerGutters: feConfig.structure.gutters.inner,
        outerGutters: feConfig.structure.gutters.outer,
        columnCount: feConfig.structure.columns,
        fontFamilies: feConfig.typography.families, // https://systemfontstack.com/
        typesets: feConfig.typography.typesets,
        spacingGroups: feConfig.spacing.groups,
        colors: feConfig.color.tokens,
        borderColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.border
        ),
        divideColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.border
        ),
        ringOffsetColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.border
        ),
        textDecorationColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.border
        ),
        textColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.text
        ),
        backgroundColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.background
        ),
        underlineColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.underline
        ),
        outlineColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.outlineColor
        ),
        aspectRatio: feConfig.ratios,
        zIndex: () => {
            const max = 100
            let values = {
                9999: 9999
            }

            for (let index = 1; index <= max; index++) {
                values[index] = index
            }

            return values
        },
        extend: {
            width: {
                'panel-max': '760px'
            },
            height: {
                'header-panel': '30vh'
            },
            minHeight: ({ theme }) => theme('spacing'),
            minWidth: ({ theme }) => theme('spacing'),
            maxWidth: ({ theme }) => theme('spacing'),
            spacing: {
                'safe-top': 'env(safe-area-inset-top)',
                'safe-bottom': 'env(safe-area-inset-bottom)',
                'safe-left': 'env(safe-area-inset-left)',
                'safe-right': 'env(safe-area-inset-right)',
                gutter: 'var(--inner-gutter)',
                'outer-gutter': 'var(--outer-gutter, 0px)'
            }
        }
    }
}
