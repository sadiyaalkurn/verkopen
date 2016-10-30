<?php
namespace frontend\models;

use frontend\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * Add a new field
     * @var string
     */
    public $fname;
    public $lname;
    public $city;
    public $state;
    public $zipcode;
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['fname','lname','city','state','zipcode','phone'], 'required'];
        $rules[] = [['fname','lname','city','state','zipcode','phone'], 'string', 'max' => 255];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['fname'] = \Yii::t('user', 'First Name');
        $labels['lname'] = \Yii::t('user', 'Last Name');
        $labels['city'] = \Yii::t('user', 'City');
        $labels['state'] = \Yii::t('user', 'State');
        $labels['phone'] = \Yii::t('user', 'Phone Number');
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(Profile::className());
        $profile->setAttributes([
            'fname' => $this->fname,
            'lname' => $this->lname,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'phone' => $this->phone,
        ]);
        $user->setProfile($profile);
    }
}