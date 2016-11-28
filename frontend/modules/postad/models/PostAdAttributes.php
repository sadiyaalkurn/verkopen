<?php

namespace frontend\modules\postad\models;

use Yii;

/**
 * This is the model class for table "post_ad_attributes".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $attribute_property
 * @property string $attribute_value
 */
class PostAdAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_ad_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['attribute_property', 'attribute_value'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'attribute_property' => 'Attribute Property',
            'attribute_value' => 'Attribute Value',
        ];
    }
}
