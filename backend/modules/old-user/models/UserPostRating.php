<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_post_rating".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property integer $ratings
 * @property string $date_on
 *
 * @property User $user
 * @property UserPost $post
 */
class UserPostRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'ratings'], 'required'],
            [['user_id', 'post_id', 'ratings'], 'integer'],
            [['date_on'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserPost::className(), 'targetAttribute' => ['post_id' => 'id']],
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
            'post_id' => 'Post ID',
            'ratings' => 'Ratings',
            'date_on' => 'Date On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(UserPost::className(), ['id' => 'post_id']);
    }
}
