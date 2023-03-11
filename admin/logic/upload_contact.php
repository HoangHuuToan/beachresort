<?php
include "../form/form_contact.php";
include "../../controller/connect.php";
$DB = new connect_DB("localhost", "root", "", "beachresort");

$list_fields = $DB->get_list_fields("contact");


if(isset($_POST['btn_submit']))
{
	$edt_name = $_POST['txt_name'];
	$edt_email = $_POST['txt_email'];
	$edt_subject = $_POST['txt_subject'];
	$edt_message = $_POST['txt_message'];
	//list_fields : $list_fields
	$list_values;
	if(empty($edt_name) || empty($edt_email) || empty($edt_subject) || empty($edt_message) )
	{
		die ("<script> alert('Mời bạn nhập đầy đủ thông tin để gửi dữ liệu đến quản trị viên !!') </script>");
	}
	else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $edt_name)){
		die ("<script> alert('user name không được phép có ký tự đặc biệt') </script>");
	}
	else{
		$list_values = array(null,$edt_name,$edt_email,$edt_subject,$edt_message);
		$data_inset = array_combine($list_fields,$list_values);

		var_dump($data_inset);
		$result = $DB->insert("contact", $data_inset);

        if($result)
            {   
                $_SESSION['status_insert'] = true;
                header("Location: ../index.php?slug=contact");
            }
            else {
                echo "<script> alert('Nhập Không Thành Công !!!') </script>";
            }
		
	}
}
?>