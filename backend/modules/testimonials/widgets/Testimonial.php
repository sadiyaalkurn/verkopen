<?php
namespace backend\modules\testimonials\widgets;

use yii\base\Widget;
use backend\modules\testimonials\models\Testimonials;
use yii\db\Query;


class Testimonial extends Widget
{


    public function run()
    {
        $data = Testimonials::find()->asArray()->All();
        return $this->render('testimonials', [
            'data' => $data
        ]);
    }
}

?>