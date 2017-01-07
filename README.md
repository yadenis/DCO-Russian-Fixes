# DCO Russian Fixes

[Описание плагина на русском языке](http://www.compnot.ru/wordpress/dco-russian-fixes-korrektiruem-russkij-wordpress.html "Страница плагина на русском языке")

DCO Russian Fixes is a Wordpress plugin is intended for:
  - transliteration permanent links
  - transliteration russian names of uploading files
  - correct dates for russian language

# Version
1.0.8

#Usage
The plugin does not require any configuration. After installation and activation will work automatically. The plugin converts only the new permanent links and the names of new uploaded files. **Permanent links and file names created before activating the plugin will not be converted.**

#Settings
 - Transliterate url
 - Transliterate file name
 - Correct dates

#Filters list
##dco_rf_get_options
Filter for hardcoding override plugin settings. *You won't be able to edit them on the settings page anymore when using this filter.*
##dco_rf_symbol_table
Filter for override standard transliterate symbol table
##dco_rf_transliterate
Filter for change transliterate results
##dco_rf_replace_dates_table
Filter for override standard correct dates table
##dco_rf_correct_dates
Filter for change correct dates results
##dco_rf_replace_archive_titles_table
Filter for override standard correct archive titles table
##dco_rf_correct_archive_titles
Filter for change correct archive titles results

#Examples of using filters
##Hardcoding override plugin settings
```php
function custom_get_options( $current, $options, $default ) {
	$array = array(
		'transliterate_url'			 => 1,
		'transliterate_file_name'	 => 1,
		'correct_dates'				 => 1
	);

	return $array;
}

add_filter( 'dco_rf_get_options', 'custom_get_options', 10, 3 );

/*
* $current - current plugin settings
*
* $options - plugin settings from database
*
* $default - default plugin settings
*/
```

##Override standard transliterate symbol table
```php
function custom_transliterate_table( $symbol_table ) {
	$symbol_table = array(
		'А'	 => 'A', 'Б'	 => 'B', 'В'	 => 'V', 'Г'	 => 'G', 'Д'	 => 'D',
		'Е'	 => 'E', 'Ё'	 => 'YO', 'Ж'	 => 'ZH', 'З'	 => 'Z', 'И'	 => 'I',
		'Й'	 => 'Y', 'К'	 => 'K', 'Л'	 => 'L', 'М'	 => 'M', 'Н'	 => 'N',
		'О'	 => 'O', 'П'	 => 'P', 'Р'	 => 'R', 'С'	 => 'S', 'Т'	 => 'T',
		'У'	 => 'U', 'Ф'	 => 'F', 'Х'	 => 'H', 'Ц'	 => 'C', 'Ч'	 => 'CH',
		'Ш'	 => 'SH', 'Щ'	 => 'SHH', 'Ъ'	 => "", 'Ы'	 => 'YI', 'Ь'	 => "",
		'Э'	 => 'E`', 'Ю'	 => 'YU', 'Я'	 => 'YA',
		'а'	 => 'a', 'б'	 => 'b', 'в'	 => 'v', 'г'	 => 'g', 'д'	 => 'd',
		'е'	 => 'e', 'ё'	 => 'yo', 'ж'	 => 'zh', 'з'	 => 'z', 'и'	 => 'i',
		'й'	 => 'y', 'к'	 => 'k', 'л'	 => 'l', 'м'	 => 'm', 'н'	 => 'n',
		'о'	 => 'o', 'п'	 => 'p', 'р'	 => 'r', 'с'	 => 's', 'т'	 => 't',
		'у'	 => 'u', 'ф'	 => 'f', 'х'	 => 'h', 'ц'	 => 'c', 'ч'	 => 'ch',
		'ш'	 => 'sh', 'щ'	 => 'shh', 'ь'	 => "", 'ы'	 => 'yi', 'ъ'	 => "",
		'э'	 => 'e`', 'ю'	 => 'yu', 'я'	 => 'ya'
	);

	return $symbol_table;
}

add_filter( 'dco_rf_symbol_table', 'custom_transliterate_table' );

/*
* $symbol_table - default transliterate table
*/
```

#Changelog
##1.0.8
 - Fixed Text Domain
 - Transliteration title enabled for frontend of site

##1.0.7
 - Corrected localization
 - Updated admin settings page heading to WordPress 4.3 styles
 - Fixed bug with "э" transliteration for upload files
 - Restricted direct access to plugin files

##1.0.6
 - Fixed bug with russian urls

##1.0.5
 - Added support transliteration for frontend

##1.0.4
 - Added additional links for the WP plugin configuration page

##1.0.3
 - Optimized
 - Updated readme
 
##1.0.2
 - Fixed bug with filter for override plugin settings

##1.0.1
 - Corrected settings page

##1.0
 - Rework architecture
 - Add settings
 - Add additional hooks

##0.1.1
- Add filter "dco_symbol_table" for overriding the standard transliteration table

##0.1.0
- Initial Release