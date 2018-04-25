<?php

class Product extends Model {

    private static $sortfield = "name";
    private static $order = 0;

    public static $products = array(
        array(
            'id' => 1,
            'sku' => 't00001',
            'name' => 'Телефон 1',
            'price' => 3050,
            'qty' => 7,
        ),
        array(
            'id' => 2,
            'sku' => 't00002',
            'name' => 'Телефон 2',
            'price' => 5580,
            'qty' => 4,
        ),
        array(
            'id' => 3,
            'sku' => 't00003',
            'name' => 'Телефон 3',
            'price' => 8999,
            'qty' => 3,
        ),
        array(
            'id' => 4,
            'sku' => 't00004',
            'name' => 'Телефон 4',
            'price' => 4800,
            'qty' => 5,
        ),
        array(
            'id' => 5,
            'sku' => 't00005',
            'name' => 'Телефон 5',
            'price' => 5099,
            'qty' => 6,
        ),
    );

    public function getCollection() {
        return self::$products;
    }

    public function mysort($product1,$product2) {
        // TODO
        return 0;
    }

    public function myrsort($product1,$product2) {
        return $this->mysort($product2, $product1);
    }

    public function sortCollection() {
        if (self::$order) {
            usort(self::$products,array($this,"myrsort"));
        } else {
            usort(self::$products,array($this,"mysort"));
        }
    }

    public function setSortfield($params) {
        self::$sortfield = $params[0];
        self::$order = $params[1];
        return $this;
    }

}