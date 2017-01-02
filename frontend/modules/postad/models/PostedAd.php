<?php

namespace frontend\modules\postad\models;

use Yii;

/**
 * This is the model class for table "posted_ad".
 *
 * @property integer $id
 * @property string $data
 * @property string $date
 */
class PostedAd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posted_ad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['date'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'date' => 'Date',
        ];
    }
}
