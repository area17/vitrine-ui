# Changelog

## [Unreleased]

### Added

- `vitrine-ui:publish --list` shows every publishable component with its type (class or Blade-only), whether it has stories, and its JS/CSS assets.
- `vitrine-ui:publish --dry-run` lists the views, classes, stories, config changes and generated import lines that would be written, without touching any file.
- PHPUnit tests (`composer test`, Orchestra Testbench) for the `vitrine-ui:publish` command and for the manifest: every component alias is listed, every declared view, stories and asset file exists, and every behavior is exported by `behaviors/index.js` under the name it registers.
- `VitrineUI::resourcesPath()` and `VitrineUI::vendorResourcesPath()` helpers, giving the path to the package's `resources` folder (and, in an app, to its `vendor` copy).

### Updated

- New `resources/manifest.php` lists, for every component alias, its package class, view folder, stories folder and assets. `vitrine-ui:publish` reads it, and the tests check that every declared file exists. The static `$assets` property and `assets()` method of the component classes are removed.
- `vitrine-ui:publish` now generates `vitrine-ui.js` (in `js_path`) and `vitrine-ui.css` (in `css_path`), importing the behaviors and CSS of the published components. With `--assets` the JS and CSS files are now copied into `js_path` / `css_path` (same sub-folders as in the package, including the utils and constants the behaviors import) and nothing links to `vendor/` anymore; existing files are kept unless `--force`, and old `vendor/` import lines are dropped. Running it again adds the components published later. It also lists the npm packages needed and the optional extras (e.g. `video.js` for the video background), and no longer tries to rewrite a non-existent `vitrine-ui.js`.

### Fixed

- Modal, Datepicker, Dropdown, Audio player : Escape is now handled on `keydown`, and only the innermost open element reacts. Before, pressing Escape in an open datepicker or audio speed menu inside a modal also closed the modal. The dropdown now closes on Escape (as its README says) and returns the focus to its button.
- `ui()` : an option value of `0` or `"0"` now selects its preset class (for example `level: 0`). It was treated as empty and fell back to the default.
- Config : `css_class_prefix` is now defined (empty by default), it was read but missing from `config/vitrine-ui.php`.
- Range : the focus outline uses the Tailwind 4 important suffix (`outline!`) instead of the removed `!outline` prefix.
- Modal : closing then quickly reopening a modal no longer unlocks the page scroll while it is open (the 200ms unlock timer is now cancelled on open and on destroy), and the removal of a listener that was never added is gone.
- `vitrine-ui:publish` now includes the JS, CSS and npm packages of the components a published view renders with `<x-vui-*>`, transitively (e.g. `filters-panel` brings Modal, Accordion and the form inputs, `form-date-range` brings the datepicker and date inputs).

### Removed

- `resources/frontend/safelist.txt` (`start-0` and `end-0` are written in full in the presets and views, Tailwind already detects them) and its `@source` line. Apps can drop `txt` from their Tailwind content pattern.
- The empty `resources/frontend/theme/vitrine-ui.json`. The global theme of an app (`theme_file` in `vitrine_path`) is unchanged.
- `PublishComponentTheme` (`vitrine-ui:publish-theme`) command. It was never registered by the service provider, so it could not be run.

### Fixed

- `vitrine-ui:publish` : the Blade-only components (`banner`, `filters-panel`, `pagination-numbered`, `accordion-item`, `modal-close`…) can now be named, selected in the prompt and have their views published. Before, they only got their stories and assets and `publish banner` said it could not find the component. With no component named, only the selected components are published, not every Blade-only one.
- `vitrine-ui:publish` : views and stories are mapped to the right folders (`link` → button views, `card-link` → card, `tabs-list` / `tabs-panel` → tabs, Blade-only components → their component stories) and shared folders are published once. Missing sources are skipped with a message instead of failing, existing files are skipped with a hint to use `--force`, and the command exits with a failure code on unknown components.
- `vitrine-ui:publish` : publishing a class only rewrites its own `::class` entry in `config/vitrine-ui.php` (`card` also rewrote `card-link`, `form-date` also rewrote `form-date-range`…), and the stories folder no longer defaults to a folder named `null`.
- `vitrine-ui:publish` : story data files already published are skipped instead of aborting the command, and are only copied when stories are published.
- Banner, Filters panel : their behaviors (`Banner.js` with the `@area17/a17-helpers` package, `FilterPanel.js`) are declared in the manifest.
- Video background : `video.js` and `VideoBackgroundVideoJs.js` are now declared as optional assets, only needed with `:native="false"`. The `video.js` package was declared even for the default native video.
- Carousel, Tabs, Select : declare their assets (`Carousel.js` and the `swiper` npm package, `Tabs.js`, `SelectSizer.js`), so `vitrine-ui:publish` and the npm notice list them.
- Datepicker : the declared CSS asset is now `components/datepicker.css` (it was `components/date-picker.css`, a file that does not exist).
- Map Mapbox : the declared JS asset is now `behaviors/MapBoxMaps.js` (it was `behaviors/MapboxMaps.js`, which only resolved on case-insensitive file systems).

## [4.0.0-beta.3] - 2026-24-11

### Updated

- Link : the `secondary` variant now uses the grey `text-tertiary` instead of white (`text-inverse`). Overridden or published link presets keep their own value.

### Fixed

- Modal : a closed modal is now `inert`, so its content can no longer be reached with the keyboard or by assistive technologies.
- Modal : opening a modal without an initial focus element (no `title` and no `data-Modal-initial-focus` in the content, or `setInitialFocus` set to `false`) no longer throws. The focus goes to the first focusable element.
- Modal : `aria-labelledby` is only rendered when a `title` is set. A title passed in the content with the id `{modal id}_title` labels the dialog automatically. The stories now use that id.
- Link : fix the stories and README. The secondary story now uses the `secondary` variant, the stories no longer pass the nonexistent `inverse` and `active` props, and they no longer throw a `TypeError` when `iconPosition` or `static` are not set. The README uses `<x-vui-link>` and an existing icon name.

## [4.0.0-beta.2] - 2026-23-11

### Updated

- Button : render `type="button"` by default on `<button>` elements, so a button placed in a form no longer submits it. Pass `type="submit"` to opt back in.
- Media : the caption slot is now named `slotCaption` (it was never working under its previous name), consistent with the other `slot*` names. The wrapper is a `<figure>` whenever a caption is set, through the `caption` prop or the slot.

### Fixed

- Datepicker : add `type="button"` to the calendar trigger so it does not submit the form.
- Password input : add `type="button"` to the show/hide toggle so it does not submit the form.
- Password input & Datepicker : remove the invalid `text-[#basa55]` class from the icons.
- Image : a `sources` prop passed to the component was ignored.
- Heading : no longer throws a `TypeError` when `level` is not set (renders a `span`).
- Icon : no longer throws a `TypeError` when `name` is not set (renders nothing).
- Breadcrumbs : no longer throws a `TypeError` when `tag` is `null` (falls back to `nav`).
- Media : fix the caption slot, which threw an undefined variable error.

## [4.0.0-beta.1] - 2026-23-11

### Breaking

- Tailwind CSS 4 : the package now requires `tailwindcss ^4` and `@area17/a17-tailwind-plugins ^5`. Keep configuring Tailwind through your `tailwind.config.js`, and load it from your stylesheet with `@config` (see the README). Tailwind 3 is no longer supported.
- Layout classes renamed by A17 Tailwind Plugins v5 : `w-N-cols` is now `w-cols-N` (and `w-N-cols-vw` is now `w-cols-vw-N`). Update your own templates and theme overrides.
- Theme presets migrated to Tailwind 4 class names (`shrink-0`, `outline-hidden`, `ms-*` / `me-*`, `end-*`, `rounded-xs`, ...). Published or overridden preset files need the same migration.
- Tailwind Merge : `gehrisandro/tailwind-merge-laravel` is replaced by `tales-from-a-dev/tailwind-merge-php`. The `$attributes->twMerge()` macro is still provided, but the `twMerge()` helper, the `@twMerge` Blade directive and the `tailwind-merge` config file no longer exist. Declare custom utilities in the new `tailwind_merge` option of `config/vitrine-ui.php`.

### Updated

- PHP 8.4 : explicit nullable types on all component constructors and `VitrineUI::ui()`. The package still supports PHP 8.1 and above.
- Remove the unmaintained `yieldstudio/tailwind-merge-php` dependency.
- `PublishComponentTheme` command : add parameter and return types.
- Add `AGENTS.md` and `CLAUDE.md` for coding agents.

### Fixed

- Presets : fix unknown classes `before:ease--out` (radio), `f-ui-01` (carousel), `f-heading-03` (tabs) and `border-default` (filters panel).
- Theme : define `--font-weight-medium`, `--text-xs`, `--radius-xs`, `--radius-sm` and `--shadow-lg`, which the components use but the Tailwind 4 theme reset had removed.
- Tag : remove the undefined `rounded-px` and use `hover:bg-quaternary` instead of the undefined `hover:bg-accent-3`.
- Image zoom : use `bg-tertiary` instead of the undefined `bg-inverse-primary-strong`.
- Form controls : Tailwind 4 preflight makes inputs, selects and textareas transparent. Add `bg-primary` to their presets to keep the previous white background.
- Tabs : remove the invalid `f-heading-03` class from the title (it was unstyled before, and `f-heading-3` is a 52-74px display style).

## [3.1.3] - 2026-03-09

### Fixed

- Carousel : Fix Swiper navigation and pagination selectors to use relative selectors based on the carousel element.

## [3.1.2] - 2026-28-08

### Fixed

- Image & Picture component : fix incorrect config path

## [3.1.1] - 2026-28-08

### Updated

- Tabs : Fix Tabs list component html (incorrect role attribute)

## [3.1.0] - 2026-28-08

### Updated

- New : Filter Panel Component
- Simplify import and allow publish of the stories for Blade Components (with no PHP Class)

## [3.0.10] - 2025-01-10

### Updated

- Tabs : Documentation - Add example to set CSS animation

## [3.0.9] - 2025-22-09

### Updated

- Tabs : Horizontal scroll the tablist if need (center the active button)

## [3.0.8] - 2025-18-09

### Updated

- Tabs : Refactor the code to make sure the CSS transitions are looking good (first transition was broken).
- Button / Card Link : Update isExternalUrl helper to handle subdomains. Add new config 'open_subdomains_external' to set the behavior in app.

## [3.0.7] - 2025-05-09

### Updated

- VideoBackground : Add 2 options in behavior to set threshold start/end. This way you can fine tune how video should play/pause on scroll based on visibility

## [3.0.6] - 2025-03-09

### Updated

- Pagination : add labelAfterActions prop – Boolean to display "Page x of y" message under the action buttons on mobile view

## [3.0.5] - 2025-22-08

### Updated

- New : Pagination Numbered Component

## [3.0.4] - 2025-21-08

### Updated

- Banner : Add documentation

### Fixed

- Accordion : Fix incorrect HTML for accordion, checkbox, radio and pagination

## [3.0.3] - 2025-06-05

### Updated

- Select : Add option to resize automatically Select based on current value

## [3.0.2] - 2025-05-05

### Updated

- Carousel : Add option to set initial slide
- Image : Add possiblity to set image tag without an image object

## [3.0.1] - 2025-23-04

### Updated

- Image : Update Images story, add example for picture

## [3.0.0-alpha] - 2025-23-04

### Updated

- Image : Remove Twill Image dependency
- Image : Update Image story
- ImageZoom : Lazyload Openseadragon inside ImageZoom behavior
- Update Datepicker story
- Form inputs : update the input components so all components are using the master `x-vui-form-field` component and that each input can be styled using themes.
- Remove radio CSS (styling done with Tailwind CSS instead)
- Remove checkbox CSS (styling done with Tailwind CSS instead)
- Allow styling of password-input with theme

## [2.15.7] - 2025-24-09

### Updated

- Tabs : Scroll horizontally tab list to selected tab. Allow HTML in tab buttons.

## [2.15.6] - 2025-17-09

### Updated

- Tabs : Refactor the code to make sure the CSS transitions are looking good (first transition was broken).

## [2.15.5] - 2025-19-05

### Updated

- Button / Card Link : Update isExternalUrl helper to handle subdomains. Add new config 'open_subdomains_external' to set the behavior in app.

## [2.15.4] - 2025-17-04

### Fixed

- Pagination : Fix story data
- Button / Card Link : Update logic to set target value (fix issue when target is set as a string)

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
