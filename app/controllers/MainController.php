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
        $title = 'PAGE TITLE';
        $this->setData(compact('title', 'posts', 'menu'));
    }
}