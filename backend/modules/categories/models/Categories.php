<?php

namespace backend\modules\categories\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $CategoryID
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
            [['CategoryID'], 'required'],
            [['CategoryID'], 'integer'],
            [['Name', 'SubCategoryID'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CategoryID' => 'Category ID',
            'Name' => 'Name',
            'SubCategoryID' => 'Sub Category ID',
        ];
    }
}
