<?php

namespace common\models\ar;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $group_ref
 * @property string $dt_created
 * @property string $dt_updated
 * @property string $email
 * @property string $phone
 * @property string $balance
 * @property integer $is_blocked
 * @property integer $is_deleted
 *
 * @property Transactions[] $transactions
 * @property Transactions[] $transactions0
 * @property UserFactories[] $userFactories
 * @property Groups $groupRef
 */
class RArUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['group_ref', 'is_blocked', 'is_deleted'], 'integer'],
            [['dt_created', 'dt_updated'], 'safe'],
            [['balance'], 'number'],
            [['username', 'password', 'email', 'phone'], 'string', 'max' => 255],
            [['group_ref'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_ref' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'group_ref' => 'Group Ref',
            'dt_created' => 'Dt Created',
            'dt_updated' => 'Dt Updated',
            'email' => 'Email',
            'phone' => 'Phone',
            'balance' => 'Balance',
            'is_blocked' => 'Is Blocked',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['source_user_ref' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions0()
    {
        return $this->hasMany(Transactions::className(), ['dest_user_ref' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFactories()
    {
        return $this->hasMany(UserFactories::className(), ['users_ref' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRef()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_ref']);
    }
}
