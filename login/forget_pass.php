<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">user name:</label>
        <input type="text" name="txt_name">

        <label for="">mail :</label>
        <input type="text" name="txt_mail">

        <label for="">Số điện thoại :</label>
        <input type="text" name="txt_phone">

        <input type="submit" value="Lấy lại mật khẩu" name="btn_forget">
    </form>

    <?php
        include "../controller/connect.php";
        $DB = new connect_DB("localhost", "root", "", "beachresort");
        if(isset($_POST['btn_forget']))
        {
            $txt_name = $_POST['txt_name'];
            $txt_mail = $_POST['txt_mail'];
            $txt_phone = $_POST['txt_phone'];
            if(empty($txt_name) || empty($txt_mail) || empty($txt_phone))
            {
                die("<script> alert('Mời nhập đầy đủ thông tin để hệ thống kiểm tra !!!');</script>");
            }
            else
            {
                $result = $DB->get_row("SELECT  "."user_name, email, phone, pass_word FROM user WHERE user_name = '".$txt_name."' AND email = '".$txt_mail."' AND phone = '".$txt_phone."'");
                if($result)
                {
                    $txt_pass = $result['pass_word'];
                    die( "<script> alert('Mật khẩu của bạn là :".$txt_pass."');</script>");
                }
                else
                {
                    die( "<script> alert('Không tôn tại tài khoản trên !');</script>");
                }

            }
        }
        
    ?>
</body>
</html>