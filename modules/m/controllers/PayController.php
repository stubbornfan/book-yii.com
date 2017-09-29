<?php
namespace app\modules\m\controllers;
use app\modules\m\controllers\common\BaseController;


class PayController extends BaseController
{
    //支付页面
    public function actionBuy()
    {

        return $this->render("buy");
    }
}
