<h1>Nhập Dữ Liệu Cho Bài Viết</h1>
<?php
include "D:/xampp/htdocs/beachresort/controller/connect.php";

$DB = new connect_DB("localhost", "root", "", "beachresort");

$data_author = $DB->get_list("SELECT * FROM authors"); //lấy data đổ ra select option
?>
<div class="container">
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
                            <a href="upload.php?slug=authors">Đăng Ký Ngay</a>
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

</div>