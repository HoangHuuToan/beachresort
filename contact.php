<?php

// include "./controller/connect.php";
// $DB = new connect_DB("localhost", "root", "", "beachresort");

$list_fields = $DB->get_list_fields("contact");

?>

<div class="box">
	<div>
		<div id="contact" class="body">
			<h1>Contact</h1>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>Name:</td>
							<td><input type="text" class="txtfield" name="txt_name" /></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" class="txtfield" name="txt_email" /></td>
						</tr>
						<tr>
							<td>Subject:</td>
							<td><input type="text" class="txtfield" name="txt_subject" /></td>
						</tr>
						<tr>
							<td class="txtarea">Message:</td>
							<td><textarea name="txt_message"></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" class="btn" name="btn_submit" value="SEND"></td>
						</tr>
					</tbody>
				</table>
			</form>
			<h2>Bhaccasyoniztas Beach Resort</h2>
			<p>
				<span>Address:</span> 123 Lorem Ipsum Cove, Sed Ut City, LI 12345
			</p>
			<p>
				<span>Telephone Number:</span> 1-800-999-9999
			</p>
			<p>
				<span>Fax Number:</span> 1-800-111-1111
			</p>
		</div>
	</div>
</div>

<?php


if (isset($_POST['btn_submit'])) {
	$edt_name = $_POST['txt_name'];
	$edt_email = $_POST['txt_email'];
	$edt_subject = $_POST['txt_subject'];
	$edt_message = $_POST['txt_message'];
	//list_fields : $list_fields
	$list_values;
	if (empty($edt_name) || empty($edt_email) || empty($edt_subject) || empty($edt_message)) {
		die("<script> alert('Mời bạn nhập đầy đủ thông tin để gửi dữ liệu đến quản trị viên !!') </script>");
	} else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $edt_name)) {
		die("<script> alert('user name không được phép có ký tự đặc biệt') </script>");
	} else {
		$list_values = array(null, $edt_name, $edt_email, $edt_subject, $edt_message);
		$data_inset = array_combine($list_fields, $list_values);

		var_dump($data_inset);
		$DB->insert("contact", $data_inset);
		$_SESSION['insert_status'] = true;
		header("Location: index.php");
	}
}

?>