<?php

namespace frontend\modules\postad\models;

use Yii;

/**
 * This is the model class for table "post_ad_contact_info".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $name_at_ad
 * @property string $contact_preference
 * @property string $email_address
 * @property string $phone
 * @property string $location
 * @property string $zip_code
 *
 * @property PostAd $post
 */
class PostAdContactInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_ad_contact_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['location'], 'string'],
            [['name_at_ad', 'email_address'], 'string', 'max' => 255],
            [['contact_preference', 'zip_code'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 25],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostAd::className(), 'targetAttribute' => ['post_id' => 'id']],
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
            'name_at_ad' => 'Name At Ad',
            'contact_preference' => 'Contact Preference',
            'email_address' => 'Email Address',
            'phone' => 'Phone',
            'location' => 'Location',
            'zip_code' => 'Zip Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(PostAd::className(), ['id' => 'post_id']);
    }
}
