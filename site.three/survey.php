<?php
session_start();

$db=mysqli_connect("localhost","root","","comicdb");
if($db)
{
  if(isset($_POST['button']))
  {
    $intrest=mysqli_real_escape_string($db,$_POST['intrest']);
    $budget=mysqli_real_escape_string($db,$_POST['budget']);
    $email = $mysqli->real_escape_string($db,$_POST['email']);
    $result = $mysqli->query("SELECT * FROM $db WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $result = $mysqli->query("UPDATE $db 
            SET intrest = '$intrest',
                budget = '$budget', 
            
            WHERE email = '$email'
        ");
    }
    else {
        $result = $mysqli->query("INSERT IGNORE INTO $db (
            email, 
            intrest, 
            budget, 
        ) VALUES (
            '$email', 
            '$intrest', 
            '$budget',)
        ");
    }
    if ($result === true) {
        echo "Success!, Thank you for your contribution.";
    }
    else {
        echo "SQL error:" . $mysqli->error;
    }
    $mysqli->close();
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
        <h1 class="title">ONLINE SURVEY</h1>
        <h2>Please complete the survey.</h2>
    </hgroup>
    <br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Kimiko's Comic-Con</a>
            </div>
            <ul class="nav navbar-nav">
                <li ><a href="welcome.php">Home</a></li>
                <li class="active"><a href="survey.php">Survey</a></li>
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
    <h4 class="text-survey">This is the comic-con fan festavil survay. Where you have the power to set the direction for this years Comic-con.</h4>
    <h4 class="text-survey">Please fill out the form and answer the questions with pure honesty. Non-sensical replies will get you banned :) .</h4>
    <div class="col-md-3 col-md-offset-3">
        <form method="post" action="survey.php">
            <table>
                <tr><td rowspan="2"colspan="5" ><label for="intrest">Main Intrest:</label></td>  
                    <td><input type="radio" name="intrest" value="Gaming"/>Game</td>  
                    <td><input type="radio" name="intrest" value="TV/Movie"/>Movie</td>
                    <td><input type="radio" name="intrest" value="Comics"/>Comic</td>
                    <td><input type="radio" name="intrest" value="Toys"/>Toys</td>
                </tr>
                <tr></tr>
                <tr><td rowspan="2" colspan="5"><label for="budget">Budget:</label></td>  
                    <td><input type="radio" name="budget" value="Basic"/> Basic (R87)</td>  
                    <td><input type="radio" name="budget" value="Classic"/> Classic (R178)</td>  
                    <td><input type="radio" name="budget" value="VIP"/>VIP (R870)</td>
                    <td><input type="radio" name="budget" value="Premium"/>Premium (R1400)</td>
                </tr>
                <br>
                <tr></tr>
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

