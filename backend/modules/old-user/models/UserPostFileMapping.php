<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_post_file_mapping".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $file_id
 *
 * @property UserPost $post
 * @property User $file
 */
class UserPostFileMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_post_file_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'file_id'], 'required'],
            [['post_id', 'file_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserPost::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(UserPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(User::className(), ['id' => 'file_id']);
    }
}
