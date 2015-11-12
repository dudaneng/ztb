<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $area_small
 * @property integer $area_middle
 * @property integer $area_big
 * @property integer $sort
 * @property integer $status
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'area_small', 'area_middle', 'area_big'], 'required'],
            [['user_id', 'area_small', 'area_middle', 'area_big', 'sort', 'status'], 'integer']
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
            'area_small' => 'Area Small',
            'area_middle' => 'Area Middle',
            'area_big' => 'Area Big',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
