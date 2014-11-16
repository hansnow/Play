<?php 
require 'rb.php';
require 'db_config.php';
R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
$post_list = R::getAll('SELECT * FROM pb_post ORDER BY id DESC');

 ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>PlantBooster(site4test)</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){

    });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h2>LOGO HERE!</h2>
                <span class="lable label-success">Powered By PBTeam</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">这里是最简单的测试消息</div>
                  <div class="panel-body">
                    <ul class="list-group">
                      <?php 
                      foreach($post_list as $post_item){
                        echo '<li class="list-group-item">'.$post_item['content'].' @ '.$post_item['time'].'</li>';
                      }
                       ?>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                  <h4>请求方法</h4>
                  <h6>url:add.php</h6>
                  <h6>method:POST</h6>
                  <h6>param:'content':'你要发表的内容','code':'校验码'</h6>
                </div>

                <ul class="list-group">
                  <li class="list-group-item list-group-item-success">{"status":"0","msg":"Success"}</li>
                  <li class="list-group-item list-group-item-warning">{"status":"1","msg":"Post Error"}</li>
                  <li class="list-group-item list-group-item-danger">{"status":"-1","msg":"Auth Error"}</li>
                </ul>
            </div>

        </div>
        <div class="row">
            <br>
            <br>
        </div>
        <div class="row">
            <div id="main">
                
            </div>
        </div>
    </div>
    
</body>
</html>