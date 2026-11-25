# AGENTS.md

Vitrine UI is a Laravel package (`area17/vitrine-ui`) of Blade components with matching JS behaviors and Tailwind theme presets. It is consumed by Laravel apps and showcased with Blast (Storybook for Blade) in the sibling repo `vitrine-ui-doc`.

## Stack

- PHP `^8.1` declared, developed and linted on **PHP 8.4**. Keep code valid on 8.1–8.4: no implicit nullable params (`?string $x = null`), no 8.2+ only syntax.
- Laravel Blade anonymous and class components, prefix `vui` (`<x-vui-button>`).
- JS behaviors built on `@area17/a17-behaviors` (`createBehavior`), ESM, no build step in this repo.
- **Tailwind CSS 4** with `@area17/a17-tailwind-plugins` v5. Classes live in JSON presets, merged with `tales-from-a-dev/tailwind-merge-php` (a `TailwindMerge` singleton registered in `VitrineUIServiceProvider`; custom class groups via the `tailwind_merge` key in `config/vitrine-ui.php`).

## Layout

| Path | What |
|---|---|
| `src/Components/` | Component classes (extend `VitrineComponent`); form components in `Form/` |
| `src/VitrineUI.php` | Theme loading and merging, `ui()` class resolver, URL helpers |
| `src/Commands/` | `vitrine-ui:publish` |
| `config/vitrine-ui.php` | Component registry: `components` (with class) and `blade-components` (no class) |
| `resources/manifest.php` | Per alias: package class, view folder, stories folder, assets (js, css, npm, optional). Read by `vitrine-ui:publish`, not published |
| `resources/views/components/` | Blade views, one folder per component |
| `resources/views/stories/` | Blast stories + one `README.md` per component, shared data in `stories/data/` |
| `resources/frontend/scripts/behaviors/` | JS behaviors (`data-behavior="Name"`); `index.js` is the barrel |
| `resources/frontend/scripts/constants/customEvents.js` | All custom event names, never hardcode event strings |
| `resources/frontend/theme/` | `components/*.json` presets (an app adds its global theme with `theme_file`) |
| `resources/frontend/css/` | Component CSS only when Tailwind classes are not enough |
| `resources/frontend/vitrine-ui.css` | Tailwind 4 entry for consumers: `@config`, `@source`, `@theme` resets and tokens |
| `lang/` | `en` and `fr` strings (`vitrine-ui::fe.*`) |

## Commands

```bash
vendor/bin/phpstan analyse            # level 6, must stay at 0 errors
vendor/bin/phpunit                    # tests (composer test), Testbench
vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run --diff
sh tools/linters.sh eslint            # JS
sh tools/linters.sh prettify          # php-cs-fixer + prettier
```

Husky runs `lint-staged` on commit (phpstan, php-cs-fixer, eslint, prettier, conflict markers). The only automated tests cover the `vitrine-ui:publish` command (`tests/`); for components, verify by rendering them (e.g. in `vitrine-ui-doc`, or Orchestra Testbench) and say what you did not check.

## Conventions

- **Theming:** components never hardcode Tailwind classes in views. Get them with `$ui('component', 'key', ['option' => $value])` and add the keys to `resources/frontend/theme/components/<name>.json`. Consumer overrides go through the `ui` prop and the `class` attribute (`$attributes->twMerge(...)`, a macro on `ComponentAttributeBag`).
- **Adding a component:** class in `src/Components/`, view in `resources/views/components/<name>/`, register in `config/vitrine-ui.php`, theme JSON, story + README in `stories/`, JS behavior in `behaviors/` plus `index.js` export if needed, add an entry to `resources/manifest.php` (class, view folder, stories folder, assets); `vendor/bin/phpunit` checks that every declared file exists.
- **JS behaviors:** hook elements with `data-<Behavior>-<child>` attributes, clean up every listener in `destroy()`, dispatch events from `customEvents.js`.
- **Accessibility is a requirement**, not polish: roles, labelled dialogs, focus management, keyboard support, reduced motion. Follow the WAI-ARIA APG pattern cited in each component README.
- **Escaping:** use `{{ }}` by default. `{!! !!}` only for trusted slots and say why.
- **Stories:** every `args` key must be used in the template and have an `argTypes` entry (description, control). Set `status`. Use `x-vui-*` components, not raw markup, and never leave stale references to other projects (`x-organisms.*`, `x-molecules.*`).
- **Blade attribute output:** do not use `@if ($value)` for attributes that can be `0` or `"0"` (`min`, `max`, `step`, `value`); test `!is_null` / `filled`.
- **Tailwind 4:** use v4 utility names (`shrink-0`, `outline-hidden`, `rounded-xs`/`rounded-sm`, `ms-`/`me-`/`start-`/`end-`, `w-cols-N`). A JS `safelist` is ignored; use `@source inline` in the stylesheet. Every token used in a preset (`bg-*`, `border-*`, `f-*`) must exist in the theme. Form controls are transparent by default in v4, so presets set `bg-primary` explicitly.
- **Changelog:** add an entry to `CHANGELOG.md` for user-visible changes (format: version, date, `Added` / `Updated` / `Fixed`). Dates are written `YYYY-DD-MM` (e.g. `2026-23-11` for 23 November 2026), not ISO `YYYY-MM-DD`, to stay consistent with the existing entries.

## Git

- Active line is `4.x` (Tailwind 4, PHP 8.1+); `3.x` is the previous line and the remote's default branch. `vitrine-ui-doc` tracks `4.x-dev`. Check which line a change targets before branching.
- Branch per change, short imperative commit titles prefixed by component (`Modal - fix aria-labelledby`), PRs against the target line.

## Do not

- Edit `vendor/` or published copies in a consuming app.
- Add dependencies for a few lines of code.
- Commit generated logs from `tools/logs` or `tools/tmp`.
