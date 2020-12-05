<?php session_start();
include('../includes/db.php');

$message = " ";
$mail = $_SESSION["mail"];
if (isset($_SESSION['signId'])) {
    $ID = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $ID;
} elseif (isset($_SESSION['userId'])) {
    $ID = $_SESSION['userId'];
} else {
    header('Location:./index.php');
}

$vmQuery="SELECT mCode FROM user WHERE id=".$ID."";
$vmResult=mysqli_query($connect,$vmQuery);
$vmRow=mysqli_fetch_array($vmResult);
$vm=$vmRow['mCode'];
if(!empty($vm)){
    header('Location:./vmCode.php');
}

$pPQuery = "SELECT pPDir FROM user WHERE id=".$ID;
$pPResult = mysqli_query($connect, $pPQuery);
$pPRow = mysqli_fetch_array($pPResult);
$pPDir = $pPRow['pPDir'];

$minCat= 0;

if(isset($_POST['submit'])) {
    
    $dQuery="DELETE FROM `usercategory` WHERE userId = ".$ID."";
    $IDQuery = mysqli_query($connect, $dQuery);

    if(isset($_POST["documentaries"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId`, `categoryId`) VALUES (".$ID.", 1)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["comedy"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",2)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["action"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",3)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["biography"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",4)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["scifi"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",5)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["cartoons"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",6)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["thriller"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",7)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["romance"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",8)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["vlogs"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",9)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["travel"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",10)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["makeUp"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",11)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["pets"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",12)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["funnyVideos"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",13)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["dailyLife"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",14)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["sports"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",15)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["music"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",16)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["concerts"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",17)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["hobbys"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",18)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["diy"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",19)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["gameVideos"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",20)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["showroom"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",21)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["runAways"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",22)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["advertisement"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",23)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["startUp"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",24)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["product"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",25)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["languages"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",26)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["onlineClasses"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",27)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["discussions"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",28)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }

    if(isset($_POST["selfImprovement"])) {
        $wQuery = "INSERT INTO `usercategory`(`userId` ,`categoryId`) VALUES (".$ID.",29)";
        mysqli_query($connect, $wQuery)or exit(mysqli_error($connect));
        $minCat++;
    }
    if($minCat<5) {
        $message = "Please select at least 5 categories";
    } else {
        header("Location: ./index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Interests/Interests.css">
    <title>Select your interests!</title>
    <?php echo $message;?>
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <img class="photo" src="../img/logo/logoText.png" alt="">


    <form action="interests.php" method="POST">
        <div class="midCard">
            <img src="<?php echo $pPDir;?>" class="profilePhoto">
            <p class="pSelect">Select your interests!</p>
        </div>
        <div class="cats">
            <p class="catTitle">Movies & Series</p><br>
            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Documentaries</p>
                        <input type="checkbox" name="documentaries">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Comedy</p>
                        <input type="checkbox" name="comedy">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Action</p>
                        <input type="checkbox" name="action">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Biography</p>
                        <input type="checkbox" name="biography">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>



            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Sci-Fi & Fantasy</p>
                        <input type="checkbox" name="scifi">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Cartoons</p>
                        <input type="checkbox" name="cartoons">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Thriller</p>
                        <input type="checkbox" name="thriller">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ms"></div>
                        <p class="subCat">Romance</p>
                        <input type="checkbox" name="romance">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>


            <!-- Second Title -->
            <p class="catTitle">Life Styles</p><br>

            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ls"></div>
                        <p class="subCat">Vlogs</p>
                        <input type="checkbox" name="vlogs">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ls"></div>
                        <p class="subCat">Travel</p>
                        <input type="checkbox" name="travel">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ls"></div>
                        <p class="subCat">Make up</p>
                        <input type="checkbox" name="makeUp">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ls"></div>
                        <p class="subCat">Pets</p>
                        <input type="checkbox" name="pets">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ls"></div>
                        <p class="subCat">Funny Videos</p>
                        <input type="checkbox" name="funnyVideos">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- third cat -->
            <p class="catTitle">Hobbys & Sports</p><br>

            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Daily Life</p>
                        <input type="checkbox" name="dailyLife">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Sports</p>
                        <input type="checkbox" name="sports">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Music</p>
                        <input type="checkbox" name="music">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Concerts</p>
                        <input type="checkbox" name="concerts">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>


            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Hobbys</p>
                        <input type="checkbox" name="hobbys">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Do It Yourself</p>
                        <input type="checkbox" name="diy">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto hs"></div>
                        <p class="subCat">Game Videos</p>
                        <input type="checkbox" name="gameVideos">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>



            <p class="catTitle">Advertisement & Showroom</p><br>

            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto p"></div>
                        <p class="subCat">Showroom</p>
                        <input type="checkbox" name="showroom">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto p"></div>
                        <p class="subCat">Run Aways</p>
                        <input type="checkbox" name="runAways">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto p"></div>
                        <p class="subCat">Advertisement</p>
                        <input type="checkbox" name="advertisement">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto p"></div>
                        <p class="subCat">StartUp</p>
                        <input type="checkbox" name="startUp">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto p"></div>
                        <p class="subCat">Product</p>
                        <input type="checkbox" name="product">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <p class="catTitle">Instructive Content and Conference</p><br>
            <div class="cat_row">
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ei"></div>
                        <p class="subCat">Languages</p>
                        <input type="checkbox" name="languages">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ei"></div>
                        <p class="subCat">Online Classes</p>
                        <input type="checkbox" name="onlineClasses">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ei"></div>
                        <p class="subCat">Discussions</p>
                        <input type="checkbox" name="discussions">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="cat">
                    <label class="container">
                        <div class="catPhoto ei"></div>
                        <p class="subCat">Self<br>Improvement</p>
                        <input type="checkbox" name="selfImprovement">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" class="submitB" value="Submit">
    </form>
</body>

</html>