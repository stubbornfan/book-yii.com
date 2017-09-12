<?php
namespace app\modules\m\controllers;
use yii\web\Controller;

class UserController extends Controller
{

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }

    //账号绑定
    public function actionBind()
    {

        return $this->render('bind');
    }

    //我的购物车
    public function actionCat()
    {

        return $this->render("cat");
    }

    //评论列表
    public function actionComment()
    {

        return $this->render("comment");
    }
    //评论编辑
    public function actionComment_set()
    {

        return $this->render("comment_set");
    }

    //收藏
    public function actionFav()
    {

        return $this->render("fav");
    }

    //我的相关信息
    public function actionIndex()
    {

        return $this->render("index");
    }

    //地址列表
    public function actionAddress()
    {

        return $this->render("address");
    }

    //地址编辑
    public function actionAddress_set()
    {

        return $this->render("address_set");
    }

    //我的订单列表页面
    public function actionOrder()
    {

        return $this->render("order");
    }



}
