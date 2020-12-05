<?php 

$currentPage = 'pricing';
$lang = 'tr';

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
        <div class="title">Fiyatlandırma</div>

        <div class="slogan"><a href="./premiumTr.php">Premium</a> mu almak istiyorsunuz?</div>
        <div class="text">Fiyatlandırmamızı aşağıdan öğrenebilirsiniz.</div>

        <div class="slogan">Intercasted'a kayıt yaptırmadınız mı?</div>

        <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Ücretsiz Katıl!</a>

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
            <h1>Aylık</h1>
            <span class="disclaimer">(İptal edilmediği sürece her ay yenilenir.)</span>
            <p class="discount">⠀⠀⠀⠀⠀⠀⠀</p>
            <h3 class="price">16.00TL</h3>
        </div>
        <div class="col">
            <h1>3 Aylık Plan</h1>
            <span class="oldPrice">48.00TL</span>
            <p class="discount">17% İndirim</p>
            <h3 class="price">39.99TL</h3>
        </div>
        <div class="col">
            <h1>Yıllık Plan</h1>
            <span class="oldPrice">192.00TL</span>
            <p class="discount">38% İndirim</p>
            <h3 class="price">119.99TL</h3>
        </div>

    </div>

</div>

<!-- Pricing kod sonu -->

<?php 

include("../includes/footer.php");

?>