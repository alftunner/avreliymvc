<?php

/**
 * класс для построения маршрутов
 */
class Router
{

    /**
     * таблица маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     * Текущий маршрут, который отрабатывает в данный момент
     * @var array
     */
    protected static $currentRoute = [];

    /**
     * Добавляет маршрут в таблицу маршрутов
     * @param $regexp - регулярное выражение маршрута
     * @param array $route - маршрут [controller, action, param]
     */
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    /**
     * Возвращает таблицу маршрутов
     * @return array
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * Возвращает текущий маршрут
     * @return array
     */
    public static function getCurrentRoute() {
        return self::$currentRoute;
    }

    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return bool
     */
    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$currentRoute = $route;
                showMeArr(self::$currentRoute);
                return true;
            }
        }
        return false;
    }


    /**
     * перенаправляет url по корректному маршруту
     * @param string $url входящий url
     */
    public static function dispatch($url) {
        if (self::matchRoute($url)) {
            $controller = self::upperCamelCase(self::$currentRoute['controller']);
            if(class_exists($controller)) {
                echo 'OK';
            } else {
                echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404); //Код ошибки выводит в консоль
            include '404.html';
        }
    }


    /**
     * Принимает название контролера из url (controller-name) и приводит его к виду (ControllerName)
     * @param $name
     */
    protected static function upperCamelCase($name) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
}