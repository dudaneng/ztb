<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_admin".
 *
 * @property string $id
 * @property string $admin_acount
 * @property string $admin_password
 * @property integer $group_id
 * @property integer $last_time
 * @property string $last_ip
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'last_time'], 'integer'],
            [['admin_acount'], 'string', 'max' => 30],
            [['admin_password'], 'string', 'max' => 64],
            [['last_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_acount' => 'Admin Acount',
            'admin_password' => 'Admin Password',
            'group_id' => 'Group ID',
            'last_time' => 'Last Time',
            'last_ip' => 'Last Ip',
        ];
    }
	
}
