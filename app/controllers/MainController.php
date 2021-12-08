<?php

namespace app\controllers;

use R;
use app\models\Main;
use vendor\core\App;
use vendor\core\base\Controller;
use vendor\core\base\View;
use vendor\core\Registry;

class MainController extends AppController
{
    public function indexAction() {
        $model = new Main();
        //Пример использования кэширования
        /*$posts = App::$app->cache->get('posts');
        if (!$posts) {
            $posts = R::findAll('posts');
            App::$app->cache->set('posts', $posts);
        }*/
        $posts = R::findAll('posts');
        $menu = $this->menu;
        View::setMeta('Проверка', 'Это проверочные метаданные', 'данные, проверка, метаданные');
        $this->setData(compact('posts', 'menu'));
    }

    public function testAction() {
        if ($this->isAjax()) {
            $model = new Main();
            $post = R::findOne('posts', "id={$_POST['id']}");
            $this->loadView('test', compact('post'));
            die();
        }
    }
}