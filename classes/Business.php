<?php

class Business extends Application {

    private $_table = 'business';


    /**
     * Get the business details from the Business table from the database
     * @return mixed
     */
    public function getBusiness()
    {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `id` = 1";
        return $this->db->fetchOne($sql);
    }

//---------------------------------------------------------------------------------//


    public function getVatRate()
    {

    }

//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//


//------------------------------------End of class---------------------------------//
} 