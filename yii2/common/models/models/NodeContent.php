<?php

namespace common\models\models;

use Yii;
use common\models\ar\RArNodeContent;

/**
 * This is the model class for table "node_content".
 *
 * @property integer $id
 * @property integer $tree_ref
 * @property string $none_name
 * @property string $title
 * @property string $long_title
 * @property string $teaser
 * @property string $body
 * @property string $url_alias
 * @property string $dt_created
 * @property string $dt_updated
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $is_seo_noindexing
 *
 * @property Tree $treeRef
 */
class NodeContent extends RArNodeContent
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'node_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tree_ref', 'is_seo_noindexing'], 'integer'],
            [['none_name', 'title', 'long_title', 'teaser', 'body', 'url_alias', 'seo_title', 'seo_keywords', 'seo_description', 'is_seo_noindexing'], 'required'],
            [['teaser', 'body', 'seo_keywords', 'seo_description'], 'string'],
            [['dt_created', 'dt_updated'], 'safe'],
            [['none_name', 'title', 'long_title', 'url_alias', 'seo_title'], 'string', 'max' => 255],
            [['tree_ref'], 'exist', 'skipOnError' => true, 'targetClass' => Tree::className(), 'targetAttribute' => ['tree_ref' => 'id']],
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
            'none_name' => 'None Name',
            'title' => 'Title',
            'long_title' => 'Long Title',
            'teaser' => 'Teaser',
            'body' => 'Body',
            'url_alias' => 'Url Alias',
            'dt_created' => 'Dt Created',
            'dt_updated' => 'Dt Updated',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'is_seo_noindexing' => 'Is Seo Noindexing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTree()
    {
        return $this->hasOne(Tree::className(), ['id' => 'tree_ref']);
    }
}
