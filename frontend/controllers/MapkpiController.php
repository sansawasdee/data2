<?php

namespace frontend\controllers;

class MapkpiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDspm1()
    {
        return $this->render('dspm1');
    }

}
