<?php

namespace backend\modules\categories\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $uid
 * @property string $name
 * @property integer $parent
 * @property string $parent_list
 * @property decimal $price
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent','price'], 'integer'],
            [['parent_list'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'name' => 'Name',
            'parent' => 'Parent',
            'price' => 'Price',
            'parent_list' => 'Parent List',
        ];
    }
}
