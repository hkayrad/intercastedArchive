<?php 

$currentPage = 'about';
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
    <link rel="stylesheet" href="../style/about/about.css">
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

<!-- About kod başlangıcı -->

<div class="main">
    <div class="welcomer">
        <h1 class="title">What is Intercasted?</h1>
        <p class="text">Intercasted is a platform that you can live stream prepared videos with a growing audience and interact with them.</p>
        <h1 class="title">What is our purpose?</h1>
        <p class="text">We are aiming to enable people to watch and share interactive live videocasts from variety of content; furthermore, interact with people to exchange ideas and improve with the innovative and original perspective.</p>
    </div>

    <div class="values">
        <h1 class="title">Values</h1>
        <p class="text">✔ Originality</p>
        <p class="text">✔ Improvement-oriented</p>
        <p class="text">✔ People-toPeople Interaction</p>
        <p class="text">✔ Unbiased Reaction</p>
    </div>

    <div class="faq">
        <h1 class="title">FAQ</h1>
        <div class="row">
            <h2 class="question">What is intercasted?</h2>
            <p class="answer">-Intercasted is a video platform in wich you can share your interactive video casts.</p>
        </div>
        <div class="row">
            <h2 class="question">What is interactive video cast?</h2>
            <p class="answer">-A new content type that you can interact with people while streaming drawn up videos.</p>
        </div>
        <div class="row">
            <h2 class="question">Why interactive video cast?</h2>
            <p class="answer">-You can chat during casts and directly communicatewith intercaster which creates an idea-sharing environment and enables to see unbiased reactions of the audience.</p>
        </div>
        <div class="row">
            <h2 class="question">Why sould I pre-register?</h2>
            <p class="answer">-Pre-register and do not miss the chance to have a free Premium account for three months.</p>
        </div>
        <div class="row">
            <h2 class="question">When pre-registration ends?</h2>
            <p class="answer">-You can pre-register till the 5th of June which is our launch date.</p>
        </div>
        <div class="row">
            <h2 class="question">What's the diference between Regular and Premium account?</h2>
            <p class="answer">-Premium offers you many advantages!</p>
            <img src="../assets/img/illustrations/premiumAdvantages.png" alt="">
        </div>
        <div class="row">
            <h2 class="question">What are pricing plans and advantages?</h2>
            <p class="answer">-We have several types of payment plans. <span>Pre-register and get Premium for three months!</span></p>
            <div class="pricing">
                <div class="col">
                    <h1>Monthly Plan</h1>
                    <span class="disclaimer">(In case you do not cancel your    subscription, plan renews automatically)</span>
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
        <div class="row">
            <h2 class="question">What kind of content should I share or see?</h2>
            <p class="answer">-In Intercasted we have various kinds of content that you can watch and share. Everyone can find content for themselves which suits their interests, for example you can see videos related to your hobbies, movies, educative content, showrooms, daily life-based videos, and lots of topics!</p>
        </div>
        <div class="row">
            <h2 class="question">How can I contact Intercasted?</h2>
            <p class="answer">-You can contact us from contact@intercasted.com or from other social media platforms down below.</p>
            <div class="socialLinks">
                <a class="social" target="_blank" href="https://www.instagram.com/intercasted/?hl=tr">
                    <img src="../assets/img/icons/ig-logo.png" alt="Instagram">
                    <p>@intercasted</p>
                </a>
                <a class="social" target="_blank" href="https://twitter.com/intercasted">
                    <img src="../assets/img/icons/twitter-logo.png" alt="Instagram">
                    <p>@intercasted</p>
                </a>
                <a class="social" target="_blank" href="https://www.facebook.com/Intercasted-103285271375189/?modal=admin_todo_tour">
                    <img src="../assets/img/icons/facebook-logo.png" alt="Instagram">
                    <p>Intercasted</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- About kod sonu -->


<?php 

include("../includes/footer.php");

?>