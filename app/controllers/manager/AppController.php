<?php

namespace app\controllers\manager;

use vendor\core\base\Controller;

class AppController extends Controller
{
    public $layout = 'manager';

    public function __construct($currentRoute)
    {
        parent::__construct($currentRoute);
    }
}