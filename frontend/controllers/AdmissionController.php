<?php

namespace frontend\controllers;

class AdmissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
		$sql = "SELECT t.* ,c.hosname 
                ,(result01+result02+result03+result04+result05+result06+result07+result08+result09+result10+result11+result12) as total
                FROM t_monitor t
                INNER JOIN chospital c on t.hospcode=c.hoscode
                WHERE t.tb='admission' and  b_year='2561'
                ORDER BY t.hospcode";
		try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}
