var account_set_ops ={
    init:function() {
        this.eventBind();

    },

    eventBind:function () {
        $(".wrap_account_set .save").click(function () {
            var btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理，请不要重复提交~");
                return;
            }

            var nickname = $(".wrap_account_set input[name=nickname]").val();
            var mobile = $(".wrap_account_set input[name=mobile]").val();
            var email = $(".wrap_account_set input[name=email]").val();
            var login_name = $(".wrap_account_set input[name=login_name]").val();
            var login_pwd = $(".wrap_account_set input[name=login_pwd]").val();

            if (nickname.length < 1) {
                common_ops.tip("请输入符合规范的姓名~", $(".wrap_account_set input[name=nickname]"));
                return;
            }

            if (mobile.length < 1) {
                common_ops.tip("请输入符合规范的手机号码", $(".wrap_account_set input[name=mobile]"));
                return;
            }

            if (email.length < 1) {
                common_ops.tip("请输入符合规范的email~", $(".wrap_account_set input[name=email]"));
                return;
            }
            if (login_name.length < 1) {
                common_ops.tip("请输入符合规范的登录名~", $(".wrap_account_set input[name=login_name]"));
                return;
            }
            if (login_pwd.length < 1) {
                common_ops.tip("请输入符合规范的密码~", $(".wrap_account_set input[name=login_pwd]"));
                return;
            }


            btn_target.addClass("disabled");
            var data = {
                nickname: nickname,
                mobile: mobile,
                email: email,
                login_name: login_name,
                login_pwd: login_pwd,
                id:$(".wrap_account_set input[name=id]").val()

            };




            $.ajax({
                url: common_ops.buildWebUrl("/account/set"),
                type:'POST',
                data:data,
                dataType:'json',
                success:function (res) {
                    btn_target.removeClass("disabled");
                    var callback = null;
                    if(res.code == 200){
                        callback=function () {
                            window.location.href =common_ops.buildWebUrl("/account/index");
                        }
                    }
                    common_ops.alert(res.msg,callback);
                }

        });

        });
    }
};

$(document).ready(function () {
   account_set_ops.init();
});