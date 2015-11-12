<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_goods_color".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 */
class GoodsColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_goods_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort'], 'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 225]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
