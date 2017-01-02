<?php
namespace backend\modules\contents\widgets;

use yii\base\Widget;
use backend\modules\contents\models\Contents;
use yii\db\Query;


class Content extends Widget
{

	public $menu;
    public function run()
    {
        $data = Contents::find()->where(['menu'=>$this->menu])->asArray()->All();
        return $this->render('contents', [
            'data' => $data
        ]);
    }
}

?>