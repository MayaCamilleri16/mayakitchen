<?php
//to set up the api itself

//function
//directoryseperater
//null- if it true ma tbiddel xejn
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//define gives true or false
// the :' means li hekk ma jamilx ta ? jamel ta :
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'MAYAKITCHEN');

defined('INC_PATH')? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('CORE_PATH')? null : define('CORE_PATH', SITE_ROOT.DS.'core');

require_once(INC_PATH.DS.'config.php');
require_once(CORE_PATH.DS.'user.php');
