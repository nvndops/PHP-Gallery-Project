<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('ROOT_PATH') ? null : define('ROOT_PATH', 'C:' . DS . 'Users' . DS . 'cooln' . DS . 'Desktop' . DS . 'GitHub' . DS . 'Gallery');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', ROOT_PATH . DS . 'admin' . DS . 'includes');


require_once("functions.php");
require_once("new_config.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php");


?>