<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_workout_category".
 *
 * @property integer $id
 * @property string $category_name
 *
 * @property UserWorkout[] $userWorkouts
 */
class UserWorkoutCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_workout_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkouts()
    {
        return $this->hasMany(UserWorkout::className(), ['category_id' => 'id']);
    }
}
