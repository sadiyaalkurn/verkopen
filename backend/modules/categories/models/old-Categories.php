<?php

namespace backend\modules\categories\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $Name
 * @property string $SubCategoryID
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
            [['parent'], 'required'],
            [['parent'], 'integer'],
            [['name', 'parent_list'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'ID',
            'parent' => 'Category ID',
            'name' => 'Name',
            'parent_list' => 'Sub Category ID',
        ];
    }
}
