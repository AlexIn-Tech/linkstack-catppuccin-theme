# Catppuccin — A LinkStack Theme
Find more themes: https://github.com/JulianPrieber/llc-themes

*	Theme Name: Catppuccin
*	Theme Version: 1.0
*	Theme Date: 2026-09-19
*	Theme Author: AlexIn-Tech
*	Theme Author URI: https://github.com/AlexIn-Tech
*	Theme License: GPLv3
*	Source code: https://github.com/AlexIn-Tech/linkstack-catppuccin-theme

A [Catppuccin](https://catppuccin.com) theme for LinkStack, following the
[Catppuccin style guide](https://github.com/catppuccin/catppuccin/blob/main/docs/style-guide.md).

### Features
* All four flavors: **Latte**, **Frappé**, **Macchiato** and **Mocha**.
* By default the flavor follows the visitor's system setting (`prefers-color-scheme`): Latte for light, Mocha for dark.
* A small palette button (bottom left) lets visitors pick a flavor and one of the 14 accent colors. The choice is remembered in the visitor's browser. This needs `enable_custom_code` (enabled in `config.php`).
* Brand buttons (GitHub, Twitter, Instagram, ...) use the brand's real color mapped to the nearest Catppuccin color, so they follow the selected flavor.
* Button icons are recolored per flavor (custom icons in `extra/custom-icons`).
* Users without an avatar get the Catppuccin logo instead of LinkStack's stock logo. An uploaded avatar always wins.

Note: the switcher needs `ALLOW_CUSTOM_CODE_IN_THEMES=true` on the LinkStack server. Without it the theme still works (colors, icons, default avatar); only the flavor/accent picker is unavailable.

### Customizing
* Everything is driven by `--ctp-*` CSS variables at the top of `skeleton-auto.css`.
* To fix a flavor or accent without the switcher, set `data-flavor="latte|frappe|macchiato|mocha"` and/or `data-accent="mauve|pink|..."` on `<html>`.
* To remove the switcher, set `'enable_custom_code' => 'false'` in `config.php`.

### Used assets:
* Catppuccin palette: https://github.com/catppuccin/catppuccin
* License: MIT
* Built using:
* https://github.com/dhg/Skeleton
* License: MIT
* Based on the LinkStack default theme: https://github.com/LinkStackOrg/linkstack-default-theme
* Button icons: LinkStack / LittleLink Custom icons (recolored), with Notion, Misskey and Apple Podcasts from Simple Icons (CC0): https://simpleicons.org
* Default avatar: Catppuccin logo, https://github.com/catppuccin/catppuccin (MIT)
