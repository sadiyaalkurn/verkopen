<?php

namespace backend\modules\categories_attribute\models;

use Yii;

/**
 * This is the model class for table "categories_attributes".
 *
 * @property integer $uid
 * @property string $name
 * @property integer $parent
 * @property string $type
 * @property integer $category_id
 * @property string $parent_list
 */
class CategoriesAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'category_id'], 'integer'],
            [['parent_list'], 'string'],
            [['name', 'type'], 'string', 'max' => 45],
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
            'type' => 'Type',
            'category_id' => 'Category ID',
            'parent_list' => 'Parent List',
        ];
    }


    
}
