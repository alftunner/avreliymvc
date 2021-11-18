<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Controller;
use R;

/**
 * Базовый класс для наследования остальными контроллерами, для того, чтобы не лезть в контроллер ядра
 */
class AppController extends Controller
{
    public $menu;
    public $meta = [];
    public function __construct($currentRoute)
    {
        parent::__construct($currentRoute);
        new Main();
        $this->menu = R::findAll('category');
    }

    protected function setMeta($title = '', $description = '', $keywords = '') {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}