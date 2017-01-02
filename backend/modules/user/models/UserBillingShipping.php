<?php

namespace backend\modules\user\models;

use Yii;
use backend\modules\user\models\User;

/**
 * This is the model class for table "user_billing_shipping".
 *
 * @property integer $id
 * @property integer $contractee_id
 * @property string $billing_company
 * @property string $billing_address
 * @property string $billing_apt
 * @property string $billing_city
 * @property string $billing_province
 * @property string $billing_postalcode
 * @property string $shipping_company
 * @property string $shipping_address
 * @property string $shipping_apt
 * @property string $shipping_city
 * @property string $shipping_province
 * @property string $shipping_postalcode
 *
 * @property User $contractee
 */
class UserBillingShipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_billing_shipping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contractee_id'], 'integer'],
            [['billing_company', 'billing_address', 'billing_apt', 'billing_city', 'billing_province', 'billing_postalcode', 'shipping_company', 'shipping_address', 'shipping_apt', 'shipping_city', 'shipping_province', 'shipping_postalcode'], 'required'],
            [['billing_company', 'billing_address', 'billing_apt', 'shipping_company', 'shipping_address', 'shipping_apt'], 'string', 'max' => 255],
            [['billing_city', 'billing_province', 'billing_postalcode', 'shipping_city', 'shipping_province', 'shipping_postalcode'], 'string', 'max' => 45],
            [['contractee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['contractee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contractee_id' => 'Contractee ID',
            'billing_company' => 'Billing Company',
            'billing_address' => 'Billing Address',
            'billing_apt' => 'Billing Apt',
            'billing_city' => 'Billing City',
            'billing_province' => 'Billing Province',
            'billing_postalcode' => 'Billing Postalcode',
            'shipping_company' => 'Shipping Company',
            'shipping_address' => 'Shipping Address',
            'shipping_apt' => 'Shipping Apt',
            'shipping_city' => 'Shipping City',
            'shipping_province' => 'Shipping Province',
            'shipping_postalcode' => 'Shipping Postalcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractee()
    {
        return $this->hasOne(User::className(), ['id' => 'contractee_id']);
    }
}
