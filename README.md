#Mowie Multilanguage

A Class which takes care of deploying your site in multiple languages.

##Usage

```php
$lang = new lang($defaultLanguage);
```

The default language, which will be used if the users language is not found, is english. However, you can change this to any language you want.

```php
$lang->setLangFolder('../langs');
$lang->setLang($langfile, $lang);
$lang->setLang('langfile.en.php', 'en');
```

You can either define multiple languagefiles, which contain the languagestrings, or define a folder, where the different files are placed. If you do a folder, the files need to be named clearly.
For example `lang.en.php`.

The script will find the file and use it.

You can also define multiple langfiles to get the strings of (see example.php).

To output a string, simply use the following command:
```php
$lang->get($identifier);
$lang->get('Home');
```
Where `$identifier` is the Key _**OR**_ the value defined in the default's langfile.

###Change the displayed language

You can change the displayed language to one the user selects. To do this, use this command:

```php
$lang->setCurrentLang($lang);
```

##Reserved Identifiers

The two idetifiers `__Lang__` and `__Countrycode__` are reserved identifiers and used by the script to output a list of all available languages to the user.

##Langfile

A languagefile consists of the following code:

```php
$lang = [];
$lang['__Lang__'] = 'English (English)';
$lang['__Countrycode__'] = 'en_US';

$lang['Home'] = 'Home is where your wifi connects automatically';
$lang['About'] = 'About us';
$lang['Contact'] = 'Contact us';
...
```

**NOTE:** To make sure all your languages are displayed correctly, set the file encoding to `UTF-8`.

##Examples

Examples can be found in the `examples` folder.