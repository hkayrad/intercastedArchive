<?php 
session_start();
include('../includes/db.php');
$message="";
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
if(isset($_POST['submitB'])){
    $bio=$_POST['bio'];
    if(strlen($bio)>1000){
        $message="User Biography can't be longer than 1000 characters";
    }
    else{
        $bioQuery="UPDATE user SET bio = '".$bio."' WHERE id = ".$ID."";
        mysqli_query($connect,$bioQuery);
        $_SESSION['bio']=$bio;
        header('Location:./profile.php');
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cBio/cBio.css">
    <title>Forgot Password</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="cBio.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail"><pre>Write Biography</pre></label>
                    <textarea class="formInputs" name="bio"></textarea>
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Submit Bio</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>