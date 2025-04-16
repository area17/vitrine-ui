# Changelog

## [2.15.4] - 2025-16-04

### Updated

- Pagination : Fix story data

## [2.15.3] - 2025-11-04

### Updated

- Banner : Add OPENED event and export method to set banner height so it can be use in app.js

## [2.15.2] - 2025-10-04

### Updated

- Button : New scoped Slots added to handle extra markup/content before or after the label span.

## [2.15.1] - 2025-08-04

### Fixed

- VideoBackground : A11Y fix in the Show Video behavior - set focus on iframe on loading, make sure the play button is not focusable anymore.

## [2.15.0] - 2025-01-04

### Updated

- New : Banner Component

## [2.14.9] - 2025-10-03

### Updated

- Carousel : Add CAROUSEL_INIT and CAROUSEL_DESTROY events on the Carousel behavior to notifiy other behaviors. Add swiper instance into the CAROUSEL_CHANGE behavior.

## [2.14.8] - 2025-05-03

### Updated

- Modal : Add 'open' prop to tell if a modal must open on page load.

## [2.14.7] - 2025-07-02

### Updated

- Icon : Avoid duplicated aria-hidden attributes when using Icon Component. The attribute is already added when rendering the icon.

## [2.14.6] - 2025-04-02

### Updated

- Accordion Item : add $ui override capablity. Accordion Item can now be styled individually to override default style.

## [2.14.5] - 2025-29-01

### Fixed

- Accordion : Exclusive mode should not throw error when destroy() is called.


## [2.14.4] - 2025-23-01

### Updated

- Accordion : add events for closed/opened status.
- Accordion : Set invisible content as inert to better avoid link being focusable on page load.

## [2.14.3] - 2025-14-01

### Updated

- Pagination : add option to control Prev/Next button sizes.

## [2.14.2] - 2025-08-01

### Updated

- Modal : add 'data-init' attribute when modal is first opened. This can be used to set some styling before modal is first opened. For example, this can be used to set a display none (to avoid iOS Safari crashing for example)

## [2.14.1] - 2025-08-01

### Updated

- New : Tabs Component

## [2.14.0] - 2025-06-01

### Updated

- New : Carousel Component using SwiperJS

## [2.13.7] - 2024-18-12

### Fixed

- Modal - Check if scroller exist to avoid issues when called from destroy method when navigating from page to page

## [2.13.6] - 2024-10-12

### Fixed

- VideoBackground - Make sure the Play/Pause button are displaying properly following video status

## [2.13.5] - 2024-03-12

### Fixed

- Motion reduced - avoid issue when calling destroy on videoBackground

## [2.13.4] - 2024-14-10

### Updated

- Inputs - allow to set additional behaviors
- Set Theme key for required label and checkbox (because sometimes we dont to display "Required" to every fields)

## [2.13.3] - 2024-30-09

### Fixed

-   Dropdown : Update keyboard behavior to match Disclosure pattern. https://www.w3.org/WAI/ARIA/apg/patterns/disclosure/examples/disclosure-navigation/

## [2.13.2] - 2024-27-09

### Added

-   Translations : add French translation keys

## [2.13.1] - 2024-27-09

### Fixed

-   CardLink : Make sure we can use other tags than span, a (ie : button)

## [2.13.0] - 2024-25-09

### Updated

-   Use TailwindMerge for passing custom class via attributes-bags
-   Modal : allow to add a behavior on Modal element

### Fixed

-   Modal Click Outside option will not interfering with click events inside the modal

## [2.12.1] - 2024-23-09

### Fixed

-   Rename Tailwind Config to cjs : it make it clear that it is a CommonJS module (all JS are now treated as ES module)

## [2.12.0] - 2024-23-09

### Updated

-   Configure linters and code formatters to improve codebase's architecture :
    -   Add Phpstan (level 6) and php-cs-fixer for static analysis
    -   Add Eslint
    -   Add Prettier with specifics plugin for PHP and Laravel
    -   Run linters on pre-commit githook

## [2.11.0] - 2024-19-09

### Updated

-   DateRange : use Theme UI CSS
-   DateTrio : use Theme UI CSS
-   Date : use Theme UI CSS
-   Password : use Theme UI CSS
-   Add Documentation for Form Components
-   Update Stories for Form Components

## [2.10.4] - 2024-13-09

### Fixed

-   UI Merge : test if component theme is existing

## [2.10.3] - 2024-12-09

### Fixed

-   VideoBackground logic to handle autoplay when they are in viewport

## [2.10.2] - 2024-03-09

### Fixed

-   Image sources definition

## [2.10.1] - 2024-03-09

### Fixed

-   Picture rendering logic

## [2.10.0] - 2024-30-08

### Updated

-   Stories and documentation for components
-   Update readme

## [2.9.1] - 2024-30-08

### Fixed

-   Fix typo in VideoBackground component

## [2.9.0] - 2024-29-08

### Added

-   Add simple card-wrapper and card-link components to compose card components at application level

### Updated

-   Prepare Twill-image depreciation for next major release with better support of images passed as an array
-   Refactor and add theming file for video-background : _Breaking-change : no more "aspect-ratio" prop in the component (this will be ignored)_, use class instead to define the aspect ratio of the video wrapper.
-   Inline heading component to remove spacings generated in rendered html

## [2.8.2] - 2024-25-07

### Updated

-   Update Vitrine-ui default icons_view_path

## [2.8.1] - 2024-25-07

### Updated

-   Update dependencies (Update Twill Image to fix calculation of sizes atributes)

## [2.8.0] - 2024-22-07

### Updated

-   Custom Events : Custom Events are referenced into a shared object so you can easily use these in behaviors created outside Vitrine UI. **Avoid Magic strings**

## [2.7.4] - 2024-12-07

### Added

-   ShowVideo : Add events to control states of the component (ie : to reset the video if not visible anymore)

## [2.7.3] - 2024-02-07

### Added

-   Modal : iOS – Body Scroll Lock : add a way to specify another scrollable div to target "data-modal-scroller". If not present it will fallback on the focus trap div. It is important that the scroller div is the one we would like to allow scroll on (NOT a parent of that element) as specified in the doc : https://github.com/rick-liruixin/body-scroll-lock-upgrade

## [2.7.2] - 2024-12-06

### Added

-   Inputs : Radio and Checkbox - Allow local overrides

## [2.7.1] - 2024-11-06

### Added

-   Inputs : JSON theming files for checkbox group and radio group

## [2.7.0] - 2024-06-06

### Added

-   Inputs : JSON theming files for inputs checkbox and radio

## [2.6.1] - 2024-06-06

### Update

-   Forms : Checkboxes - Add ability to customize the checkbox icon

## [2.6.0] - 2024-06-06

### Fixed

-   Forms : Checkboxes and radios : fix incorrect "for" attribute for the label. It should always be the same as the id attribute of the input.

## [2.5.1] - 2024-04-06

### Updated

-   Accordion : fix issue with content overflow when opening accordion item : remove useless code in favor of using transitionend event

## [2.5.0] - 2024-04-06

## Fixed

-   Accordion : fix issue with content overflow when opening accordion item. Add option timing to set overflow timeout.

## [2.4.0] - 2024-04-06

### Updated

-   Laravel 11 Support

## [2.3.0] - 2024-03-06

### Added

-   Accordion : add "exclusive" mode to make sure only one item is opened at a time

## [2.2.0] - 2024-12-02

## Fixed

-   Aria-describedby for form elements – [MR-2](https://code.area17.com/a17/vitrine/vitrine-ui-blade/-/merge_requests/2)
-   Accordion behavior open state – [MR-3](https://code.area17.com/a17/vitrine/vitrine-ui-blade/-/merge_requests/3)

## [2.1.0] - 2024-22-01

### Added

-   New FormField component : New component to handle markup around Input / Textarea

### Changed

-   Update Input and Textarea

## [2.0.0] - 2024-16-01

### Added

-   New Image component : Split Media component into Image component so we have a way to add an image without extra markup around

### Fixed

-   VideoBackground - Refactor VideoBackground so it is not using Videojs by default. Native HTML5 video element is used instead. You can still use VideoJs to handle video with new prop native=false
-   Behavior ShowVideo - Cleanup behavior, remove unused code
-   Input - Fix input type definition
-   Input - Check if label is not empty to display input label

### Changed

-   Twill Image - Add case where image is being send as Twill Image Array when rendering an image tag
-   Textarea - Adjust component & add slot
-   Components - Remove listing stories and listing component
-   Pagination - Add options to change icon and display dropdown message

## [1.0.0] - 2023-10-12

### Added

-   Theme options : add `ui` logic to set Taiwlind CSS classes that will override default vitrine styling

### Fixed

-   Accordion - fix error when destroying the Accordion
-   Fix class name casing in mapbox

### Changed

-   Initial release
