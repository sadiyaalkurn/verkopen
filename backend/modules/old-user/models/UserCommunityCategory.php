<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_category".
 *
 * @property integer $id
 * @property integer $icon_id
 * @property string $title
 * @property string $description
 * @property string $status
 *
 * @property UserCommunity[] $userCommunities
 * @property Files $icon
 */
class UserCommunityCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon_id'], 'integer'],
            [['title'], 'required'],
            [['status'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['description'], 'string', 'max' => 255],
            [['icon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['icon_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon_id' => 'Icon ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunities()
    {
        return $this->hasMany(UserCommunity::className(), ['category_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcon()
    {
        return $this->hasOne(Files::className(), ['id' => 'icon_id']);
    }
}
