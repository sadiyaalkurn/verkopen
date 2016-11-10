<?php

namespace backend\modules\user\models;

use Yii;

use backend\modules\user\models\Files;

/**
 * This is the model class for table "user_comminity_file_mapping".
 *
 * @property integer $ID
 * @property integer $community_id
 * @property integer $file_id
 *
 * @property Files $file
 * @property UserCommunity $community
 */
class UserComminityFileMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_comminity_file_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['community_id', 'file_id'], 'required'],
            [['community_id', 'file_id'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCommunity::className(), 'targetAttribute' => ['community_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'community_id' => 'Community ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity()
    {
        return $this->hasOne(UserCommunity::className(), ['id' => 'community_id']);
    }
}
