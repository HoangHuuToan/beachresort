<?php
session_start();
include("connect.php");

$data_user_login = $_SESSION['data_user_login'];
$id_cmt = $_GET['id_cmt'];
$id_new = $_GET['id_new'];
$txt_cmt = $_POST['txt_reply_comment'];

if(empty($txt_cmt))
{
    echo "<script>  
                alert('Bạn chưa nhập nội dung bình luận');
                location.href='../news.php?id_new=$id_new';
        </script>";
        
}else{
        $DB = new connect_DB("localhost", "root", "", "beachresort");
        $list_fields_comment = $DB->get_list_fields("comment");
        var_dump($list_fields_comment);
        $list_value_comment = [null, $id_new, $data_user_login['id_user'], $txt_cmt, $id_cmt, null];

        $data_insert_comment = array_combine($list_fields_comment, $list_value_comment);

        $result = $DB->insert("comment", $data_insert_comment);
        if($result)
        {
                echo "<script>  
                        location.href='../news.php?id_new=$id_new';
                </script>";
        }
}
?>