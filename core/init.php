<?php
  defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
  defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'wamp64'.DS.'www'.DS.'ekasline-backend');

  //wamp64/www/ekasline-backend/include
  defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'include');
  defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

  //load the config file first
  require_once(INC_PATH.DS."config.php");

  //core classes
  require_once(CORE_PATH.DS."products.php");
  require_once(CORE_PATH.DS."orders.php");
  require_once(CORE_PATH.DS."addresses.php");
  require_once(CORE_PATH.DS."users.php");
  require_once(CORE_PATH.DS."counties.php");
  require_once(CORE_PATH.DS."categorie.php");
  require_once(CORE_PATH.DS."sub-categories.php");

?>