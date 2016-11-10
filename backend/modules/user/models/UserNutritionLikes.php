<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_nutrition_likes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $nutrition_id
 * @property string $date_on
 *
 * @property User $user
 * @property UserNutrition $nutrition
 */
class UserNutritionLikes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_nutrition_likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nutrition_id'], 'required'],
            [['user_id', 'nutrition_id'], 'integer'],
            [['date_on'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['nutrition_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserNutrition::className(), 'targetAttribute' => ['nutrition_id' => 'id']],
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
            'nutrition_id' => 'Nutrition ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutrition()
    {
        return $this->hasOne(UserNutrition::className(), ['id' => 'nutrition_id']);
    }
}
