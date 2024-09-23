# Changelog

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
