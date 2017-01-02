<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_booking".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $member_name
 * @property integer $expert_user_id
 * @property string $booking_time
 * @property string $status
 *
 * @property User $user
 * @property User $expertUser
 */
class UserBooking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'member_name', 'expert_user_id', 'booking_time'], 'required'],
            [['user_id', 'expert_user_id'], 'integer'],
            [['booking_time'], 'safe'],
            [['status'], 'string'],
            [['member_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['expert_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['expert_user_id' => 'id']],
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
            'member_name' => 'Member Name',
            'expert_user_id' => 'Expert User ID',
            'booking_time' => 'Booking Time',
            'status' => 'Status',
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
    public function getExpertUser()
    {
        return $this->hasOne(User::className(), ['id' => 'expert_user_id']);
    }
}
