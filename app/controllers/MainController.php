<?php

namespace app\controllers;

use R;
use app\models\Main;
use vendor\core\base\Controller;

class MainController extends AppController
{
    public function indexAction() {
        $model = new Main();
        $posts = R::findAll('posts');
        $menu = $this->menu;
        $this->setMeta('Проверочная страница', 'Это описание страницы', 'Это набор ключевых слов страницы');
        $meta = $this->meta;
        $this->setData(compact('meta', 'posts', 'menu'));
    }
}