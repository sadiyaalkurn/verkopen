<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $message
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property UserPostFileMapping[] $userPostFileMappings
 * @property UserPostLikes[] $userPostLikes
 * @property UserPostRating[] $userPostRatings
 */
class UserPost extends \yii\db\ActiveRecord
{
    public $gallery;public $video;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'message'], 'required'],
            [['id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string'],
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
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getUserPostFileMappings()
    {
        return $this->hasMany(UserPostFileMapping::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostLikes()
    {
        return $this->hasMany(UserPostLikes::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostRatings()
    {
        return $this->hasMany(UserPostRating::className(), ['post_id' => 'id']);
    }
}
