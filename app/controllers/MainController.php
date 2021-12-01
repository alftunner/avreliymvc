<?php

namespace app\controllers;

use R;
use app\models\Main;
use vendor\core\App;
use vendor\core\base\Controller;
use vendor\core\Registry;

class MainController extends AppController
{
    public function indexAction() {
        $model = new Main();
        /*$posts = App::$app->cache->get('posts');
        if (!$posts) {
            $posts = R::findAll('posts');
            App::$app->cache->set('posts', $posts);
        }*/
        $posts = R::findAll('posts');
        $menu = $this->menu;
        $this->setMeta('Проверочная страница', 'Это описание страницы', 'Это набор ключевых слов страницы');
        $meta = $this->meta;
        $this->setData(compact('meta', 'posts', 'menu'));
    }

    public function testAction() {
        if ($this->isAjax()) {
            echo 'Hello';
            die();
        }
    }
}