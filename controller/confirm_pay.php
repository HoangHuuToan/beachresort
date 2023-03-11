<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include("connect.php");
    $DB = new connect_DB("localhost", "root", "", "beachresort");
    $data_user_login = $_SESSION['data_user_login'];

    $result = $DB->insert("bills",['id'=>null,'id_user'=>$_POST['id_user'],'date'=>$_POST['date'],'sum_price'=>$_POST['sum_price'],'status'=>null]);

    $DB->delete("order_cart","id_user =".$_POST['id_user']);
    ?>

</body>

</html>