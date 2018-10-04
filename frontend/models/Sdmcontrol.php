<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "s_dm_control".
 *
 * @property string $id
 * @property string $hospcode
 * @property string $areacode
 * @property string $flag_sent
 * @property string $date_com
 * @property string $b_year
 * @property int $target
 * @property int $result
 * @property int $hba1c
 * @property int $target1
 * @property int $result1
 * @property int $hba1c1
 */
class Sdmcontrol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 's_dm_control';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hospcode', 'areacode', 'b_year'], 'required'],
            [['target', 'result', 'hba1c', 'target1', 'result1', 'hba1c1'], 'integer'],
            [['id'], 'string', 'max' => 32],
            [['hospcode'], 'string', 'max' => 5],
            [['areacode'], 'string', 'max' => 8],
            [['flag_sent'], 'string', 'max' => 1],
            [['date_com'], 'string', 'max' => 14],
            [['b_year'], 'string', 'max' => 4],
            [['id', 'hospcode', 'areacode', 'b_year'], 'unique', 'targetAttribute' => ['id', 'hospcode', 'areacode', 'b_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'Hospcode',
            'areacode' => 'Areacode',
            'flag_sent' => 'Flag Sent',
            'date_com' => 'Date Com',
            'b_year' => 'B Year',
            'target' => 'Target',
            'result' => 'Result',
            'hba1c' => 'Hba1c',
            'target1' => 'Target1',
            'result1' => 'Result1',
            'hba1c1' => 'Hba1c1',
        ];
    }
}
