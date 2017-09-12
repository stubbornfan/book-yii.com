<?php
namespace app\modules\web\controllers;
use yii\web\Controller;

class UserController extends Controller
{
    //登陆页面
    public function actionLogin()
    {
        $this->layout=false;
        return $this->render('login');

    }

    //重置当前登录人信息的
    public function actionEdit(){
        $this->layout=false;
        return $this->render('edit');
    }

    //重置当前人登陆密码
    public function actionResetPwd(){
        $this->layout=false;
        return $this->render('reset_pwd');
    }

}
