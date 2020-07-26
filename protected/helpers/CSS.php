<?php

namespace app\helpers;

use Yii;

class CSS
{
    /**
     * @return string
     */
    public static function generateCurrentClass()
    {
        $controller = Yii::$app->controller;
        $idArray = [
            $controller->module->id,
            $controller->id,
            $controller->action->id,
        ];
        return implode('-', $idArray);
    }
}