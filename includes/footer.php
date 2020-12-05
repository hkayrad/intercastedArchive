
<!-- footer start-->
<footer class="footer">
    <div class="top">
        <div class="left">
            <?php 

	if ($lang === 'en') {
            
            if ($currentPage === 'index') {
                echo '<img class="logo" src="./assets/img/logo/text.png" alt="">
                <div class="socialMediaLinks">
                <a class="social" target="_blank" href="https://www.instagram.com/intercasted/?hl=tr">
                    <img src="./assets/img/icons/ig-logo.png" alt="Instagram">
                    <p>@intercasted</p>
                </a>
                <a class="social" target="_blank" href="https://twitter.com/intercasted">
                    <img src="./assets/img/icons/twitter-logo.png" alt="Instagram">
                    <p>@intercasted</p>
                </a>
                <a class="social" target="_blank" href="https://www.facebook.com/Intercasted-103285271375189/?modal=admin_todo_tour">
                    <img src="./assets/img/icons/facebook-logo.png" alt="Instagram">
                    <p>Intercasted</p>
                </a>
                <a class="social" href="mailto:contact@intercasted.com">
                    <img src="./assets/img/icons/mail.png" alt="Mail Us">
                    <p>Mail Us</p>
                </a></div>';
                
            } else {
                echo '<img class="logo" src="../assets/img/logo/text.png" alt="">
                <div class="socialMediaLinks">
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
                <a class="social" href="mailto:contact@intercasted.com">
                    <img src="../assets/img/icons/mail.png" alt="Mail Us">
                    <p class="mailUsP">Mail Us</p>
                </a></div>';
            }
           } else {

	            if ($currentPage === 'index') {
                echo '<img class="logo" src="../assets/img/logo/text.png" alt="">
                <div class="socialMediaLinks">
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
                <a class="social" href="mailto:contact@intercasted.com">
                    <img src="../assets/img/icons/mail.png" alt="Mail Us">
                    <p>Mail Us</p>
                </a></div>';
                
            } else {
                echo '<img class="logo" src="../assets/img/logo/text.png" alt="">
                <div class="socialMediaLinks">
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
                <a class="social" href="mailto:contact@intercasted.com">
                    <img src="../assets/img/icons/mail.png" alt="Mail Us">
                    <p class="mailUsP">Mail Us</p>
                </a></div>';
            }


}
            ?>
            
        </div>
        <div class="right">  
        </div>
    </div>
    <div class="bottom">
    <p>
            ©2020 Intercasted. All rights reserved. 

            <?php

            if ($lang === "en") {
                if ($currentPage === "index") {
                    echo '<a href="./pages/tos.php">Terms of Service</a>, 
                        <a href="./pages/privacy.php">Privacy Policy</a>, 
                        <a href="#">Copyright</a>
                        & 
                        <a href="./pages/cookies.php">Cookies</a>';
                } else {
                    echo '<a href="../pages/tos.php">Terms of Service</a>, 
                        <a href="../pages/privacy.php">Privacy Policy</a>, 
                        <a href="#">Copyright</a>
                        & 
                        <a href="../pages/cookies.php">Cookies</a>';
                }
            } else {

                if ($currentPage === "index") {
                    echo '<a href="../pages/tosTr.php">Hizmet Kullanım Şartları</a>, 
                        <a href="../pages/privacyTr.php">Gizlilik Politikası</a>, 
                        <a href="#">Telif Hakkı</a>
                        & 
                        <a href="../pages/cookies.php">Çerez Politikası</a>';
                } else {
                    echo '<a href="../pages/tosTr.php">Hizmet Kullanım Şartları</a>, 
                        <a href="../pages/privacyTr.php">Gizlilik Politikası</a>, 
                        <a href="#">Telif Hakkı</a>
                        & 
                        <a href="../pages/cookiesTr.php">Çerez Politikası</a>';
                }
            }
            
                
            ?>
        </p>   
    </div>
</footer>

<!-- footer end -->

<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-database.js"></script>

<script <?php 

    if ($currentPage === 'index') {
        echo 'src="./js/firebase.js"';
    } else {
        echo 'src="../js/firebase.js"';
    }

?>></script>

</body>

<!-- body end -->

</html>

<!-- html end -->