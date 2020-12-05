<?php
include('../includes/db.php');
session_start();
$message = " ";

if(empty($_SESSION['signId'])){
    $id=$_SESSION['userId'];
}else{
    $id = $_SESSION['signId'];
}
if(isset($_POST["submitB"])){
    $code = $_POST["code"];
    // $id = $_SESSION['signId'];
    $mail = $_SESSION['mail'];
    $newMail=$_SESSION['newVerifyM'];
    echo $code."   ".$mail."   ".$newMail;

    $condition = "";
    if(!empty($code) && !empty($id)) {
        $condition = " mCode = '" . $code . "' AND id = '" . $id . "'";
    }else{
        $message = "Code can't be blank.";
    }
    
    if(!empty($condition)) {
        $condition = " WHERE " . $condition;
        $sql = "SELECT * FROM user " . $condition;
        $result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
        $user = mysqli_fetch_array($result);
    
        if(!empty($user)) {
            if(!empty($_SESSION['mail'])) {
                $pUQuery = "UPDATE user SET mail = '" . $mail . "' WHERE id = ".$id."";
                $cQuery = "UPDATE user SET mCode = NULL WHERE mCode = '".$code."'";
                mysqli_query($connect, $cQuery)or die(mysqli_error($connect));
                mysqli_query($connect, $pUQuery)or die(mysqli_error($connect));
                header('Location: ./interests.php');
            }
            else {
                $pUQuery = "UPDATE user SET mail = '" . $newMail . "' WHERE id = ".$id."";
                $cQuery = "UPDATE user SET mCode = NULL WHERE mCode = '".$code."'";
                mysqli_query($connect, $cQuery)or die(mysqli_error($connect));
                mysqli_query($connect, $pUQuery)or die(mysqli_error($connect));
                header('Location: ./profile.php');
            }
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
    <title>Verify E-Mail</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="vmCode.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail">Enter Code</label>
                    <input class="formInputs" type="text" name="code">
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Verify E-Mail</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>