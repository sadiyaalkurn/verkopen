<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_nutrition".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $nutrition_title
 * @property string $ingredients
 * @property string $details
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property UserNutritionFileMapping[] $userNutritionFileMappings
 * @property UserNutritionLikes[] $userNutritionLikes
 * @property UserNutritionVideoMapping[] $userNutritionVideoMappings
 */
class UserNutrition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_nutrition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nutrition_title', 'ingredients', 'details'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['ingredients', 'details'], 'string'],
            [['nutrition_title'], 'string', 'max' => 255],
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
            'nutrition_title' => 'Nutrition Title',
            'ingredients' => 'Ingredients',
            'details' => 'Details',
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
    public function getUserNutritionFileMappings()
    {
        return $this->hasMany(UserNutritionFileMapping::className(), ['nutrition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritionLikes()
    {
        return $this->hasMany(UserNutritionLikes::className(), ['nutrition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritionVideoMappings()
    {
        return $this->hasMany(UserNutritionVideoMapping::className(), ['nutrition_id' => 'id']);
    }
}
