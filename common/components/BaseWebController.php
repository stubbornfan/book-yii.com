<?php
namespace app\common\components;

use yii\web\Controller;

/**
 * 集成常用公用方法，提供给所有的Controller使用
 * @package app\common\components
 *  get post,setCookie,getCookie,removeCookie,renderJson
 */
class BaseWebController extends Controller
{
    public $enableCsrfValidation = false; // 关闭csrf

    //获取http的get参数
    public function get($key,$default_val = ""){
        return \Yii::$app->request->get($key,$default_val);
    }

    //获取http的post参数
    public function post($key,$default_val = ""){
        return \Yii::$app->request->post($key,$default_val);
    }

    //设置Cookie值
    public function setCookie($name,$value,$expire = 0){
        $cookie = \Yii::$app->response->cookies;
        $cookie->add( new \yii\web\Cookie([
            'name'=>$name,
            'value'=>$value,
            'expire' =>$expire,
        ]));
    }

    //获取Cookie
    public function getCookie($name,$default_val = ''){
        $cookie = \Yii::$app->request->cookies;
        return $cookie->getValue( $name,$default_val );
    }

    //删除Cookie
    public function removeCookie($name){
        $cookie = \Yii::$app->response->cookies;
        $cookie->remove($name);
    }

    //API 统一返回json格式方法
    protected function renderJSON($data=[], $msg ="ok", $code = 200)
    {
        header('Content-type: application/json');
        echo json_encode([
            "code" => $code,
            "msg"   =>  $msg,
            "data"  =>  $data,
            "req_id" =>  uniqid()
        ]);

        return \Yii::$app->end();
    }

    //统一JS提醒
    public function renderJs($msg,$url){
        return $this->renderPartial( "@app/views/common/js",[ 'msg'=>$msg,'url'=>$url]);
    }













}