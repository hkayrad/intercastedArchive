<?php
session_start();
include('../includes/db.php');
if (isset($_SESSION['signId'])) {
    $ID = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $ID;
} elseif (isset($_SESSION['userId'])) {
    $ID = $_SESSION['userId'];
} else {
    header('Location:./index.php');
}
$vmQuery="SELECT mCode FROM user WHERE id=".$ID."";
$vmResult=mysqli_query($connect,$vmQuery);
$vmRow=mysqli_fetch_array($vmResult);
$vm=$vmRow['mCode'];
if(!empty($vm)){
    header('Location:./vmCode.php');
}
$message="";
if(isset($_POST['submitB'])){
    
    $username=$_POST['username'];
    $uQuery="UPDATE user SET username= '".$username."' WHERE id=".$ID."";
    mysqli_query($connect,$uQuery)or die(mysqli_error($connect));
    header('Location:./profile.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/fpCode/fpCode.css">
    <title>Change Username</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="cUsername.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" username">Enter New Username</label>
                    <input class="formInputs" type="text" name="username">
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Change Username</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>