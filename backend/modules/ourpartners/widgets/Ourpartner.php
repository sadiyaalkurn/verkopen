<?php
namespace backend\modules\ourpartners\widgets;

use yii\base\Widget;
use backend\modules\ourpartners\models\Ourpartners;
use yii\db\Query;


class Ourpartner extends Widget
{


    public function run()
    {
        $data = Ourpartners::find()->asArray()->All();
        return $this->render('ourpartner', [
            'data' => $data
        ]);
    }
}

?>