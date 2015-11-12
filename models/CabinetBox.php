<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cabinet_box".
 *
 * @property integer $id
 * @property integer $cab_id
 * @property string $nunber
 * @property integer $status
 * @property string $contact
 * @property integer $update_time
 */
class CabinetBox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cabinet_box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cab_id', 'nunber', 'status', 'contact', 'update_time'], 'required'],
            [['cab_id', 'status', 'update_time'], 'integer'],
            [['nunber', 'contact'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cab_id' => 'Cab ID',
            'nunber' => 'Nunber',
            'status' => 'Status',
            'contact' => 'Contact',
            'update_time' => 'Update Time',
        ];
    }
}
