<?php

namespace frontend\modules\postad\models;

use Yii;


/**
 * This is the model class for table "post_ad".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $type_of_ad
 * @property string $title
 * @property string $type
 * @property string $delivery
 * @property string $characterstics
 * @property string $show_location_map
 * @property string $files
 * @property string $text
 * @property string $website
 * @property string $youtube
 * @property string $price
 *
 * @property PostAdContactInfo[] $postAdContactInfos
 */
class PostAd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_ad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'delivery', 'characterstics','files', 'text', 'website', 'youtube', 'type'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['files', 'text', 'website', 'youtube'], 'string'],
            [['type_of_ad', 'type', 'show_location_map', 'price'], 'string', 'max' => 45],
            [['title', 'delivery', 'characterstics'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'type_of_ad' => 'Type Of Ad',
            'title' => 'Title',
            'type' => 'Type',
            'delivery' => 'Delivery',
            'characterstics' => 'Characterstics',
            'show_location_map' => 'Show Location Map',
            'files' => 'Files',
            'text' => 'Text',
            'website' => 'Website',
            'youtube' => 'Youtube',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostAdContactInfos()
    {
        return $this->hasMany(PostAdContactInfo::className(), ['post_id' => 'id']);
    }
}
