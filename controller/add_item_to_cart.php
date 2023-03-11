<?php
session_start();
include("connect.php");
$DB = new connect_DB("localhost", "root", "", "beachresort");
$data_user_login = $_SESSION['data_user_login'];

$result = $DB->get_list("SELECT * FROM order_cart WHERE id_user =".$data_user_login['id_user']." AND id_room =".$_POST['id_room']);

if( count($result) > 0)
{
    $DB->update("order_cart",['cout'=>$result[0]['cout']+1],"id =".$result[0]['id']);
}else
{
    $DB->insert("order_cart",['id'=>null,'id_user'=>$data_user_login['id_user'],'id_room'=>$_POST['id_room'],'cout'=>1]);
}

?>