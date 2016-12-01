<?php

namespace backend\modules\adformattribute\models;

use Yii;

/**
 * This is the model class for table "ad_form_attribute".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $status
 * @property string $value
 */
class AdFormAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_form_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['value'], 'string'],
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
            'type' => 'Type',
            'status' => 'Status',
            'value' => 'Value',
        ];
    }
}
