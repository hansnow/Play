<?php 
require 'rb.php';
require 'db_config.php';
R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
$post_content = $_POST['content'];
$post_code = $_POST['code'];

$res = R::exec('INSERT INTO pb_post (content,time) VALUES (:content,NOW())',[':content'=>$post_content]);
if($res){
    echo 'success';
}else{
    echo 'post error';
}

 ?>


