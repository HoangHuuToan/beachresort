<head>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php 
// include("controller/connect.php");
// $DB = new connect_DB("localhost", "root", "", "beachresort");
$data_rooms = $DB->get_list("SELECT * FROM rooms");

?>
<div class="box">
	<div>
		<div class="body">
			<h1>Rooms</h1>
			<ul id="rooms">
				<?php foreach($data_rooms as $data_room){ ?>
				<li style="display:flex;">
					<a href="detail_room.php?id_room=<?php echo $data_room["id"];?>"><img src="images/first-class.jpg" alt="Img"></a>
					<div>
						<h2><a href="detail_room.php?id_room=<?php echo $data_room["id"];?>"><?php echo $data_room["name_room"];?></a></h2>
						<p style="display:block; height:250px;overflow: hidden;text-overflow: ellipsis;">
							<?php echo $data_room["information_room"];?>
						</p>
					</div>
					<span class="rate">Rate: <?php echo $data_room["price_room"];?> / Day</span>
					<div class="btn_order" onclick="add_item_to_cart(<?php echo $data_room['id'];?>)">Thêm Vào Giỏ Hàng</div>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>