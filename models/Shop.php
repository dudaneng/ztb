<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%shop}}".
 *
 * @property string $id
 * @property integer $shop_code
 * @property string $shop_account
 * @property string $shop_password
 * @property string $shop_name
 * @property double $group_rate
 * @property string $user_name
 * @property string $type_big
 * @property string $type_small
 * @property string $area_big
 * @property string $area_middle
 * @property string $area_small
 * @property string $shop_x
 * @property string $shop_y
 * @property string $shop_address
 * @property string $shop_logo
 * @property string $shop_about
 * @property integer $status
 * @property string $shop_tel
 * @property integer $create_time
 * @property integer $update_time
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_code', 'type_big', 'type_small', 'area_big', 'area_middle', 'area_small', 'status', 'create_time', 'update_time'], 'integer'],
            [['group_rate'], 'number'],
            [['shop_account'], 'string', 'max' => 20],
            [['shop_password', 'shop_name', 'shop_address'], 'string', 'max' => 50],
            [['user_name'], 'string', 'max' => 45],
            [['shop_x', 'shop_y'], 'string', 'max' => 10],
            [['shop_logo'], 'string', 'max' => 300],
            [['shop_about'], 'string', 'max' => 500],
            [['shop_tel'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_code' => 'Shop Code',
            'shop_account' => 'Shop Account',
            'shop_password' => 'Shop Password',
            'shop_name' => 'Shop Name',
            'group_rate' => 'Group Rate',
            'user_name' => 'User Name',
            'type_big' => 'Type Big',
            'type_small' => 'Type Small',
            'area_big' => 'Area Big',
            'area_middle' => 'Area Middle',
            'area_small' => 'Area Small',
            'shop_x' => 'Shop X',
            'shop_y' => 'Shop Y',
            'shop_address' => 'Shop Address',
            'shop_logo' => 'Shop Logo',
            'shop_about' => 'Shop About',
            'status' => 'Status',
            'shop_tel' => 'Shop Tel',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
