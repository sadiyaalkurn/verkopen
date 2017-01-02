<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_blog".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $blog_title
 * @property string $blog_desc
 *
 * @property User $user
 */
class UserCommunityBlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_title', 'blog_desc'], 'required'],
            [['user_id'], 'integer'],
            [['blog_desc'], 'string'],
            [['blog_title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'blog_title' => 'Blog Title',
            'blog_desc' => 'Blog Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
