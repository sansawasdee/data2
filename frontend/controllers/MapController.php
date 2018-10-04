<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\Map;
use Yii;
use yii\data\ArrayDataProvider;

class MapController extends \yii\web\Controller {

    public function actionIndex() {
        $contacts = Map::find()->all();
        return $this->render('index',['contacts'=>$contacts]);
    }

}
