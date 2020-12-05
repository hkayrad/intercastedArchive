<?php 

$currentPage = 'index';
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
    <link rel="stylesheet" href="./style/index/index.css">
    <link rel="stylesheet" href="./style/navBar/navBar.css">
    <link rel="stylesheet" href="./style/footer/footer.css">
    <script src="./js/toggleHamburger.js"></script>

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

include('includes/navBar.php');

?>

<!-- Index kod başlangıcı -->

<div class="main">

    <div class="welcomer">
        <div class="left">
            <h1 class="title">Interactive Video Cast</h1>
        
            <p class="slogan">Let people see the live videocasts that you prepared before.</p>
        
            <p class="text">Register to have free    <a href="./pages/premium.php">Premium</a> account!</p>

            <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Join For Free!</a>

            <!-- <form action="" id="preRegister" class="preRegister" method="POST">

                <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="with only your Email" required>

                <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Join for Free!">

                <p>*If you pre-register you are considered that you have accepted <a href="#">policies</a>.</p>

                <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

                <label for="campaignEmails" class="campaignEmailsLabel">I don't want to recieve campaign emails</label>

            </form> -->
        </div>

        <!-- <div class="right">
            <img src="./assets/img/illustrations/interact.png" alt="Interact">
        </div> -->
    </div>

    <div class="productValues">

        <a href="./pages/product.php#RtA" class="item i1">
            <img src="./assets/img/illustrations/reachingTheAudience.png" alt="">
            <p class="subTitle">Reaching The Audience</p>
        </a>
        <a href="./pages/product.php#CA" class="item i2">
            <img src="./assets/img/illustrations/comprehensiveAnalysis.png" alt="">
            <p class="subTitle">Comprehensive Analysis</p>
        </a>
        <a href="./pages/product.php#IC" class="item i3">
            <img src="./assets/img/illustrations/interactiveCasts.png" alt="">
            <p class="subTitle">Interactive Casts</p>
        </a>
    
    </div>

    <div class="whatCanIDo">

        <div class="left">
            <video width="100%" controls>
                <source src="./assets/video/intercastedVideo.mp4" type="video/mp4">
                Your browser does not support video playbacks.
            </video>
        </div>

        <div class="right">
            <h1 class="title">What Can I Do?</h1>

            <p class="text">Stream videos that you prepared with the users around the world at certain air date you decided. While watching the casts that you may like, get the chance to chat with people.</p>
        </div>

    </div>

    <div class="propertiesSection">

        <h1 class="title">Properties</h1>

        <div class="propRow">
            <div class="first">
                <h2 class="title">Discover <img src="./assets/img/icons/search.png" alt=""></h2>
                <p>-Discover and be discovered</p>
            </div>
            <div class="second">
                <h2 class="title mobileAlign">Mobile Access <img src="./assets/img/icons/mobile.png" alt=""></h2>
                <p class="comingSoon">(Coming Soon)</p>
                <p>-Access from every device ubiquitously</p>
            </div>
            <div class="third">
                <h2 class="title">Cast Planner <img src="./assets/img/icons/calendar.png" alt=""></h2>
                <p>-Compile the casts that you want to watch easily</p>
            </div>
        </div>

        <div class="propRow">
            <div class="first">
                <h2 class="title">Personal Notifications <img src="./assets/img/icons/bell.png" alt=""></h2>
                <p>-Draw the audience's attention while getting informed about the videos that you may like</p>
            </div>
            <div class="second">
                <h2 class="title">Chat During Cast <img src="./assets/img/icons/chat.png" alt=""></h2>
                <p>-Share your thoughts with intercaster</p>
            </div>
            <div class="third">
                <h2 class="title">Cast Promotion <img src="./assets/img/icons/megaphone.png" alt=""></h2>
                <p>-Promote your future intercasts with posts</p>
            </div>

        </div>

        <div class="links">

            <!-- TODO Add links to Join and Learn -->
            
            <a href="https://intercasted.com/intercasted/pages/signIn.php" class="linkButton highlight">Join for Free!</a>
            <a href="./pages/product.php" class="linkButton">Learn More</a>

        </div>                  

    </div>

</div>

<!-- Index kod sonu -->

<?php 

include('includes/footer.php');

?>