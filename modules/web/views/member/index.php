<?php
use \app\common\services\StaticService;
use \app\common\services\UrlService;
StaticService::includeAppJsStatic("/js/web/member/index.js",app\assets\WebAsset::className());
?>
<?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/tab_member.php", ['current' => 'index']); ?>

        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline wrap_search">
                    <div class="row  m-t p-w-m">
                        <div class="form-group">
                            <select name="status" class="form-control inline">
                                <option value="-1">请选择状态</option>
                                <option value="1"  >正常</option>
                                <option value="0"  >已删除</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="mix_kw" placeholder="请输入关键字" class="form-control" value="">
                                <span class="input-group-btn">
                            <button type="button" class="btn  btn-primary search">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-w-m btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/member/set");?>">
                                <i class="fa fa-plus"></i>会员
                            </a>
                        </div>
                    </div>

                </form>
                <table class="table table-bordered m-t">
                    <thead>
                    <tr>
                        <th>头像</th>
                        <th>姓名</th>
                        <th>手机</th>
                        <th>性别</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><img alt="image" class="img-circle" src="/uploads/avatar/20170313/159419a875565b1afddd541fa34c9e65.jpg" style="width: 40px;height: 40px;"></td>
                        <td></td>
                        <td></td>
                        <td>未填写</td>
                        <td>正常</td>
                        <td>
                            <a  href="/web/member/info?id=1">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                            <a class="m-l" href="/web/member/set?id=1">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a class="m-l remove" href="javascript:void(0);" data="1">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php echo \Yii::$app->view->renderFile("@app/modules/web/views/common/pagination.php", [
                    'pages' => $pages,
                    'url' => '/member/index'
                ]); ?>
            </div>
        </div>




