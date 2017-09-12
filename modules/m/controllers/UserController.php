<?php
namespace app\modules\m\controllers;
use yii\web\Controller;

class UserController extends Controller
{

    //账号绑定
    public function actionBind()
    {
        $this->layout = false;
        return $this->render('bind');
    }

    //我的购物车
    public function actionCat()
    {
        $this->layout = false;
        return $this->render("cat");
    }

    //评论列表
    public function actionComment()
    {
        $this->layout = false;
        return $this->render("comment");
    }
    //评论编辑
    public function actionComment_set()
    {
        $this->layout = false;
        return $this->render("comment_set");
    }

    //收藏
    public function actionFav()
    {
        $this->layout = false;
        return $this->render("fav");
    }

    //我的相关信息
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render("index");
    }

    //地址列表
    public function actionAddress()
    {
        $this->layout = false;
        return $this->render("address");
    }

    //地址编辑
    public function actionAddress_set()
    {
        $this->layout = false;
        return $this->render("address_set");
    }

    //我的订单列表页面
    public function actionOrder()
    {
        $this->layout = false;
        return $this->render("order");
    }



}
