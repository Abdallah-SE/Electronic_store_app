<?php
namespace PHPMVC;
use PHPMVC\LIB\Template\Template;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Authentication;



    if(!defined('DS')){
        define('DS', DIRECTORY_SEPARATOR);
    }
    require_once '..'.DS. 'app' .DS. 'config' .DS. 'config.php';
    require_once APP_PATH  .DS.'lib'.DS. 'autoload.php';
           // session_start();
    $_session = new SessionManager();
    $_session->start();
        if(!isset($_session->lang)){
        $_session->lang = DEFAULT_LANGUAGE;
    }
    $template_subset = require_once '..' .DS. 'app' .DS. 'config' .DS. 'templateconfig.php';

    $template = new Template($template_subset);
    
    $messeger = Messenger::getInstance($_session);
    $language = new Language();
    $registry = new Registry();
    
    $registry->language = $language;
    $registry->session = $_session;
    $registry->messeger = $messeger;
    
    $authentication = Authentication::getInstance($_session);
    
    $frontController = new FrontController($template, $registry, $authentication);
    $frontController->dispatch();
