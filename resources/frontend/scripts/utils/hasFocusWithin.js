const hasFocusWithin = (el) => {
    return el.contains(document.activeElement)
}

export { hasFocusWithin }
