<?php
namespace app\modules\web\controllers;
use app\common\services\ConstantMapService;
use app\models\brand\BrandImages;
use app\models\brand\BrandSetting;
use app\modules\web\controllers\common\BaseController;
use yii\web\Controller;


class BrandController extends BaseController
{

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout="main";
    }

    //品牌详情
    public function actionInfo()
    {
        $info =BrandSetting::find()->one();

        return $this->render("info",[
            'info'=>$info,

        ]);
    }

    //品牌编辑
    public function actionSet()
    {
        if(\Yii::$app->request->isGet){
            $info =BrandSetting::find()->one();
            return $this->render("set",[
                'info'=>$info,
            ]);
        }

        $name = trim($this->post("name",""));
        $image_key = trim($this->post("image_key",""));
        $mobile = trim($this->post("mobile",""));
        $address = trim($this->post("address",""));
        $description = trim($this->post("description",""));

        if( mb_strlen($name,"utf-8") <1 ){
            return $this->renderJSON([],"请输入符合规范的品牌名称",-1);
        }
        if( !$image_key ){
            return $this->renderJSON([],"请上传品牌LOGO~~",-1);
        }
        if( mb_strlen($mobile,"utf-8") <1 ){
            return $this->renderJSON([],"请输入符合规范的品牌号码",-1);
        }
        if( mb_strlen($address,"utf-8") <1 ){
            return $this->renderJSON([],"请输入符合规范的品牌地址",-1);
        }
        if( mb_strlen($description,"utf-8") <1 ){
            return $this->renderJSON([],"请输入符合规范的品牌介绍",-1);
        }

        $info  = BrandSetting::find()->one();
        if($info){
            $model_info = $info;
        }else{
            $model_info = new BrandSetting();
            $model_info->created_time = date("Y-m-d H:i:s");
        }

        $model_info->name = $name;
        $model_info->logo = $image_key;
        $model_info->mobile = $mobile;
        $model_info->address =$address;
        $model_info->description =$description;
        $model_info->updated_time =date("Y-m-d H:i:s");
        $model_info->save( 0 );
        return $this->renderJSON([],"操作成功");










    }

    //品牌相册
    public function actionImages()
    {
        $list = BrandImages::find()->orderBy(['id'=>SORT_DESC])->all();
        return $this->render("images",[
            'list'=>$list,
        ]);
    }

    //相册编辑或删除
    public function actionSetImage(){
        $image_key = trim($this->post("image_key",""));
        if(!$image_key){
            return $this->renderJSON([],"请上传图片之后在提交吧~",-1);
        }

        $total_count = BrandSetting::find()->count();
        if($total_count >= 5){
            return $this->renderJSON([],"最多只能上传5张哦~",-1);
        }
        $model = new BrandImages();
        $model->image_key = $image_key;
        $model->created_time =date("Y-m-d H:i:s");
        $model->save(0);
        return $this->renderJSON([],"操作成功~");

    }
    public function actionImagesOps(){
        if(  !\Yii::$app->request->isPost){
            return $this->renderJSON([],ConstantMapService::$default_syserror,-1);
        }

        $id = $this->post('id',[]);
        if(!$id){
            return $this->renderJSON([],"请选择要删除的图片~",-1);
        }
        $info = BrandImages::find()->where(['id'=>$id])->one();
        if(!$info){
            return $this->renderJSON([],"指定图片不存在~~",-1);
        }
        $info->delete();
        return $this->renderJSON([],"操作成功~");

    }




}
