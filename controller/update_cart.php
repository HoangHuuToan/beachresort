<?php 
include("connect.php");

$DB = new connect_DB("localhost", "root", "", "beachresort");

$DB->update("order_cart",['cout'=>$_POST['value']],'id = '.$_POST['id']);
 
?>