<!DOCTYPE html>
<html lang="en">

<?php 
include('../includes/db.php');
include('../includes/head.php');
include('../includes/navBar.php');

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

$rVideoQuery = "SELECT * FROM `video`";

$videoResult = mysqli_query($connect,$rVideoQuery);
?>

<head>
    <link rel="stylesheet" href="../styles/index/index.css">
    <link rel="stylesheet" href="../styles/footer/footer.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <main>
        <h1>For You</h1>
        <div class="row">
            <aside id="calendar">
                <h4>Calendar</h4>
                <div id="inCalendar">
            <?php 
                $daysOfWeek = array(1 => 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                $calendarQuery = "SELECT * FROM uservideocalendar WHERE userId = ". $userId;
                $calendarResult = mysqli_query($connect, $calendarQuery);

                $todayDate = date("Y-m-d");
                $time = date("H:i");

                $sundayFlag = 0;
                $mondayFlag = 0;
                $tuesdayFlag = 0;
                $wednesdayFlag = 0;
                $thursdayFlag = 0;
                $fridayFlag = 0;
                $saturdayFlag = 0;

                if($userId!==0) {
                    if(mysqli_num_rows($calendarResult)>0) {
                        while($calendarInfo = mysqli_fetch_assoc($calendarResult)) {
                            $calendarVideoId = $calendarInfo['videoId'];
                            $calendarVideoQuery = "SELECT * FROM video WHERE videoId = ". $calendarVideoId;
                            $calendarVideoResult = mysqli_query($connect, $calendarVideoQuery);
                            $calendarVideoInfo = mysqli_fetch_assoc($calendarVideoResult);
                            $videoTitle = $calendarVideoInfo['videoTitle'];
                            $airDate = $calendarVideoInfo['airDate'];
                            $airTime = $calendarVideoInfo['airTime'];
                            $airDay = date('l', strtotime($airDate));
                            $airTime = substr($airTime, 0, 5);

                            if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<-43200) 
                                $spanId = "oneDay";
                            elseif ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<-3600) 
                                $spanId = "twelveHours";
                            elseif ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<0) 
                                $spanId = "oneHour";
                            elseif ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) 
                                $spanId = "started";

                            if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>86400) {
                                $deprecatedCalendarQuery = "DELETE FROM uservideocalendar WHERE videoId = ".$calendarVideoId." AND userId = ". $userId;
                            } else {
                                if ($airDay === $daysOfWeek[1]) {
                                    if ($sundayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Sunday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $sundayFlag = 1;
                                    }
                                }
                                if ($airDay === $daysOfWeek[2]) {
                                    if ($mondayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Monday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $mondayFlag = 1;
                                    }
                                }
                                
                                if ($airDay === $daysOfWeek[3]) {
                                    if ($tuesdayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Tuesday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $tuesdayFlag = 1;
                                    }
                                }
                                
                                if ($airDay === $daysOfWeek[4]) {
                                    if ($wednesdayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Wednesday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $wednesdayFlag = 1;
                                    }
                                }
                                
                                if ($airDay === $daysOfWeek[5]) {
                                    if ($thursdayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Thursday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $thursdayFlag = 1;
                                    }
                                }

                                if ($airDay === $daysOfWeek[6]) {
                                    if ($fridayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Friday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $fridayFlag = 1;
                                    }
                                }

                                if ($airDay === $daysOfWeek[7]) {
                                    if ($saturdayFlag === 1) {
                                        echo '<ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                    } else {
                                        echo '<h5>Saturday</h5><ul><li><span id="'.$spanId.'"></span><a href="./watchVideo.php?v='.$calendarVideoId.'"><p>'.$videoTitle.'</p></a><p id="time">'.$airTime.'</p></li></ul>';
                                        $saturdayFlag = 1;
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<h5>You haven't added a video to your calendar. Let's add!</h5>";
                    }
                } else {
                    echo "<h5>You can't add a video to your calendar while you are anonymous. Let's <a href='./signUp.php'>create</a> a new account or <a href='./signIn.php'>sign in</a>!</h5>";
                }
            ?>
                
                </div>
            </aside>
            <div id="premieres">
                <section id="premiere">
                <?php
                    $premiereQuery = "SELECT * FROM video WHERE videoId=2";
                    $premiereResult = mysqli_query($connect, $premiereQuery);
                    $premiereRow = mysqli_fetch_assoc($premiereResult);

                    $premiereVideoTitle = $premiereRow['videoTitle'];
                    $premiereThumbnailDir = $premiereRow['thumbnailDir'];

                    echo '<a href="./watchVideo.php?v=2"><img src="'.$premiereThumbnailDir.'" alt="video"></a>
                        <ul>
                            <li>
                                <a href="./watchVideo.php?v=2"><p>'.$premiereVideoTitle.'</p></a>
                            </li>
                        </ul>';
                    
                ?>
                </section>
                <aside id="premCard">
                    <h1><a href="./openStreamsV2.php">Open Streams</a></h1>
                    <?php 
                        $premiereQuery = "SELECT * FROM video ORDER BY airDate LIMIT 10";
                        $premiereResult = mysqli_query($connect, $premiereQuery);
                        while ($premiereRow = mysqli_fetch_assoc($premiereResult)) {
                            $premiereAirDate = $premiereRow['airDate'];
                            $premiereAirTime = $premiereRow['airTime'];
                            if((strtotime($todayDate)+strtotime($time))-(strtotime($premiereAirDate)+strtotime($premiereAirTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($premiereAirDate)+strtotime($premiereAirTime))<86400) {
                                $premiereVideoTitle = $premiereRow['videoTitle'];
                                $premiereVideoDesc = $premiereRow['videoDesc'];
                                $premiereVideoFile = $premiereRow['videoFile'];
                                $premiereVideoDir = $premiereRow['videoDir'];
                                $premiereThumbnail = $premiereRow['thumbnail'];
                                $premiereThumbnailDir = $premiereRow['thumbnailDir'];
                                $premiereVideoDuration = $premiereRow['videoDuration'];
                                $premiereUploadedById = $premiereRow['uploadedById'];
                                $premiereVideoId = $premiereRow['videoId'];

                                echo'<div>
                                        <a href="./watchVideo.php?v='.$premiereVideoId.'"><img src="'.$premiereThumbnailDir.'" alt="video">
                                        <p>'.$premiereVideoTitle.'</p></a>
                                    </div>';
                            } else {
                                echo '';
                            }
                        }
                    ?>
                </aside>
            </div>
        </div>
        <div class="reco">
            <h1>Recommendation</h1>
            <?php
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

                    $airTime = substr($airTime, 0, 5);

                    if($userId===$uploadedById || (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>86400) {
                        echo '';
                    } else {

                        $rUserQuery = "SELECT `username`, `pPDir` FROM user WHERE id = '$uploadedById'";
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
                        <div id="recoPost">
                            <a id="thumbnailLink" href="./watchVideo.php?v='.$videoId.'"><img id="thumbnail" src="'.$thumbnailDir.'" alt="video"></a>
                            <p id="duration">'.$videoDuration.'</p> 
                            <div id="recoDesc">
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
                                </a>';
                        if($userId===0) {
                            echo '
                                </div>
                            </div>';
                        } else {
                            if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) {
                                echo '
                                    </div>
                                </div>';
                            } else {
                                echo '<p id="airDateTime">Air date: '.$airDate.' '.$airTime.'</p>
                                <button type="submit" class="addToCalendar" id="'.$videoId.'">'.$calendarButton.'</button>
                                    </div>
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
                                </script>
                                ';
                            }
                        }
                    }

                    if(isset($_POST['save'])) {
                        $videoIdCalendar = $_POST['videoId'];
                        $insertCalendarQuery = "INSERT INTO uservideocalendar (`userId`, `videoId`) VALUES ('$userId', '$videoIdCalendar')";
                        mysqli_query($connect, $insertCalendarQuery);
                    }
                    
                    if(isset($_GET['delete'])) {
                        $deleteVideoId = $_GET['videoId'];
                        $deleteCalendarQuery = "DELETE FROM uservideocalendar WHERE `userId` = ".$userId." AND `videoId` = ". $deleteVideoId;
                        mysqli_query($connect, $deleteCalendarQuery);
                    }
                }
            ?>
        </div>
    </main>

<?php 

include('../includes/footer.php');

?>