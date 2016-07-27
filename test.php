<?php
require 'lang.class.php';

$lang = new lang();
$lang->setLangFolder('examples/langs/');
$lang->setLang('examples/lang.es.php', 'es');
$lang->setCurrentLang('de');

echo $lang->get('Home').'<br/>';
echo $lang->get('something').'<br/>';

echo $lang->get('Home is where your wifi connects automatically').'<br/>';//Get Languagestring by Languagestring

$lang->setLang('examples/lang.de_extra.php', 'de');
echo $lang->get('fail');

$lang->set('Test in english', 'test', 'en');
$lang->set('Test auf Deutsch', 'test', 'de');
echo $lang->get('test');
?>