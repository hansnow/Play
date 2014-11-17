<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'lib/rb.php';
    require 'db_d.php';
    R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nickname = $_POST['nickname'];
    $res = R::exec('INSERT INTO play_user (username,password,nickname) VALUES (:u,:p,:n)',[':u'=>$username,':p'=>$password,':n'=>$nickname]);
    if($res){
        $response = array('status'=>'0','message'=>'Success');
        echo json_encode($response);
        die();
    }else{
        $response = array('status'=>'-1','message'=>'fail');
        echo json_encode($response);
        die();
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>Let's play a GAME</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="lib/sweetalert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/sweetalert/sweet-alert.css">
    <script src="lib/md5.min.js"></script>
    <script>
    $(document).ready(function(){
        $("#submit").click(function(){
            if($("#password1").val() == $("#password2").val()){
                if($("#username").val()=="" || $("#nickname").val()=="" || $("#password1").val()=="" || $("#password2").val()==""){
                    swal("", "用户名或昵称或密码为空", "error");
                }else{
                    $.post("register.php",
                        {
                            "username":$("#username").val(),
                            "password":md5($("#password1").val()),
                            "nickname":$("#nickname").val()
                        },function(data){
                        response = JSON.parse(data);
                        if(response.status == 0){
                            swal({title:"",
                                text: "注册成功",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "跳转到首页",
                                closeOnConfirm: false },function(){
                                    window.location.href='index.php';
                                });
                        }else{
                            swal({title:"",
                                text: "注册失败",
                                type: "error",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "跳转到首页",
                                closeOnConfirm: false },function(isConfirm){
                                    if(isConfirm){
                                        window.location.href='index.php';
                                    }
                                });
                        }
                    });
                }
            }else{
                swal("", "两次输入的密码不一致", "error");
            }
        });
    });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h2>LOGO HERE!</h2>
                <span class="lable label-success">Powered By HAN</span>
            </div>
        </div>
        <div class="row">
            <div id="main">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form role="form">
                          <div class="form-group">
                            <label for="username">请输入用户名</label>
                            <input type="text" class="form-control" id="username" placeholder="用户名">
                          </div>
                          <div class="form-group">
                            <label for="nickname">请输入昵称</label>
                            <input type="text" class="form-control" id="nickname" placeholder="昵称">
                          </div>
                          <div class="form-group">
                            <label for="password1">请输入密码</label>
                            <input type="password" class="form-control" id="password1" placeholder="密码">
                          </div>
                          <div class="form-group">
                            <label for="password2">请再输一次密码</label>
                            <input type="password" class="form-control" id="password2" placeholder="密码，再一次">
                          </div>
                        </form>
                          <div class="row">
                              <div class="col-md-5"></div>
                              <div class="col-md-2">
                                  <button id="submit" class="btn btn-default btn-block">提交</button>
                              </div>
                          </div>
                    </div>
                    
                </div>
            </div>      
        </div>

    </div>
    
</body>
</html>

