<?php
namespace app\common\services;


class ConstantMapService
{

    public static $status_default = -1;
    public static $default_avatar = "default_avatar";
    public static $default_password = "******";
    public static $default_syserror = '系统繁忙，请稍后再试~~';

    public static $status_mapping = [
        1 =>'正常',
        0=> '已删除'
    ];

}