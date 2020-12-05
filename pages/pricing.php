<?php 

$currentPage = 'pricing';
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
    <link rel="stylesheet" href="../style/pricing/pricing.css">
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

<!-- Pricing kod başlangıcı -->

<div class="main">

    <div class="welcomer">
        <div class="title">Pricing Plans</div>

        <div class="slogan">Interested in buying <a href="./premium.php">Premium</a> after the release?</div>
        <div class="text">You can see our pricing plans below</div>

        <div class="slogan">Not registed to Intercasted?</div>

        <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Join For Free!</a>

        <!-- <form action="" id="preRegister" class="preRegister" method="POST">

            <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="Email" required>

            <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Ücretsiz Katıl!">

            <p>*Eğer ön kayıt yaptırırsanız <a href="#">poliçeleri</a> kabul etmiş sayılırsınız.</p>

            <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

            <label for="campaignEmails" class="campaignEmailsLabel">Reklam ve kampanya mailleri almak istemiyorum.</label>

        </form> -->
    </div>

    <div class="pricing">
        <div class="col">
            <h1>Monthly Plan</h1>
            <span class="disclaimer">(In case you do not cancel your subscription, plan renews automatically)</span>
            <p class="discount">⠀⠀⠀⠀⠀⠀⠀</p>
            <h3 class="price">$8.99</h3>
        </div>
        <div class="col">
            <h1>3 Month Plan</h1>
            <span class="oldPrice">$26.99</span>
            <p class="discount">17% Discount</p>
            <h3 class="price">$21.99</h3>
        </div>
        <div class="col">
            <h1>Annual Plan</h1>
            <span class="oldPrice">$107.99</span>
            <p class="discount">38% Discount</p>
            <h3 class="price">$78.99</h3>
        </div>

    </div>

</div>

<!-- Pricing kod sonu -->

<?php 

include("../includes/footer.php");

?>