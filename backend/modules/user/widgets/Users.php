<?php
namespace backend\modules\user\widgets;

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\Widget;
use yii\db\Query;
use yii\data\ActiveDataProvider;

use backend\modules\user\models\User;

class Users extends Widget
{
    public function run()
    {
        $query = User::find()->orderBy(['created_at' => SORT_DESC])->limit(4);
        // echo $query->createCommand()->rawSql;exit();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => false
        ]);
        
        return $this->render('users', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
?>
