
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
</head>
<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_SESSION['status_register']) && $_SESSION['status_register']==true)
    {
        echo "<script>alert('Bạn đã đăng ký thành công xin mời đăng nhập !  ');</script>";
        unset($_SESSION['status_register']);
    }
?>
<body>



<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
					<a href="index.php"><img src="../images/logo.png" alt="LOGO" height="112" width="118"></a>
				</div>
				<div id="navigation">

					<ul>
						<li class="<?php if ($_GET['page'] == "home" || empty($_GET['page'])) {
										echo "selected";
									} ?>">
							<a href="">Home</a>
						</li>
						<li class="">
							<a href="">About</a>
						</li>
						<li class="">
							<a href="">Rooms</a>
						</li>
						<li class="">
							<a href="">Dive Site</a>
						</li>
						<li class="">
							<a href="">Food</a>
						</li>
						<li class="">
							<a href="">News</a>
						</li>
						<li class="">
							<a href="">Contact</a>
						</li>
					</ul>
					

				</div>
			</div>
			
			<div id="contents">
                    <h1>Đăng Nhập</h1>
				<form action="" method="post" style="background-color: white; margin:auto; display:block; padding:50px">
                    <label for="">name :</label>
                    <input type="text" name="txt_user_name">
                    <br>
                
                    

                    <label for="">pass :</label>
                    <input type="password" name="txt_pass">
                    <br>
                    <input type="submit" value="Đăng Nhập" name="btn_login">
                    <br>
                    <a href="forget_pass.php">Quên Mật Khẩu</a>
                    <a href="register.php">Đăng ký</a>
                </form>

			</div>
		</div>
		<div id="footer">
			<div>
				<ul class="navigation">
					<li class="active">
						<a href="index.php?page=home">Home</a>
					</li>
					<li>
						<a href="index.php?page=about">About</a>
					</li>
					<li>
						<a href="index.php?page=rooms">Rooms</a>
					</li>
					<li>
						<a href="index.php?page=dives">Dive Site</a>
					</li>
					<li>
						<a href="index.php?page=foods">Food</a>
					</li>
					<li>
						<a href="index.php?page=news">News</a>
					</li>
					<li>
						<a href="index.php?page=contact">Contact</a>
					</li>
				</ul>
				<div id="connect">
					<a href="http://pinterest.com/fwtemplates/" target="_blank" class="pinterest"></a> <a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a> <a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a> <a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a>
				</div>
			</div>
			<p>
				© 2023 by BHACCASYONIZTAS BEACH RESORT. All Rights Reserved
			</p>
		</div>
	</div>




    
</body>
</html>
<?php
    if(isset($_POST['btn_login']))
    {
        $DB = new connect_DB("localhost", "root", "", "beachresort");

        $txt_user_name = $_POST['txt_user_name'];
        $txt_pass = $_POST['txt_pass'];

        if(empty($txt_user_name) || empty($txt_pass))
        {
            die("<script>alert('Mời nhập đầy đủ thông tin để đăng nhập');</script>");
        }else
        {
            $data_user_login = $DB->get_row("SELECT user.*,enrol_user.role FROM `user`,enrol_user WHERE user.user_name = '".$txt_user_name."' AND user.id_user = enrol_user.id_user");
            
            if( $data_user_login ) {
                if ($txt_pass !== $data_user_login['pass_word']) 
                {
                    $_SESSION['status_login'] = false;
                }
                else
                {
                    $_SESSION['status_login'] = true;
                    $_SESSION['data_user_login'] = $data_user_login;
                }
            }
            else
            {
                $_SESSION['status_login'] = false;
            }

            if(isset($_SESSION['status_login']) && $_SESSION['status_login'] == true)
            {
                echo ("<script>alert('Đăng nhập thành công !!!');</script>");
            }
            else
            {
                die("<script>alert('Đăng Nhập thất bại do tài khoản hoặc mật khẩu không đúng !!!');</script>");
            }

            $_SESSION["user_role"] = $data_user_login['role'];
            switch ($data_user_login['role'])
            {
            case 1:
                header("Location: ../admin");
                break;
            case 0:
                header("Location: ../");
                break;
            default :
                header("Location: ./");                
            }
            

            
        }

    }
?>
