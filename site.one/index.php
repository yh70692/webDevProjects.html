<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'fitworksdb';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//-----------------------Validation-------------------------------------
if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['email'], $_POST['password'], $_POST['fitness_goals'], $_POST['workout_schedule'], $_POST['fitness_level'])) {
	exit('The Form is not completed please revist the registration form!');
}
if (empty($_POST['first_name']) || empty($_POST['phone_number']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['fitness_goals'])) {
	exit('Please fill in the missing values.');
}


if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('That is not a valid email address!');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['first_name'], $_POST['last_name']) == 0) {
    exit('One of your names is not using valid characters!');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}

//-----------------------Sending Data To Database-------------------------------------

if ($stmt = $con->prepare('SELECT member_id, password FROM accounts WHERE email = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
    	echo '<script type="text/javascript"> window.onload = function() {alert("This email already exists!"); } </script>';
	} else {
		if ($stmt = $con->prepare('INSERT INTO accounts (first_name, last_name, phone_number, email, password, fitness_goals, workout_schedule, fitness_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$stmt->bind_param('ssisssss', $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['email'], $password, $_POST['fitness_goals'], $_POST['workout_schedule'], $_POST['fitness_level']);
			$stmt->execute();
			session_start();
         $_SESSION["first_name"] = $memberRecord[0]["first_name"];
         session_write_close();
         $url = "./home.php";
         header("Location: $url");
		} else {
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$con->close();
?>
