<?php 
session_start();
include('../includes/db.php');
include('../includes/functions.php');
if(isset($_SESSION['signId'])){
    $ID=$_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId']=$ID;
} elseif(isset($_SESSION['userId'])){
    $ID=$_SESSION['userId'];
} else{
    $ID=0;
}
$vmQuery="SELECT mCode FROM user WHERE id=".$ID."";
$vmResult=mysqli_query($connect,$vmQuery);
$vmRow=mysqli_fetch_array($vmResult);
$vm=$vmRow['mCode'];
if(!empty($vm)){
    header('Location:./vmCode.php');
}
?>

<header class="navBar">
    <div class="navLeft">

        <!-- Side bar -->
        <div class="sideBar" id="sideBar">
            <ul class="sideList">
                <li><a href="../pages/index.php" class="sideItem">Home</a></li>
                <?php 
                if($ID!== 0) {
                echo '<li><a href="../pages/upload.php" class="sideItem">Upload</a></li>';}
                ?>
                <li><a href="../pages/discoverV2.php" class="sideItem">Discover</a></li>
                <li><a href="../pages/openStreamsV2.php" class="sideItem">Open Streams</a></li>
                <li><a href="../pages/profile.php" class="sideItem">Profile</a></li>
            </ul>
        </div>

        <!-- Hamburger Menu -->
        <div class="hamburger" onclick='toggleHamburger(this)'>
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>

        <!-- Intercasted Logo -->
        <div class="logoContainer">
            <a href="index.php">
                <img src="../img/logo/logoText.png" alt="Logo" class="logoText">
                <img src="../img/logo/logo.png" alt="logo" class="logo">
            </a>
        </div>

    </div>

    <div class="navRight">
        <!-- Sign in button -->
        <?php

        $photoQuery="SELECT pPDir FROM user WHERE id = '".$ID."'";
        $pResult=mysqli_query($connect,$photoQuery);
        $pPResult=mysqli_fetch_assoc($pResult);
        $ppDir = $pPResult['pPDir'];
        $_SESSION['profilePhoto']=$ppDir;

        if ($ID !== 0) {
            echo '<a href="../pages/profile.php" class="profile">
            <img src="'.$ppDir.'" alt=""></a>

            <a href="#" class="notifBtn">
                <img class="notifIcon" src="../img/icons/bell.png" alt="Notifications">
                <p class="notifText">Notifications</p>
            </a>

            <a href="../pages/upload.php" class="uploadBtn">
                <img class="uploadIcon" src="../img/icons/upload.png" alt="Upload">
                <p class="uploadText">Upload</p>
            </a>';

        } elseif (isset($_COOKIE['rememberMe'])) {
            // Decrypt cookie variable value
            $userId = decryptCookie($_COOKIE['rememberMe']);
            $sql_query = "SELECT count(*) AS cntUser,id FROM user WHERE id='" . $userId . "'";
            $result = mysqli_query($connect, $sql_query);
            $row = mysqli_fetch_assoc($result);
            $count = $row['cntUser'];

            if ($count > 0) {
                $_SESSION['userId'] = $userId;
                echo '<a href="../pages/profile.php" class="profile">
                <img src="'.$ppDir.'" alt=""></a>
    
                <a href="#" class="notifBtn" onClick="easterEgg()">
                    <img class="notifIcon" src="../img/icons/bell.png" alt="Notifications">
                    <p class="notifText">Notifications</p>
                </a>
    
                <a href="../pages/upload.php" class="uploadBtn">
                    <img class="uploadIcon" src="../img/icons/upload.png" alt="Upload">
                    <p class="uploadText">Upload</p>
                </a>';
                exit;
            }

        } elseif($ID === 0) {
            echo ('<a href="../pages/signIn.php" class="signInBtn">Sign In</a>');
        }
        ?>
        <!-- Notification button -->
        <!-- TODO Add notifications page and functionality -->
        <?php 
            if(isset($_POST["submit"])) {
                $search = $_POST["search"];
                
                $sQuery= "SELECT * FROM video WHERE videoTitle LIKE '%$search%' OR videoDesc LIKE '%$search%' ";

                $searchPlus = str_replace(' ', '+', $search);
                $searchResults = mysqli_query($connect, $sQuery);

                $_SESSION["search"] = $search;
                $_SESSION["sQuery"] = $sQuery;
                $_SESSION["searchResults"] = $searchResults;

                header("Location: ../pages/searchResults.php?search=".$searchPlus);

                if(!$searchResults) 
                    die("Query failed" . mysqli_error($connect));
            }
        ?>
        <!-- Search Form -->
        <form method="post" class="searchBtn" action="../pages/searchResults.php">
            <label class="searchSubmit">
                <img class="searchIcon" src="../img/icons/search.png" alt="">
                <input type="submit" name="submit" class="searchButton">
            </label>
            <input name="search" class="searchInput" type="keywords" placeholder="Search" required>
        </form>
    </div>
</header>

<script>

var button = document.querySelector(".notifBtn");
let clicked = 0;

button.addEventListener("click", function () {
    console.log("sa * 64^13 -> as \n
        ==QP9EFU3FlRVNFb6FmUOZEZ0pVMVNEasVFcwtmUoxGbWdkUyYVYaFjVZh2RXlGZsd1cOxmUrZkaWBFcxEmWsVlT3lUMh9EetVlM3dkYqZ0RkhFbGd1bkxWWZB3aiNlUudFeVFjVXpVMWh3asZ1VsdUYXlTRktmREpVeoNjVh5kaXNnWWZVNwIjVzwWVNhmTW5UeZZ0VxUlVUdlUYJGWkt2VXRWMkFGetZ1dChlUp5EbWlEcGVmTkZFVDJESXdFbGNmVKFjVrpFMZpXNFJma0t2UxplRS9mTqZFWCNTYSxmVNJnRH1EMKpmVZpkViNFatR1RGJzYzpFMWBzbFZlWsZlTypkMVNVNXZFNWBjVaRGbXhXWW1kSWBTVwJ1RiVFZrJFWkZVW0ETbWZDcWJ1UG1GVXVzajdkSqZldwZlVaxmRjZkSHFWNVxGV1wGbSRlTW1EdaZUVD5kaVNHayEGWOhkW4FlMWBDZxYlVwVVTTxWbWNnTWR2VGpmVQB3ahdFarFleZZ0V3hWMVhkUtZFakhUZ0pFblFGetZ1cwZlUh5kbXNnUyIGew0mVZB3aSNFbtd1VxADZGRWVUJnWGJGWkhVUJpkMWFzcyYVMatmVX5kbXd3aGVmToxWWXpURThGbYJVeVFzYvp1aWFzdXZlTOZkWJZ0RlpFeXZFTShlYahGbVhkSyU1U1ITVIVTVNNFazk1ckZEV3ZEVZ9mUHJGWstGV5llVZRjSqZ1bwVVToBnRaNnSWJFeBpmVEpUMhhFZsFVdKxGVrVjMWlHeX1UVOVUYyxmRXFTVwUFcod0VUxGWWhXSH50aGpmVoJEWW5kTGJGdkFjU3ZkaWhXRFJVY5sWV0plRXtGaWZVWGRUTXRmRjhlVW10daZFVXJFWihlSIp1cWdVT6FTbWlnSGdVaOxmU1RWMjdFZWd1dR1mVYh2RjZkSHF2S4JjV4J1VNNFdtJVRwZUTGJFbZhlUHJmUwhlU5VVMiRTMXZVeRRUTXh3RjNHZxY1dGRFVUh2RipFaW5kROxWYrRnMVVjVW10VSp2UxplRNpFdtZFcShlYSZVRjhXWxEWYGpmV69mVSdFcsRVdkFDZKpVVZhmWG1kWSRkYXFDMVBDdXZVewZVTplTbTVlUGZ1Ux0WVvBXMhVlUuRFWsZVWhpVMWZDbV10VOxmU0ZkVS9UMtVFTwVkUXJkRhhlWWl1c4dVVKB3aNhGdtd1drZVT3p1aZhlWVJ2VOhkYXpVMitmQqZVVoNjUYhmRhlFZxIVMBpXVUhGWidFcYd1dFdVYrpFbUdEcwIFVkVVTYBnVlFGdXpVYoJjUq5kbXdlWxI1aCR1VJJ0Mh5EZsRlV1U0VhpVVUNjWsZVV5ckY2oUMh9GeyYFWS1mVaZ0RlhFZsd1daVFVUJ1MShmSIpFeZFDVHB3VX1EcFJ2UkZkYH5kMjtkWWlFawFTYYhGbWZjRtFGM01WVyklRipGdFRGWsZ0V3Z1aV9GeHdFWO5WV4V0VZNkUxYFNGBTToRGbUdkRXdVYGpmV6pVRSFmRHN2VaZlVHFjMVdEcFJGa012VXJVMNdlQqV1TKtWYUZkbXNXNwI2b4d1VVhmMSlmVGJmcSZ0VrZkeZhmWrF2Vwh1UHRmVhdHetZleaxmVspVVNRnWsV2bx0mVYpkRW5kWW1kcaFjU4BzVWRjQuZlTSxGVGZkMjFmWrZFTohlYWlTbVlXRyU1coZkVZh3VNNFZIp1caxWVLJEVU9GayIVYktmV05kMhRjSUdVSCNTYoRGbXVnVGdVY4JjVopUMhpFZsJVRxAjVrZ1aXdkQuZ1TO52VXJVMUFzctlFWSdkYWhGWTlXTxYFMkxmV1IEWSlGbHp1Rwx2YhplVaNlUtZFWkhVVYFDMWdFcXVlWGRlUoJFRad3aWNVY0dFVUJ1MhRlRud1cWdVWXRXbWhlQIJWaSx2VyRmRlplRqlFeN1mVXZUbXZkWxU1bxckV6J1RidlTIVGWwZkVTFTbWZFaHJGWK5mV0ZkMiFGdXdVSwFTYOR3RaJnVxY1aaFjVzAnRidlQuN1RKdkVXVzRWhlWWJ2VkV0YZRmRNBTQqVFcSdkYYZ1aURnTyMVYaZ1V5h2RXlmWsd1ROJjULpEVWJnVq10VkZUZYFzaUtGaVpFMwZkYXlzRaJHbxUVY41WWVpEbidFaYRVeZZUTLBXbWlHOXZlTkZlTG50RkdlWsV1MatWZah2RhVXMwY1UWVVWJBXVidlTFFmVsZlTzZlVU9Gb6J1aox2VX5UMTRDZGZVWwZUTTh3RhJHZxIFeVVFVXp0ahdFZuFVSKJjVDhnMVFDcW1kakZVT5VlRhNlTqZVWwZkUoxGWXNnUxEWYWZ1V2AnRiNFaGFmeNd0VhplVU9kUHJ2Vo12UGpEbh9UNyYFNsZVToZUbRVFZWl1boxWWUJ1RiZlRuR1VOJjVHB3VXpXSGdVawxmVzZlRXtkWWdldodkYWZFRiZVMrZ1Rx0WV4BnVNRlTFF2caZkVLhXbV9mUyE2UshFVYxWMSdHZsZlUwVVTXRGbShEcsN2VaZlWHZkaNdlWuVFWax2VhJ1aZhlRE10VWRUT0pFbltkWWR1T1U0UrJlbWdkTXl1QwdlV5h2MShFZGplcaZVZSRmVXdXUX10VaRUYZp0Ri9EetVFMSdVTqRGbSZDbGF2dGRVWWBXRThGcYdFeZFjYxMmVWFmQzE2UoxmU240VlZlWWRFVGRlYW5kbRpXRyU1V4JjVIZkehNlTGVGWkZ1VDhGbVhFcrJVaO5GV4lVMStkUrZ1boJTTTRGbWVkTtNWY4dkVQBXMhhFcrdFeZZkYLhWVallQY1kTkhUZ0pFbWFmQqV1bodlUhRGbXhXTH50SSxmVzwWVNdVNFNGdWZlU3ZkeZhGcsZVVGd0YXplVWNlWVlFMwxmUWZUbXNnUxI1Ux0mVhpVViNlRud1VOFzUXJEVWplSFNVaWxmV1pVMWtmR6VlcKtWYXpERhlXWsR1aaVVW6pFbShFaYZlcax2Yv5kaWdFaHNlaO52V4lVMhFDMtZVNohlYTRmVPRnTWN2VGpWWzIFWiplVsVVeF1mVzhmVWRTMV1kVSRVT0pVMTNEasV1TWRlUhRWRjhXSxM1SwdlVRJ0MhhGZGVmckx2YHpkaWxEaH1kWoZ0YHp0RXtGaVlleKZVTTRGSkhlUxY1UkxmVPh3RXhFaI10dNdkT4NGbWJDcV1kTodUYzRWMjdlRqZlewFTYVpkbTZkWxY1b10mVykFMWhWOtdlckZVZ3RXbVVFaHd1VaZ0Y41UMR9GeXdVWoNjVTB3RallSGd1RKRVWwE1RidFbFNmcaZVY3RWRalnUtJFbK52V3lVMNdHetZlVodkYU5kbTdkRyIGMKRlV3lUMW5kWsVVcOZ1YhpVMVREaHJ2VC5WV0pUMh9GdXZVWaZlYXZ0RkhkWs50SGRFVYplRidFZW5kcKFzUrJkaWJDayYlTkxWVFpUbjhXVWlVMNdlVhxGbVhkSHJWNwITV4BHbSpmRtdlcsxmV0QGbVFHaHdFWohVV41UMk9GetZlMKtmYXVTRhhkRyYVNVBTVQJ1VWFGZrVVeF12VPJFMZhFcGJGWOV0YYplVTdHdXR1VKVkUrJlbWdkVyQWY0d1V5pkVilGasd1cWFjVzZEVVZnSFZ1Vo5mV2Y0Vh9mWrdVewtmVsp1aTFHbGF2dGRVWYVTRWBlUuN1VGJDVhh3RWVDcrZlTOZkWJZ1VlJHeXp1MwxmVVZUbTNnSGF2b0JTVwI1VNpmUEp1cax2ULpFbZRFatJ1aotWVIRmVZFGdHZlNKFTTXZFbXNnVGN1a4dkVUZlaNdFarVFWxUVY1UFMZlFcsZFW50GVxplRjtEetVFawtmYVR2aVlXUxM1U01mV2p0aiNFbHF2RGd0UPRWVadkUyEmWOR0Y4V0RXFmUrl1VwtWTWRWVNRnVGV2daZFVPxmeShmTIJ2RkFDZHJlVXVFcsZ1V1s2U1RmRlZlRUZFawFTYXh2MZllSyU1ckVlWwokVNNFZuJVcaZkV3pVVUhlSsJFaot2U0RWMjFmQUdVNChlVpRmRkRnWxM2UGRFV6JFWiZVOrVVWKd0VvhWMWhlUX1kU50mVHpFbk9WNXRFVoJjUhp1aUlXTyQ1SStmVvJkbSlGaGFGSOJjVLZEVWJHcWZlWwx2VGpkMUdUMtVFewZkYslzRhNHbGd1d41WVxJlMhRFasdFeRZkTLBXbWlFay00Usd1TyZkVSdHeyklewZVTahWbXdkStd1c4dlVJBHMShVOV5EWaZlTXplVU9mSFJVYoh1V4lkMih3YGZVVo5WTTh2RaZkTyM2TKRkVoBnRihFaHNGeFdUYrp1aXplWsJFV0t2UxpVMNNFaslFWwxmUqR2aThlWxQFNKpmVYh2MSlWOrFVRwFjVTpFMWRFaHJmWsxWVIp0RXtGdtVVNstWTVRGWNRnWsR2bxcFVUh3VihlTuZ1VSJDVHB3VWlkQYJ1UkZUYZZEbOFmRqZleohlYXplRjdkSXZ1T4JjVHJkbWRlRtJVcWx2YhZFbZllUtJlaktmU5lkMUdXMtZ1bohlYshWbXNnVWR2TGpmVIB3alpFZYVVeFJjVHBHSalFcGJWVOx2VGBXMSFTQqVlcaVlYY5kbXdkUxU1b4d1Voh3RWNFcHplcOZ0UrZEVZdXRUJ2VwtmVVpFbUNlWFp1R1AjUrZUbXZFcx00TOpmVWxmeShmUuN1cGJzYwQ2aWFzdHJ2U412VHZ1RkFmWWZFRo1mVVlzRhhkSXZ1V0JTV1EzaNRlRtFVcaZUZ3N3VU9GaHJWVWt2U510VZdEctZVVwVVTohGbUVkSyMWYaBjVQBHbWVlQqd1cKxWY1M2aXNDbsZ1V5ckW3lVMW9mSUlFW4d0VWxGWVlXUyQ2dw0mV");
    if (clicked < 10) {
        clicked+=1;
    } else {
        console.log("sa * 64^13 -> as \n
        ==QP9EFU3FlRVNFb6FmUOZEZ0pVMVNEasVFcwtmUoxGbWdkUyYVYaFjVZh2RXlGZsd1cOxmUrZkaWBFcxEmWsVlT3lUMh9EetVlM3dkYqZ0RkhFbGd1bkxWWZB3aiNlUudFeVFjVXpVMWh3asZ1VsdUYXlTRktmREpVeoNjVh5kaXNnWWZVNwIjVzwWVNhmTW5UeZZ0VxUlVUdlUYJGWkt2VXRWMkFGetZ1dChlUp5EbWlEcGVmTkZFVDJESXdFbGNmVKFjVrpFMZpXNFJma0t2UxplRS9mTqZFWCNTYSxmVNJnRH1EMKpmVZpkViNFatR1RGJzYzpFMWBzbFZlWsZlTypkMVNVNXZFNWBjVaRGbXhXWW1kSWBTVwJ1RiVFZrJFWkZVW0ETbWZDcWJ1UG1GVXVzajdkSqZldwZlVaxmRjZkSHFWNVxGV1wGbSRlTW1EdaZUVD5kaVNHayEGWOhkW4FlMWBDZxYlVwVVTTxWbWNnTWR2VGpmVQB3ahdFarFleZZ0V3hWMVhkUtZFakhUZ0pFblFGetZ1cwZlUh5kbXNnUyIGew0mVZB3aSNFbtd1VxADZGRWVUJnWGJGWkhVUJpkMWFzcyYVMatmVX5kbXd3aGVmToxWWXpURThGbYJVeVFzYvp1aWFzdXZlTOZkWJZ0RlpFeXZFTShlYahGbVhkSyU1U1ITVIVTVNNFazk1ckZEV3ZEVZ9mUHJGWstGV5llVZRjSqZ1bwVVToBnRaNnSWJFeBpmVEpUMhhFZsFVdKxGVrVjMWlHeX1UVOVUYyxmRXFTVwUFcod0VUxGWWhXSH50aGpmVoJEWW5kTGJGdkFjU3ZkaWhXRFJVY5sWV0plRXtGaWZVWGRUTXRmRjhlVW10daZFVXJFWihlSIp1cWdVT6FTbWlnSGdVaOxmU1RWMjdFZWd1dR1mVYh2RjZkSHF2S4JjV4J1VNNFdtJVRwZUTGJFbZhlUHJmUwhlU5VVMiRTMXZVeRRUTXh3RjNHZxY1dGRFVUh2RipFaW5kROxWYrRnMVVjVW10VSp2UxplRNpFdtZFcShlYSZVRjhXWxEWYGpmV69mVSdFcsRVdkFDZKpVVZhmWG1kWSRkYXFDMVBDdXZVewZVTplTbTVlUGZ1Ux0WVvBXMhVlUuRFWsZVWhpVMWZDbV10VOxmU0ZkVS9UMtVFTwVkUXJkRhhlWWl1c4dVVKB3aNhGdtd1drZVT3p1aZhlWVJ2VOhkYXpVMitmQqZVVoNjUYhmRhlFZxIVMBpXVUhGWidFcYd1dFdVYrpFbUdEcwIFVkVVTYBnVlFGdXpVYoJjUq5kbXdlWxI1aCR1VJJ0Mh5EZsRlV1U0VhpVVUNjWsZVV5ckY2oUMh9GeyYFWS1mVaZ0RlhFZsd1daVFVUJ1MShmSIpFeZFDVHB3VX1EcFJ2UkZkYH5kMjtkWWlFawFTYYhGbWZjRtFGM01WVyklRipGdFRGWsZ0V3Z1aV9GeHdFWO5WV4V0VZNkUxYFNGBTToRGbUdkRXdVYGpmV6pVRSFmRHN2VaZlVHFjMVdEcFJGa012VXJVMNdlQqV1TKtWYUZkbXNXNwI2b4d1VVhmMSlmVGJmcSZ0VrZkeZhmWrF2Vwh1UHRmVhdHetZleaxmVspVVNRnWsV2bx0mVYpkRW5kWW1kcaFjU4BzVWRjQuZlTSxGVGZkMjFmWrZFTohlYWlTbVlXRyU1coZkVZh3VNNFZIp1caxWVLJEVU9GayIVYktmV05kMhRjSUdVSCNTYoRGbXVnVGdVY4JjVopUMhpFZsJVRxAjVrZ1aXdkQuZ1TO52VXJVMUFzctlFWSdkYWhGWTlXTxYFMkxmV1IEWSlGbHp1Rwx2YhplVaNlUtZFWkhVVYFDMWdFcXVlWGRlUoJFRad3aWNVY0dFVUJ1MhRlRud1cWdVWXRXbWhlQIJWaSx2VyRmRlplRqlFeN1mVXZUbXZkWxU1bxckV6J1RidlTIVGWwZkVTFTbWZFaHJGWK5mV0ZkMiFGdXdVSwFTYOR3RaJnVxY1aaFjVzAnRidlQuN1RKdkVXVzRWhlWWJ2VkV0YZRmRNBTQqVFcSdkYYZ1aURnTyMVYaZ1V5h2RXlmWsd1ROJjULpEVWJnVq10VkZUZYFzaUtGaVpFMwZkYXlzRaJHbxUVY41WWVpEbidFaYRVeZZUTLBXbWlHOXZlTkZlTG50RkdlWsV1MatWZah2RhVXMwY1UWVVWJBXVidlTFFmVsZlTzZlVU9Gb6J1aox2VX5UMTRDZGZVWwZUTTh3RhJHZxIFeVVFVXp0ahdFZuFVSKJjVDhnMVFDcW1kakZVT5VlRhNlTqZVWwZkUoxGWXNnUxEWYWZ1V2AnRiNFaGFmeNd0VhplVU9kUHJ2Vo12UGpEbh9UNyYFNsZVToZUbRVFZWl1boxWWUJ1RiZlRuR1VOJjVHB3VXpXSGdVawxmVzZlRXtkWWdldodkYWZFRiZVMrZ1Rx0WV4BnVNRlTFF2caZkVLhXbV9mUyE2UshFVYxWMSdHZsZlUwVVTXRGbShEcsN2VaZlWHZkaNdlWuVFWax2VhJ1aZhlRE10VWRUT0pFbltkWWR1T1U0UrJlbWdkTXl1QwdlV5h2MShFZGplcaZVZSRmVXdXUX10VaRUYZp0Ri9EetVFMSdVTqRGbSZDbGF2dGRVWWBXRThGcYdFeZFjYxMmVWFmQzE2UoxmU240VlZlWWRFVGRlYW5kbRpXRyU1V4JjVIZkehNlTGVGWkZ1VDhGbVhFcrJVaO5GV4lVMStkUrZ1boJTTTRGbWVkTtNWY4dkVQBXMhhFcrdFeZZkYLhWVallQY1kTkhUZ0pFbWFmQqV1bodlUhRGbXhXTH50SSxmVzwWVNdVNFNGdWZlU3ZkeZhGcsZVVGd0YXplVWNlWVlFMwxmUWZUbXNnUxI1Ux0mVhpVViNlRud1VOFzUXJEVWplSFNVaWxmV1pVMWtmR6VlcKtWYXpERhlXWsR1aaVVW6pFbShFaYZlcax2Yv5kaWdFaHNlaO52V4lVMhFDMtZVNohlYTRmVPRnTWN2VGpWWzIFWiplVsVVeF1mVzhmVWRTMV1kVSRVT0pVMTNEasV1TWRlUhRWRjhXSxM1SwdlVRJ0MhhGZGVmckx2YHpkaWxEaH1kWoZ0YHp0RXtGaVlleKZVTTRGSkhlUxY1UkxmVPh3RXhFaI10dNdkT4NGbWJDcV1kTodUYzRWMjdlRqZlewFTYVpkbTZkWxY1b10mVykFMWhWOtdlckZVZ3RXbVVFaHd1VaZ0Y41UMR9GeXdVWoNjVTB3RallSGd1RKRVWwE1RidFbFNmcaZVY3RWRalnUtJFbK52V3lVMNdHetZlVodkYU5kbTdkRyIGMKRlV3lUMW5kWsVVcOZ1YhpVMVREaHJ2VC5WV0pUMh9GdXZVWaZlYXZ0RkhkWs50SGRFVYplRidFZW5kcKFzUrJkaWJDayYlTkxWVFpUbjhXVWlVMNdlVhxGbVhkSHJWNwITV4BHbSpmRtdlcsxmV0QGbVFHaHdFWohVV41UMk9GetZlMKtmYXVTRhhkRyYVNVBTVQJ1VWFGZrVVeF12VPJFMZhFcGJGWOV0YYplVTdHdXR1VKVkUrJlbWdkVyQWY0d1V5pkVilGasd1cWFjVzZEVVZnSFZ1Vo5mV2Y0Vh9mWrdVewtmVsp1aTFHbGF2dGRVWYVTRWBlUuN1VGJDVhh3RWVDcrZlTOZkWJZ1VlJHeXp1MwxmVVZUbTNnSGF2b0JTVwI1VNpmUEp1cax2ULpFbZRFatJ1aotWVIRmVZFGdHZlNKFTTXZFbXNnVGN1a4dkVUZlaNdFarVFWxUVY1UFMZlFcsZFW50GVxplRjtEetVFawtmYVR2aVlXUxM1U01mV2p0aiNFbHF2RGd0UPRWVadkUyEmWOR0Y4V0RXFmUrl1VwtWTWRWVNRnVGV2daZFVPxmeShmTIJ2RkFDZHJlVXVFcsZ1V1s2U1RmRlZlRUZFawFTYXh2MZllSyU1ckVlWwokVNNFZuJVcaZkV3pVVUhlSsJFaot2U0RWMjFmQUdVNChlVpRmRkRnWxM2UGRFV6JFWiZVOrVVWKd0VvhWMWhlUX1kU50mVHpFbk9WNXRFVoJjUhp1aUlXTyQ1SStmVvJkbSlGaGFGSOJjVLZEVWJHcWZlWwx2VGpkMUdUMtVFewZkYslzRhNHbGd1d41WVxJlMhRFasdFeRZkTLBXbWlFay00Usd1TyZkVSdHeyklewZVTahWbXdkStd1c4dlVJBHMShVOV5EWaZlTXplVU9mSFJVYoh1V4lkMih3YGZVVo5WTTh2RaZkTyM2TKRkVoBnRihFaHNGeFdUYrp1aXplWsJFV0t2UxpVMNNFaslFWwxmUqR2aThlWxQFNKpmVYh2MSlWOrFVRwFjVTpFMWRFaHJmWsxWVIp0RXtGdtVVNstWTVRGWNRnWsR2bxcFVUh3VihlTuZ1VSJDVHB3VWlkQYJ1UkZUYZZEbOFmRqZleohlYXplRjdkSXZ1T4JjVHJkbWRlRtJVcWx2YhZFbZllUtJlaktmU5lkMUdXMtZ1bohlYshWbXNnVWR2TGpmVIB3alpFZYVVeFJjVHBHSalFcGJWVOx2VGBXMSFTQqVlcaVlYY5kbXdkUxU1b4d1Voh3RWNFcHplcOZ0UrZEVZdXRUJ2VwtmVVpFbUNlWFp1R1AjUrZUbXZFcx00TOpmVWxmeShmUuN1cGJzYwQ2aWFzdHJ2U412VHZ1RkFmWWZFRo1mVVlzRhhkSXZ1V0JTV1EzaNRlRtFVcaZUZ3N3VU9GaHJWVWt2U510VZdEctZVVwVVTohGbUVkSyMWYaBjVQBHbWVlQqd1cKxWY1M2aXNDbsZ1V5ckW3lVMW9mSUlFW4d0VWxGWVlXUyQ2dw0mV");
    }
});
</script>
