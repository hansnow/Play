<?php 
session_start();
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
    <script src="common.js"></script>
    <style>body { padding-top: 50px; }</style>
</head>
<body>
    <div class="container">
        
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Play</a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">帮助<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="register.php" target="_blank">注册</a></li>
                        <li><a href="#">使用说明</a></li>
                        <li><a href="logout.php">注销</a></li>
                        <li class="divider"></li>
                        <li><a id="navbar_changelog" href="#">Change Log</a></li>
                        <li><a id="navbar_about" href="#">关于</a></li>
                    </ul>
                </li>
            </ul>
            <?php 
            if($_SESSION['login']){
                echo '<div id="login_panel" style="display:none">';
            }else{
                echo '<div id="login_panel">';
            }
            ?>
                <button id="login" class="btn btn-default btn-sm navbar-right navbar-btn">登录</button>
                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group">
                    <input id="username" type="text" class="form-control" placeholder="用户名">
                    <input id="password" type="password" class="form-control" placeholder="密码">
                  </div>
                </form>
            </div>
            <p id="welcome_text" class="navbar-text navbar-right">
                <?php 
                if($_SESSION['login']){
                    echo "Welcome Back! ";
                    echo $_SESSION['nickname'];
                }
                ?>
            </p>
          </div>
        </nav>



        <div class="row">
            <div class="jumbotron">
                <h2>LOGO HERE!</h2>
                <span class="lable label-success">Powered By HAN</span>
            </div>
        </div>
        <div class="row">
            <div id="main">
                <div class="col-md-8">
                    <div class="panel panel-default">
                      <div class="panel-heading">这里是最简单的测试消息</div>
                      <div class="panel-body">
                        <ul id="content" class="list-group">
                        
                        </ul>
                      </div>
                    </div>
                </div>
                
                <?php 
                if($_SESSION['login']){
                    echo '<div id="input_panel" class="col-md-4">';
                }else{
                    echo '<div id="input_panel" class="col-md-4" style="display:none">';
                }
                 ?>
                  <div class="input-group">
                    <input id="input" type="text" class="form-control">
                    <button id="submit" class="btn btn-default">提交</button>
                  </div>
            </div>      
        </div>

    </div>
    
</body>
</html>

