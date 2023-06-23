const variableComponents = [
    'btn',
    'wysiwyg'
]

module.exports = {
    safeListPattern(prefix = '') {
        return variableComponents.map((component) => ({
            pattern: prefix ? new RegExp(`^${prefix}-${component}--.+`) : new RegExp(`^${component}--.+`)
        }))
    }
}
