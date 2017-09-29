<?php
namespace app\modules\web\controllers;
use app\common\services\ConstantMapService;
use app\models\member\Member;
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
        if( \Yii::$app->request->isGet ){
            $id = intval($this->get("id",0));
            $info =[];
            if($id){
                $info = Member::find()->where(['id'=>$id])->one();
             }
            return $this->render('set',[
                'info'=>$info
            ]);
        }

        $id = intval($this->post("id",0) );
        $nickname = trim( $this->post("nickname","") );
        $mobile = trim( $this->post("mobile",0));

        if(mb_strlen($nickname,"utf-8")<1){
            return $this->renderJSON([],"请输入符合规范的姓名~",-1);
        }
        if(mb_strlen($mobile,"utf-8")<1){
            return $this->renderJSON([],"请输入符合规范的手机号码~",-1);
        }

        $info = [];
        if($id){
            $info = Member::findOne(['id'=>$id]);
        }
        if($info){
            $model_member = $info;
        }else{
            $model_member = new Member();
            $model_member->status =1;
            $model_member->avatar = ConstantMapService::$default_avatar;
            $model_member->created_time = date("Y-m-d H:i:s");
        }

        $model_member->nickname = $nickname;
        $model_member->mobile = $mobile;
        $model_member->updated_time=date("Y-m-d H:i:s");
        $model_member->save(0);
        return $this->renderJSON([],"操作成功~~");

    }

}
