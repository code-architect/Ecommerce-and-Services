<?php

class Catalogue extends Application {

    private $_table = 'categories';
    private $_table_2 = 'products';


    /**
     * Get all the categories
     * @return array
     */
    public function getCategories()
    {
        $sql = "SELECT * FROM `{$this->_table}` ORDER BY `name` ASC";

        return $this->db->fetchAll($sql);
    }

//---------------------------------------------------------------------------------//


    /**
     * Get the Category by id
     * @param $id
     * @return mixed
     */
    public function getCategory($id)
    {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `id` = '".$this->db->escape($id)."'";
        return $this->db->fetchOne($sql);
    }

//---------------------------------------------------------------------------------//


    /**
     * Getting products by category id
     * @param $cat
     */
    public function getProducts($cat)
    {
        $sql = "SELECT * FROM `{$this->_table_2}` WHERE `category` = '".$this->db->escape($cat)."' ORDER BY `date` desc";
        return $this->db->fetchAll($sql);
    }

//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------//
}