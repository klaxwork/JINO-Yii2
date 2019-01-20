<?php

namespace common\models\models;

use Yii;
use common\models\ar\RArGroups;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property string $group_key
 * @property string $group_name
 * @property string $description
 *
 * @property Users[] $users
 */
class Groups extends RArGroups
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_key', 'group_name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_key' => 'Group Key',
            'group_name' => 'Group Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['group_ref' => 'id']);
    }
}
