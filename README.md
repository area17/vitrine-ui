# Vitrine

[![Latest Version on Packagist](https://img.shields.io/packagist/v/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/area17/vitrine-ui/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/area17/vitrine-ui/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/area17/vitrine-ui.svg?style=flat-square)](https://packagist.org/packages/area17/vitrine-ui)

Vitrine is a library of components crafted by AREA 17 to use inside Laravel applications.

Components follow the best practices around performance, accessibility, and maintainability.


This library is under active development and name is subject to change in feature release.

## Installation

This package is not yet available on Packagist. You can install it from GitHub:
Add the repository to your composer.json file:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/area17/vitrine-ui.git"
        }
    ]
}
```

```bash
composer require area17/vitrine-ui
```

If you need specific configuration, you can publish the config file:

You can publish the config file with:

```bash
php artisan vendor:publish --tag="vitrine-ui-config"
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

### Import behaviors

Import single component behavior (Recommend way):

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

Custom Events are referenced into a shared object so you can easily use these in new behaviors created outside Vitrine.

```js
import { customEvents } from '@vitrineUI/resources/frontend/scripts/constants/customEvents.js'

/* Trigger openModal() when a modal is opened into the document */
document.addEventListener(
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
- `--stories` : Publish only the stories for the component

## Theming

Each component has default classes that you can customize through its associated JSON file located in the [components folder](resources/frontend/theme/components).
You can override this config in your Laravel application by updating 'vitrine_path' key set in [vitrine-ui config](config/vitrine-ui.php)  

### Configure tailwind for theming in your laravel application `tailwind.config.js`:
```js
module.exports = {
    content: [
        join(rootPath, "/resources/frontend/vitrine-ui/**/*.{js,json}"),
    ],
}
```

Example of a component JSON config :

```json
{
    "base": "custom-class",
    "wrapper": "custom-class"
}
```
The base key will replace the base component classes, which is the root DOM element of the component.
For some components, other properties are customizable. Refer to the [component's stories](resources/views/stories) to see which properties can be themed.

The configuration will replace existing default vitrine-ui classes. You can change this behavior by specifying merge rules in your component's JSON config and specifying elements.

```json
{
    "rules": {
      "merge": "base"
    },
    "base": "custom-class",
    "wrapper": "custom-class"
}
```

You can also override the json configuration directly in the component call by passing 'ui' key :
```html
<x-vui-component :ui="[
    'json-file-name' => [
        'base' => [
            'custom-class',
        ],
    ],
]" >
    ...
</x-vui-component>
```

###  Add variants
For some components, you can also add variants by including a variant key in the component's JSON config.

```json
{
    "base": "custom-class",
    "wrapper": "custom-class",
    "variant": {
        "primary": "variant-primary-class",
        "secondary": "variant-secondary-class"
    }
}
```

To use a variant, specify it in the component call:
```html
<x-vui-component variant="primary">
    ...
</x-vui-component>
```

###  Retrieve config CSS classes
You can retrieve CSS classes from the JSON configuration file by calling the Vitrine's helper using the following syntax:

```php
VitrineUI::ui('json_file_name', 'key_in_json_file', array_of_options)
```
array_of_options can be used for variant mapping.

## IDE configuration

Auto-completion for Vitrine's components is supported on PhpStorm and VS Code. 

### Phpstorm
For Phpstorm, you need to have [Laravel idea plugin](https://plugins.jetbrains.com/plugin/13441-laravel-idea) installed. 

Vitrine contains an ide.json file that will be read by the plugin. 

This file looks for the components key inside the Vitrine's config file. If your published the config file in your project. You can lose auto-completion feature if you remove the components key inside the published file.  


### VS Code
VS Code autocompletion support is available from a fork of [blade-components](https://github.com/m4n1ok/blade-components/tree/improve-autocompletion) plugin.

A packaged version of the plugin can be downloaded here: [blade-components-next-1.0.0.vsix](https://drive.google.com/file/d/1RccB7syGVgqH5h-Jw9bCeSlROzzRgQYT/view?usp=drive_link). 

You can manually install the plugin by following instructions from [VS Code documentation](https://code.visualstudio.com/docs/editor/extension-gallery#_install-from-a-vsix).

Please note that this package is currently in development and may not work as expected.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

Vitrine library is licensed under the [Apache 2.0 license](https://www.apache.org/licenses/LICENSE-2.0.html).
