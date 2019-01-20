<?php

namespace common\models\models;

use Yii;
use common\models\ar\RArTree;

/**
 * This is the model class for table "tree".
 *
 * @property integer $id
 * @property integer $ns_tree_ref
 * @property integer $ns_left_key
 * @property integer $ns_right_key
 * @property string $dt_created
 * @property string $dt_updated
 * @property string $alias
 * @property string $title
 * @property string $description
 *
 * @property Tree $nsTreeRef
 * @property Tree[] $rArTrees
 */
class Tree extends RArTree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'ns_tree_ref', 'ns_left_key', 'ns_right_key'], 'integer'],
            [['dt_created', 'dt_updated'], 'safe'],
            [['description'], 'string'],
            [['alias', 'title'], 'string', 'max' => 255],
            [['ns_tree_ref'], 'exist', 'skipOnError' => true, 'targetClass' => Tree::className(), 'targetAttribute' => ['ns_tree_ref' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ns_tree_ref' => 'Ns Tree Ref',
            'ns_left_key' => 'Ns Left Key',
            'ns_right_key' => 'Ns Right Key',
            'dt_created' => 'Dt Created',
            'dt_updated' => 'Dt Updated',
            'alias' => 'Alias',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNsTreeRef()
    {
        return $this->hasOne(Tree::className(), ['id' => 'ns_tree_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrees()
    {
        return $this->hasMany(Tree::className(), ['ns_tree_ref' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeContent()
    {
        return $this->hasOne(NodeContent::className(), ['tree_ref' => 'id']);
    }
}
