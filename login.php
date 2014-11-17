<?php 
session_start();
require 'lib/rb.php';
require 'db_d.php';
R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
if($_POST['username'] && $_POST['password']){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = R::getRow('SELECT * FROM play_user WHERE username=:u AND password=:p',[':u'=>$username,':p'=>$password]);
  if($query){
    $nickname = $query['nickname'];
    $userid = $query['id'];
    $_SESSION['username'] = $username;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['login'] = 1;
    $_SESSION['userid'] = $userid;
    echo $_SESSION['nickname'];
    echo '|'.$_SESSION['userid'];
  }
}else{
  $_SESSION['login'] = 0;
  echo 'Login error';
}
  

 ?>

