<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_nutrition_video_mapping".
 *
 * @property integer $id
 * @property integer $nutrition_id
 * @property integer $file_id
 *
 * @property UserNutrition $nutrition
 * @property Files $file
 */
class UserNutritionVideoMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_nutrition_video_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nutrition_id', 'file_id'], 'required'],
            [['nutrition_id', 'file_id'], 'integer'],
            [['nutrition_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserNutrition::className(), 'targetAttribute' => ['nutrition_id' => 'id']],
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
            'nutrition_id' => 'Nutrition ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutrition()
    {
        return $this->hasOne(UserNutrition::className(), ['id' => 'nutrition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
