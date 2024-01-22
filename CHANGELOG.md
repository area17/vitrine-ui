# Changelog


## [2.1.0] - 2024-22-01

## Added
- New FormField component : New component to handle markup around Input / Textarea

### Changed
- Update Input and Textarea

## [2.0.0] - 2024-16-01

## Added
- New Image component : Split Media component into Image component so we have a way to add an image without extra markup around

### Fixed
- VideoBackground - Refactor VideoBackground so it is not using Videojs by default. Native HTML5 video element is used instead. You can still use VideoJs to handle video with new prop native=false
- Behavior ShowVideo - Cleanup behavior, remove unused code
- Input - Fix input type definition
- Input - Check if label is not empty to display input label

### Changed
- Twill Image - Add case where image is being send as Twill Image Array when rendering an image tag
- Textarea - Adjust component & add slot
- Components - Remove listing stories and listing component
- Pagination - Add options to change icon and display dropdown message

## [1.0.0] - 2023-10-12

## Added
- Theme options : add `ui` logic to set Taiwlind CSS classes that will override default vitrine styling

### Fixed
- Accordion - fix error when destroying the Accordion
- Fix class name casing in mapbox

### Changed
- Initial release

