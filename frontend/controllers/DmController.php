<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SDmControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\SqlDataProvider;
use yii\db\Expression;

/**
 * DmController implements the CRUD actions for SDmControl model.
 */
 
class ApiController extends ActiveController
{

    public $modelClass = 'app\models\Api';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ];
    }
class DmController extends Controller
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
     * Lists all SDmControl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SDmControl::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SDmControl model.
     * @param string $id
     * @param string $hospcode
     * @param string $areacode
     * @param string $b_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $hospcode, $areacode, $b_year)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $hospcode, $areacode, $b_year),
        ]);
    }

    /**
     * Creates a new SDmControl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SDmControl();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'hospcode' => $model->hospcode, 'areacode' => $model->areacode, 'b_year' => $model->b_year]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SDmControl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $hospcode
     * @param string $areacode
     * @param string $b_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $hospcode, $areacode, $b_year)
    {
        $model = $this->findModel($id, $hospcode, $areacode, $b_year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'hospcode' => $model->hospcode, 'areacode' => $model->areacode, 'b_year' => $model->b_year]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SDmControl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $hospcode
     * @param string $areacode
     * @param string $b_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $hospcode, $areacode, $b_year)
    {
        $this->findModel($id, $hospcode, $areacode, $b_year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SDmControl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $hospcode
     * @param string $areacode
     * @param string $b_year
     * @return SDmControl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $hospcode, $areacode, $b_year)
    {
        if (($model = SDmControl::findOne(['id' => $id, 'hospcode' => $hospcode, 'areacode' => $areacode, 'b_year' => $b_year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
