<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;


class UserController extends BaseController
{


    //登陆页面
    public function actionLogin()
    {
        //如果是get请求，直接展示登陆页面
        if(\Yii::$app->request->isGet){

            $this->layout = "user";
            return $this->render('login');
        }
        //登陆逻辑处理
        $login_name = trim($this->post("login_name",''));
        $login_pwd = trim($this->post("login_pwd",''));
        if(!$login_name || !$login_pwd){
            return $this->renderJs('请输入正确的用户名和密码~！',UrlService::buildWebUrl("/user/login"));

        }

        //从用户表 获取 login_name = $login_name 信息是否存在
        $user_info = User::find()->where(['login_name'=>$login_name])->one();
        if(!$user_info){
            return $this->renderJs('请输入正确的用户名和密码~~！',UrlService::buildWebUrl("/user/login"));

        }

        //验证密码
        //密码加密算法 = md5( login_pwd + md5(login_salt) )
        $auth_pwd = md5( $login_pwd.md5($user_info['login_salt']));
        if( $auth_pwd != $user_info['login_pwd']){
            return $this->renderJs('请输入正确的用户名和密码~~~！',UrlService::buildWebUrl("/user/login"));
        }

        //保存用户的登陆状态
        //cookie进行保存用户的登录态，session 和cookie 之间有什么区别?
        //加密字符串 + “#”+uid, 加密字符串 = md5( login_name + login_pwd + login_salt )

        $this->setLoginStatus($user_info);
        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));

    }

    //重置当前登录人信息的
    public function actionEdit()
    {

        return $this->render('edit');
    }

    //重置当前人登陆密码
    public function actionResetPwd()
    {

        return $this->render('reset_pwd');
    }

    public function actionLogout(){
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }

}
