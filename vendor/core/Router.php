<?php

class Router
{
    protected static $routes = []; // Массив со всеми маршрутами
    protected static $currentRoute = []; // Текущий маршрут, который отрабатывает в данный момент

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getCurrentRoute() {
        return self::$currentRoute;
    }

    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if ($url == $pattern) {
                self::$currentRoute = $route;
                return true;
            }
        }
        return false;
    }
}