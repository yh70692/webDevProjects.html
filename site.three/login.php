<?php
session_start();
if(  isset($_SESSION['email']) )
{
  header("location:welcome.php");
  die();
}
$db=mysqli_connect("localhost","root","","comicdb");
if($db)
{
  if(isset($_POST['button']))
  {
      $email=mysqli_real_escape_string($db,$_POST['email']);
      $password=mysqli_real_escape_string($db,$_POST['password']);
      $password=md5($password);
      $sql="SELECT * FROM users WHERE email='$email' AND  password='$password'";
      $result=mysqli_query($db,$sql);
      if($result)
      {
     
        if( mysqli_num_rows($result)>=1)
        {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['email']=$email;
            header("location:welcome.php");
        }
       else
       {
            $_SESSION['message']="One of the fields are incorrect";
       }
      }
  }
}
?>

<!DOCTYPE html>
<head>
  <title>You'r Back!</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="site-style.css">
</head>
<body>

<div class="container">
    <hgroup>
        <h1 class="title">KIMIKO ENTERTAINMENT • COMIC-CON </h1>
        <h2>love to have you back.</h2>
    </hgroup>
    <br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Kimiko's Comic-Con</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LogIn</a></li>
            </ul>
        </div>
        </div>
    </nav>
</div>

<main class="main-content">
    <div class="col-md-1 col-md-offset-1">
        <form method="post" action="login.php">
            <table>		
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" placeholder="" id="email"  autocomplete="on" required></td>
                        <br>	
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" placeholder="hope you remember" id="password"  minLength="4" autocomplete="off" required></td>
                        <br>	
                <div class="button">
                    <td><input type="submit" name="button" value="Login"></td>
                </div>
            </table>
        </form>
        <br>
        <br>
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