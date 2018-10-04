<?php

namespace frontend\controllers;

class IsController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }
    public function actionSummary() {
        //return $this->render('summary');
		
		$sql = "SELECT * FROM summary_is";
				//$rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
				//print_r($rawData) ;
		$sql2 ="SELECT finish FROM is_log";
		 try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
			$rawData2 = \Yii::$app->db2->createCommand($sql2)->queryAll();
			
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		 $dataProvider2 = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData2,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('summary', [
                    'dataProvider' => $dataProvider,
					'dataProvider2' => $dataProvider2,
        ]);
		
    }
	 public function actionCause1($date1 = null, $date2 = null, $hoscode =null) {
        //return $this->render('summary');
		$sql4 = "SELECT finish FROM is_log";
		
		if(!empty($date1) && !empty($date2) && empty($hoscode)){
		$sql = "SELECT INJT
				,i.injt_name
				,COUNT(*) as total
				,SUM(if(injp='2',1,0)) as driver
				,SUM(if(injp='3',1,0)) as passenger
				,SUM(if(injp='N',1,0)) as N
				FROM is_cause1 c
				LEFT OUTER JOIN is_injt i on i.injt_id=c.injt
				WHERE INJT is not NULL and ADATE between '$date1' and '$date2'
				GROUP BY INJT";
				
		$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2'" ;
		$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_cause1
                WHERE ADATE between '$date1' and '$date2'				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2'" ;
		} elseif(!empty($date1) && !empty($date2) && !empty($hoscode)){ 
		      $sql = "SELECT INJT
				,i.injt_name
				,COUNT(*) as total
				,SUM(if(injp='2',1,0)) as driver
				,SUM(if(injp='3',1,0)) as passenger
				,SUM(if(injp='N',1,0)) as N
				FROM is_cause1 c
				LEFT OUTER JOIN is_injt i on i.injt_id=c.injt
				WHERE INJT is not NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				GROUP BY INJT";
				
		       $sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode'" ;
				
				$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_cause1
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_cause1
                WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_cause1	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'" ;
				
		   } elseif(empty($date1) && empty($date2) && !empty($hoscode)){ 
		        $sql = "SELECT INJT
				,i.injt_name
				,COUNT(*) as total
				,SUM(if(injp='2',1,0)) as driver
				,SUM(if(injp='3',1,0)) as passenger
				,SUM(if(injp='N',1,0)) as N
				FROM is_cause1 c
				LEFT OUTER JOIN is_injt i on i.injt_id=c.injt
				WHERE INJT is not NULL  and hosp='$hoscode'
				GROUP BY INJT";
				
		       $sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL  and hosp='$hoscode'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_cause1
				WHERE SEX is NOT NULL and hosp='$hoscode'" ;
				
				$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_cause1	
				WHERE hosp='$hoscode'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_cause1	
				WHERE hosp='$hoscode'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_cause1
				WHERE hosp='$hoscode'				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_cause1
				WHERE  hosp='$hoscode'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_cause1	
				WHERE hosp='$hoscode'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_cause1	
				WHERE  hosp='$hoscode'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_cause1	
				WHERE hosp='$hoscode'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_cause1
                WHERE hosp='$hoscode'				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_cause1	
				WHERE hosp='$hoscode'" ;
		
		   } else {	$sql = "SELECT INJT
				,i.injt_name
				,COUNT(*) as total
				,SUM(if(injp='2',1,0)) as driver
				,SUM(if(injp='3',1,0)) as passenger
				,SUM(if(injp='N',1,0)) as N
				FROM is_cause1 c
				LEFT OUTER JOIN is_injt i on i.injt_id=c.injt
				WHERE INJT is not NULL 
				GROUP BY INJT";
			$sql2 = "SELECT 'ชาย' as name
				,ROUND(SUM(IF(SEX='1',1,0)) *100/COUNT(*),2) as y
				FROM is_cause1
				WHERE SEX is NOT NULL 
				UNION
				SELECT 
				'หญิง' as name
				,CAST(SUM(IF(SEX='2',1,0)) *100/COUNT(*) as DECIMAL) as y
				FROM is_cause1
				WHERE SEX is NOT NULL" ;
			$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_cause1
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_cause1	
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_cause1
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_cause1	
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_cause1			
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_cause1
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_cause1				
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_cause1	
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_cause1		
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_cause1	" ;
		}
				//$rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
				//print_r($rawData) ;
		 try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
			$rawData2 = \Yii::$app->db2->createCommand($sql2)->queryAll();
			$rawData3 = \Yii::$app->db2->createCommand($sql3)->queryAll();
			$rawData4 = \Yii::$app->db2->createCommand($sql4)->queryAll();
			
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
        
		$dataProvider2 = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData2,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
        
		$dataProvider3 = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData3,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider4 = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData4,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);		
		
        return $this->render('cause1', [
                    'dataProvider' => $dataProvider,
					'dataProvider2' => $dataProvider2,
					'dataProvider3' => $dataProvider3,
					'dataProvider4' => $dataProvider4,
					'date1' => $date1,
                    'date2' => $date2,
					'hoscode' => $hoscode,
        ]);
		
    }
	
    public function actionC19($date1 = null, $date2 = null , $hoscode = null) {
        
        //return $this->render('c19');
        
			$sql4="SELECT finish FROM is_log";
         
        if (empty($date1) && empty($hoscode)) {
            $sql = "SELECT  '01' as group_id
					,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE CAUSE='1' 
					UNION
					SELECT  '02' as group_id
					,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
					,COUNT(*) as total
                    ,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit					
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w00' and 'w19' 
					UNION
					SELECT  '03' as group_id
					,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w20' and 'w49' 
					UNION
					SELECT  '04' as group_id
					,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w50' and 'w64' 
					UNION
					SELECT  '05' as group_id
					,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w65' and 'w74' 
					UNION
					SELECT  '06' as group_id
					,'คุกคามการหายใจ (W75-W84)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w75' and 'w84' 
					UNION
					SELECT  '07' as group_id
					,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w85' and 'w99' 
					UNION
					SELECT  '08' as group_id
					,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x00' and 'x09' 
					UNION
					SELECT  '09' as group_id
					,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
				    ,SUM(IF(STAER='6',1,0)) as dead_er
				   ,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x10' and 'x19' 

                    UNION
                    SELECT  '10' as group_id
				         ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x20' and 'x29' 
    
					UNION
					SELECT  '11' as group_id
					,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x30' and 'x39' 

					UNION
					SELECT  '12' as group_id
					,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x40' and 'x49' 

					UNION
					SELECT  '13' as group_id
					,'การออกแรงเกิน (X50-X57)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x50' and 'x57' 

					UNION
					SELECT  '14' as group_id
					,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x58' and 'x59' 

					UNION
					SELECT  '15' as group_id
					,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x60' and 'x84' 

					UNION
					SELECT  '16' as group_id
					,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x85' and 'y09' 
					UNION
					SELECT  '17' as group_id
					,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'y10' and 'y33' 

					UNION
					SELECT  '18' as group_id
					,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'y35' and 'y36' 

					UNION
					SELECT  '19' as group_id
					,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE ='y34' ";
					
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL 
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL " ;
				
			$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
							
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                			
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	" ;
        } elseif(!empty($hoscode) && !empty($date1) && !empty($date2)){
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and ADATE between '$date1' and '$date2' and hosp='$hoscode'

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and ADATE between '$date1' and '$date2' and hosp='$hoscode'";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode'" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode'" ;
			
		} elseif(!empty($hoscode) && empty($date1) && empty($date2)){
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and hosp='$hoscode'
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and hosp='$hoscode'
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and hosp='$hoscode'

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and hosp='$hoscode'

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and hosp='$hoscode'

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and hosp='$hoscode'

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and hosp='$hoscode'
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and hosp='$hoscode'
                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and hosp='$hoscode'

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and hosp='$hoscode'
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and hosp='$hoscode'

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and hosp='$hoscode'

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and hosp='$hoscode'

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and hosp='$hoscode'

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and hosp='$hoscode'

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and hosp='$hoscode'

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and hosp='$hoscode'

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and hosp='$hoscode'

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and hosp='$hoscode'";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and hosp='$hoscode'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and hosp='$hoscode'" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'			
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE hosp='$hoscode'			
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode'" ;
			
		} else if(empty($hoscode) && !empty($date1 || $date2)){
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and ADATE between '$date1' and '$date2'
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and ADATE between '$date1' and '$date2'
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and ADATE between '$date1' and '$date2'
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and ADATE between '$date1' and '$date2'
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and ADATE between '$date1' and '$date2'

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and ADATE between '$date1' and '$date2'

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and ADATE between '$date1' and '$date2'

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and ADATE between '$date1' and '$date2'

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and ADATE between '$date1' and '$date2'

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and ADATE between '$date1' and '$date2'";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2'
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2'" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE ADATE between '$date1' and '$date2'				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2'" ;
			
		}
		
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
			$rawData2 = \Yii::$app->db2->createCommand($sql2)->queryAll();
			$rawData3 = \Yii::$app->db2->createCommand($sql3)->queryAll();
			$rawData4 = \Yii::$app->db2->createCommand($sql4)->queryAll();
			
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider2 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData2,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider3 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData3,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider4 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData4,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
        return $this->render('c19', [
                    'dataProvider' => $dataProvider,
					'dataProvider2' => $dataProvider2,
					'dataProvider3' => $dataProvider3,
					'dataProvider4' => $dataProvider4,
                    'date1' => $date1,
                    'date2' => $date2,
					'hoscode' =>$hoscode,
        ]);
    }
	
	public function actionC19ptin($date1 = null, $date2 = null , $hoscode = null) {
        
        //return $this->render('c19');
        
			$sql4="SELECT finish FROM is_log";
         
        if (empty($date1) && empty($hoscode) && empty($date2) ) {
            $sql = "SELECT  '01' as group_id
					,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE CAUSE='1' and  WARD is not null
					UNION
					SELECT  '02' as group_id
					,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
					,COUNT(*) as total
                    ,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit					
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and  WARD is not null
					UNION
					SELECT  '03' as group_id
					,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and  WARD is not null
					UNION
					SELECT  '04' as group_id
					,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and  WARD is not null
					UNION
					SELECT  '05' as group_id
					,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and  WARD is not null
					UNION
					SELECT  '06' as group_id
					,'คุกคามการหายใจ (W75-W84)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and  WARD is not null
					UNION
					SELECT  '07' as group_id
					,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and  WARD is not null
					UNION
					SELECT  '08' as group_id
					,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and  WARD is not null
					UNION
					SELECT  '09' as group_id
					,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
				    ,SUM(IF(STAER='6',1,0)) as dead_er
				   ,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and  WARD is not null

                    UNION
                    SELECT  '10' as group_id
				         ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and  WARD is not null
    
					UNION
					SELECT  '11' as group_id
					,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and  WARD is not null

					UNION
					SELECT  '12' as group_id
					,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and  WARD is not null

					UNION
					SELECT  '13' as group_id
					,'การออกแรงเกิน (X50-X57)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and  WARD is not null

					UNION
					SELECT  '14' as group_id
					,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and  WARD is not null

					UNION
					SELECT  '15' as group_id
					,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and  WARD is not null

					UNION
					SELECT  '16' as group_id
					,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and  WARD is not null
					UNION
					SELECT  '17' as group_id
					,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and  WARD is not null

					UNION
					SELECT  '18' as group_id
					,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and  WARD is not null

					UNION
					SELECT  '19' as group_id
					,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
					,COUNT(*) as total 
					,SUM(IF(STAER='1',1,0)) as dba
					,SUM(IF(STAER='6',1,0)) as dead_er
					,SUM(IF(STAER='7',1,0)) as admit
					FROM is_tmp
					WHERE ICDCAUSE ='y34' and  WARD is not null ";
					
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL  and  WARD is not null
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and  WARD is not null " ;
				
			$sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp 
				where WARD is not null				
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				where WARD is not null	
				
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				where WARD is not null	
				
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				where WARD is not null	
							
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				where WARD is not null	
				
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				where WARD is not null	
				
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				where WARD is not null	
				
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				where WARD is not null	
				
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
				where WARD is not null	
                			
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				where WARD is not null	" ;
				
        } elseif(!empty($hoscode) && !empty($date1) && !empty($date2)){
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null	
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and ADATE between '$date1' and '$date2' and hosp='$hoscode'
				and WARD is not null ";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and hosp='$hoscode' and WARD is not null " ;
			
		} elseif(!empty($hoscode) && empty($date1) && empty($date2)){
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and hosp='$hoscode' and WARD is not null
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and hosp='$hoscode' and WARD is not null
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and hosp='$hoscode' and WARD is not null
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and hosp='$hoscode' and WARD is not null
                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and hosp='$hoscode' and WARD is not null
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and hosp='$hoscode' and WARD is not null

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and hosp='$hoscode' and WARD is not null ";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and hosp='$hoscode' and WARD is not null
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and hosp='$hoscode' and WARD is not null" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null			
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE hosp='$hoscode' and WARD is not null		
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE hosp='$hoscode' and WARD is not null " ;
			
		} else {
			$sql = "SELECT '01' as group_id
				,'อุบัติเหตุการขนส่ง  ( V01 - V99 )' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE CAUSE='1' and ADATE between '$date1' and '$date2' and WARD is not null
                UNION
                SELECT '02' as group_id
				,'พลัด ตก หรือ หกล้ม (W00-W19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w00' and 'w19' and ADATE between '$date1' and '$date2' and WARD is not null
                UNION
                SELECT '03' as group_id
				,'สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20-W49)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w20' and 'w49' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '04' as group_id
				,'สัมผัสกับแรงเชิงกลของสัตว์/คน (W50-W64)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w50' and 'w64' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '05' as group_id
				,'การตกน้ำ จมน้ำ (W65-W74)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w65' and 'w74' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '06' as group_id
				,'คุกคามการหายใจ (W75-W84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w75' and 'w84' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '07' as group_id
				,'สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85-W99)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'w85' and 'w99' and ADATE between '$date1' and '$date2' and WARD is not null
                    
                UNION
                SELECT  '08' as group_id
				,'สัมผัสควันไฟ และเปลวไฟ (X00-X09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x00' and 'x09' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '09' as group_id
				,'สัมผัสความร้อน ของร้อน (X10-X19)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x10' and 'x19' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '10' as group_id
                                                ,'สัมผัสพิษจากสัตว์หรือพืช (X20-X29)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x20' and 'x29' and ADATE between '$date1' and '$date2' and WARD is not null
    
                UNION
                SELECT '11' as group_id
                                                ,'สัมผัสพลังงานจากธรรมชาติ (X30-X39)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x30' and 'x39' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '12' as group_id
                                               ,'สัมผัสพิษและสารอื่นๆ (X40-X49)' as group_name
                ,COUNT(*) as total
                ,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit				
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x40' and 'x49' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '13' as group_id
                                               ,'การออกแรงเกิน (X50-X57)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x50' and 'x57' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT
                 '14' as group_id
                                               ,'สัมผัสกับสิ่งไม่ทราบแน่ชัด (X58-X59)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x58' and 'x59' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT  '15' as group_id
                                                  ,'ทำร้ายตัวเองด้วยวิธีต่างๆ (X60-X84)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x60' and 'x84' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '16' as group_id
                                                 ,'ถูกทำร้ายด้วยวิธีต่างๆ (X85-Y09)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'x85' and 'y09' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT '17' as group_id
                                                ,'บาดเจ็บโดยไม่ทราบเจตนา (Y10-Y33)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y10' and 'y33' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT  '18' as group_id
                                               ,'ดำเนินการทางกฎหมายหรือสงคราม (Y35-Y36)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE BETWEEN 'y35' and 'y36' and ADATE between '$date1' and '$date2' and WARD is not null

                UNION
                SELECT  '19' as group_id
                                             ,'ไม่ทราบทั้งสาเหตุและเจตนา (Y34)' as group_name
                ,COUNT(*) as total 
				,SUM(IF(STAER='1',1,0)) as dba
				,SUM(IF(STAER='6',1,0)) as dead_er
				,SUM(IF(STAER='7',1,0)) as admit
				FROM is_tmp
                WHERE ICDCAUSE ='y34' and ADATE between '$date1' and '$date2' and WARD is not null ";
				
			$sql2 = "SELECT 'ชาย' as name
				,SUM(IF(SEX='1',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT 
				'หญิง' as name
				,SUM(IF(SEX='2',1,0)) *100/COUNT(*) as y
				FROM is_tmp
				WHERE SEX is NOT NULL and ADATE between '$date1' and '$date2' and WARD is not null" ;
				
		    $sql3 = "SELECT '< 1 ปี' as age
				,SUM(if(age<1,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '1 ปี ถึง < 5 ปี' as age
				,SUM(if(age between 1 and 5,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '6 ปี ถึง < 10 ปี' as age
				,SUM(if(age between 6 and 10,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 15 ปี' as age
				,SUM(if(age between 11 and 15,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '16 ปี ถึง < 20 ปี' as age
				,SUM(if(age between 16 and 20,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '11 ปี ถึง < 25 ปี' as age
				,SUM(if(age between 21 and 25,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '26 ปี ถึง < 30 ปี' as age
				,SUM(if(age between 26 and 30,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '31 ปี ถึง < 35 ปี' as age
				,SUM(if(age between 31 and 35,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT 
				'36 ปี ถึง < 40 ปี' as age
				,SUM(if(age between 36 and 40,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null				
				UNION
				SELECT '41 ปี ถึง < 45 ปี' as age
				,SUM(if(age between 40 and 45,1,0)) as total
				FROM is_tmp
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '46 ปี ถึง < 50 ปี' as age
				,SUM(if(age between 46 and 50,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '51 ปี ถึง < 55 ปี'  as age
				,SUM(if(age between 51 and 55,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '56 ปี ถึง < 60 ปี'  as age
				,SUM(if(age between 56 and 60,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null
				UNION
				SELECT '60 ปี ขึ้นไป'  as age
				,SUM(if(age > 60,1,0)) as total
				FROM is_tmp
                WHERE ADATE between '$date1' and '$date2' and WARD is not null				
				UNION
				SELECT 'ไม่ทราบอายุ'  as age
				,SUM(if(age is null,1,0)) as total
				FROM is_tmp	
				WHERE ADATE between '$date1' and '$date2' and WARD is not null" ;
			
		}
		
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
			$rawData2 = \Yii::$app->db2->createCommand($sql2)->queryAll();
			$rawData3 = \Yii::$app->db2->createCommand($sql3)->queryAll();
			$rawData4 = \Yii::$app->db2->createCommand($sql4)->queryAll();
			
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider2 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData2,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider3 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData3,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
		$dataProvider4 = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData4,
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);
		
        return $this->render('c19ptin', [
                    'dataProvider' => $dataProvider,
					'dataProvider2' => $dataProvider2,
					'dataProvider3' => $dataProvider3,
					'dataProvider4' => $dataProvider4,
                    'date1' => $date1,
                    'date2' => $date2,
					'hoscode' =>$hoscode,
        ]);
    }
	 

}
