<?php
namespace app\modules\web\controllers;
use yii\web\Controller;


class BookController extends Controller
{
    //图书列表
    public function actionIndex(){
        $this->layout =false;
        return $this->render("index");
    }

    //图书
    public function actionCat(){
        $this->layout =false;
        return $this->render("cat");
    }

    public function actionCat_set(){
        $this->layout =false;
        return $this->render("cat_set");
    }

    //图书图片资源
    public function actionImages(){
        $this->layout =false;
        return $this->render("images");
    }

    //图书详情
    public function actionInfo(){
        $this->layout =false;
        return $this->render("info");
    }

    //图书编辑或添加
    public function actionSet(){
        $this->layout =false;
        return $this->render("set");
    }

}
