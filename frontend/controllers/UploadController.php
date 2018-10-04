<?php

namespace frontend\controllers;

class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
$sql = "SELECT a.ampurcodefull as id
       ,a.ampurname as a
            ,COUNT(DISTINCT l.hospcode) as e
           ,COUNT(l.file_name) as c
          FROM tmp_upload_ssj l
         LEFT OUTER JOIN chospital c on c.hoscode=l.hospcode
        LEFT OUTER JOIN campur a on a.ampurcodefull=CONCAT(c.provcode,c.distcode)
          GROUP BY a.ampurcodefull ";
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
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
}
     public function actionUploads($id) {
        $sql = "SELECT 
	 t.hospcode
	,c.hosname
	,t.file_name
	,(t.file_size)/1048576 as file_size
	,t.upload_date_ssj
	,t.upload_cloud
	FROM tmp_upload_ssj t
	LEFT OUTER JOIN chospital c on c.hoscode=t.hospcode
	WHERE CONCAT(c.provcode,c.distcode) ='$id' ";
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
            //'pagination' => FALSE,
        ]);


        return $this->render('uploads', [
                    'dataProvider' => $dataProvider,
                  //  'pagination' => [ 'pageSize' => 10 ],
        ]);
    }


  

}
