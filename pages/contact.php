<?php 

//load phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// load composer
require '../vendor/autoload.php';

$currentPage = 'contact';
$lang = 'en';

$status = '';

$mail = new PHPMailer(true);

if (isset($_POST['contactSubmit'])) {
    try {

    // Get form values and append them to variables
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Set sender
    $mail->IsSMTP();
    $mail->Mailer = "smtp"; 
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;
    $mail->Host       = "smtpout.secureserver.net";
    $mail->Username   = "contact@intercasted.com";
    $mail->Password   = "pentaduke2505";
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    // Set email adresses
    $mail->AddAddress("intercastedinfo@gmail.com", "Intercasted");
    $mail->SetFrom("contact@intercasted.com", "$name");

    // Set content
    $mail->IsHTML(true);
    $mail->Subject = "$subject from $email";
    $mail->Body = "<b>From</b><br> 
    $name - $email<br><br>

    <b>About</b><br>
    $subject</b><br><br>

    <b>Message</b><br>
    <p>$message</p>";
    $mail->AltBody = "From: $name - $email    About: $subject    Message: $message";

    $mail->send();
    $status = "<p class=\"successful\">Your email has been sent successfully</p>";
    } catch (Exception $e) {
        $status = "<p class=\"failed\">There was a problem with sending your email. Error: {$mail->ErrorInfo}</p>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PM53D9Q');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../style/contact/contact.css">
    <link rel="stylesheet" href="../style/navBar/navBar.css">
    <link rel="stylesheet" href="../style/footer/footer.css">
    <script src="../js/toggleHamburger.js"></script>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM53D9Q" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<?php 

include('../includes/navBar.php');

?>

<!-- Contact kod başlangıcı -->

<div class="main">

    <div class="welcomer">
        <h1 class="title">Contact Intercasted</h1>

        <p class="text">If you have any question or you want to get in touch with Intercasted, you can fill out the form below and send it.</p>

        <form class="contact" action="contact.php" method="post">

            <div class="top">

                <input type="text" name="name" class="contactName" placeholder="Name" required>

                <input type="text" name="subject" class="contactSubject" placeholder="Subject" required>

            </div>

            <input type="email" name="email" class="contactEmail" placeholder="Email" required>

            <textarea name="message" class="contactMessage" placeholder="Message" required></textarea>

            <?php 
            
            echo $status;
            
            ?>

            <input type="submit" name="contactSubmit" class="contactSubmit" value="Send">

        </form>
    </div>

</div>

<!-- Contact kod sonu -->

<?php 

include('../includes/footer.php');

?>