<?php 

$currentPage = 'premium';
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
    <link rel="stylesheet" href="../style/premium/premium.css">
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

<!-- Premium kod başlangıcı -->

<div class="main">
    <div class="welcomer">
        <div class="specialOffer">
            <h1 class="title">Special Offer!</h1>
            <p class="slogan">Register to have <span>FREE</span> premium account!</p>
        </div>


        <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Join For Free!</a>

        <!-- <form action="" id="preRegister" class="preRegister" method="POST">

            <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="Email" required>

            <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Join for Free!">


            <p>*If you pre-register you are considered that you have accepted <a href="#">policies</a>.</p>

            <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

            <label for="campaignEmails" class="campaignEmailsLabel">I don't want to recieve campaign emails</label>

        </form> -->
    
        <p class="title">What kind of advantages does a premium account offer you?</p>
        <p class="text">As Intercaster, the Premium account offers you so many advantages. You can be discovered and announce your casts easily to grow your audience, get analysis to better understand whom you are addressing and lots of advantages to making you shine out!</p>

        <p class="title">Why should I upgrade my account?</p>
        <ul>
            <li>
                <p class="slogan">✓ Priority to display your streams in home page</p>
                <p class="text">Let people see your casts on the home page and discover you easily. With this priority, you will have a chance to be discovered by so many people, increase your audience and interest  them.</p>
            </li>
            <li>
                <p class="slogan">✓ Easiness to be discovered in discover page</p>
                <p class="text">Be one of the first intercasters which people see when they are looking for new streamers or content. Show up easily to show your unique content and let them get informed by you. Be discovered by people and let them watch your interactive casts.</p>
            </li>
            <li>
                <p class="slogan">✓ Chance to announce your casts with push notifications</p>
                <p class="text">With personalized notifications, you can announce your casts to your audience and people who may like your casts according to their interests. You can increase the number of users who are watching your casts with informing them by push notifications.</p>
            </li>
            <li>
                <p class="slogan">✓ Comprehensive Analysis</p>
                <p class="text">Get analysis at the end of your interactive video casts, see whom you are adressing, and plan your strategy accordingly. You can better understand the audience’s opinions of your content or you as a intercaster.</p>
            </li>
            <li>
                <p class="slogan">✓ Choosing multiple airdates</p>
                <p class="text">Stream your casts in different airdates that you decide. Enable to share your content multiple times with different and larger audience. People might have a chance to watch again or if they missed the first date they will be able to watch again.</p>
            </li>
        </ul>

        <h1 class="title">Pricing Plans</h1>

        <div class="pricing">
        <div class="col">
            <h1>Monthly Plan</h1>
            <span class="disclaimer">(In case you do not cancel your subscription, plan renews automatically)</span>
            <p class="discount">⠀⠀⠀⠀⠀⠀⠀</p>
            <h3 class="price">16.00TL</h3>
        </div>
        <div class="col">
            <h1>3 Month Plan</h1>
            <span class="oldPrice">48.00TL</span>
            <p class="discount">17% Discount</p>
            <h3 class="price">39.99TL</h3>
        </div>
        <div class="col">
            <h1>Annual Plan</h1>
            <span class="oldPrice">192.00TL</span>
            <p class="discount">38% Discount</p>
            <h3 class="price">119.99TL</h3>
        </div>

    </div>

    <h1 class="title">Premium is free for whom pre-registered!</h1>

    <p class="slogan centeredText">So what are you waiting for?</p>

    <a class="signUp" href="https://intercasted.com/intercasted/pages/signIn.php">Join For Free!</a>

    <!-- <form action="" id="preRegister" class="preRegister" method="POST">

            <input type="email" name="email" id="preRegisterInput" class="preRegisterInput" placeholder="Email" required>

            <input type="submit" id="preRegisterSubmit" class="preRegisterSubmit" value="Join for Free!">

             TODO add link to policies 

            <p>*If you pre-register you are considered that you have accepted <a href="../pages/tos.php">policies</a>.</p>

            <input type="checkbox" name="campaignEmails" id="preRegisterCampaign" class="preRegisterCampaign">

            <label for="campaignEmails" class="campaignEmailsLabel">I don't want to recieve campaign emails</label>

        </form> -->

</div>

<!-- Premium kod sonu -->

<?php 

include("../includes/footer.php");

?>