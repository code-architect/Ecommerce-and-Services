<?php

//checking session is open or not
if(!isset($_SESSION)){
    session_start();
    ob_start();
}


// Directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);

// site domain name with http
defined("SITE_URL") || define("SITE_URL", "http://".$_SERVER['SERVER_NAME'].DS."sand_box".DS."ecommerce_and_services");

// Root Path
defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__FILE__).DS."..".DS));

// Classes Folder
defined("CLASSES_DIR") || define("CLASSES_DIR", "classes");

// Pages Folder
defined("PAGES_DIR") || define("PAGES_DIR", "pages");

// Modules Folder
defined("MOD_DIR") || define("MOD_DIR", "mod");

// inc Folder
defined("INC_DIR") || define("INC_DIR", "inc");

// templates Folder
defined("TEMPLATE_DIR") || define("TEMPLATE_DIR", "template");

// emails path
defined("EMAILS_PATH") || define("EMAILS_PATH", ROOT_PATH.DS."emails");

// catalogue  images path
defined("CATALOGUE_PATH") || define("CATALOGUE_PATH", ROOT_PATH.DS."media".DS."catalogue");

// adding directories into include path
set_include_path(implode(PATH_SEPARATOR,
                [
                    realpath(ROOT_PATH.DS.CLASSES_DIR),
                    realpath(ROOT_PATH.DS.PAGES_DIR),
                    realpath(ROOT_PATH.DS.MOD_DIR),
                    realpath(ROOT_PATH.DS.INC_DIR),
                    realpath(ROOT_PATH.DS.TEMPLATE_DIR),
                    get_include_path()
                ]));