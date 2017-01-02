<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_accounting".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $community_id
 * @property string $paypal_id
 * @property string $facebook_link
 * @property string $twitter_link
 * @property string $google_plus_link
 *
 * @property User $user
 * @property UserCommunity $community
 */
class UserCommunityAccounting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_accounting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'community_id'], 'required'],
            [['user_id', 'community_id'], 'integer'],
            [['paypal_id', 'facebook_link', 'twitter_link', 'google_plus_link'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCommunity::className(), 'targetAttribute' => ['community_id' => 'id']],
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
            'community_id' => 'Community ID',
            'paypal_id' => 'Paypal ID',
            'facebook_link' => 'Facebook Link',
            'twitter_link' => 'Twitter Link',
            'google_plus_link' => 'Google Plus Link',
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
    public function getCommunity()
    {
        return $this->hasOne(UserCommunity::className(), ['id' => 'community_id']);
    }
}
