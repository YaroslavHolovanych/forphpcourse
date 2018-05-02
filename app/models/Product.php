<?php

class Product extends Model {

    function __construct() {
        $this->table_name = "products";
        $this->id_column = "id";
    }
   
}