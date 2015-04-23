=== DCO Russian Fixes ===
Contributors: denisco
Tags: transliteration, russian
Requires at least: 4.1
Tested up to: 4.1.2
Stable tag: 1.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Wordpress russian language fixes.

== Description ==
[Описание плагина на русском языке](http://www.compnot.ru/wordpress/dco-russian-fixes-korrektiruem-russkij-wordpress.html "Страница плагина на русском языке")

[GitHub](https://github.com/Denis-co/DCO-Russian-Fixes "GitHub plugin repository")

DCO Russian Fixes is a Wordpress plugin is intended for:

* transliteration permanent links
* transliteration russian names of uploading files
* correct dates for russian language

= Usage =
The plugin does not require any configuration. After installation and activation will work automatically. The plugin converts only the new permanent links and the names of new uploaded files. **Permanent links and file names created before activating the plugin will not be converted.**

= Settings =
* Transliterate url
* Transliterate file name
* Correct dates

= Filters list =
**dco_rf_get_options**

Filter for hardcoding override plugin settings. You won't be able to edit them on the settings page anymore when using this filter.

**dco_rf_symbol_table**

Filter for override standard transliterate symbol table

**dco_rf_transliterate**

Filter for change transliterate results

**dco_rf_replace_dates_table**

Filter for override standard correct dates table

**dco_rf_correct_dates**

Filter for change correct dates results

**dco_rf_replace_archive_titles_table**

Filter for override standard correct archive titles table

**dco_rf_correct_archive_titles**

Filter for change correct archive titles results

== Installation ==
1. Upload `dco-russian-fixes` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= It is necessary to configure the plugin? =

The plugin does not require any configuration. After installation and activation will work automatically. But you can configure it on the settings page.

= Old links and file names will be changed? =

No. The plugin converts only the new permanent links and the names of new uploaded files. Permanent links and file names created before activating the plugin will not be converted.

== Screenshots ==

1. Settings page

== Changelog ==

= 1.0.4 =
* Add additional links for the WP plugin configuration page

= 1.0.3 =
* Optimized

= 1.0.2 =
* Fixed bug with filter for override plugin settings

= 1.0.1 =
* Corrected settings page

= 1.0 =

* Rework architecture
* Add settings
* Add additional hooks

= 0.1.1 =
* Add filter "dco_symbol_table" for overriding the standard transliteration table

= 0.1.0 =
* Initial Release