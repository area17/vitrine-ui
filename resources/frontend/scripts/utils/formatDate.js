const formatDate = (d, type = 'iso') => {
    const lang = new Intl.NumberFormat().resolvedOptions().locale
    const labels = window.A17?.translations?.form?.datepicker
    const date = new Date(new Date(d).setHours(0, 0, 0, 0))
    let today = new Date().setHours(0, 0, 0, 0)
    let tomorrow = new Date(new Date().setHours(0, 0, 0, 0))
    tomorrow = tomorrow.setDate(tomorrow.getDate() + 1)

    if (type === 'iso') {
        return `${date.getFullYear()}-${(date.getMonth() + 1)
            .toString()
            .padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`
    }

    if (type === 'display') {
        if (today === date.getTime()) {
            return labels.today
        } else if (tomorrow === date.getTime()) {
            return labels.tomorrow
        } else {
            return `${date.getFullYear()}-${date.toLocaleDateString('default', {
                month: '2-digit'
            })}-${date.toLocaleDateString('default', {
                day: '2-digit'
            })}`
        }
    }

    if (type === 'human') {
        let dateStr = new Intl.DateTimeFormat(lang, {
            dateStyle: 'full'
        }).format(date)

        if (today === date.getTime()) {
            return `${labels.today} (${dateStr})`
        }

        if (tomorrow === date.getTime()) {
            return `${labels.tomorrow} (${dateStr})`
        }

        return dateStr
    }
}

export default formatDate
