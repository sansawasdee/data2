<?php

namespace frontend\controllers;

class CounttbController extends \yii\web\Controller
{
   // public function actionIndex()
    //{
               // return $this->render('index');
  //  }
  


   public function actionIndex() {
        $sql = "SELECT  * FROM t_monitor";
        // $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
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
      public function actionCounttbs($areacode) {
        $sql = "SELECT * from t_monitor_s t WHERE areacode = $areacode 	GROUP BY t.hospcode";
        // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            //'pagination' => FALSE,
        ]);


        return $this->render('counttbs', [
                    'dataProvider' => $dataProvider,
                  //  'pagination' => [ 'pageSize' => 10 ],
        ]);
    }
      public function actionCounttbt($hospcode) {
        $sql = "SELECT * FROM t_monitor_t
	            WHERE hospcode=$hospcode";
        // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
           // 'pagination' => FALSE,
        
        ]);


        return $this->render('counttbt', [
                    'dataProvider' => $dataProvider,
                  
        ]);
    }


        public function actionDontsend() {
        $sql = " SELECT vw.hoscode,vw.hosname,a.ampurname FROM chospital vw
	LEFT OUTER JOIN (
	SELECT HOSPCODE,COUNT(SEQ) as cc FROM service
	WHERE DATE_SERV BETWEEN concat('20180',MONTH(NOW())-1,'01')
                and concat('20180',MONTH(NOW())-1,'31')
	
    GROUP BY HOSPCODE) v ON v.HOSPCODE=vw.hoscode
 	LEFT OUTER JOIN campur a on concat(vw.provcode,vw.distcode)=a.ampurcodefull
	WHERE v.cc is NULL and vw.provcode='57' and  vw.hdc_regist='1'  ";
        // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
         //   'pagination' => FALSE,
        ]);


        return $this->render('dontsend', [
                    'dataProvider' => $dataProvider,
        ]);
    }
}

