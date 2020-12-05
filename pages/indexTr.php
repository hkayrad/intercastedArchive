<?php 

$currentPage = 'index';
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
    <link rel="stylesheet" href="../style/index/index.css">
    <link rel="stylesheet" href="../style/navBar/navBar.css">
    <link rel="stylesheet" href="../style/footer/footer.css">
    <script src="../js/toggleHamburger.js"></script>

    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165860412-1"></script>

    <!-- Google Analtytics Connection -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-165860412-1');
    </script>
</head>
<body>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM53D9Q"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<?php 

include('../includes/navBar.php');

?>

<!-- Index kod başlangıcı -->

<div class="main">

    <div class="welcomer">
        <div class="left">
            <h1 class="title">Etkileşime açık video yayınları</h1>
        
            <p class="slogan tr">Paylaşıma hazır hale getirdiğiniz etkileyici videoları insanların canlı izlemesine fırsat verin.</p>
        
            <p class="text"><a href="../pages/premiumTr.php">Premium</a> kazanmak için hemen kayıt ol!</p>

            <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Ücretsiz Katıl!</a>

            <!-- <form action="" id="preRegister" class="preRegister" method="POST">

                <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="Email" required>

                <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Ücretsiz Katıl!">

            

                <p>*Eğer ön kayıt yaptırısanız <a href="#">poliçeleri</a> kabul etmiş sayılırsınız.</p>

                <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

                <label for="campaignEmails" class="campaignEmailsLabel">Reklam ve kampanya mailleri almak istemiyorum.</label>

            </form> -->
        </div>

        <!-- <div class="right">
            <img src="./assets/img/illustrations/interact.png" alt="Interact">
        </div> -->
    </div>

    <div class="productValues">

        <a href="../pages/productTr.php#RtA" class="item i1">
            <img src="../assets/img/illustrations/reachingTheAudience.png" alt="">
            <p class="subTitle">Kitleye Ulaşma</p>
        </a>
        <a href="../pages/productTr.php#CA" class="item i2">
            <img src="../assets/img/illustrations/comprehensiveAnalysis.png" alt="">
            <p class="subTitle">Kapsamlı Analiz</p>
        </a>
        <a href="../pages/productTr.php#IC" class="item i3">
            <img src="../assets/img/illustrations/interactiveCasts.png" alt="">
            <p class="subTitle">Etkileşimli Yayınlar</p>
        </a>
    
    </div>

    <div class="whatCanIDo">

        <div class="left">
            <video width="100%" controls>
                <source src="../assets/video/intercastedVideo.mp4" type="video/mp4">
                Tarayıcınız video oynatmayı desteklememektedir.
            </video>
        </div>

        <div class="right">
            <h1 class="title">Neler Yapabilirim?</h1>

            <p class="text">Hazırlamış olduğunuz videoları belirlediğiniz gösterim tarihinde dünyanın her yanındaki kullanıcılarla canlı olarak paylaşın. İlginizi çekebilecek yayınları izlerken kullanıcılarla sohbet şansı yakalayın.</p>
        </div>

    </div>

    <div class="propertiesSection">

        <h1 class="title">Özellikler</h1>

        <div class="propRow">
            <div class="first">
                <h2 class="title">Keşfet <img src="../assets/img/icons/search.png" alt=""></h2>
                <p>-Keşfedin ve keşfedilin</p>
            </div>
            <div class="second">
                <h2 class="title mobileAlign">Mobil Erişim <img src="../assets/img/icons/mobile.png" alt=""></h2>
                <p class="comingSoon">(Yakında)</p>
                <p>-Her an her yerde tüm cihazlarınızdan erişin.</p>
            </div>
            <div class="third">
                <h2 class="title">Yayın Planlayıcı <img src="../assets/img/icons/calendar.png" alt=""></h2>
                <p>-İzlemek istediğiniz yayınları kolayca derleyin.</p>
            </div>
        </div>

        <div class="propRow">
            <div class="first">
                <h2 class="title">Kişisel Bildirimler <img src="../assets/img/icons/bell.png" alt=""></h2>
                <p>-İlgilenebileceğiniz içeriklerden haberdar olurken izleyicilerinizin de dikkatini çekin.</p>
            </div>
            <div class="second">
                <h2 class="title">Yayın Esnasında Sohbet <img src="../assets/img/icons/chat.png" alt=""></h2>
                <p>-Yayıncı ve izleyicilerle fikir alışverişi yapın.</p>
            </div>
            <div class="third">
                <h2 class="title">Yayın Tanıtımı <img src="../assets/img/icons/megaphone.png" alt=""></h2>
                <p>-Gönderilerinizle ilerideki yayınlarınızı tanıtın ve öne çıkarın.</p>
            </div>

        </div>

        <div class="links">

            <!-- TODO Add links to Join and Learn -->
            
            <a href="https://intercasted.com/intercasted/pages/signIn.php" class="linkButton highlight">Ücretsiz Katıl!</a>
            <a href="../pages/productTr.php" class="linkButton">Bilgi Edinin</a>

        </div>                  

    </div>

</div>

<!-- Index kod sonu -->

<?php 

include('../includes/footer.php');

?>