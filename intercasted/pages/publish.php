<?php 
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');
require_once '../vendor/autoload.php';
if (isset($_SESSION['signId'])) {
    $uploadedById = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $uploadedById;
} elseif (isset($_SESSION['userId'])) {
    $uploadedById = $_SESSION['userId'];
} else {
    header('Location:./index.php');
}

$message = " ";

$videoFileName = $_SESSION['videoFileName'];
$videoFile = $_SESSION['videoFile'];

$thumbnailFileName = $_SESSION['thumbnailFileName'];
$thumbnailFile = $_SESSION['thumbnailFile'];

$durMinSec = $_SESSION['duration'];

$randVideoFileNameWithMP4 = $_SESSION['randVideoFileNameWithMP4'];
$randVideoFileWithMP4 = $_SESSION['randVideoFileWithMP4'];

$randThumbnailFileName = $_SESSION['randThumbnailFileName'];
$randThumbnailFile = $_SESSION['randThumbnailFile'];

if (isset($_POST["publish"]) ) {
    //forms
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $date = $_POST["date"];
    $categoryIdPost = $_POST["category"];
    $airTime = $_POST["time"];
    $maxTitle = 100;
    $maxDesc = 5000;
    $todayDate = date("Y-m-d");
    $time = date("H:i");

    $timeInt = (int) str_replace(":", "", $airTime);

    $timeInt = $timeInt*100;

    //uploadedById
    
    
    //file type
    $thumbnailFileType = strtolower(pathinfo($thumbnailFile,PATHINFO_EXTENSION));
    $videoFileType = strtolower(pathinfo($videoFile,PATHINFO_EXTENSION));

    if(strlen($title)>$maxTitle) {
        $message = "Your title is too long. Allowed length is 32 characters.";
    } else {
        if(strlen($desc)>$maxDesc) {
            $message = "Your description is too long. Allowed length is 5000 characters.";
        } else {
            if ((strtotime($todayDate)+strtotime($time))-(strtotime($date)+strtotime($airTime))>=-86400) {
                $message = "Air date must be at least 24 hours later than now.";
            } else {
                if (isset($title) && isset($desc) && isset($date) && isset($categoryIdPost) && isset($time)) {
                    $wQuery = "INSERT INTO video (`videoTitle`, `videoDesc`, `videoFile`, `videoDir`, `thumbnail`, `thumbnailDir`, `categoryId`, `airDate`, `airTime`, `videoDuration`, `uploadedById`) VALUES ('$title','$desc','$randVideoFileNameWithMP4','$randVideoFileWithMP4','$randThumbnailFileName','$randThumbnailFile','$categoryIdPost','$date','$timeInt','$durMinSec','$uploadedById')";
                    mysqli_query($connect,$wQuery);
                    header("Location: ./published.php");
                }
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/publish/publish.css">
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
<body>
    <main>
        <form action="./publish.php" method="POST">
            <div id="topBar">
                <?php echo "<img id='thumbnail' src='". $randThumbnailFile ."' alt=''>";?>
                <div id="columnForm">
                    <input type="text" id="title" placeholder="Title" name="title" required></input>
                    <div id="rowForm">
                        <textarea rows="12" id="description" placeholder="Description" name="desc" required></textarea>
                            <div id="dateColumn">
                            <label id="dateLabel">Select air date:
                            <input type="date" name="date" id="date" required></label>
                            <label id="dateLabel">Select air time:
                            <input type="time" id="date" name="time" required></label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bottomBar">
                <?php echo "<p id='fileNames'>Video File Name: ".$videoFileName." was uploaded.</p>"; ?>
                <?php
                if($thumbnailFileName == $videoFileName . ".png") {
                    echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600; width:16.41vw;'>Thumbnail File Name: auto_created_" . $thumbnailFileName . " was uploaded</p>"; 
                } else {
                    echo "<p id='fileNames'>Thumbnail File Name: " . $thumbnailFileName . " was uploaded</p>"; 
                } 
                ?>
                <select id="formInputs" name="category" required>
                    <option value="" class="options">Select a category</option>
                    <?php 
                        $categoryQuery = "SELECT * FROM category";
                        $categoryResult = mysqli_query($connect, $categoryQuery);
                        while($categoryInfo = mysqli_fetch_assoc($categoryResult)) {
                            $categoryId = $categoryInfo['categoryId'];
                            $categoryName = $categoryInfo['categoryName'];

                            echo '<option class="options" value="'.$categoryId.'">'.$categoryName.'</option>';
                        }
                    ?>
                </select>
                <input type="submit" name="publish" id="publish" value="Publish">
            </div>
            <?php echo "<p style='color:#FF4E4E;font-family:nunito;font-size:20px;font-weight:600;'>$message</p>"; ?>
        </form>
    </main>
</body>

</html>