<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "f43v23".
 *
 * @property string $HOSPCODE
 * @property string $hosname
 * @property string $ampurname
 */
class F43 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f43v23';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE'], 'required'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['hosname', 'ampurname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => 'รหัสสถานพยาบาล',
            'hosname' => 'ชื่อสถานพยาบาล',
            'ampurname' => 'อำเภอ',
        ];
    }
}
