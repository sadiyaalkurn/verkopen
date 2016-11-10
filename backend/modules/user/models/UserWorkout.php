<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_workout".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $workout_title
 * @property string $workout_time
 * @property string $workout_description
 * @property string $compete_icon
 * @property string $workout_status
 * @property string $price
 * @property string $status
 * @property string $is_competition
 * @property string $type
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UserFitness[] $userFitnesses
 * @property User $user
 * @property UserWorkoutCategory $category
 * @property UserWorkoutFileMapping[] $userWorkoutFileMappings
 * @property UserWorkoutLikes[] $userWorkoutLikes
 * @property UserWorkoutRating[] $userWorkoutRatings
 * @property UserWorkoutVideoMapping[] $userWorkoutVideoMappings
 */
class UserWorkout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_workout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'workout_title', 'workout_description'], 'required'],
            [['user_id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['workout_time'], 'safe'],
            [['workout_description', 'workout_status', 'status', 'type'], 'string'],
            [['price'], 'number'],
            [['workout_title', 'compete_icon'], 'string', 'max' => 255],
            [['is_competition'], 'string', 'max' => 1],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserWorkoutCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'workout_title' => 'Workout Title',
            'workout_time' => 'Workout Time',
            'workout_description' => 'Workout Description',
            'compete_icon' => 'Compete Icon',
            'workout_status' => 'Workout Status',
            'price' => 'Price',
            'status' => 'Status',
            'is_competition' => 'Is Competition',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFitnesses()
    {
        return $this->hasMany(UserFitness::className(), ['workout_id' => 'id']);
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
    public function getCategory()
    {
        return $this->hasOne(UserWorkoutCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutFileMappings()
    {
        return $this->hasMany(UserWorkoutFileMapping::className(), ['workout_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutLikes()
    {
        return $this->hasMany(UserWorkoutLikes::className(), ['workout_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutRatings()
    {
        return $this->hasMany(UserWorkoutRating::className(), ['workout_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutVideoMappings()
    {
        return $this->hasMany(UserWorkoutVideoMapping::className(), ['workout_id' => 'id']);
    }
}
