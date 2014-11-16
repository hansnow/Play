<?php 
require 'rb.php';
require 'db_config.php';
R::setup('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
$post_content = $_POST['content'];
$post_code = $_POST['code'];
$response = array('status'=>'',
                    'msg'=>'');
if($post_code=='2333'){
    $res = R::exec('INSERT INTO pb_post (content,time) VALUES (:content,NOW())',[':content'=>$post_content]);
    if($res){
        $response['status'] = '0';
        $response['msg'] = 'Success';
        echo json_encode($response);
    }else{
        $response['status'] = '1';
        $response['msg'] = 'Post Error';
        echo json_encode($response);
    }
}else{
    $response['status'] = '-1';
    $response['msg'] = 'Auth Error';
    echo json_encode($response);
}
 ?>


