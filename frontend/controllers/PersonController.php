<?php

namespace frontend\controllers;

class PersonController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sql = "SELECT * FROM person_data";
        //$rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData) ;


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPerson2($distcode)
    {
        $sql = "SELECT * FROM person_data2 WHERE ampurcodefull=$distcode";
        //$rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData) ;


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('person2', [
                    'dataProvider' => $dataProvider,
        ]);
    }
	

}
