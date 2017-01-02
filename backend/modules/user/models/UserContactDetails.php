<?php

namespace backend\modules\user\models;

use Yii;
use backend\modules\user\models\User;

/**
 * This is the model class for table "user_contact_details".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $mobile
 * @property string $phone
 * @property string $note
 * @property string $manager_fname
 * @property string $manager_lname
 * @property string $manager_email
 * @property string $manager_note
 *
 * @property User $user
 */
class UserContactDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_contact_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'mobile'], 'integer'],
            [['note', 'manager_note'], 'string'],
            [['phone', 'manager_fname', 'manager_lname'], 'string', 'max' => 45],
            [['manager_email'], 'string', 'max' => 255],
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
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'note' => 'Note',
            'manager_fname' => 'Manager Fname',
            'manager_lname' => 'Manager Lname',
            'manager_email' => 'Manager Email',
            'manager_note' => 'Manager Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
