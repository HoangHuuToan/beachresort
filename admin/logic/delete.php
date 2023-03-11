<?php
    session_start();
    
    $tb_name = $_GET['slug'];
    $id_delete = $_GET['id'];

    include "../../controller/connect.php";
    $DB = new connect_DB("localhost","root","","beachresort");
    $list_fields = $DB->get_list_fields($tb_name);
    
    $result = $DB->delete($tb_name, $list_fields[0]."=".$id_delete ); //  $list_fields[0]."=".$id_delete <=> "<tên cột dữ liệu đầu tiên>"= id lấy qua $_GET[]

    if($result)
    {
        $_SESSION['status_delete'] = true;
        header("Location: ../index.php?slug=".$tb_name);
    }
    else {
        echo "<script> alert('Xóa Không Thành Công !!!') </script>";
    }
