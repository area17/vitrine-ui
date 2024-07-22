# Vitrine UI blade components

[![Latest Version on Packagist](https://img.shields.io/packagist/v/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)

AREA 17 Vitrine Blade components to import into a Laravel application. Individual Blade components are showcased in the dedicated demo website : https://vitrine.a17.dev/storybook

## Installation

You can install the package via Composer:

```bash
composer require area17/vitrine-ui
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="vitrine-ui-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

### Use component

Modal:

```html
<x-vui-modal>
    ...
</x-vui-modal>
```

Heading

```html
<x-vui-heading>
    ...
</x-vui-heading>
```

Button

```html
<x-vui-button>
    ...
</x-vui-button>
```

Some components require CSS/JS:

### Add alias to project `vite.config.js`:

```js
export default ({ mode }) =>
    defineConfig({
        resolve: {
            alias: {
                '@vitrineUI': resolve(
                    __dirname,
                    'vendor/area17/vitrine-ui'
                ),
                '@vitrineUIComponents': resolve(
                    __dirname,
                    'vendor/area17/vitrine-ui/resources/views/components/'
                )
            }
        }
    })
```

### Add component css to `app.css`

Import single component:

```css
@import "@vitrineUIComponent/modal/modal.css";
```

Import all components:

```css
@import "@vitrineUI/index.css";
```

### Import behaviors

Import single component behavior:

```js
import { manageBehaviors } from '@area17/a17-behaviors'
import ModalBehavior from '@vitrineUIComponents/modal/modal'

document.addEventListener('DOMContentLoaded', async function () {
    manageBehaviors.init({ ...ModalBehavior, ...Behaviors })
})
```

Import all component behaviors:

```js
import { manageBehaviors } from '@area17/a17-behaviors'
import * as VitrineBehaviors from '@vitrineUI/resources/frontend/scripts/behaviors'

document.addEventListener('DOMContentLoaded', async function () {
    manageBehaviors.init({ ...VitrineBehaviors, ...Behaviors })
})
```

Or

```js
import { manageBehaviors } from '@area17/a17-behaviors'
import * as Behaviors from './behaviors'
import * as VitrineBehaviors from './behaviors/vitrine' /* import only the needed behaviors from VitrineUI */

document.addEventListener('DOMContentLoaded', function () {
    // expose manageBehaviors
    window.A17.behaviors = manageBehaviors
    // init behaviors!
    // TBD: We may switch to direct import instead of barrel file
    window.A17.behaviors.init({
        ...VitrineBehaviors,
        ...Behaviors
    })
})
```


### Custom Events

Custom Events are referenced into a shared object so you can easily use these in new behaviors created outside Vitrine UI.

```js
import { customEvents } from '@vitrineUI/resources/frontend/constants/customEvents'

/* Trigger openModal() when a modal is opened into the document */
document.removeEventListener(
    customEvents.MODAL_OPENED,
    this.openModal,
    false
)
```

## Publish Components

You can publish the components using the `vitrine-ui:publish` command. You can specify components by adding their names as arguments. If you don't specify any components and don't pass the `--all` option, it will prompt to select components to publish.

### Supported options:

- `--all` : publish all vitrine-ui components
- `--view` : Publish only the view of the component
- `--class` : Publish only the class of the component
- `--force` : Overwrite existing files

## Todo

- Add ability to publish components to application
- Integration / autocompletion with IDE
- Contributions rules
- Add tests
- Theme options and extends possibilities (with css classes, specific tailwind components plugin -> tbd, extends basic theme through css / tailwind css preset)... 

- Components refactoring
- [x] Accordion
- [ ] Audio player
- [x] Breadcrumbs
- [x] Button
- [ ] Card Inline
- [ ] Card Primary
- [ ] Datepicker
- [ ] Dropdown
- [ ] Form
- [ ] Inputs
- [x] Form Select
- [x] Heading
- [x] Icon

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
