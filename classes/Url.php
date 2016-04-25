<?php

class Url{

    public static $_page = "page";
    public static $_folder = PAGES_DIR;
    public static $_params = [];

    /**
     * Checking if the url is set or not
     * @param $par The key which we want to return from our url
     * @return null
     */
    public static function getParam($par)
    {
        return isset($_GET[$par]) && $_GET[$par] != "" ? $_GET[$par] : null;
    }


    /**
     * This will return our current page
     */
    public static function cPage()
    {
        // if it not present that mean swe are on the index page, which is our landing page
        return isset($_GET[self::$_page]) ? $_GET[self::$_page] : 'index';
    }


    /**
     * This is out path to pages folder and to our specific files
     */
    public static function getPage()
    {
        $page = self::$_folder.DS.self::cPage().".php";
        $error = self::$_folder.DS."error.php";
        return is_file($page) ? $page : $error;
    }


    /**
     * populates all the parameters and values
     * and puts them into an associative array
     */
    public static function getAll()
    {
        if(!empty($_GET)){
            foreach($_GET as $key => $value)
            {
                if(!empty($value)){
                    self::$_params[$key] = $value;
                }
            }
        }
    }


}