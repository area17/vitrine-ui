// A17 tailwind plugins
const {
    Setup,
    ApplyColorVariables,
    ColorTokens,
    Components,
    Container,
    CssInJs,
    DevTools,
    FullBleedScroller,
    GridGap,
    GridLayout,
    GridLine,
    InteractionMediaQueries,
    Keyline,
    Layout,
    PseudoElements,
    RatioBox,
    Scrollbar,
    Spacing,
    SpacingTokens,
    Typography,
    Underline
} = require('@area17/a17-tailwind-plugins')

// conf
const feConfig = require('./frontend.config.json')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/frontend/**/*.js',
        './resources/views/**/*.blade.php',
        './app/View/**/*.php'
    ],
    corePlugins: {
        container: false
    },
    plugins: [
        Setup,
        ColorTokens,
        Components,
        Container,
        CssInJs,
        DevTools,
        FullBleedScroller,
        GridGap,
        GridLayout,
        GridLine,
        InteractionMediaQueries,
        Keyline,
        Layout,
        PseudoElements,
        RatioBox,
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
        spacingGroupProperties: { h: ['height'] },
        spacingGroups: feConfig.spacing.groups,
        spacing: SpacingTokens(feConfig.spacing.tokens),
        colors: feConfig.color.tokens,
        borderColor: ApplyColorVariables(
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
        placeholderColor: ApplyColorVariables(
            feConfig.color.tokens,
            feConfig.color.text
        ),
        aspectRatio: feConfig.aspectRatio,
        ratios: feConfig.ratios,
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
        components: feConfig.components,
        css: feConfig.css,
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
