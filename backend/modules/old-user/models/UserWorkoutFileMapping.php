<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_workout_file_mapping".
 *
 * @property integer $id
 * @property integer $workout_id
 * @property integer $file_id
 *
 * @property UserWorkout $workout
 * @property Files $file
 */
class UserWorkoutFileMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_workout_file_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workout_id', 'file_id'], 'required'],
            [['workout_id', 'file_id'], 'integer'],
            [['workout_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserWorkout::className(), 'targetAttribute' => ['workout_id' => 'id']],
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
            'workout_id' => 'Workout ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkout()
    {
        return $this->hasOne(UserWorkout::className(), ['id' => 'workout_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
