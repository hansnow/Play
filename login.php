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
    $response = array('status'=>'0','message'=>'Success','userid'=>$_SESSION['userid'],'nickname'=>$_SESSION['nickname']);
    echo json_encode($response);
  }else{
    $response = array('status'=>'404','message'=>'Wrong username or password');
    echo json_encode($response);
  }
}else{
  $_SESSION['login'] = 0;
  $response = array('status'=>'-1','message'=>'Error in POST username or password');
  echo json_encode($response);
}
  

 ?>

