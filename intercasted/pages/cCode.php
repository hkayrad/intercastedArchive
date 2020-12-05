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
    $ID = $_SESSION['newVerifyI'];
    $newMail = $_SESSION['newVerifyM'];
    

    
        $condition = "";
        if(!empty($code) && !empty($ID)) {
            $condition = " mCode = '" . $code . "' AND id = '" . $ID . "'";
        }else{
            $message = "Code can't be blank.";
        }
        
        if(!empty($condition)) {
            $condition = " WHERE " . $condition;
            $sql = "SELECT * FROM user " . $condition;
            $result = mysqli_query($connect,$sql);
            $user = mysqli_fetch_array($result);
        
            if(!empty($user)) {
                $pUQuery = "UPDATE user SET mail = '$newMail' WHERE id = '$ID'";
                $cQuery = "UPDATE user SET mCode = NULL WHERE mCode = '$code'";
                mysqli_query($connect, $cQuery);
                mysqli_query($connect, $pUQuery);
                header('Location: ./profile.php');
            } else {
                $message = 'Code is incorrect.';
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/fpCode/fpCode.css">
    <title>Submit Code!</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="cCode.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail">Enter Code</label>
                    <input class="formInputs" type="text" name="code">
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Submit Code</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>