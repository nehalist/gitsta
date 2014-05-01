Version 1.0.5
------
* Fixed syntax error `content.php` and `content-single.php`

Version 1.0.4
------
* Removed author url from comment form
* Added `global $content_width`

Version 1.0.3
------
* Posts without title now have a permalink on their post date
* Tags and comments swapped positions
* Added changelog to repository
* Replaced minified css and js files with "full" files
* Fixed `max-width` of `div`-containers within post content
* Added filter for bootstrap tables
* Added color to caption texts
* Fixed body top padding when navbar gets too high
* Changed CSS classes for reply and edit comment links
* Sidebar is now no longer fixed if it's higher than the window
* Revised pingback style
* Fixed a bug with the `$aria_req` var in comments form
* All theme setup is now placed within `after_setup_theme`-actions
* Changed `$content_width` to 945
* Added `theme_location`, `fallback_cb` and `menu` to `wp_nav_menu()`-args
* Require JS is now included via `wp_enqueue_script()`
* Re-added blog name to copyright in footer
* Removed (dead) link from gravatar in comments area
* Comment reply js works properly now
* Added prefixes to theme constants, classes, variables and options

Version 1.0.2
------
* Changed Theme URI
* Added tags to `style.css`
* Added CSS classes required by WordPress
* Fixed CSS for code tags
* Changed declaration of `Bootstrap_Walker_Nav_Menu::start_lvl()` to be compatible with `Walker::start_lvl()`
* Removed hard-coded styles and scripts, enqueued them via `wp_enqueue_style()` and `wp_enqueue_script()`
* Removed user level call (deprecated)
* Removed PHP short tags
* Enqueued comment reply script
* Added `$content_width` to `functions.php`
* Added `wp_link_pages()`

Version 1.0.1
------
* Minor bug fixes

Version 1.0.0
------
* Release