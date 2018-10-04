<?php

namespace frontend\controllers;

class RduController extends \yii\web\Controller {

    public function actionIndex() {
        $sql = "SELECT * FROM rdu";
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

    public function actionRdu19() {
        $sql = "SELECT * FROM rdu19";
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


        return $this->render('rdu19', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRdu19s($ampurcodefull) {
     $sql = "SELECT * FROM rdu19s
    WHERE ampurcodefull=$ampurcodefull
     ";
    // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
    //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
                //'pagination' => FALSE,
        ]);


        return $this->render('rdu19s', [
                    'dataProvider' => $dataProvider,
                        //  'pagination' => [ 'pageSize' => 10 ],
        ]);
    }
     public function actionRdu20s($ampurcodefull) {
     $sql = "SELECT * FROM rdu20s
    WHERE ampurcodefull=$ampurcodefull
     ";
    // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
    //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
                //'pagination' => FALSE,
        ]);


        return $this->render('rdu20s', [
                    'dataProvider' => $dataProvider,
                        //  'pagination' => [ 'pageSize' => 10 ],
        ]);
    }
    public function actionRdu20() {
        $sql = "SELECT * FROM rdu20";
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


        return $this->render('rdu20', [
                    'dataProvider' => $dataProvider,
        ]);
    }
    

}
