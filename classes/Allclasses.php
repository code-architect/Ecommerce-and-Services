<?php

Class AllClasses
{
    public $objCatalogue;
    public $objBusiness;

    public function __construct()
    {
        $this->objCatalogue = new Catalogue();
        $this->objBusiness = new Business();
    }

}
