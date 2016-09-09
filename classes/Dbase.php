<?php

/**
 * Class Dbase
 * Associated with database connection and methods
 */
class Dbase {

    // Database connection info
    private $_host = "localhost";
    private $_user = "root";
    private $_password = "";
    private $_name = "obj_ecommerce"; // Yes. I couldn't find a better name. happy!

    // the names are pretty self-explanatory
    private $_conndb = false;
    public $_last_query = null;
    public $_affected_rows = 0;

    public $_insert_keys = [];
    public $_insert_values = [];
    public $_update_sets = [];

    public $_id;





    public function __construct()
    {
        $this->connect();
    }


//--------------------------------------------------------------------------------------------------//


    /**
     * Connect the database
     */
    private function connect()
    {
        $this->_conndb = mysqli_connect($this->_host, $this->_user, $this->_password);

        if(!$this->_conndb)
        {
            die("Database Connection Failed:<br/ >".mysqli_connect_error());
        }
        else
        {
            $_select = mysqli_select_db($this->_conndb,$this->_name);
            if(!$_select)
            {
                die("Database Selection Failed:<br/ >".mysqli_error($this->_conndb));
            }
        }
        mysqli_set_charset($this->_conndb,"Utf8");
    }


//--------------------------------------------------------------------------------------------------//


    /**
     * Closing mysqli connection
     */
    public function close()
    {
        if(!mysqli_close($this->_conndb))
        {
            die("Clossing Connection Failed! <br/>".mysqli_error($this->_conndb));
        }
    }


//--------------------------------------------------------------------------------------------------//


    /**
     * Clean given string
     * @param $value
     * @return string
     */
    public function escape($value)
    {
        // check if php is above 4.0
        if(function_exists(" mysqli_real_escape_string"))
        {
            if(get_magic_quotes_gpc())
            {
                $value = stripcslashes($value);
            }
            $value = mysqli_real_escape_string($this->_conndb, $value);
        }else
        {
            if(!get_magic_quotes_gpc())
            {
                $value = addslashes($value);
            }
        }
        return $value;

    }


//--------------------------------------------------------------------------------------------------//


    /**
     * Mysqli query
     * @param $sql
     * @return bool|mysqli_result1
     */
    public function query($sql)
    {
        $this->_last_query = $sql;
        $result = mysqli_query($this->_conndb, $sql);
        $this->displayQuery($result);
        return $result;

    }

//--------------------------------------------------------------------------------------------------//


    /**
     * Check if mysqli query was successful or not
     * if not show error, else store number affected rows
     * @param $result
     */
    public function displayQuery($result)
    {
        if(!$result)
        {
            $output = "Database Query Failed: ".mysqli_error($this->_conndb)."<br/>";
            $output .= "Last SQL Query was: ".$this->_last_query;
            die($output);
        }
        else
        {
            $this->_affected_rows = mysqli_affected_rows($this->_conndb);
        }
    }

//--------------------------------------------------------------------------------------------------//


    /**
     * Find all data
     * @param $sql
     * @return array
     */
    public function fetchAll($sql)
    {
        $result  = $this->query($sql);
        $out = [];
        while($row = mysqli_fetch_assoc($result))
        {
            $out[] = $row;
        }
        mysqli_free_result($result);
        return $out;
    }


//--------------------------------------------------------------------------------------------------//


    /**
     * Fetch only one record
     * @param $sql
     * @return mixed
     */
    public function fetchOne($sql)
    {
        $out = $this->fetchAll($sql);
        return array_shift($out);
    }

//--------------------------------------------------------------------------------------------------//


    /**
     * Return last inserted id
     * @return int|string
     */
    public function lastId()
    {
        return mysqli_insert_id($this->_conndb);
    }


//--------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------//
}