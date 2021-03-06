
<?php 
include 'view/connect.php';
if (isset($_GET['logout'])) {
	session_destroy();
	echo '<script>window.location.href="login.php";</script>'; 
}
if (!isset($_SESSION['user_id'])) {
	echo '<script>window.location.href="login.php";</script>'; 
}
	if (isset($_GET['page'])) {

		include "view/header.php";
		include "page/".$_GET['page'].".php";
		include "view/footer.php";
	}else{
		include "view/header.php";
		include "page/home.php";
		include "view/footer.php";
	}

 ?>