<?php

class Helper {

    public static function getMenu()
    {
        $menu = [
            [
                'path' => '/product/list',
                'name' => 'Products'
            ],
            [
                'path' => '/index/test',
                'name' => 'Test 1'
            ],
            [
                'path' => '/test/test2',
                'name' => 'Test 2'
            ],
            [
                'path' => '/test/test3',
                'name' => 'Test 3'
            ],

        ];
        return $menu;

    }
    
    public static function simpleLink($path, $name, $params = []) {
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach($params as $key=>$value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return '<a href="' . route::getBP() . $path .'">' .$name . '</a>';
    }

}