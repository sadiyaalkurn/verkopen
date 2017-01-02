<?php

namespace frontend\modules\postad\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $filename
 * @property string $url
 * @property integer $posted_ad_id
 *
 * @property PostedAd $postedAd
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
            [['url'], 'string'],
            [['posted_ad_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['posted_ad_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostedAd::className(), 'targetAttribute' => ['posted_ad_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'url' => 'Url',
            'posted_ad_id' => 'Posted Ad ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostedAd()
    {
        return $this->hasOne(PostedAd::className(), ['id' => 'posted_ad_id']);
    }
}
