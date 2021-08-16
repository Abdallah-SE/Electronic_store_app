<?php
namespace PHPMVC;
namespace PHPMVC\LIB;
   if(!defined('DS')){
            define('DS', DIRECTORY_SEPARATOR);
        }
define('APP', 'app');
define('APP_PATH', realpath(dirname(__FILE__)) . DS . ".." .DS);
define('VIEWS_PATH', dirname(__FILE__, 2).DS. 'views' );
define('TEMPLATE_PATH', dirname(__FILE__, 2).DS. 'template'. DS);
define('LANGUAGE_PATH', dirname(__FILE__, 2).DS. 'languages'. DS);

define('CSS', '/css/');
define('JS', '/js/');

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define ('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'storedb');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);
//lamguages
defined('DEFAULT_LANGUAGE')     ? null : define ('DEFAULT_LANGUAGE', 'ar');

//for sessionmanger class
defined('SESSION_NAME_PATH') ? null : define ('SESSION_NAME_PATH', dirname(realpath(__FILE__)) .DS.'..' .DS. '..' .DS. 'sessions');

// salt for password crypt
defined('MIXTURECHARS_SALT')     ? null : define ('MIXTURECHARS_SALT', '$2a$07$yeNCSNwRpYopOhv0TrrReP$');

defined('OPEN_LOCK_PRIVILEGES')     ? null : define ('OPEN_LOCK_PRIVILEGES', 0);
// uploaded files cons URL position where it's been saving
defined('UPLOAD_MEMORY') ? null : define ('UPLOAD_MEMORY', dirname(realpath(__FILE__)) .DS.'..' .DS. '..' .DS. 'public' .DS. 'uploads');
defined('UPLOAD_MEMORY_IMG') ? null : define ('UPLOAD_MEMORY_IMG', UPLOAD_MEMORY .DS. 'img');
defined('UPLOAD_MEMORY_DOC') ? null : define ('UPLOAD_MEMORY_DOC', UPLOAD_MEMORY .DS. 'doc');
defined('UPLOAD_FILE_SIZE_ALLOWED') ? null : define ('UPLOAD_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));