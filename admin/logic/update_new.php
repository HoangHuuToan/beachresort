
<div class="name_site_admin">
    <h1>Nhập Dữ Liệu Cho Bài Viết</h1>
</div>

<?php
include "../../controller/connect.php";

$DB = new connect_DB("localhost", "root", "", "beachresort");

$data_author = $DB->get_list("SELECT * FROM authors"); //lấy data đổ ra select option

$table_name = $_GET['slug'];
$id_new = $_GET['id'];

$data = $DB->get_row("SELECT id_new,title_new,`date`,summary_new,`description`,name_author FROM news,authors WHERE news.id_author = authors.id_author AND id_new = " . $id_new);

?>
<div class="container">
    <form action="" method="POST">
        <table>
            <tr>
                <td>
                    <label for="">Tiêu Đề Bài Viết :</label>
                </td>
                <td>
                    <input type="text" name="txt_title" value="<?php echo $data['title_new']; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Ngày Viết :</label>
                </td>
                <td>
                    <input type="date" name="txt_date" id="" value="<?php echo $data['date']; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Tóm tắt :</label>
                </td>
                <td>
                    <input type="text" name="txt_summary" value="<?php echo $data['summary_new']; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Chi Tiết :</label>
                </td>
                <td>
                    <textarea name="txt_desciption" cols="60" rows="10">
                        <?php echo $data['description']; ?>
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
                            <a href="upload.php?slug=authors">Đăng Ký Ngay</a>
                        </div>
                    </div>
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
if (isset($_POST['btn_update'])) {
    $txt_title = $_POST['txt_title'];
    $txt_date = $_POST['txt_date'];
    $txt_summary = $_POST['txt_summary'];
    $txt_description = $_POST['txt_desciption'];
    $id_author = $_POST['txt_name_author'];

    if (empty($txt_title) || empty($txt_date) || empty($txt_summary) || empty($txt_description) || empty($id_author)) {
        die("<script> alert('Bạn chưa nhập đầy đủ dữ liệu xin mời nhập lại'); </script>");
    } else {
        $list_fields = $DB->get_list_fields($table_name);
        $data_values = array($id_new, $txt_title, $txt_date, $txt_summary, $txt_description, $id_author);
        $data_insert = array_combine($list_fields, $data_values);

        $result = $DB->update($table_name, $data_insert, $list_fields[0] . " = " . $id_new);

        if ($result) {
            $_SESSION['status_update'] = true;
            header("Location: ../index.php?slug=news");
        } else {
            echo "<script> alert('Cập Nhật Không Thành Công !!!') </script>";
        }
    }
}

?>