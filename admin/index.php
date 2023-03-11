<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<?php


?>

<body>
    <div class="name_site">

        <div class="logo_header">
            <img class="avt" src="images/avt.png" alt="">
            <div style="height: 50px;margin-left:10px;">
                <span style="font-size: 22px;font-weight:bold">Nguyễn Thu Vân</span>
                <br>
                <span style="font-size: 15px;float:left;">admin</span>
            </div>
        </div>
        
        <div style="display: flex;width: -webkit-fill-available;">
            <h1 class="name_page">SITE ADMIN BEACHREDORT</h1>
        </div>
        
    </div>

    <div class="content">
        <nav class="nav_menu">
            <div class="menu_index_admin">
                <div class="btn_nav">
                    <a href="index.php?slug=news" <?php if (isset($_GET['slug']) && $_GET['slug'] == 'news') {
                                                        echo "class='active'";
                                                    } ?>>Quản Lý Bài Viết</a>
                </div>
                <div class="btn_nav">
                    <a href="index.php?slug=authors" <?php if (isset($_GET['slug']) && $_GET['slug'] == 'authors') {
                                                            echo "class='active'";
                                                        } ?>>Quản Lý Tác Giả</a>
                </div>
                <div class="btn_nav">
                    <a href="index.php?slug=contact" <?php if (isset($_GET['slug']) && $_GET['slug'] == 'contact') {
                                                            echo "class='active'";
                                                        } ?>>Quản Lý Contact</a>
                </div>

                <div class="btn_nav">
                    <a href="index.php?slug=bills" <?php if (isset($_GET['slug']) && $_GET['slug'] == 'bills') {
                                                            echo "class='active'";
                                                        } ?>>Quản Lý Bills</a>
                </div>
            </div>
        </nav>
       
        <div class="dynamic_data">
            <?php
            session_start();

            if (isset($_GET['slug'])) {
                $name_site = $_GET['slug'];
                switch ($name_site) {
                    case "news":
                        include "admin_new.php";
                        break;
                    case "authors":
                        include "admin_author.php";
                        break;
                    case "contact":
                        include "admin_contact.php";
                        break;
                    case "bills":
                        include "admin_bills.php";
                        break;
                    default:
                        include "admin_new.php";
                }
            } else {
                include "admin_new.php";
            }
            if (isset($_SESSION['status_delete'])) {
                echo "<script> alert('Xóa Thành Công !!!'); </script>";
                unset($_SESSION['status_delete']);
            }
            if (isset($_SESSION['status_insert'])) {
                echo "<script> alert('Nhập Dữ Liệu Thành Công !!!'); </script>";
                unset($_SESSION['status_insert']);
            }
            if (isset($_SESSION['status_update'])) {
                echo "<script> alert('Cập Nhật Dữ Liệu Thành Công !!!'); </script>";
                unset($_SESSION['status_update']);
            }

            ?>
            <div class="btn_add_data">
                <a href="./logic/upload.php?slug=<?php echo $name_site ?>">
                    Nhập Dữ Liệu
                </a>
            </div>
        </div>
    </div>



    <div><a href="../login/logout.php">Đăng Xuất</a></div>

</body>

</html>