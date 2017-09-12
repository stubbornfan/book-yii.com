<?php
namespace app\modules\web\controllers;
use yii\web\Controller;

class StatController extends Controller
{

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }

    //统计详情
    public function actionIndex()
    {

        return $this->render('index');
    }

    //会员消费统计
    public function actionMember()
    {

        return $this->render('member');
    }

    //商品售卖
    public function actionProduct()
    {

        return $this->render('product');
    }

    //分享统计
    public function actionShare()
    {

        return $this->render('share');
    }

}
