<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_gishealth1".
 *
 * @property integer $id
 * @property string $MAINCODE
 * @property string $NAME
 * @property string $TYPECODE
 * @property string $ADDRESS
 * @property string $LOCATION
 * @property string $PCODE
 * @property string $ACODE
 * @property string $TCODE
 * @property string $TEL
 * @property string $FAX
 * @property string $WWW
 * @property string $EMAIL
 * @property string $LAT
 * @property string $LON
 * @property string $LAST_UPDATE
 */
class Gishealth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_gishealth1';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_57');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LAST_UPDATE'], 'safe'],
            [['MAINCODE', 'NAME', 'ADDRESS', 'LOCATION', 'TEL', 'FAX', 'WWW', 'EMAIL'], 'string', 'max' => 100],
            [['TYPECODE'], 'string', 'max' => 1],
            [['PCODE', 'ACODE'], 'string', 'max' => 2],
            [['TCODE'], 'string', 'max' => 10],
            [['LAT', 'LON'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'MAINCODE' => 'Maincode',
            'NAME' => 'Name',
            'TYPECODE' => 'Typecode',
            'ADDRESS' => 'Address',
            'LOCATION' => 'Location',
            'PCODE' => 'Pcode',
            'ACODE' => 'Acode',
            'TCODE' => 'Tcode',
            'TEL' => 'Tel',
            'FAX' => 'Fax',
            'WWW' => 'Www',
            'EMAIL' => 'Email',
            'LAT' => 'Lat',
            'LON' => 'Lon',
            'LAST_UPDATE' => 'Last  Update',
        ];
    }
}
