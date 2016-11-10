<?php

namespace backend\modules\user\models;

use Yii;

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
 *
 * @property Request[] $requests
 * @property UserAvatar[] $userAvatars
 * @property UserBooking[] $userBookings
 * @property UserBooking[] $userBookings0
 * @property UserCommunity[] $userCommunities
 * @property UserCommunityAccounting[] $userCommunityAccountings
 * @property UserCommunityBlog[] $userCommunityBlogs
 * @property UserCommunityEvents[] $userCommunityEvents
 * @property UserCommunityNews[] $userCommunityNews
 * @property UserCommunityProduct[] $userCommunityProducts
 * @property UserFitness[] $userFitnesses
 * @property UserFollow[] $userFollows
 * @property UserFollow[] $userFollows0
 * @property UserGalleryMapping[] $userGalleryMappings
 * @property UserMeasurement[] $userMeasurements
 * @property UserNutrition[] $userNutritions
 * @property UserNutritionLikes[] $userNutritionLikes
 * @property UserPost[] $userPosts
 * @property UserPostFileMapping[] $userPostFileMappings
 * @property UserPostLikes[] $userPostLikes
 * @property UserPostRating[] $userPostRatings
 * @property UserPostVideoMapping[] $userPostVideoMappings
 * @property UserProfile[] $userProfiles
 * @property UserWorkout[] $userWorkouts
 * @property UserWorkoutLikes[] $userWorkoutLikes
 * @property UserWorkoutRating[] $userWorkoutRatings
 */
class User extends \yii\db\ActiveRecord
{
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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAvatars()
    {
        return $this->hasMany(UserAvatar::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBookings()
    {
        return $this->hasMany(UserBooking::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBookings0()
    {
        return $this->hasMany(UserBooking::className(), ['expert_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunities()
    {
        return $this->hasMany(UserCommunity::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityAccountings()
    {
        return $this->hasMany(UserCommunityAccounting::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityBlogs()
    {
        return $this->hasMany(UserCommunityBlog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityEvents()
    {
        return $this->hasMany(UserCommunityEvents::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityNews()
    {
        return $this->hasMany(UserCommunityNews::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCommunityProducts()
    {
        return $this->hasMany(UserCommunityProduct::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFitnesses()
    {
        return $this->hasMany(UserFitness::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFollows()
    {
        return $this->hasMany(UserFollow::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFollows0()
    {
        return $this->hasMany(UserFollow::className(), ['follow_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGalleryMappings()
    {
        return $this->hasMany(UserGalleryMapping::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMeasurements()
    {
        return $this->hasMany(UserMeasurement::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritions()
    {
        return $this->hasMany(UserNutrition::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNutritionLikes()
    {
        return $this->hasMany(UserNutritionLikes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPosts()
    {
        return $this->hasMany(UserPost::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostFileMappings()
    {
        return $this->hasMany(UserPostFileMapping::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostLikes()
    {
        return $this->hasMany(UserPostLikes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostRatings()
    {
        return $this->hasMany(UserPostRating::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPostVideoMappings()
    {
        return $this->hasMany(UserPostVideoMapping::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkouts()
    {
        return $this->hasMany(UserWorkout::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutLikes()
    {
        return $this->hasMany(UserWorkoutLikes::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkoutRatings()
    {
        return $this->hasMany(UserWorkoutRating::className(), ['user_id' => 'id']);
    }
}
