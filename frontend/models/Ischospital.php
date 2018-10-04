<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "is_chospital".
 *
 * @property string $hoscode
 * @property string $hosname
 */
class Ischospital extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'is_chospital';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoscode'], 'required'],
            [['hoscode'], 'string', 'max' => 5],
            [['hosname'], 'string', 'max' => 255],
            [['hoscode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hoscode' => 'Hoscode',
            'hosname' => 'Hosname',
        ];
    }
}
