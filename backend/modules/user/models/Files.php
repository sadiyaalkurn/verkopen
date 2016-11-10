<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $file_name
 * @property string $file_size
 * @property string $mime_type
 * @property string $path
 * @property string $url
 * @property string $extension
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property UserAvatar[] $userAvatars
 * @property UserComminityFileMapping[] $userComminityFileMappings
 * @property UserCommunityEventsFileMapping[] $userCommunityEventsFileMappings
 * @property UserGalleryMapping[] $userGalleryMappings
 * @property UserNutritionFileMapping[] $userNutritionFileMappings
 * @property UserNutritionVideoMapping[] $userNutritionVideoMappings
 * @property UserPostVideoMapping[] $userPostVideoMappings
 * @property UserWorkoutFileMapping[] $userWorkoutFileMappings
 * @property UserWorkoutVideoMapping[] $userWorkoutVideoMappings
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_size', 'mime_type', 'path', 'url', 'extension'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['file_name', 'file_size', 'mime_type', 'path', 'url', 'extension'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'file_size' => 'File Size',
            'mime_type' => 'Mime Type',
            'path' => 'Path',
            'url' => 'Url',
            'extension' => 'Extension',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAvatars()
    {
        return $this->hasMany(UserAvatar::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserComminityFileMappings()
    {
        return $this->hasMany(UserComminityFileMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityEventsFileMappings()
    {
        return $this->hasMany(UserCommunityEventsFileMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGalleryMappings()
    {
        return $this->hasMany(UserGalleryMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritionFileMappings()
    {
        return $this->hasMany(UserNutritionFileMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritionVideoMappings()
    {
        return $this->hasMany(UserNutritionVideoMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostVideoMappings()
    {
        return $this->hasMany(UserPostVideoMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutFileMappings()
    {
        return $this->hasMany(UserWorkoutFileMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutVideoMappings()
    {
        return $this->hasMany(UserWorkoutVideoMapping::className(), ['file_id' => 'id']);
    }
}
