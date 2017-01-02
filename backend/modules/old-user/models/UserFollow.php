<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_follow".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $follow_user_id
 *
 * @property User $user
 * @property User $followUser
 */
class UserFollow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_follow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'follow_user_id'], 'required'],
            [['user_id', 'follow_user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['follow_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['follow_user_id' => 'id']],
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
            'follow_user_id' => 'Follow User ID',
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
    public function getFollowUser()
    {
        return $this->hasOne(User::className(), ['id' => 'follow_user_id']);
    }
}
