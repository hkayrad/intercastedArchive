
<header class="navBar">

<div class="left">
    <!-- <img src="./img/logo/text.png" alt=""> -->
<?php 

    if ($lang === 'en') {
        if ($currentPage === 'index') {
        echo '<a href="./"><img src="./assets/img/logo/text.png" alt="">';
    } else {
        echo '<a href="../"><img src="../assets/img/logo/text.png" alt="">';
    }
    } else {
        echo '<a href="../pages/indexTr.php">';
        echo '<img src="../assets/img/logo/text.png" alt="">';
    }

    ?></a>

</div>

<div class="right">

    <!-- Sidebar -->
    <div class="sideBar" id="sideBar">
        <ul class="sideList">
            <?php 

                if($lang === 'en') {

                    if ($currentPage === 'index') {
                        echo '<li><a href="./pages/product.php" class="sideItem">Product</a></li>
                            <li><a href="./pages/premium.php" class="sideItem">Premium</a></li>
                            <li><a href="./pages/pricing.php" class="sideItem">Pricing</a></li>
                            <li><a href="./pages/about.php" class="sideItem">About</a></li>
                            <li><a href="./pages/contact.php" class="sideItem contactUs">Contact Us</a></li>
                            <li><div class="languageSelection" onclick="toggleLanguage(this)"><span class="triangle"></span><p>Language</p></div></li>
                            <li class="languages">
                                <a href="./">English</a>
                                <a href="./pages/indexTr.php">Türkçe</a>
                            </li>';
                    } else {
                        echo '<li><a href="../pages/product.php" class="sideItem">Product</a></li>
                            <li><a href="../pages/premium.php" class="sideItem">Premium</a></li>
                            <li><a href="../pages/pricing.php" class="sideItem">Pricing</a></li>
                            <li><a href="../pages/about.php" class="sideItem">About</a></li>
                            <li><a href="../pages/contact.php" class="sideItem contactUs">Contact Us</a></li>
                            <li><div class="languageSelection" onclick="toggleLanguage(this)"><div class="triangle"></div><p>Language</p></div></li>
                            <li class="languages">
                                <a href="../">English</a>
                                <a href="../pages/indexTr.php">Türkçe</a>
                            </li>';
                    }
                } else {

                    if ($currentPage === 'index') {
                        echo '<li><a href="../pages/productTr.php" class="sideItem">Ürün</a></li>
                            <li><a href="../pages/premiumTr.php" class="sideItem">Premium</a></li>
                            <li><a href="../pages/pricingTr.php" class="sideItem">Fiyatlandırma</a></li>
                            <li><a href="../pages/aboutTr.php" class="sideItem">Hakkımızda</a></li>
                            <li><a href="../pages/contactTr.php" class="sideItem contactUs">Bize Ulaşın</a></li>
                            <li><div class="languageSelection" onclick="toggleLanguage(this)"><span class="triangle"></span><p>Dil Seçimi</p></div></li>
                            <li class="languages">
                                <a href="../">English</a>
                                <a href="../pages/indexTr.php">Türkçe</a>
                            </li>';
                    } else {
                        echo '<li><a href="../pages/productTr.php" class="sideItem">Ürün</a></li>
                            <li><a href="../pages/premiumTr.php" class="sideItem">Premium</a></li>
                            <li><a href="../pages/pricingTr.php" class="sideItem">Fiyatlandırma</a></li>
                            <li><a href="../pages/aboutTr.php" class="sideItem">Hakkımızda</a></li>
                            <li><a href="../pages/contactTr.php" class="sideItem contactUs">Bize Ulaşın</a></li>
                            <li><div class="languageSelection" onclick="toggleLanguage(this)"><div class="triangle"></div><p>Dil Seçimi</p></div></li>
                            <li class="languages">
                                <a href="../">English</a>
                                <a href="../pages/indexTr.php">Türkçe</a>
                            </li>';
                    }
                }

                
            
            ?>

        
            
        </ul>
    </div>

    <!-- Hamburger Menu -->
    <div class="hamburger" onclick='toggleHamburger(this)'>
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <div class="navList">
        <?php 

        if ($lang === 'en') {
            if ($currentPage === 'index') {
            echo '<a href="./pages/contact.php" class="navItem contactUs">Contact Us</a> 
            <a href="https://intercasted.com/intercasted/pages/signIn.php" class="joinForFree">Join for Free</a>';
            
        } else {
            echo '<a href="./contact.php" class="navItem contactUs">Contact Us</a> 
            <a href="https://intercasted.com/intercasted/pages/signIn.php" class="joinForFree">Join for Free</a>';
        }
        } else {
            if ($currentPage === 'index') {
                echo '<a href="../pages/contactTr.php" class="navItem contactUs">Bize Ulaşın</a> 
                <a href="https://intercasted.com/intercasted/pages/signIn.php" class="joinForFree">Ücretsiz Katıl</a>';
                
            } else {
                echo '<a href="../pages/contactTr.php" class="navItem contactUs">Bize Ulaşın</a> 
                <a href="https://intercasted.com/intercasted/pages/signIn.php" class="joinForFree">Ücretsiz Katıl</a>';
            }
        }
        
        

        ?>
        
    </div>
    

</div>

</header>
