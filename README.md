# DCO Russian Fixes

DCO Russian Fixes is a Wordpress plugin is intended for:
  - transliteration of russian permanent links
  - transliteration of russian names of uploading files
  - correct dates for russian language
  - remove unused links from head

# Version
0.1.1

#Usage
The plugin does not require any configuration. After installation and activation will work automatically.
The plugin converts only the new permanent links and the names of uploaded files. **Permanent links and file names created before activating the plugin will not be converted.**

##Override the standard transliteration symbol table
You can override the standard transliteration symbol table with a filter dco_symbol_table
```php
function themename_symbol_table($symbol_table = array()) {	
	return array(
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
		'э'	 => 'e`', 'ю'	 => 'yu', 'я'	 => 'ya');
}

add_filter('dco_symbol_table', 'themename_symbol_table');
```

#Changelog
##0.1.1
- Add filter "dco_symbol_table" for overriding the standard transliteration table

##0.1.0
- Initial Release