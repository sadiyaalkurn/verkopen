<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_community".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $logo_id
 * @property integer $category_type_id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $country
 * @property string $zipcode
 * @property string $community_type
 * @property string $message
 * @property string $about_the_community
 * @property string $paypal_email
 * @property string $community_services_info
 * @property string $service_type
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Request[] $requests
 * @property User $user
 * @property UserCommunityCategory $categoryType
 * @property Files $logo
 * @property UserCommunityAccounting[] $userCommunityAccountings
 */
class UserCommunity extends \yii\db\ActiveRecord
{
    public $avatar;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_community';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_type_id', 'name', 'email'], 'required'],
            [['user_id', 'logo_id', 'category_type_id', 'created_at', 'updated_at'], 'integer'],
            [['community_type', 'message', 'about_the_community', 'community_services_info', 'service_type'], 'string'],
            [['name', 'email', 'address', 'country'], 'string', 'max' => 255],
            [['zipcode'], 'string', 'max' => 10],
            [['paypal_email'], 'string', 'max' => 40],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCommunityCategory::className(), 'targetAttribute' => ['category_type_id' => 'id']],
            [['logo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['logo_id' => 'id']],
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
            'logo_id' => 'Logo ID',
            'category_type_id' => 'Category Type ID',
            'name' => 'Community Name',
            'email' => 'Email',
            'address' => 'Address',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
            'community_type' => 'Community Type',
            'message' => 'Message',
            'about_the_community' => 'About The Community',
            'paypal_email' => 'Paypal Email',
            'community_services_info' => 'Community Services Info',
            'service_type' => 'Service Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['community_id' => 'id']);
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
    public function getCategoryType()
    {
        return $this->hasOne(UserCommunityCategory::className(), ['id' => 'category_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo()
    {
        return $this->hasOne(Files::className(), ['id' => 'logo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityAccountings()
    {
        return $this->hasMany(UserCommunityAccounting::className(), ['community_id' => 'id']);
    }
}
