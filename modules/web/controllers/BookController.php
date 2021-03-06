<?php
namespace app\modules\web\controllers;
use app\modules\web\controllers\common\BaseController;
use yii\web\Controller;


class BookController extends BaseController
{

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }


    //图书列表
    public function actionIndex(){

        return $this->render("index");
    }

    //图书
    public function actionCat(){

        return $this->render("cat");
    }

    public function actionCat_set(){

        return $this->render("cat_set");
    }

    //图书图片资源
    public function actionImages(){

        return $this->render("images");
    }

    //图书详情
    public function actionInfo(){

        return $this->render("info");
    }

    //图书编辑或添加
    public function actionSet(){

        return $this->render("set");
    }

}
