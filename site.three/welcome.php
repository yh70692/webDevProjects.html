<?php
session_start();

$db=mysqli_connect("localhost","root","","comicdb");


?>

<!DOCTYPE html>
<head>
  <title>Kimiko's Comic-Con</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="site-style.css">
</head>
<body>

<div class="container">
    <hgroup>
        <h1 class="title">KIMIKO ENTERTAINMENT • COMIC-CON </h1>
        <h2>Welcome please checkout our survey.</h2>
    </hgroup>
    <br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Kimiko's Comic-Con</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="welcome.php">Home</a></li>
                <li ><a href="survey.php">Survey</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LogIn</a></li>
            </ul>
        </div>
        </div>
    </nav>
</div>

<main class="main-content">
 <div class="col-md-6 col-md-offset-1">
    <h1>Welcome.</h1>
    <div>
        <h4>Hello,  <?php echo $_SESSION['email']; ?></h4>
    </div>
    <a href="logout.php">Log Out</a>
    <?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
    ?>
</div>
</main>
</body>