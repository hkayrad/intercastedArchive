<?php
include('../includes/db.php');
session_start();
$message = " ";
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
if(isset($_POST["submitB"])){
    $code = $_POST["code"];
    $dbmail = $_SESSION["mailSession"];
    $password = $_POST["password"];
    $cPassword = $_POST["cPassword"];

    if($password === $cPassword){
        $condition = "";
        if(!empty($code) && !empty($dbmail)) {
            $condition = " pCode = '" . $code . "' AND mail = '" . $dbmail . "'";
        }else{
            $message = "Code and mail adress can't be blank.";
        }
        
        if(!empty($condition)) {
            $condition = " WHERE " . $condition;
            $sql = "SELECT * FROM user " . $condition;
            $result = mysqli_query($connect,$sql);
            $user = mysqli_fetch_array($result);
        
            if(!empty($user)) {
                $pUQuery = "UPDATE user SET password = '$password' WHERE mail = '$dbmail'";
                $cQuery = "UPDATE user SET pCode = NULL WHERE pCode = '$code'";
                mysqli_query($connect, $cQuery);
                mysqli_query($connect, $pUQuery);
                header('Location: ./index.php');
            } else {
                $message = 'No User Found';
            }
        }
        
    }
    else{
        $message ="Passwords don't match.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/fpCode/fpCode.css">
    <title>Forgot Password</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="fpCode.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail">Enter Code</label>
                    <input class="formInputs" type="text" name="code">
                </div>
                <div class="labelColumn">
                    <label class="labels" for=" mail">New Password</label>
                    <input class="formInputs" type="password" name="password">
                </div>
                <div class="labelColumn">
                    <label class="labels" for=" password">Confirm Password</label>
                    <input class="formInputs" type="password" name="cPassword">
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Change Password</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>