<?php
namespace app\modules\web\controllers;
use yii\web\Controller;

class UserController extends Controller
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }

    //登陆页面
    public function actionLogin()
    {
        $this->layout="user";
        return $this->render('login');

    }

    //重置当前登录人信息的
    public function actionEdit(){

        return $this->render('edit');
    }

    //重置当前人登陆密码
    public function actionResetPwd(){

        return $this->render('reset_pwd');
    }

}
