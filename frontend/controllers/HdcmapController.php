<?php

namespace frontend\controllers;
use yii\web\Controller;
use app\models\Map;
use Yii;
use yii\data\ArrayDataProvider;

class HdcmapController extends \yii\web\Controller
{
    //public function actionIndex()
   // {
   //     return $this->render('index');
   // }
   
   public function actionIndex() {
    $sql = "SELECT 
	        CONCAT(c.provcode,c.distcode) as areacode
			,a.ampurname
			,COUNT(c.hoscode) as a
			,COUNT(a.hcode) as b
			,round(COUNT(a.hcode)*100/COUNT(c.hoscode),2) as percent
			FROM hdc.chospital c
			LEFT OUTER JOIN (
			SELECT m.hcode
			,m.`timestamp`
			FROM log_map_hosp_cloud m
			GROUP BY m.hcode
			) a on a.hcode=c.hoscode
			LEFT OUTER JOIN hdc.campur a on a.ampurcodefull=CONCAT(c.provcode,c.distcode)
			WHERE provcode='57' AND hostype in('18','05','01','02','07','04','08')
			GROUP BY a.ampurname
			UNION 
            SELECT 
			'' as cc
			,'รวม' as total
			,COUNT(c.hoscode) as a
			,COUNT(a.hcode) as b
			,round(COUNT(a.hcode)*100/COUNT(c.hoscode),2) as percent
			FROM hdc.chospital c
			LEFT OUTER JOIN (
			SELECT m.hcode
			,m.`timestamp`
			FROM log_map_hosp_cloud m
			GROUP BY m.hcode
			) a on a.hcode=c.hoscode
			LEFT OUTER JOIN hdc.campur a on a.ampurcodefull=CONCAT(c.provcode,c.distcode)
			WHERE provcode='57' AND hostype in('18','05','01','02','07','04','08')
			";
        //$rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        //   print_r($rawData) ;
		

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

        $contacts = Map::find()->all();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'contacts'=>$contacts,
               ]               
                );
    }
    public function actionMaps($areacode) {
        $sql = "SELECT 
				c.hoscode
				,c.hosname
				,a.ampurname
				,concat(date_format(a.`timestamp`,'%d'),'/',date_format(a.`timestamp`,'%m'),'/',date_format(a.`timestamp`,'%Y')+543) as d_update
				,if(timestamp is null,'N','Y') as resul
				FROM hdc.chospital c
				LEFT OUTER JOIN (
				SELECT m.hcode
				,m.`timestamp`
				FROM log_map_hosp_cloud m
				GROUP BY m.hcode
				) a on a.hcode=c.hoscode
				LEFT OUTER JOIN hdc.campur a on a.ampurcodefull=CONCAT(c.provcode,c.distcode)
				WHERE a.ampurcodefull=$areacode and provcode='57' AND hostype in('18','05','01','02','07','04','08')
				ORDER BY hoscode";
        // $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        //  print_r($rawData) ;

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $contacts = Map::find()
                  ->where(['areacode' => $areacode])
                  ->all();
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            //'pagination' => FALSE,
        ]);


        return $this->render('maps', [
                    'dataProvider' => $dataProvider,
                     'contacts'=>$contacts,
                  //  'pagination' => [ 'pageSize' => 10 ],
        ]);
    }
}
