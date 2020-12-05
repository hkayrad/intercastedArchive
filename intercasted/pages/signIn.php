<?php
include('../includes/functions.php');
include('../includes/db.php');
include('../includes/head.php');
session_start();
$message = " ";


// Check if $_SESSION or $_COOKIE already set
if(isset($_SESSION['userId']) ){
    header('Location: index.php');
    exit;
} else if( isset($_COOKIE['rememberMe'] )){
    
    // Decrypt cookie variable value
    $userId = decryptCookie($_COOKIE['rememberMe']);
    
    $sql_query = "select count(*) as cntUser,id from users where id='".$userId."'";
    $result = mysqli_query($connect,$sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cntUser'];

    if( $count > 0 ){
    $_SESSION['userId'] = $userId; 
    header('Location: index.php');
    exit;
    }
}

// login button
if(isset($_POST['submitB'])){
    $dbmail = $_POST['email'];
    $password = $_POST['password'];
    $dbmail =mysqli_real_escape_string($connect,$dbmail);
    $password =mysqli_real_escape_string($connect,$password);
    if(!empty($dbmail) && !empty($password)){
        $rQuery = "SELECT * FROM user WHERE mail = '" . $dbmail . "'";
        $result=mysqli_query($connect,$rQuery);
        if(mysqli_num_rows($result)>0) {
            $row=mysqli_fetch_array($result);
            $dbpassword = $row['password'];

            if($dbpassword === $password){
                $userId = $row['id'];
                if(isset($_POST['rememberMe'])){
                    // Set cookie variables
                    $days = 30;
                    $value = encryptCookie($userId);
                    setcookie ("rememberMe",$value,time()+ ($days * 24 * 60 * 60));
                }
                $_SESSION['userId'] = $userId;
                header('Location: ./index.php');
            }
            else{
                $message = "Your password is incorrect.";
            }
        } else {
            $message ="User can't be found.";
        }
        
    } else{
        $message="E-mail and password can't be blank.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/SignIn/SignIn.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
    <title>Sign In!</title>
</head>

<body>
    <div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="signButton">
            <a href="#" class="signIn">Sign In</a>
            <a href="./signUp.php" class="signUp">Sign Up</a>
        </div>
        <div class="forms">
            <form action="" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail">E-mail</label>
                    <input class="formInputs" type="email" name="email">
                </div>
                <div class="labelColumn">
                    <label class="labels" for=" password">Password</label>
                    <input class="formInputs" type="password" name="password">
                    <label id="cbL"><input id="checkbox" type="checkbox" name="rememberMe">Remember me</label>
                </div>
                
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB" type="submit">Sign In</button>
                <br>
                <br>
                <a id="fp" href="./fpMail.php">Forgot Password?</a>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>

</html>