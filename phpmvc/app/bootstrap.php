<?php 
include ROOT . '/app/core/model.php';
function myAutoloader($class_name) {   
    include ROOT . '/app/models/' . ucfirst($class_name) . '.php'; 
}
spl_autoload_register("myAutoloader");
include ROOT . '/app/core/controller.php';
include ROOT . '/app/core/helper.php';
include ROOT . '/app/core/route.php';  

Route::Start(); 
