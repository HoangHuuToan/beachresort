<?php
include "../../controller/connect.php";
$id_author = $_GET['id'];
$table_name = $_GET['slug'];

$DB = new connect_DB("localhost","root","","beachresort");

$list_fields = $DB->get_list_fields($table_name);
$data = $DB->get_row("SELECT * FROM ".$table_name." WHERE ".$list_fields[0]."=".$id_author );

?>  
    <div class="name_site_admin">
        <h1>Cập Nhật Dữ Liệu Author</h1>
    </div>
    <div class="container">
    <form action="" method="POST">
        <table>
            <tr>
                <td>
                    <label for="">Tên Tác Giả :</label>
                </td>
                <td>
                    <input type="text" name="txt_name_author" value="<?php echo $data['name_author']?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Số Điện Thoại :</label>
                </td>
                <td>
                    <input type="text" name="txt_number_phone" value="<?php echo $data['number_phone']?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Email :</label>
                </td>
                <td>
                    <input type="text" name="txt_email" value="<?php echo $data['email']?>">
                </td>
            </tr>
            <tr style="text-align: center;">
                <td colspan="2">
                    <input type="submit" value="Cập Nhật" name="btn_update">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php

if (isset($_POST['btn_update'])) 
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
        $data_values = array($id_author,$name_author,$number_phone_author,$email);
        $data_insert = array_combine($list_fields,$data_values); //array_combine() tạo ra 1 mảng mới từ 2 mảng truyền vào, 1 mảng đầu làm key mảng 2 làm value

        $result = $DB->update($table_name, $data_insert,$list_fields[0]."=".$id_author);
        if($result)
        {   
            $_SESSION['status_update'] = true;
            header("Location: ../index.php?slug=authors");
        }
        else {
            echo "<script> alert('Nhập Không Thành Công !!!') </script>";
        }
    }
}

?>
