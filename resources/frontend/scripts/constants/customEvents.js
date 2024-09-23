/* Custom Events Constant Definition */
/* - Easier to be used in other files */
/* - Avoid spelling mistakes */
/* - Easier to update values */
/* - Avoid magic strings */
/* - Avoid duplicated values */

export const customEvents = {
    CAROUSEL_CHANGE: 'Carousel:Change' /* node event */,

    MODAL_CLOSED: 'Modal:hasClosed' /* document event */,
    MODAL_OPENED: 'Modal:hasOpened' /* document event */,
    MODAL_CLOSE_ALL: 'Modal:closeAll' /* document event */,
    MODAL_OPEN_BY_ID: 'Modal:openById' /* document event */,

    MODAL_NODE_CLOSED: 'Modal:closed' /* node event*/,
    MODAL_NODE_OPENED: 'Modal:opened' /* node event*/,
    MODAL_NODE_OPEN: 'Modal:open' /* node event*/,
    MODAL_NODE_TOGGLE: 'Modal:toggle' /* node event*/,
    MODAL_NODE_CLOSE: 'Modal:close' /* node event*/,

    VIDEO_PLAYED: 'video:played' /* node event */,
    VIDEO_RESET: 'video:reset' /* node event */,
    VIDEO_DESTROY: 'video:destroy' /* node internal videoplayer event */,

    VIDEO_BACKGROUND_MUTE_ALL: 'VideoBackground:muteAll' /* document event */,

    DATE_INPUT_SELECT_DATE: 'DateInput:SelectDate' /* node event */,
    DATE_INPUT_RANGE_VALIDATION: 'DateInput:RangeValidation' /* node event */,
    DATE_PICKER_MIN_UPDATE: 'DateInput:PickerMinUpdate' /* node event */,
    DATE_PICKER_MAX_UPDATE: 'DateInput:PickerMaxUpdate' /* node event */,

    DATE_PICKER_CHANGE: 'DatePicker:Change' /* node event */,
    DATE_PICKER_UPDATE: 'DatePicker:MinMaxUpdate' /* node event */,

    INPUT_VALIDATED: 'Input:Validated' /* node event */,
    INPUT_RESET: 'Input:Reset' /* node event */,

    TABS_OPENED: 'Tabs:opened', /* node event */
    TABS_SHOWN: 'Tabs:shown', /* node event */
    TABS_HIDDEN: 'Tabs:hidden' /* node event */
}
