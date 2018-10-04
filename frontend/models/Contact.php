<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $address
 * @property string $tambon
 * @property string $district
 * @property string $province
 * @property string $email
 * @property string $lat
 * @property string $lng
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'address', 'tambon', 'district', 'province', 'email', 'lat', 'lng'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'address' => 'Address',
            'tambon' => 'Tambon',
            'district' => 'District',
            'province' => 'Province',
            'email' => 'Email',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }
}
