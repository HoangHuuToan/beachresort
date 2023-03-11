
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    include "../controller/connect.php";
    session_start();

?>
<body>
    <form action="" method="post" enctype="multipart/form-data">


        <label for="">name :</label>
        <input type="text" name="txt_user_name">
    <br>
    <br>
        <label for="">pass :</label>
        <input type="password" name="txt_pass">
    <br>
    <br>
        <label for="">repass :</label>
        <input type="password" name="txt_repass">
    <br>
    <br>
        <label for="">birth day :</label>
        <input type="date" name="txt_birth_day" id="">
    <br>
    <br>
        <label for="">Email :</label>
        <input type="text" name="txt_mail">
    <br>
    <br>
        <label for="">Phone :</label>
        <input type="text" name="txt_phone">
    <br>
    <br>
        <label for="">Gende :</label>
        <input type="radio" name="txt_gende"  value="nam"> Male
        <input type="radio" name="txt_gende"  value="nữ"> Femal
    <br>
    <br>   
        <label for="">Ảnh đại diện :</label>
        <input type="file" name="txt_avt">
    <br>
    <br>

        <input type="submit" value="Đăng Ký" name="btn_register">
        
    </form>
</body>
</html>
<?php
$DB = new connect_DB("localhost", "root", "", "beachresort");

if (isset($_POST['btn_register'])) {
    $txt_user_name = $_POST['txt_user_name'];
    $txt_pass = $_POST['txt_pass'];
    $txt_repass = $_POST['txt_repass'];
    $txt_birth_day = $_POST['txt_birth_day'];
    $txt_mail = $_POST['txt_mail'];
    $txt_phone = $_POST['txt_phone'];
    $txt_gende = $_POST['txt_gende'];
    $txt_avt = $_FILES['txt_avt'];

    if (
        empty($txt_user_name)
        || empty($txt_pass)
        || empty($txt_repass)
        || empty($txt_birth_day)
        || empty($txt_mail)
        || empty($txt_phone)
        || empty($txt_avt)
    ) {
        die("<script> alert ('Bạn chưa nhập đầy đủ thông tin để đăng ký , Mời nhập và đăng ký lại');</script>");
    } else {
        //validate user name

        $old_data = $DB->get_list("SELECT * FROM user");
        $list_name_user_old = array_column($old_data, "user_name");

        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $txt_user_name)) {
            die("<script>alert('Tên không được phép chưa ký tự đặc biệt');</script>");
        }
        if (in_array($txt_user_name, $list_name_user_old)) {
            die("<script>alert ('Tên này đã tồn tại !');</script>");
        }
        if (!filter_var($txt_mail, FILTER_VALIDATE_EMAIL)) {
            die("<script>alert('Mail không đúng định dạng mời nhập lại !');</script>");
        }
        if ($txt_pass != $txt_repass) {
            die("<script>alert('Mật khẩu nhập lại không khớp xin nhập lại !!!');</script>");
        }

        //process avatar
        $target_dir = "../user/avatar/";
        $target_file = $target_dir . $txt_user_name."_avatar.jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES['txt_avt']['name'], PATHINFO_EXTENSION));

        $real_name_file = $_FILES["txt_avt"]["name"];
        $tmp_name_file = $_FILES['txt_avt']['tmp_name'];
        //check image
        $check = getimagesize($tmp_name_file);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType == "jpg" 
            || $imageFileType == "png" 
            || $imageFileType == "jpeg"
            || $imageFileType == "gif") 
        {
            $uploadOk = 1;
        }
        else
        {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            die("Sorry, your file was not uploaded.") ;
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($tmp_name_file, $target_file)) {
                echo "The file " . htmlspecialchars(basename($real_name_file)) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


        $list_fields = $DB->get_list_fields("user");
        $txt_avt = "beachresort/user/avatar/" . basename($target_file);
        $list_values = [null,$txt_user_name, $txt_pass, $txt_birth_day, $txt_mail, $txt_phone, $txt_gende, $txt_avt];

        $data_user_insert = array_combine($list_fields,$list_values);

        $result= $DB->insert('user', $data_user_insert);

        if($result)
        {
            header("Location: index.php");
            $_SESSION['status_register'] = true;
        }
    }
}
?>