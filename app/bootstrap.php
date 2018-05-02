<?php 
session_start();
include ROOT . '/app/etc/config.php'; 
include ROOT . '/app/core/DB.php';
include ROOT . '/app/core/Model.php';
function myAutoloader($class_name) {
    include ROOT . '/app/models/' . ucfirst($class_name) . '.php';
}
spl_autoload_register("myAutoloader");
include ROOT . '/app/core/Helper.php';
include ROOT . '/app/core/Controller.php';
include ROOT . '/app/core/Route.php';

Route::Start(); 
