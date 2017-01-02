<?php
namespace frontend\modules\postad\models;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "posted_ad_status".
 *
 * @property integer $id
 * @property integer $posted_ad_id
 * @property string $platform
 * @property integer $payment_status
 * @property integer $api_response
 * @property integer $user_id
 *
 * @property PostedAd $postedAd
 * @property User $user
 */
class PostedAdStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posted_ad_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['posted_ad_id', 'payment_status', 'api_response', 'user_id'], 'integer'],
            [['platform'], 'string', 'max' => 45],
            [['posted_ad_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostedAd::className(), 'targetAttribute' => ['posted_ad_id' => 'id']],
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
            'posted_ad_id' => 'Posted Ad ID',
            'platform' => 'Platform',
            'payment_status' => 'Payment Status',
            'api_response' => 'Api Response',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostedAd()
    {
        return $this->hasOne(PostedAd::className(), ['id' => 'posted_ad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
