<?php
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');

$ppDir = $_SESSION['profilePhoto'];
if (isset($_SESSION['signId'])) {
    $ID = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $ID;
} elseif (isset($_SESSION['userId'])) {
    $ID = $_SESSION['userId'];
} else {
    header('Location:./index.php');
}

$usernameQuery = "SELECT username FROM user WHERE id =" . $ID . "";
$nameResult = mysqli_query($connect, $usernameQuery);
$nameRow = mysqli_fetch_array($nameResult);
$username = $nameRow['username'];

$mailQuery = "SELECT mail FROM user WHERE id =" . $ID . "";
$mailResult = mysqli_query($connect, $mailQuery);
$mailRow = mysqli_fetch_array($mailResult);
$mail = $mailRow['mail'];
$_SESSION['mail'] = $mail;

$tViews = 0;
$tLikes = 0;
$tDislikes = 0;
$tFollowers = 0;
$tFollowed = 0;
//////////////////////////////BAR////////////////////////////////
$dataQuery = "SELECT `viewCount`, `likeCount`, `dislikeCount` FROM `video` WHERE uploadedById=" . $ID . "";
$dataResult = mysqli_query($connect, $dataQuery);
while ($data = mysqli_fetch_assoc($dataResult)) {
    $likes = $data['likeCount'];
    $dislikes = $data['dislikeCount'];
    $views = $data['viewCount'];

    $tViews += $views;
    $tLikes += $likes;
    $tDislikes += $dislikes;
}

$followerQuery = "SELECT count(*) AS cFollowers FROM `follow` WHERE followedId=" . $ID . "";
$followerResult = mysqli_query($connect, $followerQuery);
$follower = mysqli_fetch_assoc($followerResult);
$tFollowers = $follower['cFollowers'];


$followedQuery = "SELECT count(*) AS cFolloweds FROM `follow` WHERE followerId=" . $ID . "";
$followedResult = mysqli_query($connect, $followedQuery);
$followed = mysqli_fetch_assoc($followedResult);
$tFollowed = $followed['cFolloweds'];


///////////////////////////SIGN OUT//////////////////////////////
if (isset($_POST['signOut'])) {
    if (isset($_COOKIE['rememberMe'])) {
        $userId = decryptCookie($_COOKIE['rememberMe']);
        $sql_query = "SELECT count(*) AS cntUser,id FROM user WHERE id='" . $userId . "'";
        $result = mysqli_query($connect, $sql_query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['cntUser'];
        if ($count > 0) {
            $days = 1;
            $value = encryptCookie($userId);
            setcookie("rememberMe", $value, time() + ($days * -1 * 60 * 60));
            session_destroy();
            header('Location:./signIn.php');
        }
    } else {
        session_destroy();
        header('Location:./signIn.php');
    }
}
/////////////////////////////////////////////CHANGE PROFILE PHOTO///////////////////////////////////////////////////
if (isset($_POST['submitB'])) {
    $pBLOB = $_FILES['ppUpload']['name'];
    $png = ".png";
    $add = random_int(100000000, 999999999);
    $photo = $add . $png;
    $photoDir = '../img/pp/';
    $photoSum = $photoDir . $photo;
    $allFiles = scandir('../img/pp/');
    foreach ($allFiles as $file) {
        while (strstr($file, $photo)) {
            $add = random_int(100000000, 999999999);
            $photo = $add . $png;
            $photoSum = $photoDir . $photo;
        }
    }
    if (move_uploaded_file($_FILES['ppUpload']['tmp_name'], $photoSum)) {
        //echo "Dosya Yüklendi.\n";
        $blobQuery = "UPDATE `user`SET `pp`='$pBLOB' WHERE `id`=".$ID."";
        $uQuery = "UPDATE `user`SET `pPDir`='".$photoSum."' WHERE `id`=".$ID."";
        $result = mysqli_query($connect, $uQuery) or die(mysqli_error($connect));
        $blobResult = mysqli_query($connect, $blobQuery) or die(mysqli_error($connect));
        header('Location:./profile.php');
    } else {
        //echo "Dosya Yüklenemedi!\n";
    }
}
///////////////////////////////////////////BIOGRAPHY//////////////////////////////////////////////
$bioQuery="SELECT bio FROM user WHERE id=".$ID."";
$bioResult=mysqli_query($connect,$bioQuery);
$bioRow=mysqli_fetch_array($bioResult);
$bio=$bioRow['bio'];
if(strlen($bio)==0){
    
    $biography="";
}
else{
    $biography=$bio;
}
///////////////////////////////////////SELECT INTERESTS//////////////////////////////////////////
if (isset($_POST['interests'])) {
    header('Location:./interests.php');
}
///////////////////////////////////////CHANGE USERNAME//////////////////////////////////////////
if (isset($_POST['changeU'])) {
    $_SESSION['ID'] = $ID;
    header('Location:./cUsername.php');
}
////////////////////////////////////////VERIFY MAIL//////////////////////////////////////////
if (isset($_POST['cMail'])) {
    $_SESSION['ID'] = $ID;
    header('Location:./cMail.php');
}
///////////////////////////////////////CHANGE BIOGRAPHY//////////////////////////////////////////
if (isset($_POST['changeB'])) {
    $_SESSION['ID'] = $ID;
    header('Location:./cBio.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/profile/profile.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <aside>
        <div id="curoption">
            <a href="./profile.php">
                <p>Profile</p>
            </a>
        </div>
        <div id="option">
            <a href="./analytics.php">
                <p>Analytics</p>
            </a>
        </div>

        <div id="option">
            <form action="profile.php" method="POST">
                <label for="signOut">
                    <button type="submit" name="signOut">
                        <p>Sign Out</p>
                    </button>
                </label>
            </form>
        </div>
    </aside>
    <main>
        <section>
            <div id="upProf">
                <img src=<?php echo $ppDir; ?> alt="pp"><br>
                <h3><?php echo $username; ?></h3>

                <div class="barLine">
                    <div id="bar">
                        <p>Total<br> Followers</p><br><?php echo $tFollowers; ?>
                    </div>
                    <div id="bar">
                        <p>Total <br>Follows</p><br><?php echo $tFollowed; ?>
                    </div>
                    <div id="bar">
                        <p>Total <br>Views</p><br><?php echo $tViews; ?>
                    </div>
                    <div id="bar">
                        <p>Total <br>Likes</p><br><?php echo $tLikes; ?>
                    </div>
                    <div id="bar">
                        <p>Total <br>Dislikes</p><br><?php echo $tDislikes; ?>
                    </div>
                </div>
            </div>
                <p class="bio"><?php echo $biography;?></p>

            <hr>
            <br>
            <div id="upProf">
                <form action="profile.php" method="POST" enctype="multipart/form-data">

                    <input type="file" id="ppUpload" name="ppUpload" value="ppUpload" accept="img/.png,.jpg,.jpeg" style="display:none; position:relative;">
                    <label class="photo" for="ppUpload">Change Photo</label>
                    <button class="changeUsername" name="changeU" type="submit">Change Username</button>
                    <button class="changeUsername" name="changeB" type="submit">Change Biography</button>

            </div>
            <br>
            <div id="downProf">
                <input name="interests" class="interests" value="Select Interests" type="submit">
                <input name="cMail" class="mailB" value="Change E-mail: <?php echo $mail; ?>" type="submit">
                <br>
                <input name="submitB" class="submitChanges" value="Submit Changes" type="submit">
                </form>
            </div>
        </section>
    </main>
</body>

</html>