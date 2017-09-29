<?php
namespace app\common\services;

//所有服务的基类
class BaseService
{
    protected static $_errer_msg = null;
    protected static $_errer_code = null;
    public static function _err( $msg ='',$code = -1){
        self::$_errer_msg =$msg;
        self::$_errer_code=$code;
        return false;
    }

    public static function getLastErrorMsg(){
        return self::$_errer_msg;
    }
    public static function getLastErrorCode(){
        return self::$_errer_code;
    }


}