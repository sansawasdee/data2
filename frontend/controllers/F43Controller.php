<?php

namespace frontend\controllers;

use Yii;
use frontend\models\F43;
use frontend\models\F43Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * F43Controller implements the CRUD actions for F43 model.
 */
class F43Controller extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all F43 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new F43Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 public function actionIndex2() {
        $sql = "SELECT * FROM 
(SELECT
       areacode		
			,ampurname
			,COUNT(hoscode) as total
			,SUM(if(v23='Y',1,0)) as v23
			,ROUND(SUM(if(v23='Y',1,0))/COUNT(hoscode) *100,2) as  percent
			FROM
		   (
			SELECT 
			c.hoscode
			,c.hosname 
			,a.ampurname 
			,CONCAT(c.provcode,c.distcode) as areacode
			,IF(f.HOSPCODE is not null ,'Y','N') as v23
			FROM  hdc.chospital c
			LEFT OUTER JOIN f43v23 f on  f.HOSPCODE=c.hoscode
			INNER JOIN hdc.campur_57 a on CONCAT(c.provcode,c.distcode)=a.ampurcodefull
			where c.hdc_regist='1' and c.provcode='57'
			) ampur
			GROUP BY ampurname
			 UNION
		SELECT 
		'' as areacode	
		,'รวมจังหวัด' as ampurname
		,COUNT(hoscode) as total 
		,COUNT(f.HOSPCODE) as v23
		,ROUND(COUNT(f.HOSPCODE)/COUNT(hoscode)*100,2) as percent
		FROM hdc.chospital c
		LEFT OUTER JOIN f43v23 f on f.HOSPCODE=c.hoscode
		WHERE c.hdc_regist='1' and c.provcode='57' ) a
		ORDER BY areacode ";
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
            'pagination' => FALSE,
        ]);


        return $this->render('index2', [
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionV23($areacode) {
        $sql = "SELECT 
				c.hoscode
				,c.hosname 
				,a.ampurname 
				,IF(f.HOSPCODE is not null ,'Y','N') as v23
				FROM  hdc.chospital c
				LEFT OUTER JOIN f43v23 f on  f.HOSPCODE=c.hoscode
				INNER JOIN hdc.campur_57 a on CONCAT(c.provcode,c.distcode)=a.ampurcodefull
				where c.hdc_regist='1' and c.provcode='57' and CONCAT(c.provcode,c.distcode)= $areacode
				ORDER BY hoscode ASC ";
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
            'pagination' => FALSE,
        ]);


        return $this->render('v23', [
                    'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single F43 model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new F43 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new F43();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->HOSPCODE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing F43 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->HOSPCODE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing F43 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the F43 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return F43 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = F43::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
