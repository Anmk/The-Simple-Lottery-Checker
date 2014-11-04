<?php 
/*
 * $Id: init.php, v 1.0
 * The Simple Lottery Checker
 * Copyright (c) 2014 Andrzej Kałowski
 * http://lotek.kalowski.com
 */

define('SITE_PATH',"http://lotek.kalowski.com/");
define('APP_PATH', str_replace('//', '/', str_replace('\\', '/', dirname(__FILE__) . '/')));
define('DIR_CATALOG', '/var/www/lotek.kalowski/');
define('DIR_APP', 'app/');
define('DIR_CTRL', 'controllers/');
define('DIR_CONF', 'config/');
define('DIR_VWS', 'views/');
define('DIR_MOD', 'models/');
define('DIR_PUB', 'public/');
define('DIR_IMAGES', DIR_PUB . 'img/');
define('DIR_CSS', DIR_PUB . 'css/');
define('DIR_LANGUAGES', DIR_CONF . 'languages/');

include(DIR_CONF.'filenames.php');
include(DIR_MOD.'main.php');

$Transfer->setColourAlertTypes(array('greenColour', 'redColour', 'blueColour', 'redColourM'));
session_start();

//languages
include(DIR_LANGUAGES.FILE_POLISH);
//include(DIR_LANGUAGES.FILE_ENGLISH);

