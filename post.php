<?php 
session_start();
require 'lib/rb.php';
require 'db_d.php';
R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
if($_POST['content']){
  $input_content = $_POST['content'];
  if($_SESSION['login'] && $_SESSION['userid']){
    $userid = $_SESSION['userid'];
    R::exec('INSERT INTO play_post (content,owner,date) VALUES (:content,:userid,NOW())',[':content'=>$input_content,':userid'=>$userid]);
  }else{
    echo "user not login or user doesn't have id @post.php line 8";
  }
}

if($_GET['type']=='all'){
  $post_list = R::getAll('SELECT * FROM play_post ORDER BY date DESC');
  foreach($post_list as $post_item){
     $owner = R::getRow('SELECT * FROM play_user WHERE id=:owner',[':owner'=>$post_item['owner']]);
     echo '<div id="post'.$post_item['id'].'" class="row">';
     echo '<div class="col-md-10">';
     echo '<li class="list-group-item">'.'['.$owner['nickname'].'] '.$post_item['content'].' @ '.$post_item['date'].'</li>';
     echo '</div>';
     echo '<div class="col-md-2">';
     
     if($post_item['owner']==$_SESSION['userid']){
      echo '<button del="'.$post_item['id'].'" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove"></span></button>';
     }else{
      echo '<button del="'.$post_item['id'].'" class="btn btn-danger btn-block" noauth="'.$post_item['owner'].'" style="display:none"><span class="glyphicon glyphicon-remove"></span></button>';
     }
     echo '</div>';
     echo '</div>';
   }
}

if ($_GET['type']=='new') {
  $post_item = R::getRow('SELECT * FROM play_post ORDER BY date DESC LIMIT 1');
  echo '<div id="post'.$post_item['id'].'" class="row">';
  echo '<div class="col-md-10">';
  echo '<li class="list-group-item">'.'['.$_SESSION['nickname'].'] '.$post_item['content'].' @ '.$post_item['date'].'</li>';
  echo '</div>';
  echo '<div class="col-md-2">';
  echo '<button del="'.$post_item['id'].'" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove"></span></button>';
  echo '</div>';
  echo '</div>';
}

if($_POST['type']=='del' && $_POST['delid']){
    $delid = $_POST['delid'];
    $owner = R::getCell('SELECT owner FROM play_post WHERE id=:delid',[':delid'=>$delid]);
    if($owner == $_SESSION['userid']){
      $res = R::exec('DELETE FROM play_post WHERE id=:delid',[':delid'=>$delid]);
      echo $res;
    }else{
      echo 'No auth to delete';
    }
}

 ?>

