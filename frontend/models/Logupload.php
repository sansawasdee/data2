<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "log_upload".
 *
 * @property integer $id
 * @property string $hospcode
 * @property string $hosname
 * @property string $ampurname
 * @property string $upload_date
 * @property string $file_size
 */
class Logupload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_upload';
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
            [['file_size'], 'number'],
            [['hospcode'], 'string', 'max' => 5],
            [['hosname', 'ampurname' ,'file_name'], 'string', 'max' => 255],
            [['upload_date'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'รหัสสถานบริการ',
            'hosname' => 'สถานบริการ',
            'ampurname' => 'อำเภอ',
            'upload_date' => 'วันที่ upload',
            'file_name' => 'File Name',
            'file_size' => 'File Size (Mb)',
        ];
    }
}
