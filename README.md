# Vitrine UI blade components

[![Latest Version on Packagist](https://img.shields.io/packagist/v/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)

AREA 17 Vitrine components to import into a laravel application

## Installation

You can install the package via composer:

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

## Todo

- Add ability to publish components to application

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
