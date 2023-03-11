<?php

if (isset($_GET['id_new'])) {

	include "controller/connect.php";
	$DB = new connect_DB("localhost", "root", "", "beachresort");
?>

	<head>
		<meta charset="UTF-8">
		<title>News - Bhaccasyoniztas Beach Resort Website Template</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		

	</head>

	<body>
		<div id="background">
			<div id="page">
				<div id="header">
					<div id="logo">
						<a href="index.php"><img src="images/logo.png" alt="LOGO" height="112" width="118"></a>
					</div>
					<div id="navigation">

						<ul>
							<li>
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
							<li class="selected">
								<a href="index.php?page=news">News</a>
							</li>
							<li>
								<a href="index.php?page=contact">Contact</a>
							</li>
						</ul>
					</div>
				</div>
				<a href="login/logout.php">Đăng Xuất</a>
				<div id="contents">
				<?php
			}
				?>

				<?php
				
				$data_news = $DB->get_list("SELECT news.id,news.title_new,news.date,news.summary_new,news.description,authors.name_author FROM news,authors WHERE news.id_author = authors.id_author ORDER BY `date` DESC");


				$latest_new = $data_news[0];


				?>
				<div class="box">
					<div>
						<div id="news" class="body">
							<div class="sidebar">
								<h3>Latest News</h3>
								<ul>
									<?php
									$n = 0;
									foreach ($data_news as $data_new) { ?>
										<li>
											<a href="#">
												<?php echo $data_new['title_new'];
												$n++;
												if ($n == 3) {
													break;
												}
												?>
											</a>
										</li>
									<?php } ?>
								</ul>
								<h3>Vaction Tips</h3>
								<ul>
									<li>
										<a href="#">What to bring on the beach?</a>
									</li>
									<li>
										<a href="#">Planning Fun Activities</a>
									</li>
									<li>
										<a href="#">Diving Checklist</a>
									</li>
									<li>
										<a href="#">First Aid</a>
									</li>
									<li>
										<a href="#">How to Build a Sand Castle?</a>
									</li>
									<li>
										<a href="#">Tanning Tips</a>
									</li>
								</ul>

								<div style="padding:10px;background-color:green;color:white;cursor:pointer"> <a href="./controller/post_new.php">Đăng Ký Viết Bài</a> </div>
							</div>
							<?php
							if (isset($_GET['id_new'])) {
								session_start();
								$data_user_login = $_SESSION['data_user_login'];
								$id_new = $_GET['id_new'];
							}

							if (isset($id_new)) {
								global $new_now;
								function filter_new($new)
								{
									global $id_new;
									global $new_now;
									if ($new['id'] == $id_new) {
										$new_now = $new;
										return true;
									} else {
										return false;
									}
								}
								array_filter($data_news, "filter_new");

							?>
								<div>
									<h1>News</h1>
									<img src="images/kayak.jpg" alt="Img">
									<h2> <?php echo $new_now['title_new']; ?> </h2>
									<span class="time"><?php echo $new_now['date']; ?>
										<br>
										by: <?php echo $new_now['name_author']; ?></span>
									<p>
										<?php echo $new_now['description']; ?>
									</p>
								</div>
								<div class="commnent_box">
									<?php
									$data_comments = $DB->get_list("SELECT  comment.id,`id_new`,user.`id_user`, `content_comment`, `id_comment_reply`,`user_name`,`avt`,`liked` FROM `comment`,`user` WHERE comment.id_user = user.id_user AND id_comment_reply = 0 AND `id_new` ='" . $id_new . "'");

									?>

									<h2>Bình Luận</h2>
									<div class="content_all_comment">
										<?php foreach ($data_comments as $data_comment) { ?>
											<div class="comment">
												<div style="display: flex; align-items: center; justify-content: center; justify-items: center; margin-right: 10px;">
													<img src="/<?php echo $data_comment['avt']; ?>" alt="" class="img_avt">
												</div>
												<div>
													<div class="user_name">
														<?php echo $data_comment['user_name']; ?>
													</div>
													<div class="content_comment">
														<?php echo $data_comment['content_comment']; ?>
													</div>
													<div class="react">
														<a href="controller/react_new.php?id_comment=<?php echo $data_comment['id'].'&id_new='.$data_comment['id_new'];?>">
															<i class="fa-solid fa-heart inc-like <?php if($data_comment['liked'] == 1){echo "selected";}?>"></i>
														</a>
														
														<div class="box_reply" id_comment="<?php echo $data_comment['id'];?>">
															<button class="btn_rep">Reply</button>
														</div>
														
													</div>
												</div>
												<br>
												
											</div>
												<?php 
													$data_comments_reply = $DB->get_list("SELECT  comment.id,`id_new`,user.`id_user`, `content_comment`, `id_comment_reply`,`user_name`,`avt`,`liked` FROM `comment`,`user` WHERE comment.id_user = user.id_user AND `id_comment_reply`=".$data_comment['id']."  AND `id_new` ='" . $id_new . "'");
														foreach($data_comments_reply as $data_comment_reply){
							
												?>
													<div class="comment_reply">
														<div style="display: flex; align-items: center; justify-content: center; justify-items: center; margin-right: 10px;">
															<img src="/<?php echo $data_comment_reply['avt']; ?>" alt="" class="img_avt">
														</div>
														<div>
															<div class="user_name">
																<?php echo $data_comment_reply['user_name']; ?>
															</div>
															<div class="content_comment">
																<?php echo $data_comment_reply['content_comment']; ?>
															</div>
															<div class="react">
																<a href="controller/react_new.php?id_comment=<?php echo $data_comment_reply['id'].'&id_new='.$data_comment['id_new'];?>">
																	<i class="fa-solid fa-heart inc-like <?php if($data_comment_reply['liked'] == 1){echo "selected";}?>"></i>
																</a>
																
																<div class="box_reply" id_comment="<?php echo $data_comment_reply['id'];?>">
																	<button class="btn_rep">Reply</button>
																</div>
																
															</div>
														</div>
														<br>
														
													</div>
												<?php } ?>

										<?php } ?>

									</div>
									<form action="" method="post">
										<input type="text" name="txt_comment">
										<input type="submit" name="btn_cmt" value="Bình Luận">
									</form>
									<?php
									if (isset($_POST['btn_cmt'])) {
										if (empty($_POST['txt_comment'])) {
											die("<script> alert('Bạn chưa nhập nội dung bình luận'); </script>");
										} else {
											$txt_cmt = $_POST['txt_comment'];

											$data_insert_comment = ['id' => null, 'id_new' => $id_new, 'id_user' => $data_user_login['id_user'], 'content_comment' => $txt_cmt, 'id_comment_reply' => null,'liked'=>null];

											if ($DB->insert('comment', $data_insert_comment)) {

												//Tạm thời dùng javascript để load lại trang đẩy comment lên
												echo "<script>location.href = './news.php?id_new=" . $id_new . "';</script>";
											}
										}
									}
									?>
								</div>
							<?php } else { ?>
								<div>
									<h1>News</h1>
									<img src="images/kayak.jpg" alt="Img">
									<h2> <?php echo $latest_new['title_new']; ?> </h2>
									<span class="time"><?php echo $latest_new['date']; ?>
										<br>
										by: <?php echo $latest_new['name_author']; ?></span>
									<p>
										<?php echo $latest_new['description']; ?>
									</p>
								</div>

							<?php } ?>


						
						</div>
					</div>
				</div>
				<?php
				if (isset($_GET['id_new'])) {
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
<?php
				}
?>
<script src="css/javs.js"></script>