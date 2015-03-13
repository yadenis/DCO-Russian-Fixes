# DCO Russian Fixes

DCO Russian Fixes is a Wordpress plugin is intended for:
  - transliteration permanent links
  - transliteration russian names of uploading files
  - correct dates for russian language

# Version
1.0.2

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

#Changelog
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