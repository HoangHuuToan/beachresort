<?php
include("connect.php");
$id_comment = $_GET['id_comment'];
$id_new = $_GET['id_new'];
$DB = new connect_DB("localhost", "root", "", "beachresort");

$result = $DB->update("comment", ['liked' => 1], "`id` = " . $id_comment);

if($result)
{
    header("Location: ../news.php?id_new=".$id_new);
}
?>