<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_fitness".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $workout_id
 *
 * @property User $user
 * @property UserWorkout $workout
 */
class UserFitness extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_fitness';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'workout_id'], 'required'],
            [['id', 'user_id', 'workout_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['workout_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserWorkout::className(), 'targetAttribute' => ['workout_id' => 'id']],
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
            'workout_id' => 'Workout ID',
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
    public function getWorkout()
    {
        return $this->hasOne(UserWorkout::className(), ['id' => 'workout_id']);
    }
}
