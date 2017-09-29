<?php
namespace app\modules\web\controllers\common;
use app\common\components\BaseWebController;
use app\common\services\applog\AppLogService;
use app\common\services\UrlService;
use app\models\log\AppAccessLog;
use app\models\User;

//web 统一控制器 当中会做一些web独有的验证
//1 指定特定的布局文件
//2 进行登陆验证
class BaseController extends BaseWebController
{
    private $auth_cookie_name = "mooc_book";
    public $current_user = null; //当前登录人信息
    public $allowAllAction =[
      "web/user/login"
    ];

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    //登陆统一验证
    public function beforeAction($action)
    {
        //验证是否登录
        $is_login = $this->checkLoginStatus();
        if(in_array( $action->getUniqueId(),$this->allowAllAction )){
            return true;

        }

        if(!$is_login){
            if( \Yii::$app->request->isAjax){
                $this->renderJSON([],"未登录，请先登录",-302);
            }else{
                $this->redirect(UrlService::buildWebUrl("/user/login"));
            }
            return false;
        }

        //记录所有用户的访问信息
        AppLogService::addAppAccessLog($this->current_user['uid']);
        return true;
    }

    /**
     * 目的：验证是否当前登录态有效 true or false
     */
    private function checkLoginStatus(){

        $auth_cookie = $this->getCookie($this->auth_cookie_name,"");
        if( !$auth_cookie){
            return false;
        }

        list($auth_token,$uid) = explode("#",$auth_cookie);
        if( !$auth_cookie || !$uid ){
            return false;
        }

        if( !preg_match( "/^\d+$/",$uid)){
            return false;
        }

        /**
         *取出用户信息
         */
        $user_info = User::find()->where(['uid'=>$uid])->one();
        if( !$user_info ){
            return false;
        }


        if( $auth_token != $this->geneAuthToken($user_info) ){
            return false;
        }

        $this->current_user = $user_info;

        return true;

    }

    //加密字符串 + “#”+uid, 加密字符串 = md5( login_name + login_pwd + login_salt )
    public function geneAuthToken($user_info){
        return md5( $user_info['login_name'].$user_info['login_pwd'].$user_info['login_salt']);
    }

    public function removeLoginStatus(){
        $this->removeCookie($this->auth_cookie_name);
    }


    //设置登录态的方法
    public function setLoginStatus($user_info){
        $auth_token = $this->geneAuthToken($user_info);
        $this->setCookie($this->auth_cookie_name,$auth_token."#".$user_info['uid']);
    }



}