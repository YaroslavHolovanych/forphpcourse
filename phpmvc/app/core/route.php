<?php

/**
 * Class Route
 */
class Route {

    /**
     * @return mixed|string
     */
    public static function getBP() {
        return self::getBasePath();
    }

    /**
     * @return mixed|string
     */
    public static function getBasePath() {
        $base_path = substr(ROOT, strlen($_SERVER['DOCUMENT_ROOT']));
        if (DS !== '/') {
            $base_path = str_replace(DS,'/', $base_path);
        }
        return $base_path;
    }

    /**
     * @param $uri
     * @return array
     */
    protected static function getRoute($uri) {
         $route = substr($uri, strlen(self::getBasePath()));
         $route_array = explode('/', $route);
         if ($route_array[0] === "") {
              array_shift($route_array);
         }
         if (isset($route_array[0]) && $route_array[0] === 'index.php') {
              array_shift($route_array);
         }
         $controller = !empty($route_array[0]) ? $route_array[0] : 'index';
         $action = !empty($route_array[1]) ? $route_array[1] : 'index';
         return [
             'controller' => $controller,
             'action' => $action
         ];
    }

    /**
     *
     */
    public static function Start() {
           
            // витягуємо маршрут із строки запроса
            $request = explode('?', $_SERVER['REQUEST_URI']);
            $uri = $request[0];
            
            $route = self::getRoute($uri);

            // визначаємо імена класу контролера та методу екшен
            $controller_name = ucfirst($route['controller']) .'Controller';
            $action_name = $route['action'] . 'Action';
            
            if(file_exists(ROOT . '/app/controllers/'.$controller_name.'.php')) {
                include ROOT . '/app/controllers/'.$controller_name.'.php';
            }
            else {
                include ROOT . '/app/controllers/ErrorController.php';
                $controller_name = 'ErrorController';
            }

            $controller = new $controller_name();
            $controller->$action_name();
     }

}
