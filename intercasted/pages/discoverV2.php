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
    <link rel="stylesheet" href="../styles/discoverV2/discoverV2.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <main>
        <aside>
            <a href="./discoverV2.php?category=1">
                <div id="card">
                    <p>Movies & Series</p>
                </div>
            </a>
            <a href="./discoverV2.php?category=2">
                <div id="card">
                    <p>Life Style</p>
                </div>
            </a>
            <a href="./discoverV2.php?category=3">
                <div id="card">
                    <p>Product Overview</p>
                </div>
            </a>
            <a href="./discoverV2.php?category=4">
                <div id="card">
                    <p>Education & Conference</p>
                </div>
            </a>
            <a href="./discoverV2.php?category=5">
                <div id="card">
                    <p>Hobbies</p>
                </div>
            </a>
            <a href="./discoverV2.php?category=6">
                <div id="card">
                    <p>Media</p>
                </div>
            </a>
        </aside>
        <section>
            
            <?php 
                $userFollowQuery = "SELECT followedId FROM follow WHERE followerId = ". $userId;
                $userFollowResult = mysqli_query($connect, $userFollowQuery);

                $userCategoryQuery = "SELECT categoryId FROM usercategory WHERE userId = ". $userId;
                $userCategoryResult = mysqli_query($connect, $userCategoryQuery);

                $userVideoQuery = "SELECT videoId FROM uservideocalendar WHERE userId = ". $userId;
                $userVideoResult = mysqli_query($connect, $userVideoQuery);

                $followedId = [];
                $categoryId = [];
                $a = 0;
                $b = 0;

                while($userFollowRow = mysqli_fetch_assoc($userFollowResult)) {
                    $followedId[$a] = $userFollowRow['followedId'];
                    $a++;
                    while($userCategoryRow = mysqli_fetch_assoc($userCategoryResult)){
                        $categoryId[$b] = $userCategoryRow['categoryId'];
                        $b++;
                        
                    }
                }

                $followedIdSQL = '(' . implode(',', $followedId) .')';

                if(!empty($followedId) && !empty($categoryId)) {
                    if(isset($_GET['category'])) {
                        switch ($_GET['category']) {
                            case '':
                                $categoryIdSQL = '(' . implode(',', $categoryId) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId NOT IN ".$categoryIdSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 1:
                                $categoryIds = array(1, 2, 3, 4, 5, 6 ,7, 8);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 2:
                                $categoryIds = array(9, 10, 11, 12, 13);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));;
                                break;
                            case 3:
                                $categoryIds = array(21,22,23);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 4:
                                $categoryIds = array(26,27,29);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 5:
                                $categoryIds = array(14,15,16,17,18,19,20);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 6:
                                $categoryIds = array(24,25,28);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            default:
                                header("Location: ./discoverV1.php");
                                break;
                        }
                    } else {
                        header("Location: ./discoverV1.php");
                    }
                } elseif(empty($followedId)) {
                    if(isset($_GET['category'])) {
                        switch($_GET['category']){
                            case 1:
                                $categoryIds = array(1, 2, 3, 4, 5, 6 ,7, 8);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 2:
                                $categoryIds = array(9, 10, 11, 12, 13);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));;
                                break;
                            case 3:
                                $categoryIds = array(21,22,23);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 4:
                                $categoryIds = array(26,27,29);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 5:
                                $categoryIds = array(14,15,16,17,18,19,20);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 6:
                                $categoryIds = array(24,25,28);
                                $categoryIds = array_diff($categoryIds, $categoryId);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            default:
                                header("Location: ./discoverV1.php");
                                break;
                        }
                    } else {
                        header("Location: ./discoverV1.php");
                    }
                } elseif(empty($categoryId)) {
                    if(isset($_GET['category'])) {
                        switch ($_GET['category']) {
                            case 1:
                                $categoryIds = array(1, 2, 3, 4, 5, 6 ,7, 8);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 2:
                                $categoryIds = array(9, 10, 11, 12, 13);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));;
                                break;
                            case 3:
                                $categoryIds = array(21,22,23);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 4:
                                $categoryIds = array(26,27,29);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 5:
                                $categoryIds = array(14,15,16,17,18,19,20);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 6:
                                $categoryIds = array(24,25,28);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE uploadedById NOT IN ".$followedIdSQL." AND categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            default:
                                header("Location: ./discoverV1.php");
                                break;
                        }
                    } else {
                        header("Location: ./discoverV1.php");
                    }
                } else {
                    if(isset($_GET['category'])) {
                        switch($_GET['category']){
                            case 1:
                                $categoryIds = array(1, 2, 3, 4, 5, 6 ,7, 8);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 2:
                                $categoryIds = array(9, 10, 11, 12, 13);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));;
                                break;
                            case 3:
                                $categoryIds = array(21,22,23);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 4:
                                $categoryIds = array(26,27,29);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 5:
                                $categoryIds = array(14,15,16,17,18,19,20);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            case 6:
                                $categoryIds = array(24,25,28);
                                $categoryIdsSQL = '(' . implode(',', $categoryIds) .')';
                                $rVideoQuery = "SELECT * FROM `video` WHERE categoryId IN ".$categoryIdsSQL;
                                $videoResult = mysqli_query($connect,$rVideoQuery) or die(mysqli_error($connect));
                                break;
                            default:
                                header("Location: ./discoverV1.php");
                                break;
                        }
                    } else {
                        header("Location: ./discoverV1.php");
                    }
                }

                if(mysqli_num_rows($videoResult)>0) {
                    while ($videoInfo = mysqli_fetch_assoc($videoResult)) {
                        $videoTitle = $videoInfo['videoTitle'];
                        $videoDesc = $videoInfo['videoDesc'];
                        $videoFile = $videoInfo['videoFile'];
                        $videoDir = $videoInfo['videoDir'];
                        $thumbnail = $videoInfo['thumbnail'];
                        $thumbnailDir = $videoInfo['thumbnailDir'];
                        $videoDuration = $videoInfo['videoDuration'];
                        $uploadedById = $videoInfo['uploadedById'];
                        $videoId = $videoInfo['videoId'];
                        $airDate = $videoInfo['airDate'];
                        $airTime = $videoInfo['airTime'];

                        if($userId===$uploadedById || (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>86400) {
                            echo '';
                        } else {

                            $rUserQuery = "SELECT `username`, `pPDir` FROM user WHERE id = ".$uploadedById;
                            $userResult = mysqli_query($connect, $rUserQuery);

                            $userInfo = mysqli_fetch_array($userResult);
                            $username = $userInfo[0];
                            $pPDir = $userInfo[1];

                            $userCalendarQuery = "SELECT * FROM uservideocalendar WHERE `userId`= ". $userId ." AND `videoId` = ". $videoId;
                            $userCalendarResult = mysqli_query($connect, $userCalendarQuery);

                            if (mysqli_num_rows($userCalendarResult)>0) {
                                $calendarButton = "Added to Calendar";
                                $clickBool = "true";
                            }
                            else {
                                $calendarButton = "Add to Calendar";
                                $clickBool = "false";
                            }
                            
                            
                            if (strlen($videoDesc)>218) 
                                $videoDesc = substr($videoDesc, 0, 218) . "...";
                                
                            echo '
                            <div id="stream">
                                <a id="thumbnail" href="./watchVideo.php?v='.$videoId.'">
                                    <img src="'.$thumbnailDir.'" alt="thumbnail">
                                </a>
                                <p id="duration">'.$videoDuration.'</p> 
                                <div id="channel">
                                    <a id="channel" href="./visitProfile.php?user='.$uploadedById.'">
                                        <img src="'.$pPDir.'" alt="profilePhoto">
                                        <p>'.$username.'</p>
                                    </a>';

                            if($userId ===0) {
                                echo '
                                </div>
                                <a href="./watchVideo.php?v='.$videoId.'">
                                    <p id="title">'.$videoTitle.'</p>
                                </a>
                                <p id="desc">'.$videoDesc.'</p>
                            </div>';
                            } else {
                            if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) {
                                echo '
                                </div>
                                <a href="./watchVideo.php?v='.$videoId.'">
                                    <p id="title">'.$videoTitle.'</p>
                                </a>
                                <p id="desc">'.$videoDesc.'</p>
                            </div>';
                            } else {
                                echo '
                                    <button id="'.$videoId.'" type="submit">'.$calendarButton.'</button>
                                </div>
                                <a href="./watchVideo.php?v='.$videoId.'">
                                    <p id="title">'.$videoTitle.'</p>
                                </a>
                                <p id="desc">'.$videoDesc.'</p>
                            </div>
                            <script>
                                $("#'.$videoId.'").data("clicked", '.$clickBool.');
                                $("#'.$videoId.'").data("id", '.$videoId.');
                                console.log($("#'.$videoId.'").data("clicked"));
                                var log = [];

                                $("#'.$videoId.'").click(function() {
                                    if ($("#'.$videoId.'").data("clicked") == false) {
                                        $("#'.$videoId.'").text("Added to Calendar");
                                        $("#'.$videoId.'").data("clicked", true);
                                        log[0] = $("#'.$videoId.'").data("clicked");
                                        log[1] = $("#'.$videoId.'").data("id");

                                        $.ajax ({
                                            type: "POST",
                                            data: {
                                                "save": 1,
                                                "videoId": '.$videoId.'
                                            } 
                                        });
                                    } else {
                                        $("#'.$videoId.'").text("Add to Calendar");
                                        $("#'.$videoId.'").data("clicked", false);
                                        log[0] = $("#'.$videoId.'").data("clicked");
                                        log[1] = $("#'.$videoId.'").data("id");

                                        $.ajax ({
                                            type: "GET",
                                            data: {
                                                "delete": 1,
                                                "videoId": '.$videoId.'
                                            } 
                                        });
                                    }
                                });
                            </script>';
                            }
                            }
                        }
                    }

                    
                    if(isset($_POST['save'])) {
                        $videoIdCalendar = $_POST['videoId'];
                        $insertCalendarQuery = "INSERT INTO uservideocalendar (`userId`, `videoId`) VALUES (".$userId.", ".$videoIdCalendar.")";
                        mysqli_query($connect, $insertCalendarQuery);
                    }

                    if(isset($_GET['delete'])) {
                        $deleteVideoId = $_GET['videoId'];
                        $deleteCalendarQuery = "DELETE FROM uservideocalendar WHERE `userId` = ".$userId." AND `videoId` = ". $deleteVideoId;
                        mysqli_query($connect, $deleteCalendarQuery);
                    }
                } else {
                    echo '<h1 id="notFoundError">NOT FOUND</h1>';
                }
            ?>
        </section>
    </main>
</body>

</html>