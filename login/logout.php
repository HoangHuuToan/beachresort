<?php
session_start();
unset($_SESSION['status_login']);
header("Location: ../index.php");
?>