<?php

$table_name = $_GET['slug'];
$id = $_GET['id'];
$status = $_GET['status'];


include("../../controller/connect.php");

$DB = new connect_DB("localhost", "root", "","beachresort");

$result = $DB->update($table_name, ['status' => $status], "id =".$id);

if($result)
{
    if($status == 1)
    {   
        echo "<script>alert('Confirm thành công');</script>";
        echo "<script>location.href = '../index.php';</script>";
    }
    if($status == 0)
    {   
        echo "<script>alert('Bài viết đã được bỏ qua');</script>";
        echo "<script>location.href = '../index.php';</script>";
    }
}

?>