<?php

namespace frontend\controllers;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
		$sql = "SELECT 
				a.ampurcodefull as areacode
				,a.ampurname
				,COUNT(DISTINCT c.hoscode) as a
				,SUM(IF(h.address_en is null or h.contactperson_firstname is null 
				or contactperson_lastname is null 
				or contactperson_phoneno is NULL 
				or h.OrganizationName_en,0,1)) as b
			   ,ROUND(SUM(IF(h.address_en is null or h.contactperson_firstname is null 
				or contactperson_lastname is null 
				or contactperson_phoneno is NULL 
				or h.OrganizationName_en,0,1))*100/COUNT(c.hoscode) ,2) as p
				FROM chospital_57 c
				LEFT OUTER JOIN  (SELECT * FROM hospital_profile GROUP BY hoscode) h on c.hoscode=h.hoscode
				LEFT OUTER JOIN campur a on a.ampurcodefull=CONCAT(c.provcode,c.distcode)
				WHERE c.provcode='57' and   c.hostype in('18','05','01','02','07','04','08')
				GROUP BY a.ampurcode";
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


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                  //  'pagination' => [ 'pageSize' => 10 ],
        ]);
				
	}
	
	public function actionProfile($areacode)
    {
        //return $this->render('index');
		$sql = "SELECT c.hoscode
               ,c.hosname
				,h.OrganizationName_en
				,h.address_en
				,CONCAT(h.contactperson_firstname,'  ',h.contactperson_lastname) as contactperson
				,IF(h.address_en is null or h.contactperson_firstname is null 
				or contactperson_lastname is null 
				or contactperson_phoneno is NULL 
				or h.OrganizationName_en,'N','Y') as r
				FROM chospital_57 c
				LEFT OUTER JOIN hospital_profile h on c.hoscode=h.hoscode				
				WHERE c.provcode='57' and   c.hostype in('18','05','01','02','07','04','08')
				and CONCAT(c.provcode,c.distcode)= $areacode
				GROUP BY c.hoscode" ;
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


        return $this->render('profile', [
                    'dataProvider' => $dataProvider,
                  //  'pagination' => [ 'pageSize' => 10 ],
        ]);
				
	}
	
}
