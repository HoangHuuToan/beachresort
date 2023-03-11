<?php

include "../form/form_author.php";
include "../../controller/connect.php";

$table_name = $_GET['slug'];

$DB = new connect_DB("localhost","root","","beachresort");

$list_fields = $DB->get_list_fields($table_name);


if (isset($_POST['btn_submit'])) 
{   
    $name_author = $_POST['txt_name_author'];
    $number_phone_author = $_POST['txt_number_phone'];
    $email = $_POST['txt_email'];

    if(empty($name_author) || empty($number_phone_author) || empty($email))
    {
        die ("<script> alert('Mời Bạn Nhập Đầy Đủ Dữ Liệu !!!');</script>");
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name_author))
    {
		die ("<script> alert('Tên không được phép có ký tự đặc biệt') </script>");
	}
    else
    {
        $data_values = array(null,$name_author,$number_phone_author,$email);
        $data_inset = array_combine($list_fields,$data_values); //array_combine() tạo ra 1 mảng mới từ 2 mảng truyền vào, 1 mảng đầu làm key mảng 2 làm value

        $result = $DB->insert($table_name, $data_inset);
        if($result)
        {   
            $_SESSION['status_insert'] = true;
            header("Location: ../index.php?slug=authors");
        }
        else {
            echo "<script> alert('Nhập Không Thành Công !!!') </script>";
        }
    }
}

?>