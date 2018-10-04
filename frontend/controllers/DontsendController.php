<?php

namespace frontend\controllers;

class DontsendController extends \yii\web\Controller {

    public function actionIndex() {
        //return $this->render('index');
        $sql = "SELECT ampurname ,COUNT(hoscode) as total FROM dontsend   WHERE month_send>='201710'
                GROUP BY ampurname ORDER BY COUNT(hoscode) DESC";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
                //'pagination' => [
                //'pagesize' => 20
                //]
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }
    public function actionDontsend2($ampurname) {
        //return $this->render('index');
        $sql = "SELECT * FROM dontsend   WHERE month_send>='201710' and ampurname='$ampurname' order by hoscode";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
                //'pagination' => [
                //'pagesize' => 20
                //]
        ]);
        return $this->render('dontsend2', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

}
