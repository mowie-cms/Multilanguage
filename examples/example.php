<?php
require_once '../lang.class.php';

$lang = new lang();
$lang->setLangFolder('langs/');
$lang->setLang('lang.es.php', 'es');
$lang->setCurrentLang('de');

echo $lang->get('Home').'<br/>';
echo $lang->get('something').'<br/>';

echo $lang->get('Home is where your wifi connects automatically').'<br/>';//Get Languagestring by Languagestring

$lang->setLang('lang.de_extra.php', 'de');
echo $lang->get('fail');

echo '<pre>';
print_r($lang->getAll());
echo '</pre>';