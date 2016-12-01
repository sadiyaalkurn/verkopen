<?php

namespace backend\modules\platforms\models;

use Yii;

/**
 * This is the model class for table "platforms".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $basic_price
 * @property string $api_price
 */
class Platforms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'platforms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['basic_price', 'api_price'], 'number'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'basic_price' => 'Basic Price',
            'api_price' => 'Api Price',
        ];
    }
}
