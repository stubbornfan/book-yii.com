<?php
namespace app\modules\web\controllers;
use yii\web\Controller;

class StatController extends Controller
{
    //统计详情
    public function actionIndex()
    {
        $this->layout=false;
        return $this->render('index');
    }

    //会员消费统计
    public function actionMember()
    {
        $this->layout=false;
        return $this->render('member');
    }

    //商品售卖
    public function actionProduct()
    {
        $this->layout=false;
        return $this->render('product');
    }

    //分享统计
    public function actionShare()
    {
        $this->layout=false;
        return $this->render('share');
    }

}
