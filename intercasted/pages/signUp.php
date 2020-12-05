<?php
session_start();
include('../includes/db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/autoload.php';

if(isset($_SESSION['userId']) ){
    header('Location: ./index.php');
    exit;
} else if(isset($_COOKIE['rememberMe'])){

    // Decrypt cookie variable value
    $userId = decryptCookie($_COOKIE['rememberMe']);

    $sql_query = "select count(*) as cntUser,id from users where id='".$userId."'";
    $result = mysqli_query($connect,$sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cntUser'];

    if( $count > 0 ){
    $_SESSION['userId'] = $userId; 
    header('Location: ./index.php');
    exit;
    }
}

$message = " ";
if (isset($_POST["submitB"])) {

    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];
    $cPassword = $_POST["cPassword"];
    $gender = $_POST["gender"];
    $birthdate = $_POST["birthdate"];

    if ($username && $mail && $password && $cPassword) {

        if (strlen($username) > 32) {
            $message = "Username can't be longer than 32 characters.";
        } elseif (strlen($username) < 3) {

            $message = "Username can't be shorter than 3 characters.";
        } else {

            if (strlen($password) < 8) {
                $message = "Password can't be shorter than 8 characters.";
            } elseif (strlen($password) > 255) {
                $message = "Password can't be longer than 255 characters.";
            } else {
                $mailCheckQuery = "SELECT * FROM user WHERE mail='$mail'";
                $mailCheckResult = mysqli_query($connect, $mailCheckQuery);

                if (mysqli_num_rows($mailCheckResult)>0) {
                    $message = "This mail is already used.";
                    /* return; */
                } else {
                    if ($password === $cPassword) {
                        $_SESSION["mail"] = $mail;
                        if($birthdate=='') {
                            $saveUserQuery = "INSERT INTO user (`username`, `mail`, `password`, `gender`) VALUES ('$username','".$mail."','$password','$gender')";
                        } else {
                            $saveUserQuery = "INSERT INTO user (`username`, `mail`, `password`, `gender`, `birthdate`) VALUES ('$username','$mail','$password','$gender','$birthdate')";
                        }
                        mysqli_query($connect, $saveUserQuery) or die(mysqli_error($connect));
                        $aQuery = "SELECT `id` FROM `user` WHERE `mail`='".$mail."'";
                        $aResult = mysqli_query($connect, $aQuery);
                        $avatarResult = mysqli_fetch_assoc($aResult);
                        $id = $avatarResult['id'];
                        $_SESSION['signId']= $id;

                        echo $id;
                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $sMail = new PHPMailer(true);
                        $code = rand(100001, 999999);
                        $mQuery = "UPDATE user SET mail = NULL WHERE id = ".$id;
                        mysqli_query($connect, $mQuery)or die(mysqli_error($connect));
                        $cQuery = "UPDATE user SET mCode = '$code' WHERE id = ".$id;
                        mysqli_query($connect, $cQuery)or die(mysqli_error($connect));

                        try {
                            $sMail->isSMTP();
                            $sMail->Host = "smtpout.secureserver.net";
                            $sMail->Username   = 'contact@intercasted.com';
                            $sMail->Password   = 'pentaduke2505';
                            $sMail->SMTPAuth = true;
                            $sMail->SMTPSecure = "ssl";
                            $sMail->Port = 465;

                            $sMail->setFrom('contact@intercasted.com', 'Intercasted');
                            $sMail->addAddress($mail);

                            $sMail->isHTML(true);
                            $sMail->Subject = 'Intercasted Verify E-mail';
                            $sMail->Body    = 'Your code for verifying e-mail is <b>' . $code . '</b>';
                            $sMail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                            $sMail->send();
                            header('Location: ./vmCode.php');
                            
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$sMail->ErrorInfo}";
                        }
                    } else {
                        $message = "Passwords don't match.";
                    }
                }
            }
        }
    } else {
        $message = "Please fill required fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signUp/signUp.css">
    <title>Sign Up!</title>

</head>

<body>
    <div class="form_card">
        <img src="../img/logo/logoText.png" class="photo"><br>
        <div class="signButton">
            <a href="./signIn.php" class="signIn">Sign In</a>
            <a href="#" class="signUp">Sign Up</a>
        </div>
        <div class="forms">
            <form action="signUp.php" method="post">
                <div class="signUpRow">
                    <div class="left">
                        <label class="labels" for=" nickname">Username<span style="color: #FF4E4E ">*</span></label>
                        <input class="formInputs" type="text" name="username" required>
                    </div>
                    <div class="right">
                        <label class="labels" for=" mail">E-mail<span style="color: #FF4E4E ">*</span></label>
                        <input class="formInputs" type="email" name="mail" required>
                    </div>

                </div>

                <div class="signUpRow">
                    <div class="left">
                        <label class="labels" for=" password">Password<span style="color: #FF4E4E ">*</span></label>
                        <input class="formInputs" type="password" name="password" required>
                    </div>
                    <div class="right">
                        <label class="labels" for="cPassword">Confirm Password<span style="color: #FF4E4E ">*</span></label>
                        <input class="formInputs" type="password" name="cPassword" required>
                    </div>

                </div>

                <div class="signUpRow">
                    <div class="left">
                        <label class="labels" for=" gender">Gender</label>
                        <select class="formInputs" name="gender">
                            <option label="Male" value="male"></option>
                            <option label="Female" value="female"></option>
                            <option label="Other" value="other"></option>
                            <option label="Prefer not to disclose" value="none"></option>
                        </select>
                    </div>
                    <div class="right">
                        <label class="labels" for="birthdate">Birthdate</label>
                        <input class="formInputs" type="date" name="birthdate">
                    </div>

                </div>
                <button name="submitB" class="submitButton" type="submit">Sign Up</button>
            </form>
            <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
            <p class="warning">* Required for Signing Up</p>
            <p class="warning">* By signing up you automatically accept <a href="#"><span style="color:#FF4E4E">Terms of
                        Service</span></a> and <a href="#"><span style="color:#FF4E4E">Privacy Policy</span></a></p>
        </div>
    </div>
</body>

</html>
