<?php

namespace backend\modules\ourpartners\models;

use Yii;

/**
 * This is the model class for table "ourpartners".
 *
 * @property integer $id
 * @property string $title
 * @property string $imageFile
 */
class Ourpartners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ourpartners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'file'], 'string', 'max' => 45],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'file' => 'Image',
        ];
    }
}
