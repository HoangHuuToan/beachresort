<?php
include "D:/xampp/htdocs/beachresort/controller/connect.php";

$DB = new connect_DB("localhost", "root", "", "beachresort");

$data_author = $DB->get_list("SELECT * FROM authors"); //lấy data đổ ra select option
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
        <table>
            <tr>
                <td>
                    <label for="">Tiêu Đề Bài Viết :</label>
                </td>
                <td>
                    <input type="text" name="txt_title">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Ngày Viết :</label>
                </td>
                <td>
                    <input type="date" name="txt_date" id="">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Tóm tắt :</label>
                </td>
                <td>
                    <input type="text" name="txt_summary">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Chi Tiết :</label>
                </td>
                <td>
                    <textarea name="txt_desciption" cols="60" rows="10">

                    </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Tên Tác Giả</label>
                </td>
                <td>
                    <select name="txt_name_author" id="">
                        <!-- Đổ dữ liệu từ bảng author ra để chọn -->
                        <?php foreach ($data_author as $value) { ?>

                            <option value="<?php echo $value['id_author'] ?>">
                                <?php echo $value['name_author'] ?>
                            </option>

                        <?php } ?>
                    </select>
                    <div style="display:flex">
                        <label for="">Nếu Bạn Chưa Đăng Ký Tác Giả :</label>
                        <div class="btn btn_register">
                            <a href="../admin/logic/upload.php?slug=authors">Đăng Ký Ngay</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td colspan="2">
                    <input type="submit" value="Nhập" name="btn_submit">
                </td>
            </tr>
        </table>

    </form>
</body>
</html>
<?php 
    
    
    $table_name = "news";    

    if(isset($_POST['btn_submit']))
    {
        $txt_title = $_POST['txt_title'];
        $txt_date = $_POST['txt_date'];
        $txt_summary = $_POST['txt_summary'];
        $txt_description = $_POST['txt_desciption'];
        $id_author = $_POST['txt_name_author'];
        
        if( empty($txt_title) || empty($txt_date) || empty($txt_summary) || empty($txt_description) ||empty($id_author) )
        {
            die("<script> alert('Bạn chưa nhập đầy đủ dữ liệu xin mời nhập lại'); </script>"); 
        }
        else
        {
            $list_fields = $DB->get_list_fields($table_name);
            $data_values = array(null,$txt_title,$txt_date,$txt_summary,$txt_description,$id_author,null);
            $data_insert = array_combine($list_fields, $data_values);

            $result = $DB->insert($table_name,$data_insert);

            if($result)
            {   
                $_SESSION['status_insert'] = true;
                header("Location: ../index.php?slug=news");
            }
            else {
                echo "<script> alert('Nhập Không Thành Công !!!') </script>";
            }
        }



    }

?>