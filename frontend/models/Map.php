<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map".
 *
 * @property int $id
 * @property string $hcode
 * @property string $areacode
 * @property string $hosname
 * @property string $lat
 * @property string $lng
 * @property string $timestamp
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map';
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
            [['id'], 'integer'],
            [['hcode'], 'required'],
            [['timestamp'], 'safe'],
            [['hcode'], 'string', 'max' => 5],
            [['areacode'], 'string', 'max' => 4],
            [['hosname'], 'string', 'max' => 255],
            [['lat', 'lng'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hcode' => 'Hcode',
            'areacode' => 'Areacode',
            'hosname' => 'Hosname',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'timestamp' => 'Timestamp',
        ];
    }
}
