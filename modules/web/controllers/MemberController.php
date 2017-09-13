<?php
namespace app\modules\web\controllers;
use app\modules\web\controllers\common\BaseController;
use yii\web\Controller;

class MemberController extends BaseController
{

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }

    //会员列表
    public function actionIndex()
    {

        return $this->render('index');
    }

    //会员详情
    public function actionInfo()
    {

        return $this->render('info');
    }

    //会员评论
    public function actionComment()
    {

        return $this->render('comment');
    }

    //会员编辑或者添加
    public function actionSet()
    {

        return $this->render('set');
    }

}
