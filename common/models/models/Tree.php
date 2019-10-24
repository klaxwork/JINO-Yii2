<?php

namespace common\models\ar;

use Yii;
use common\models\ar\RArTree;

/**
 * This is the model class for table "tree".
 *
 * @property integer $id
 * @property integer $ns_tree_ref
 * @property integer $ns_left_key
 * @property integer $ns_right_key
 * @property integer $ns_level
 * @property string $node_name
 * @property string $dt_created
 * @property string $dt_updated
 * @property string $alias
 * @property string $title
 * @property string $description
 *
 * @property NodeContent[] $nodeContents
 * @property RArTree $nsTreeRef
 * @property RArTree[] $rArTrees
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
            [['id', 'ns_level'], 'required'],
            [['id', 'ns_tree_ref', 'ns_left_key', 'ns_right_key', 'ns_level'], 'integer'],
            [['dt_created', 'dt_updated'], 'safe'],
            [['description'], 'string'],
            [['node_name', 'alias', 'title'], 'string', 'max' => 255],
            [['ns_tree_ref'], 'exist', 'skipOnError' => true, 'targetClass' => RArTree::className(), 'targetAttribute' => ['ns_tree_ref' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'ns_tree_ref',
                 'leftAttribute' => 'ns_left_key',
                 'rightAttribute' => 'ns_right_key',
                 'depthAttribute' => 'ns_level',
            ],
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
            'ns_level' => 'Ns Level',
            'node_name' => 'Node Name',
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
    public function getNodeContents()
    {
        return $this->hasMany(NodeContent::className(), ['tree_ref' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNsTreeRef()
    {
        return $this->hasOne(RArTree::className(), ['id' => 'ns_tree_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRArTrees()
    {
        return $this->hasMany(RArTree::className(), ['ns_tree_ref' => 'id']);
    }
}
