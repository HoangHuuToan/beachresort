<?php
session_start();
include("controller/connect.php");
$DB = new connect_DB("localhost", "root", "", "beachresort");
$data_user_login = $_SESSION['data_user_login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Bhaccasyoniztas Beach Resort Website Template</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		function change_value(id){
			// alert(document.getElementById("cart_element_"+id).value);
			// const xhttp = new XMLHttpRequest();
			// xhttp.onload = function() {
				
			// }
			// xhttp.open("POST", "controller/update_cart.php?id_cart="+id+"&value="+document.getElementById("cart_element_"+id).value);
			// xhttp.send();
			$.ajax({
            type : "POST",  //type of method
            url  : "controller/update_cart.php?id_cart="+id+"&value="+document.getElementById("cart_element_"+id).value,  //your page
            data : { id : id, value : document.getElementById("cart_element_"+id).value},// passing the values
            success: function(res){
                        //do what you want here...
                    }
        });
		}

		function add_item_to_cart(id_room)
		{
			$.ajax({
				type : "POST",  //type of method
				url  : "controller/add_item_to_cart.php?id_room="+id_room,  //your page
				data : { id_room : id_room},// passing the values
				success: function(res){
							//do what you want here...
						}
        	});
		}

	</script>
</head>
<?php


if (!$_SESSION['status_login']) {
	header("Location: ./login/index.php");
}
if ($_SESSION["user_role"] == "1" && $_SESSION['status_login']) {
	header("Location: ./admin");
}
if (isset($_SESSION['insert_status'])) {
	echo "<script> alert('Đăng Ký contact thành công !!!'); </script>";
	unset($_SESSION['insert_status']);
}

?>

<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
					<a href="index.php"><img src="images/logo.png" alt="LOGO" height="112" width="118"></a>
				</div>
				<div id="navigation">

					<ul>
						<li class="<?php if ($_GET['page'] == "home" || empty($_GET['page'])) {
										echo "selected";
									} ?>">
							<a href="index.php?page=home">Home</a>
						</li>
						<li class="<?php if ($_GET['page'] == "about") {
										echo "selected";
									} ?>">
							<a href="index.php?page=about">About</a>
						</li>
						<li class="<?php if ($_GET['page'] == "rooms") {
										echo "selected";
									} ?>">
							<a href="index.php?page=rooms">Rooms</a>
						</li>
						<li class="<?php if ($_GET['page'] == "dives") {
										echo "selected";
									} ?>">
							<a href="index.php?page=dives">Dive Site</a>
						</li>
						<li class="<?php if ($_GET['page'] == "foods") {
										echo "selected";
									} ?>">
							<a href="index.php?page=foods">Food</a>
						</li>
						<li class="<?php if ($_GET['page'] == "news") {
										echo "selected";
									} ?>">
							<a href="index.php?page=news">News</a>
						</li>
						<li class="<?php if ($_GET['page'] == "contact") {
										echo "selected";
									} ?>">
							<a href="index.php?page=contact">Contact</a>
						</li>
					</ul>
					<div class="task__cart">
						<a href="#">
							<i class="fa-solid fa-cart-shopping" style="font-size:30px;float:right;margin:10px;"></i>
						</a>


						<div class="list-cart">
			
							<h4 class="task__cart-heading">Sản Phẩm Đã Thêm</h4>
							<ul type="none" class="list-items-cart">
								<?php
								
								$data_carts = $DB->get_list("SELECT order_cart.id,order_cart.id_user,order_cart.id_room,order_cart.cout,rooms.name_room,rooms.information_room,rooms.price_room,rooms.img_room FROM order_cart,rooms WHERE order_cart.id_user = ".$data_user_login['id_user']." AND order_cart.id_room = rooms.id");
								//var_dump($data_carts);
								$sum_price =0;
								foreach($data_carts as $data_cart){
								?>
								<li class="item-cart">
									<img  class="item-cart__img" src="<?php echo $data_cart['img_room'];?>" alt="">
									<div class="item-cart--info">
										<h5 class="name-product">
											<span><?php echo $data_cart['name_room'];?></span>
										</h5>
										<span class="price-product">
											<span><?php echo $data_cart['price_room'];?>$</span>
										</span>
									</div>
									
									<div class="detail-bill">
										<span>Số Lượng :</span>
										<input id="cart_element_<?php echo $data_cart['id'];?>" class="amount-product" type="number" value="<?php echo $data_cart['cout'];?>" min="1" onchange="change_value(<?php echo $data_cart['id'];?>)">
									</div>
									<?php $sum_price = $sum_price + ($data_cart['cout'] * $data_cart['price_room']);?>
								</li>
								<?php } ?>
							</ul>
							<div class="price-product">
								<span>Tổng Tiền :</span> <span><?php echo $sum_price;?>$</span>
								<button> <a href="detail_cart.php">Thanh Toán</a> </button>
							</div>
							
							

						</div>


					</div>

				</div>
			</div>
			<a href="login/logout.php">Đăng Xuất</a>
			<div id="contents">

				<?php

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
					switch ($page) {
						case "home":
							include "home.php";
							break;
						case "about":
							include "about.php";
							break;
						case "rooms":
							include "rooms.php";
							break;
						case "dives":
							include "dives.php";
							break;
						case "foods":
							include "foods.php";
							break;
						case "news":
							include "news.php";
							break;
						case "contact":
							include "contact.php";
							break;

						default:
							include "home.php";
					}
				} else {
					include "home.php";
				}

				?>

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

<script src="css/javs.js"></script>