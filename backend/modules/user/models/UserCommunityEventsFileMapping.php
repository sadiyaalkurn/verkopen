<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community_events_file_mapping".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $file_id
 *
 * @property UserCommunityEvents $event
 * @property Files $file
 */
class UserCommunityEventsFileMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community_events_file_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'file_id'], 'required'],
            [['event_id', 'file_id'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCommunityEvents::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(UserCommunityEvents::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
