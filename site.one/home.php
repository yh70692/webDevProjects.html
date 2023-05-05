<?php
session_start();
if (isset($_SESSION["first_name"])) {
    $username = $_SESSION["first_name"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./index.html";
    header("Location: $url");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
	<link href="index-style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="phppot-container">
		<div class="page-header">
			<span class="login-signup"><a href="logout.php">Logout</a></span>
		</div>
		<div class="page-content">Welcome <?php echo $username;?></div>
	</div>
</body>
</html>