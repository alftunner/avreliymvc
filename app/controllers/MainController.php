<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Controller;

class MainController extends AppController
{
    public function indexAction() {
        $model = new Main();
        $res = $model->findLike('помощью', 'post');
        $this->setData(['data' => $res]);
    }
}