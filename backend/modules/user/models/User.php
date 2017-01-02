<?php

namespace backend\modules\user\models;

use Yii;
use backend\modules\requests\models\MobileInfo;
use common\models\User as BaseUser;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $is_mail_verified
 * @property string $user_verification_token
 * @property string $access_token
 *
 * @property MobileInfo[] $mobileInfos
 * @property UserBillingShipping $userBillingShippings
 * @property UserContactDetails $userContactDetails
 */
class User extends BaseUser
{
    //public $user_role;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            //[['user_verification_token'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'/*, 'access_token'*/], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            //[['is_mail_verified'], 'string', 'max' => 1],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            //'is_mail_verified' => 'Is Mail Verified',
            //'user_verification_token' => 'User Verification Token',
            //'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMobileInfos()
    {
        return $this->hasMany(MobileInfo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBillingShippings()
    {
        return $this->hasOne(UserBillingShipping::className(), ['contractee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserContactDetails()
    {
        return $this->hasOne(UserContactDetails::className(), ['user_id' => 'id']);
    }
}
