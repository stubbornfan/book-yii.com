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
        if( !$user_info->verifyPassword($login_pwd) ){
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
        if( \Yii::$app->request->isGet){
            //获取当前登录人
            return $this->render('edit',['user_info'=>$this->current_user]);
        }

        $nickname = trim($this->post("nickname",""));
        $email = trim($this->post("email",""));

        if( mb_strlen( $nickname,"utf-8") <1 ){
            return $this->renderJSON([],"请输入合法的姓名~~",-1);
        }
        if( mb_strlen( $email,"utf-8" ) <1 ){
            return $this->renderJSON([],"请输入合法的邮箱~~",-1);
        }

        $user_info = $this->current_user;
        $user_info->nickname =$nickname;
        $user_info->email =$email;
        
        $user_info->updated_time =date("Y-m-d H:i:s");
        $user_info->update(0);
        
        return $this->renderJSON([],"编辑成功");



    }

    /*
     * 重置当前人登陆密码
     */
    public function actionResetPwd()
    {
        if(\Yii::$app->request->isGet){
            return $this->render('reset_pwd',['user_info'=>$this->current_user]);
        }

        $old_passowrd = trim($this->post("old_password",""));
        $new_passowrd = trim($this->post("new_password",""));

        if(mb_strlen($old_passowrd,"utf-8") < 1){
            return $this->renderJSON([],"请输入原密码~",-1);
        }
        if(mb_strlen($new_passowrd,"utf-8") < 6){
            return $this->renderJSON([],"请输入不少于6位新密码~",-1);
        }

        if($old_passowrd == $new_passowrd){
            return $this->renderJSON([],"新密码和老密码不能相同~",-1);
        }

        /**
         * 判断原密码是否正确
         */
        $user_info = $this->current_user;

        if( $user_info->verifyPassword($old_passowrd) ){
            return $this->renderJSON([],"请检查原密码是否正确~",-1);
        }

        $user_info->setPassword($new_passowrd);
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);

         //重新设置登录态
        $this->setLoginStatus($user_info);

         return $this->renderJSON([],"重置密码成功~");


    }

    public function actionLogout(){
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }

}
