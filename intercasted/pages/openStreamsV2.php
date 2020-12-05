<?php 
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');

if(isset($_SESSION['signId'])){
    $userId=$_SESSION['signId'];
    unset($_SESSION['signId']);
}

elseif(isset($_SESSION['userId'])){
    $userId=$_SESSION['userId'];
}

else{
    $userId=0;
}

$todayDate = date("Y-m-d");
$time = date("H:i");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/openStreamsV2/openStreamsV2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<script>

$("#addToCalendar").click(function(e) {
    if ($(this).html() == "Add to Calendar") {
        $(this).html('Added');
    }
    else {
        $(this).html('Add to Calendar');
    }
    return false;
});​
</script>

<body>
    <main>
        <aside>
            <a href="./openStreamsV2.php?category=1">
                <div id="card">
                    <p>Movies & Series</p>
                </div>
            </a>
            <a href="./openStreamsV2.php?category=2">
                <div id="card">
                    <p>Life Style</p>
                </div>
            </a>
            <a href="./openStreamsV2.php?category=3">
                <div id="card">
                    <p>Product Overview</p>
                </div>
            </a>
            <a href="./openStreamsV2.php?category=4">
                <div id="card">
                    <p>Education & Conference</p>
                </div>
            </a>
            <a href="./openStreamsV2.php?category=5">
                <div id="card">
                    <p>Hobbies</p>
                </div>
            </a>
            <a href="./openStreamsV2.php?category=6">
                <div id="card">
                    <p>Media</p>
                </div>
            </a>
        </aside>
        <section> 
            <?php
            $flag = 0;
                if(isset($_GET['category'])) {
                    switch($_GET['category']){
                        case 1:
                            $categoryIds = array(1, 2, 3, 4, 5, 6 ,7, 8);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL." ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                            break;
                        case 2:
                            $categoryIds = array(9, 10, 11, 12, 13);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL."  ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));;
                            break;
                        case 3:
                            $categoryIds = array(21,22,23);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL."  ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                            break;
                        case 4:
                            $categoryIds = array(26,27,29);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL."  ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                            break;
                        case 5:
                            $categoryIds = array(14,15,16,17,18,19,20);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL."  ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                            break;
                        case 6:
                            $categoryIds = array(24,25,28);
                            $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                            $videoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL."  ORDER BY airDate";
                            $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                            break;
                        default:
                            header("Location: ./openStreamsV2.php");
                            break;
                    }
                } else {
                    $videoQuery = "SELECT * FROM video ORDER BY airDate";
                    $videoResult = mysqli_query($connect,$videoQuery) or die(mysqli_error($connect));
                }

                while ($videoInfo = mysqli_fetch_assoc($videoResult)) {
                    $airDate = $videoInfo['airDate'];
                    $airTime = $videoInfo['airTime'];
                    if((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0) {
                        if((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) {
                            $videoTitle = $videoInfo['videoTitle'];
                            $videoDesc = $videoInfo['videoDesc'];
                            $videoFile = $videoInfo['videoFile'];
                            $videoDir = $videoInfo['videoDir'];
                            $thumbnail = $videoInfo['thumbnail'];
                            $thumbnailDir = $videoInfo['thumbnailDir'];
                            $videoDuration = $videoInfo['videoDuration'];
                            $uploadedById = $videoInfo['uploadedById'];
                            $videoId = $videoInfo['videoId'];

                            $rUserQuery = "SELECT `username`, `pPDir` FROM user WHERE id = '$uploadedById'";
                            $userResult = mysqli_query($connect, $rUserQuery);

                            $userInfo = mysqli_fetch_array($userResult);
                            $username = $userInfo[0];
                            $pPDir = $userInfo[1];
                            
                            if (strlen($videoDesc)>218) 
                                $videoDesc = substr($videoDesc, 0, 218) . "...";
    
                            echo '
                                <div id="row">
                                    <a id="thumbnailLink" href="./watchVideo.php?v='.$videoId.'"><img id="thumbnail" src="'.$thumbnailDir.'" alt="video"></a>
                                    <p id="duration">'.$videoDuration.'</p> 
                                    <div id="column">
                                        <a href="./watchVideo.php?v='.$videoId.'">
                                            <h2>'.$videoTitle.'</h2>
                                        </a>
                                        <p id="desc">
                                            '.$videoDesc.'
                                        </p>
                                        <a href="./visitProfile.php?user='.$uploadedById.'">
                                            <div id="chRow">
                                                <img id="channelImg" src="'.$pPDir.'" alt="profile">
                                                <p id="channelN"> '.$username.' </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        }
                        $flag = 1;
                    } else {
                        if ($flag === 0) {
                            echo '<h1 id="notFoundError">NOT FOUND</h1>';
                            $flag = 1;
                        } else {
                            echo '';
                            $flag = 1;
                        }
                    }
                }
            ?>
        </section>

    </main>
</body>

</html>