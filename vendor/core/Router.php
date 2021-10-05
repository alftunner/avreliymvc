<?php

namespace vendor\core;

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
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$currentRoute = $route;
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
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\\controllers\\' . self::$currentRoute['controller'];
            if(class_exists($controller)) {
                $controllerObj = new $controller(self::$currentRoute);
                $action = self::lowerCamelCase(self::$currentRoute['action']) . 'Action';
                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    echo "Метод <b>$controller::$action()</b> не найден";
                }
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
     * @param string $name
     */
    protected static function upperCamelCase($name) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * Принимает название action (action-name) и приводит его к виду (actionName)
     * @param string $name
     */
    protected static function lowerCamelCase($name) {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
    }

    /**
     * метод для отсечения от url явных Get параметров
     * @param $url
     */
    protected static function removeQueryString($url) {
        if ($url) {
            $params = explode('&', $url, 2);
            if (strpos($params[0], '=') === false) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}