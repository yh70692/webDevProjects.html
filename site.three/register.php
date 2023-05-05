<?php
session_start();
$db=mysqli_connect("localhost","root","","comicdb");
if(isset($_POST['button']))
{
    $first_name=mysqli_real_escape_string($db,$_POST['first_name']);
    $last_name=mysqli_real_escape_string($db,$_POST['last_name']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $password1=mysqli_real_escape_string($db,$_POST['password1']); 
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result=mysqli_query($db,$query);
      if($result)
      {
     
        if( mysqli_num_rows($result) > 0)
        {
                
                echo '<script language="javascript">';
                echo 'alert("User email already exists")';
                echo '</script>';
        }
        
          else
          {
            
            if($password==$password1)
            {           
                $password=md5($password); 
                $sql="INSERT INTO users(first_name, last_name, gender, email, password ) VALUES('$first_name','$last_name','$gender','$email','$password')"; 
                mysqli_query($db,$sql);  
                $_SESSION['message']="You are now logged in"; 
                $_SESSION['email']=$email;
                $to = $email;
                $subject = "Welcome to Kimiko Entertainment";
                $txt = "Hello! you've just been registered to Kimiko Entertainment, hope to see you at Comic-con.";
                $headers = "From: kimikoent@con.com";
                mail($to,$subject,$txt,$headers);
                header("location:welcome.php"); 
            }
            else
            {
                if($gender=="")
                {
                    $_SESSION['message']="Are you non-binary?";
                }
                else
                {
                    $_SESSION['message']="Passwords do not match";   
                }
            
            }
          }
      }
}
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
        <h2 >register to access and complete survey.</h2>
    </hgroup>
    <br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Kimiko's Comic-Con</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LogIn</a></li>
            </ul>
        </div>
        </div>
    </nav>
</div>

<main class="main-content">
    <div class="col-md-1 col-md-offset-1">
        <form method="post" action="register.php">
            <table>
                <tr>
                    <td><label for="first_name">First Name:</label></td>
                    <td><input name="first_name" type="text" placeholder="John" id="first_name"></td>
                </tr>
                <br>		
                <tr>
                    <td><label for="last_name">Last Name:</label></td>
                    <td><input name="last_name" type="text" placeholder="Wick" id="last_name"></td>
                </tr>
                <br>
                <tr>				
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" placeholder="johnwick4@gmail.com" id="email"  autocomplete="on" required></td>
                        <br>	
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" placeholder="Keep it private" id="password"  minLength="4" autocomplete="off" required></td>
                        <br>	
                    <td><label for="password">Re-type Password:</label></td>
                    <td><input type="password" name="password1" placeholder="Keep it private again :)" id="password1"  minLength="4" autocomplete="off" required></td>
                </tr>
                <br>
                <tr><td rowspan="2"><label for="gender">Gender:</label></td>  
                    <td><input type="radio" name="gender" value="Male"/>Male</td>  
                <tr>  
                    <td><input type="radio" name="gender" value="Female"/>Female</td></tr>
                <br>
                <tr>
                    <div class="button">
                        <td><button type="submit" name="button">Submit</button></td>
                    </div>
                </tr>
            </table>
        </form>
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