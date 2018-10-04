<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        // return $this->render('index');
        $sql = "SELECT 
                 FORMAT(SUM(result01+result02+result03+result04+result05+result06+result07+result08+result09+result10+result11+result12),0) as total
                FROM t_monitor   WHERE b_year='2561' AND tb='service'";
        $sql2 = "SELECT 
                 FORMAT(SUM(result01+result02+result03+result04+result05+result06+result07+result08+result09+result10+result11+result12),0) as total
                FROM t_monitor   WHERE b_year='2561' AND tb='admission'";
        $sql3 = "SELECT SQL_BIG_RESULT FORMAT(COUNT(*),0 )as total
                FROM t_person_cid";
        $sql4 = "SELECT c.month_name ,if(total is null,0,total) as total FROM cmonth_send c
                  LEFT OUTER JOIN 
                (SELECT month_send ,COUNT(hoscode) as total  FROM dontsend WHERE month_send>='201710'
                 GROUP BY month_send) d on c.month_send=d.month_send";
        $sql5 = "SELECT ampurname ,COUNT(hoscode) as total FROM dontsend   WHERE month_send>='201710'
                GROUP BY ampurname
                ORDER BY COUNT(hoscode) DESC";
        $sql6 = "SELECT 1 as id ,'ร้อยละของเด็กอายุ 0-5 ปี มีพัฒนาการสมวัย' as kpi,sum(targetq1+targetq2+targetq3+targetq4) as targetq
                ,sum(result1q1+result1q2+result1q3+result1q4+result2q1+result2q2 +result2q3+result2q4) as result
                ,ROUND(sum(result1q1+result1q2+result1q3+result1q4+result2q1+result2q2 +result2q3+result2q4) *100/sum(targetq1+targetq2+targetq3+targetq4) ,2)as percent
                FROM hdc.s_kpi_child_specialpp
                 WHERE b_year=(year(NOW())+543)";
        $sql7 = "SELECT 2 as id,'ร้อยละของเด็กอายุ 12 ปี มีฟันดีไม่มีผุ' as kpi,SUM(target)  as target,SUM(result) as result
                ,ROUND(SUM(result)*100/SUM(target),2) as percent from hdc.s_dental_caries_free
                WHERE b_year=(year(NOW())+543)";
		$sql8 = "SELECT  3 as id ,'ร้อยละควบคุมระดับน้ำตาลได้ดี' as kpi,SUM(target) as target ,SUM(result) as result
                 ,ROUND(SUM(result) *100/SUM(target) ,2) as percent from hdc.s_dm_control 
                 WHERE b_year=(year(NOW())+543)";
        $sql9 = "SELECT 4 as id ,'ร้อยละควบคุมความดันโลหิตได้ดี' as kpi ,SUM(target) as target ,SUM(result) as result
                 ,ROUND(SUM(result) *100/SUM(target) ,2) as percent  FROM hdc.s_ht_control
                 WHERE b_year=(year(NOW())+543)";
        $sql10 = "SELECT 5 as id ,'ร้อยละหญิงตั้งครรภ์ฝากครรภ์ 12 สัปดาห์' as kpi,SUM(target) as target,SUM(result) as result
                 ,ROUND(SUM(result) *100/SUM(target) ,2) as percent  FROM hdc.s_kpi_anc12
                 WHERE b_year=(year(NOW())+543)"; 
        $sql11 = "SELECT 5 as id,'ความครอบคลุมวัคซีน อายุครบ 1 ปี' as kpi,SUM(target) as target,SUM(result) as result
                 ,ROUND(SUM(result) *100/SUM(target) ,2) as percent FROM hdc.s_epi_complete 
                WHERE b_year=(year(NOW())+543)";
        $sql12 = "SELECT * FROM qof_dm62_a WHERE ampurname='รวมจังหวัด'";	
        $sql13 = "SELECT * FROM qof_ht62_a WHERE ampurname='รวมจังหวัด'";	
        $sql14 = "SELECT * FROM qof_anc62_a WHERE ampurname='รวมจังหวัด'";
		$sql15 = "SELECT * FROM qof_pap62_a WHERE ampurname='รวมจังหวัด'";
		$sql16 = "SELECT * FROM qof_asu62_ad_a WHERE ampurname='รวมจังหวัด'";
		$sql17 = "SELECT * FROM qof_asu62_ri_a WHERE ampurname='รวมจังหวัด'";
		$sql18 = "SELECT * FROM qof_dspm62_1_a  WHERE ampurname='รวมจังหวัด'";
		$sql19 = "SELECT * FROM qof_dspm62_2_a  WHERE ampurname='รวมจังหวัด'";
		$sql20 = "SELECT * FROM qof_dspm62_3_a  WHERE ampurname='รวมจังหวัด'";
		$sql21 = "SELECT * FROM qof_ltc62_a  WHERE ampurname='รวมจังหวัด'";
		$sql22 = "SELECT * FROM qof_ltc62_2_a  WHERE ampurname='รวมจังหวัด'";
		$sql23 = "SELECT DATE_FORMAT(p_date,'%d-%m-%Y') as date,TIME(p_date) as time FROM hdc_log
                  WHERE p_name='end_process' AND date(p_date)=CURDATE()";
		$sql25 = "SELECT DATE_FORMAT(d_run,'%d-%m-%Y') as date ,t_run as time FROM sys_log
                  WHERE procedure_name='smoke' AND d_run=CURDATE()";
		
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
            $rawData2 = \Yii::$app->db2->createCommand($sql2)->queryAll();
            $rawData3 = \Yii::$app->db2->createCommand($sql3)->queryAll();
            $rawData4 = \Yii::$app->db2->createCommand($sql4)->queryAll();
            $rawData5 = \Yii::$app->db2->createCommand($sql5)->queryAll();
            $rawData6 = \Yii::$app->db2->createCommand($sql6)->queryAll();
            $rawData7 = \Yii::$app->db2->createCommand($sql7)->queryAll();
			$rawData8 = \Yii::$app->db2->createCommand($sql8)->queryAll();
			$rawData9 = \Yii::$app->db2->createCommand($sql9)->queryAll();
			$rawData10 = \Yii::$app->db2->createCommand($sql10)->queryAll();
			$rawData11 = \Yii::$app->db2->createCommand($sql11)->queryAll();
			$rawData12 = \Yii::$app->db3->createCommand($sql12)->queryAll();
			$rawData13 = \Yii::$app->db3->createCommand($sql13)->queryAll();
			$rawData14 = \Yii::$app->db3->createCommand($sql14)->queryAll();
			$rawData15 = \Yii::$app->db3->createCommand($sql15)->queryAll();
			$rawData16 = \Yii::$app->db3->createCommand($sql16)->queryAll();
			$rawData17 = \Yii::$app->db3->createCommand($sql17)->queryAll();
			$rawData18 = \Yii::$app->db3->createCommand($sql18)->queryAll();
			$rawData19 = \Yii::$app->db3->createCommand($sql19)->queryAll();
			$rawData20 = \Yii::$app->db3->createCommand($sql20)->queryAll();
			$rawData21 = \Yii::$app->db3->createCommand($sql21)->queryAll();
			$rawData22 = \Yii::$app->db3->createCommand($sql22)->queryAll();
			$rawData23 = \Yii::$app->db4->createCommand($sql23)->queryAll();
			$rawData24 = \Yii::$app->db2->createCommand($sql23)->queryAll();
			$rawData25 = \Yii::$app->db3->createCommand($sql25)->queryAll();
			
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
                //'pagination' => [
                //'pagesize' => 20
                //]
        ]);

        $dataProvider2 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData2,
        ]);
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData3,
        ]);

        $dataProvider4 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData4,
        ]);

        $dataProvider5 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData5,
        ]);

        $dataProvider6 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData6,
        ]);

        $dataProvider7 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData7,
        ]);
		
		$dataProvider8 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData8,
        ]);
		
		$dataProvider9 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData9,
        ]);
		
		$dataProvider10 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData10,
        ]);
		
		$dataProvider11 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData11,
        ]);
		
		$dataProvider12 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData12,
        ]);
		
		$dataProvider13 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData13,
        ]);
		
		$dataProvider14 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData14,
        ]);
		
		$dataProvider15 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData15,
        ]);
		
		$dataProvider16 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData16,
        ]);
		
		$dataProvider17 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData17,
        ]);
		
		$dataProvider18 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData18,
        ]);
		
		$dataProvider19 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData19,
        ]);
		
		$dataProvider20 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData20,
        ]);
		
		$dataProvider21 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData21,
        ]);
		
		$dataProvider22 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData22,
        ]);
		
		$dataProvider23 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData23,
        ]);
		
		$dataProvider24 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData24,
        ]);
				
		$dataProvider25 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData25,
        ]);
		




        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'dataProvider2' => $dataProvider2,
                    'rawData2' => $rawData2,
                    'sql2' => $sql2,
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    'dataProvider4' => $dataProvider4,
                    'rawData4' => $rawData4,
                    'sql4' => $sql4,
                    'dataProvider5' => $dataProvider5,
                    'rawData5' => $rawData5,
                    'sql5' => $sql5,
                    'dataProvider6' => $dataProvider6,
                    'dataProvider7' => $dataProvider7,
					'dataProvider8' => $dataProvider8,
					'dataProvider9' => $dataProvider9,
					'dataProvider10' => $dataProvider10,
					'dataProvider11' => $dataProvider11,
					'dataProvider12' => $dataProvider12,
					'dataProvider13' => $dataProvider13,
					'dataProvider14' => $dataProvider14,
					'dataProvider15' => $dataProvider15,
					'dataProvider16' => $dataProvider16,
					'dataProvider17' => $dataProvider17,
					'dataProvider18' => $dataProvider18,
					'dataProvider19' => $dataProvider19,
					'dataProvider20' => $dataProvider20,
					'dataProvider21' => $dataProvider21,
					'dataProvider22' => $dataProvider22,
					'dataProvider23' => $dataProvider23,
					'dataProvider24' => $dataProvider24,
					'dataProvider25' => $dataProvider25,
					
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
