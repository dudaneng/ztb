<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cabinet".
 *
 * @property integer $id
 * @property string $code
 * @property integer $status
 * @property integer $creat_time
 * @property integer $update_time
 */
class Cabinet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cabinet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'creat_time', 'update_time'], 'required'],
            [['status', 'creat_time', 'update_time'], 'integer'],
            [['code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'status' => 'Status',
            'creat_time' => 'Creat Time',
            'update_time' => 'Update Time',
        ];
    }
}
