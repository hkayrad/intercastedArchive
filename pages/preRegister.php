<?php 

$currentPage = 'preRegister';
$lang = 'en';

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
    <title>Intercasted</title>
    <link rel="stylesheet" href="../style/preRegister/preRegister.css">
    <link rel="stylesheet" href="../style/navBar/navBar.css">
    <link rel="stylesheet" href="../style/footer/footer.css">
    <script src="../js/toggleHamburger.js"></script>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM53D9Q"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php 

include('../includes/navBar.php');

?>

<!-- PreRegister kod başlangıcı -->

<div class="main">

    <div class="welcomer">
        <h1 class="title">Pre-register to Intercasted</h1>
        
        <p class="slogan">Let people see the live videocasts that you prepared before.</p>
    
        <p class="text">Pre-register with to have free    <a href="./premium.php">Premium</a> account for three months</p>

        <form action="" id="preRegister" class="preRegister" method="POST">

            <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="with only your Email" required>

            <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Join for Free!">

            <!-- TODO add link to policies -->

            <p>*If you pre-register you are considered that you have accepted <a href="#">policies</a>.</p>

            <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

            <label for="campaignEmails" class="campaignEmailsLabel">I don't want to recieve campaign emails</label>

        </form>
    </div>

</div>

<!-- PreRegister kod sonu -->

<?php 

include("../includes/footer.php");

?>