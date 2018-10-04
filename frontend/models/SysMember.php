<?php

namespace frontend\models;


use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "sys_member".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $officename
 * @property string $username
 * @property string $password
 * @property string $lastlogin
 * @property string $status
 * @property string $cid
 * @property string $mobile
 * @property string $off_name
 */
class SysMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['off_name'], 'string'],
            [['firstname', 'lastname', 'password', 'lastlogin'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['officename'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 30],
            [['status'], 'string', 'max' => 4],
            [['cid'], 'string', 'max' => 13],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'officename' => 'Officename',
            'username' => 'Username',
            'password' => 'Password',
            'lastlogin' => 'Lastlogin',
            'status' => 'Status',
            'cid' => 'Cid',
            'mobile' => 'Mobile',
            'off_name' => 'Off Name',
        ];
    }
}
