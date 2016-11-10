<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_measurement".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $data_measurement
 * @property string $data_health
 * @property string $data_wellness
 * @property string $data_medical
 * @property string $data_fitness
 * @property string $data_flexibility
 * @property string $date_on
 *
 * @property User $user
 */
class UserMeasurement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_measurement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['data_measurement', 'data_health', 'data_wellness', 'data_medical', 'data_fitness', 'data_flexibility'], 'string'],
            [['date_on'], 'safe'],
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
            'data_measurement' => 'Data Measurement',
            'data_health' => 'Data Health',
            'data_wellness' => 'Data Wellness',
            'data_medical' => 'Data Medical',
            'data_fitness' => 'Data Fitness',
            'data_flexibility' => 'Data Flexibility',
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
}
