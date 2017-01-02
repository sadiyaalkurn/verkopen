<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_news".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $news_title
 * @property string $news_desc
 *
 * @property User $user
 */
class UserCommunityNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'news_title', 'news_desc'], 'required'],
            [['user_id'], 'integer'],
            [['news_desc'], 'string'],
            [['news_title'], 'string', 'max' => 255],
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
            'news_title' => 'News Title',
            'news_desc' => 'News Desc',
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
