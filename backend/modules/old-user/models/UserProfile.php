<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $date_of_birth
 * @property string $phone_number
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $postal_code
 * @property string $security_private_profile
 * @property string $security_request_following
 * @property string $security_account
 * @property string $paypal_id
 * @property string $school
 * @property string $college
 * @property string $degree
 * @property string $work
 * @property string $position
 * @property string $facebook_link
 * @property string $instagram_link
 * @property string $youtube_link
 * @property string $twitter_link
 * @property string $google_link
 * @property string $snapchat_link
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [['user_id'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['paypal_id'], 'string'],
            [['first_name', 'last_name', 'phone_number', 'country', 'state', 'city'], 'string', 'max' => 40],
            [['gender', 'postal_code'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 80],
            [['security_private_profile', 'security_request_following', 'security_account'], 'string', 'max' => 1],
            [['school', 'college', 'degree', 'work', 'position', 'facebook_link', 'instagram_link', 'youtube_link', 'twitter_link', 'google_link', 'snapchat_link'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'phone_number' => 'Phone Number',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'security_private_profile' => 'Security Private Profile',
            'security_request_following' => 'Security Request Following',
            'security_account' => 'Security Account',
            'paypal_id' => 'Paypal ID',
            'school' => 'School',
            'college' => 'College',
            'degree' => 'Degree',
            'work' => 'Work',
            'position' => 'Position',
            'facebook_link' => 'Facebook Link',
            'instagram_link' => 'Instagram Link',
            'youtube_link' => 'Youtube Link',
            'twitter_link' => 'Twitter Link',
            'google_link' => 'Google Link',
            'snapchat_link' => 'Snapchat Link',
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
