const variableComponents = [
    'btn',
    'wysiwyg'
]

export const safeListPattern = (prefix = '') => {
    return variableComponents.map((component) => ({
        pattern: prefix ? new RegExp(`^${prefix}-${component}--.+`) : new RegExp(`^${component}--.+`)
    }))
}
