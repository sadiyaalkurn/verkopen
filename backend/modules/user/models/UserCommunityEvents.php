<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_events".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $event_name
 * @property string $event_description
 * @property string $price
 * @property string $start_time
 * @property string $end_time
 * @property string $location
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property UserCommunityEventsFileMapping[] $userCommunityEventsFileMappings
 */
class UserCommunityEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event_name', 'event_description', 'price', 'start_time', 'end_time', 'location'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['event_description'], 'string'],
            [['price'], 'number'],
            [['start_time', 'end_time'], 'safe'],
            [['event_name', 'location'], 'string', 'max' => 255],
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
            'event_name' => 'Event Name',
            'event_description' => 'Event Description',
            'price' => 'Price',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'location' => 'Location',
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
    public function getUserCommunityEventsFileMappings()
    {
        return $this->hasMany(UserCommunityEventsFileMapping::className(), ['event_id' => 'id']);
    }
}
