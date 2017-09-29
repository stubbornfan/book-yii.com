
upload  = {
    error:function(msg){
        common_ops.alert(msg);
    },
    success:function(image_key){
        //common_ops.alert(msg);
        var html ='<img src="'+common_ops.buildPicUrl("brand",image_key)+'"><span class="fa fa-times-circle del del_image" data="'+image_key+'"><i></i></span>';
        if( $(".upload_pic_wrap .pic-each").size() > 0 ) {
            $(".upload_pic_wrap .pic-each").html(html);
        }else{
            $(".upload_pic_wrap").append('<span class="pic-each">'+html+'</span>' );            
        }

        brand_set_ops.delete_img();
        
    }

};



var brand_set_ops ={
  init:function () {
    this.eventBind();
    this.delete_img();
  },
  eventBind:function () {
      //数据提交
      $(".wrap_brand_set .save").click(function () {
            var btn_target =$(this);
            if(btn_target.hasClass("disabled")){
                common_ops.alert("正在处理，请不要重复提交！");
                return;
            }

          var name =$(".wrap_brand_set input[name=name]").val();
          var image_key = $(".wrap_brand_set .pic-each .del_image").attr("data");
          var mobile =$(".wrap_brand_set input[name=mobile]").val();
          var address =$(".wrap_brand_set input[name=address]").val();
          var description =$(".wrap_brand_set textarea[name=description]").val();

          if(name.length <1 ){
              common_ops.tip("请输入符合规范的品牌名称",$(".wrap_brand_set input[name=name]"));
              return;
          }
          if( $(".wrap_brand_set .pic-each").size() <1 ) {
              common_ops.alert("请上传品牌LOGO~~");
              return; 
          }
          if(mobile.length <1 ){
              common_ops.tip("请输入符合规范的手机号码",$(".wrap_brand_set input[name=mobile]"));
              return;
          }
          if(address.length <1 ){
              common_ops.tip("请输入符合规范的地址",$(".wrap_brand_set input[name=address]"));
              return;
          }
          if(description.length <1 ){
              common_ops.tip("请输入符合规范的品牌描述",$(".wrap_brand_set textarea[name=description]"));
              return;
          }

          btn_target.addClass("disabled");
          var data = {
              name:name,
              image_key:image_key,
              mobile:mobile,
              address:address,
              description:description,
          };

          $.ajax({
              url:common_ops.buildWebUrl("/brand/set"),
              type:'POST',
              data:data,
              dataType:'json',
              success:function (res) {
                  btn_target.removeClass("disabled");
                  callback=null;
                  if( res.code == 200 ){
                      callback =function () {
                          window.location.href =common_ops.buildWebUrl("/brand/info");
                      }
                  }
                  common_ops.alert(res.msg,callback);

              }


          });




      });

      //图片上传
      $(".wrap_brand_set .upload_pic_wrap input[name=pic]").change(function () {
          $(".wrap_brand_set .upload_pic_wrap").submit();
      });
  },

    delete_img:function () {
        $(".wrap_brand_set .del_image").unbind().click(function () {
            $(this).parent().remove();
        });
    }

};

$(document).ready(function () {
    brand_set_ops.init();
});