<?php

namespace common\models\ar;

use Yii;

/**
 * This is the model class for table "aliases_nodes".
 *
 * @property integer $id
 * @property integer $tree_ref
 * @property string $url_alias
 * @property string $dt_created
 * @property string $dt_updated
 * @property integer $is_deprecated
 * @property integer $is_trash
 */
class RArAliasesNodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aliases_nodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tree_ref', 'url_alias'], 'required'],
            [['tree_ref', 'is_deprecated', 'is_trash'], 'integer'],
            [['dt_created', 'dt_updated'], 'safe'],
            [['url_alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree_ref' => 'Tree Ref',
            'url_alias' => 'Url Alias',
            'dt_created' => 'Dt Created',
            'dt_updated' => 'Dt Updated',
            'is_deprecated' => 'Is Deprecated',
            'is_trash' => 'Is Trash',
        ];
    }
}
