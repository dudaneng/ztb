<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_act_number".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type1
 * @property integer $type2
 * @property integer $type3
 * @property integer $status
 * @property integer $update_time
 */
class ActNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_act_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'update_time'], 'required'],
            [['user_id', 'type1', 'type2', 'type3', 'status', 'update_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type1' => 'Type1',
            'type2' => 'Type2',
            'type3' => 'Type3',
            'status' => 'Status',
            'update_time' => 'Update Time',
        ];
    }
}
