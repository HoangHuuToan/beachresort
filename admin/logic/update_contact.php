<?php
include "../../controller/connect.php";
$id_contact = $_GET['id'];
$table_name = $_GET['slug'];

$DB = new connect_DB("localhost","root","","beachresort");

$list_fields = $DB->get_list_fields($table_name);
$data = $DB->get_row("SELECT * FROM ".$table_name." WHERE ".$list_fields[0]."=".$id_contact );

?>
<div class="name_site_admin">
    <h1>Cập Nhật Dữ Liệu Cho Contact</h1>
</div>


<div class="container">
    <form action="" method="post">
        <table>
            <tbody>
                <tr>
                    <td> <label for="">Name:</label> </td>
                    <td><input type="text" class="txtfield" name="txt_name" value="<?php echo $data['name']?>" /></td>
                </tr>
                <tr>
                    <td> <label for="">Email:</label> </td>
                    <td><input type="text" class="txtfield" name="txt_email" value="<?php echo $data['email']?>"/></td>
                </tr>
                <tr>
                    <td><label for="">Subject:</label> </td>
                    <td><input type="text" class="txtfield" name="txt_subject" value="<?php echo $data['subject']?>"/></td>
                </tr>
                <tr>
                    <td class="txtarea"> <label for="">Message:</label> </td>
                    <td><textarea name="txt_message"><?php echo $data['message']?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="btn" name="btn_update" value="Cập Nhật"></td>
                </tr>
            </tbody>
        </table>
    </form>

</div>
<?php

if(isset($_POST['btn_update']))
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
		$list_values = array($id_contact,$edt_name,$edt_email,$edt_subject,$edt_message);
		$data_inset = array_combine($list_fields,$list_values);

		var_dump($data_inset);
		$result = $DB->update($table_name, $data_inset,$list_fields[0]." = ".$id_contact);

        if($result)
            {   
                $_SESSION['status_update'] = true;
                header("Location: ../index.php?slug=contact");
            }
            else {
                echo "<script> alert('Cập Nhật Không Thành Công !!!') </script>";
            }
		
	}
}
?>