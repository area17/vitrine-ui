export const MOTION_REDUCE_MEDIA = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
)

export const useMotionReduce = (onChange = () => {}) => {
    const _onChange = () => {
        if (typeof onChange === 'function') {
            onChange(MOTION_REDUCE_MEDIA.matches)
        }
    }
    MOTION_REDUCE_MEDIA.addEventListener('change', _onChange)

    return [
        MOTION_REDUCE_MEDIA.matches,
        () => {
            MOTION_REDUCE_MEDIA.removeEventListener('change', _onChange)
        }
    ]
}
