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
require_once(CORE_PATH.DS.'booking.php');
require_once(CORE_PATH.DS.'BusinessInsight.php');
require_once(CORE_PATH.DS.'DailySpecials.php');
require_once(CORE_PATH.DS.'discounts.php');
require_once(CORE_PATH.DS.'eventFeedback.php');
require_once(CORE_PATH.DS.'eventManagement.php');
require_once(CORE_PATH.DS.'loyaltyProgram.php');
require_once(CORE_PATH.DS.'food.php');
require_once(CORE_PATH.DS.'drinks.php');
require_once(CORE_PATH.DS.'appOrders.php');
require_once(CORE_PATH.DS.'orderManagement.php');
require_once(CORE_PATH.DS.'orders.php');
require_once(CORE_PATH.DS.'recipes.php');
require_once(CORE_PATH.DS.'Reviews.php');
require_once(CORE_PATH.DS.'specialOffers.php');
require_once(CORE_PATH.DS.'staffmanagement.php');
require_once(CORE_PATH.DS.'userPreferances.php');

