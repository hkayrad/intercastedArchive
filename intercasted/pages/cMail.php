<?php
include('../includes/db.php');
session_start();
//////////////////
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/autoload.php';
$mail = new PHPMailer(true);
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
$vmResult=mysqli_query($connect,$vmQuery)or die(mysqli_error($connect));
$vmRow=mysqli_fetch_array($vmResult);
$vm=$vmRow['mCode'];
if(!empty($vm)){
    header('Location:./vmCode.php');
}


$message =" ";
if (isset($_POST["submitB"])){
    $mailQuery="SELECT `mail`,`password` FROM user WHERE id=".$ID."";
    $mailResult=mysqli_query($connect,$mailQuery)or die(mysqli_error($connect));
    $mailRow=mysqli_fetch_array($mailResult);
    $dbmail = $mailRow["mail"];
    $dbpassword = $mailRow["password"];
    $newMail=$_POST['nMail'];

    if($dbpassword === $_POST['password'] && $dbmail === $_POST['mail']){
        if (mysqli_num_rows($mailResult)) { 
            $code=rand(100001,999999);
            $cQuery = "UPDATE user SET mCode = '$code' WHERE id = ".$ID."";
            mysqli_query($connect, $cQuery)or die(mysqli_error($connect));
            
                try {
                $mail->isSMTP();
                $mail->Host = "smtpout.secureserver.net";
                $mail->Username   = 'contact@intercasted.com';
                $mail->Password   = 'pentaduke2505';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
            
                $mail->setFrom('contact@intercasted.com', 'Intercasted');
                $mail->addAddress($newMail);
            
                $mail->isHTML(true);
                $mail->Subject = 'Intercasted Forgot Password';
                $mail->Body    = 'You are changing your e-mail to <b>'. $newMail .'</b>. Your code for changing mail is <b>' . $code .'</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                $_SESSION['newVerifyI']=$ID;
                $_SESSION['newVerifyM']=$newMail;
                header('Location: ./cCode.php');
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            } 
    
        } 
        else {
            $message ="This mail does not exists.";
    }
    }




}


//////////////////////////
   




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forgot-password/fpMail.css">
    <title>Change E-Mail</title>
</head>

<body>
<div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="forms">
            <form action="cMail.php" method="POST">
                <div class="labelColumn">
                    <label class="labels" for=" mail">E-mail</label>
                    <input class="formInputs" type="email" name="mail">
                </div>
                <div class="labelColumn">
                    <label class="labels" for=" mail">New E-mail</label>
                    <input class="formInputs" type="email" name="nMail">
                </div>
                <div class="labelColumn">
                    <label class="labels" for=" mail">Password</label>
                    <input class="formInputs" type="password" name="password">
                </div>
                <input style="display:none" type="submit">
                <button class="submitButton" name="submitB"type="submit">Send to Mail</button>
                <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>