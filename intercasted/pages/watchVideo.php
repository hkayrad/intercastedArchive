<?php
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');

$userId = $_SESSION['userId'];

if (isset($_SESSION['userId'])) {
    $ID = $_SESSION['userId'];
} else {
    $ID = 0;
}

$todayDate = date("Y-m-d");
$time = date("H:i");

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/watchVideo/watchVideo.css">
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
<body>
    <main>
        <?php
        $urlVideoId = $_GET['v'];
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
        else  
            $url = "http://"; 

        $url.= $_SERVER['HTTP_HOST'];  
        $url.= $_SERVER['REQUEST_URI'];

        $checkVideoQuery = "SELECT * FROM `video` WHERE `videoId` = ".$urlVideoId." LIMIT 1";

        if(isset($urlVideoId) && !empty($urlVideoId)){
            $rVideoQuery = "SELECT * FROM `video` WHERE `videoId` = " . $urlVideoId;
            $videoResult = mysqli_query($connect,$rVideoQuery);
            $checkVideoResult = mysqli_query($connect, $checkVideoQuery);


            if(mysqli_num_rows($checkVideoResult) == 0){
                echo "<h1 id='videoError'>Video not found.</h1>
                    <p id='errorDesc'>You'll be redirecting to home page. If nothing happens, press <a id='errorDesc' href='./index.php'>here</a></p>
                    ";
                header('Refresh: 5; URL=./index.php');
                
            } else {
                $hostCheckerQuery = "SELECT uploadedById FROM video WHERE videoId = ". $urlVideoId;
                $hostCheckerResult = mysqli_query($connect, $hostCheckerQuery);
                $hostInfo = mysqli_fetch_assoc($hostCheckerResult);
                $hostId = $hostInfo['uploadedById'];
                if($userId === $hostId) {
                    header("Location: ./hostVideo.php?v=".$urlVideoId);

                } else {
                    $videoInfo = mysqli_fetch_assoc($videoResult);
                    $videoTitle = $videoInfo['videoTitle'];
                    $videoDesc = $videoInfo['videoDesc'];
                    $videoFile = $videoInfo['videoFile'];
                    $videoDir = $videoInfo['videoDir'];
                    $thumbnail = $videoInfo['thumbnail'];
                    $thumbnailDir = $videoInfo['thumbnailDir'];
                    $videoDuration = $videoInfo['videoDuration'];
                    $uploadedById = $videoInfo['uploadedById'];
                    $airDate = $videoInfo['airDate'];
                    $airTime = $videoInfo['airTime'];
                    $viewCount = $videoInfo['viewCount'];

                    $newViewCount = $viewCount+1;

                    $viewCountAdd = "UPDATE video SET viewCount=".$newViewCount." WHERE videoId=".$urlVideoId;
                    mysqli_query($connect, $viewCountAdd) or die(mysqli_error($connect));
        
                    $airTime = substr($airTime, 0, 5);

                    $rUserQuery = "SELECT `username`, `pPDir` FROM user WHERE id = '$uploadedById'";
                    $userResult = mysqli_query($connect, $rUserQuery);
        
                    $userInfo = mysqli_fetch_array($userResult);
                    $username = $userInfo[0];
                    $pPDir = $userInfo[1];

                    if($ID!== 0) {
                        $followQuery = "SELECT * FROM follow WHERE `followerId`= ". $userId ." AND `followedId` = ". $uploadedById;
                        $followResult = mysqli_query($connect, $followQuery);

                        if (mysqli_num_rows($followResult)>0) {
                            $followButton = "Followed";
                            $clickBool = "true";
                        }
                        else {
                            $followButton = "Follow";
                            $clickBool = "false";
                        }

                        $userCalendarQuery = "SELECT * FROM uservideocalendar WHERE `userId`= ". $userId ." AND `videoId` = ". $urlVideoId;
                        $userCalendarResult = mysqli_query($connect, $userCalendarQuery);

                        if (mysqli_num_rows($userCalendarResult)>0) {
                            $calendarButton = "Added to Calendar";
                            $clickBool = "true";
                        }
                        else {
                            $calendarButton = "Add to Calendar";
                            $clickBool = "false";
                        }

                        $userLikeCheckQuery = "SELECT likeDislike FROM uservideolikedislike WHERE userId=".$userId." AND videoId= ".$urlVideoId;
                        $userLikeCheckResult = mysqli_query($connect, $userLikeCheckQuery);
                        
                        
                        if(mysqli_num_rows($userLikeCheckResult)>0) {
                            $userLikeCheckRow = mysqli_fetch_assoc($userLikeCheckResult);
                            $likeDislikeCheck = $userLikeCheckRow['likeDislike'];
                            if($likeDislikeCheck === "like") {
                                $likeButtonSrc= "../img/icons/likeS.png";
                                $dislikeButtonSrc = "../img/icons/dislike.png";
                                $likeBool = "true";
                                $dislikeBool = "false";

                            } elseif($likeDislikeCheck === "dislike") {
                                $likeButtonSrc = "../img/icons/like.png";
                                $dislikeButtonSrc = "../img/icons/dislikeS.png";
                                $likeBool = "false";
                                $dislikeBool = "true";
                            } elseif(empty($likeDislikeCheck)) {
                                $likeButtonSrc = "../img/icons/like.png";
                                $dislikeButtonSrc = "../img/icons/dislike.png";
                                $likeBool = "false";
                                $dislikeBool = "false";
                            }

                        } else {
                            $userVideoLikeDislikeQuery = "INSERT INTO uservideolikedislike (userId, videoId) VALUES(".$userId.",".$urlVideoId.")";
                            mysqli_query($connect, $userVideoLikeDislikeQuery) or die(mysqli_error($connect));
                            $likeButtonSrc = "../img/icons/like.png";
                            $dislikeButtonSrc = "../img/icons/dislike.png";
                            $likeBool = "false";
                            $dislikeBool = "false";
                        }
                    }
                    
        
                    echo '
                    <div id="videoChat">
                        <div id="video">';
                    if((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400 || $urlVideoId==2) 
                        echo '<video id="videoArea" src="'.$videoDir.'" alt="" controls poster="'.$thumbnailDir.'"></video>';
                                    
                    else 
                        echo '<img id="videoThumb" src="'.$thumbnailDir.'" alt="">';
                    
                    echo'
                            <div id="videoInfo">
                                <div id="titleChannel">
                                    <h1 id="title">
                                        '.$videoTitle.'
                                    </h1>
                                </div>
                                <p id="description">
                                    '.$videoDesc.'
                                </p>
                                <div id="dateLikeShare">
                                    <p id="date">'.$airDate.' '.$airTime.'</p>
                                    <input type="text" style="display:none;" value="'.$url.'" id="myInput">
                                    <div class="tooltip">
                                        <button onclick="myFunction()" onmouseout="outFunc()" class="share">
                                            <img src="../img/icons/share.png" alt="">
                                            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                            Copy text
                                        </button>
                                    </div>';
                        if($ID!==0) {
                            echo '
                                    <input type="image" id="like" class="likeDislike" src="'.$likeButtonSrc.'">
                                    <input type="image" id="dislike" class="likeDislike" src="'.$dislikeButtonSrc.'">
                                </div>';
                        } else {
                            echo '</div>';
                        }
                            echo '
                                <div id="channelRow">
                                    <a id="channelLink" href="./visitProfile.php?user='.$uploadedById.'">
                                        <img id="channelImg" src="'.$pPDir.'" alt="">
                                        <p id="channel">'.$username.'</p>
                                    </a>';
                                    if($ID!==0) {
                                        echo '
                                            <button class="follow" id="'.$uploadedById.'">'.$followButton.'</button>
                                        </div>';
                                    } else {
                                        echo '</div>';
                                    }
                        if((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400 || $urlVideoId==2) 
                        echo '</div>';
                        else {
                            if($ID!==0) {
                                echo '
                                    <button type="submit" class="addToCalendar" id="'.$urlVideoId.'">'.$calendarButton.'</button>
                                    </div>';
                            } else { 
                                echo '</div>';
                            }
                        }
                        echo '
                        </div>
                            <form action="" method="POST">
                                <div id="chat">
                                    <h1 id="chatT">Chat</h1>
                                    <div id="messages">
                                    </div>
                                    <div id="chatWrite">
                                        <input id="chatInput" type="text" disabled>
                                        <input id="chatSubmit" type="submit" value="Send" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>';
                        if($ID !== 0) {
                            echo '
                            <script>
                                $("#'.$uploadedById.'").data("clicked", '.$clickBool.');
                                $("#'.$uploadedById.'").data("id", '.$uploadedById.');
                                console.log($("#'.$uploadedById.'").data("clicked"));
                                var log = [];
                                $("#'.$uploadedById.'").click(function() {
                                    if ($("#'.$uploadedById.'").data("clicked") == false) {
                                        $("#'.$uploadedById.'").text("Followed");
                                        $("#'.$uploadedById.'").data("clicked", true);
                                        log[0] = $("#'.$uploadedById.'").data("clicked");
                                        log[1] = $("#'.$uploadedById.'").data("id");
                                        $.ajax ({
                                            type: "POST",
                                            data: {
                                                "save": 1,
                                                "uploadedById": '.$uploadedById.'
                                            } 
                                        });
                                    } else {
                                        $("#'.$uploadedById.'").text("Follow");
                                        $("#'.$uploadedById.'").data("clicked", false);
                                        log[0] = $("#'.$uploadedById.'").data("clicked");
                                        log[1] = $("#'.$uploadedById.'").data("id");
                                        $.ajax ({
                                            type: "GET",
                                            data: {
                                                "delete": 1,
                                                "uploadedById": '.$uploadedById.'
                                            } 
                                        });
                                    }
                                });
                            ';
                            if((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) 
                                echo '</script>';
                            else {
                                    echo '
                                    </script>
                                    <script>
                                        $("#'.$urlVideoId.'").data("clicked", '.$clickBool.');
                                        $("#'.$urlVideoId.'").data("id", '.$urlVideoId.');
                                        console.log($("#'.$urlVideoId.'").data("clicked"));
                                        var log = [];

                                        $("#'.$urlVideoId.'").click(function() {
                                            if ($("#'.$urlVideoId.'").data("clicked") == false) {
                                                $("#'.$urlVideoId.'").text("Added to Calendar");
                                                $("#'.$urlVideoId.'").data("clicked", true);
                                                log[0] = $("#'.$urlVideoId.'").data("clicked");
                                                log[1] = $("#'.$urlVideoId.'").data("id");

                                                $.ajax ({
                                                    type: "POST",
                                                    data: {
                                                        "saveVideo": 1,
                                                        "videoId": '.$urlVideoId.'
                                                    } 
                                                });
                                            } else {
                                                $("#'.$urlVideoId.'").text("Add to Calendar");
                                                $("#'.$urlVideoId.'").data("clicked", false);
                                                log[0] = $("#'.$urlVideoId.'").data("clicked");
                                                log[1] = $("#'.$urlVideoId.'").data("id");

                                                $.ajax ({
                                                    type: "GET",
                                                    data: {
                                                        "deleteVideo": 1,
                                                        "videoId": '.$urlVideoId.'
                                                    } 
                                                });
                                            }
                                        });
                                    </script>';
                            }

                            echo '
                            <script>
                                $("#like").data("clicked", '.$likeBool.');

                                $("#like").click(function() {
                                    if ($("#like").data("clicked") == false) {
                                        $("#like").attr("src", "../img/icons/likeS.png");
                                        $("#like").data("clicked", true);
                                        $("#dislike").attr("src", "../img/icons/dislike.png");
                                        $("#dislike").data("clicked", false);

                                        $.ajax ({
                                            type: "POST",
                                            data: {
                                                "like": 1,
                                                "likeCount": 1
                                            } 
                                        });
                                    } else {
                                        $("#like").attr("src", "../img/icons/like.png");
                                        $("#like").data("clicked", false);

                                        $.ajax ({
                                            type: "GET",
                                            data: {
                                                "unlike": 1,
                                                "likeCount": -1
                                            } 
                                        });
                                    }
                                });
                            </script>
                            <script>
                                $("#dislike").data("clicked", '.$dislikeBool.');

                                $("#dislike").click(function() {
                                    if ($("#dislike").data("clicked") == false) {
                                        $("#dislike").attr("src", "../img/icons/dislikeS.png");
                                        $("#dislike").data("clicked", true);
                                        $("#like").attr("src", "../img/icons/like.png");
                                        $("#like").data("clicked", false);

                                        $.ajax ({
                                            type: "POST",
                                            data: {
                                                "dislike": 1,
                                                "dislikeCount": 1
                                            } 
                                        });
                                    } else {
                                        $("#dislike").attr("src", "../img/icons/dislike.png");
                                        $("#dislike").data("clicked", false);

                                        $.ajax ({
                                            type: "GET",
                                            data: {
                                                "undislike": 1,
                                                "dislikeCount": -1
                                            } 
                                        });
                                    }
                                });
                            </script>
                            <script>
                                function myFunction() {
                                    var copyText = document.getElementById("myInput");
                                    copyText.select();
                                    copyText.setSelectionRange(0, 99999);
                                    document.execCommand("copy");
                                    
                                    var tooltip = document.getElementById("myTooltip");
                                    tooltip.innerHTML = "Copied: " + copyText.value;
                                }
                                
                                function outFunc() {
                                    var tooltip = document.getElementById("myTooltip");
                                    tooltip.innerHTML = "Copy to clipboard";
                                }
                            </script>';
                        }
                    

                    if(isset($_POST['save'])) {
                        $followedId = $_POST['uploadedById'];
                        $insertFollowQuery = "INSERT INTO follow (`followerId`, `followedId`) VALUES ('$userId', '$followedId')";
                        mysqli_query($connect, $insertFollowQuery);
                    }
                    if(isset($_GET['delete'])) {
                        $deleteFollowId = $_GET['uploadedById'];
                        $deleteFollowQuery = "DELETE FROM follow WHERE `followerId` = ".$userId." AND `followedId` = ". $deleteFollowId;
                        mysqli_query($connect, $deleteFollowQuery);
                    }

                    if(isset($_POST['saveVideo'])) {
                        $videoIdCalendar = $_POST['videoId'];
                        $insertCalendarQuery = "INSERT INTO uservideocalendar (`userId`, `videoId`) VALUES ('$userId', '$videoIdCalendar')";
                        mysqli_query($connect, $insertCalendarQuery);
                    }
                    
                    if(isset($_GET['deleteVideo'])) {
                        $deleteVideoId = $_GET['videoId'];
                        $deleteCalendarQuery = "DELETE FROM uservideocalendar WHERE `userId` = ".$userId." AND `videoId` = ". $deleteVideoId;
                        mysqli_query($connect, $deleteCalendarQuery);
                    }

                    if(isset($_POST['like'])) {
                        $likeCount = $_POST['likeCount'];
                        $likeCountQuery = "SELECT likeCount, dislikeCount FROM video WHERE videoId = ". $urlVideoId;
                        $likeCountResult = mysqli_query($connect, $likeCountQuery);
                        $likeCountRow = mysqli_fetch_assoc($likeCountResult);
                        $likeCountDB = $likeCountRow['likeCount'];
                        $dislikeCountDB = $likeCountRow['dislikeCount'];
                        $likeInsert = $likeCount + $likeCountDB;

                        if($likeDislikeCheck === "dislike") {
                            $dislikeInsert = $dislikeCountDB-1;
                            $updateLikeQuery = "UPDATE video SET likeCount=".$likeInsert.", dislikeCount=".$dislikeInsert." WHERE videoId=".$urlVideoId;
                            mysqli_query($connect, $updateLikeQuery) or die(mysqli_error($connect));

                        } elseif(empty($likeDislikeCheck)) {
                            $updateLikeQuery = "UPDATE video SET likeCount=".$likeInsert." WHERE videoId=".$urlVideoId;
                            mysqli_query($connect, $updateLikeQuery) or die(mysqli_error($connect));
                        }

                        $userLikeQuery = "UPDATE uservideolikedislike SET likeDislike= 'like' WHERE videoId= ".$urlVideoId." AND userId= ".$userId;
                        mysqli_query($connect, $userLikeQuery) or die(mysqli_error($connect));
                    }
                    
                    if(isset($_GET['unlike'])) {
                        $likeCount = $_GET['likeCount'];
                        $likeCountQuery = "SELECT likeCount FROM video WHERE videoId = ". $urlVideoId;
                        $likeCountResult = mysqli_query($connect, $likeCountQuery);
                        $likeCountRow = mysqli_fetch_assoc($likeCountResult);
                        $likeCountDB = $likeCountRow['likeCount'];
                        $likeInsert = $likeCount + $likeCountDB;
                        $userLikeQuery = "UPDATE uservideolikedislike SET likeDislike= NULL WHERE videoId= ".$urlVideoId." AND userId= ".$userId;
                        $updateLikeQuery = "UPDATE video SET likeCount=".$likeInsert." WHERE videoId=".$urlVideoId;
                        mysqli_query($connect, $userLikeQuery) or die(mysqli_error($connect));
                        mysqli_query($connect, $updateLikeQuery)or die(mysqli_error($connect));
                    }

                    if(isset($_POST['dislike'])) {
                        $dislikeCount = $_POST['dislikeCount'];
                        $dislikeCountQuery = "SELECT dislikeCount, likeCount FROM video WHERE videoId = ". $urlVideoId;
                        $dislikeCountResult = mysqli_query($connect, $dislikeCountQuery);
                        $dislikeCountRow = mysqli_fetch_assoc($dislikeCountResult);
                        $dislikeCountDB = $dislikeCountRow['dislikeCount'];
                        $likeCountDB = $dislikeCountRow['likeCount'];
                        $dislikeInsert = $dislikeCount + $dislikeCountDB;

                        if($likeDislikeCheck === "like") {
                            $likeInsert = $likeCountDB-1;
                            $updateLikeQuery = "UPDATE video SET likeCount=".$likeInsert.", dislikeCount=".$dislikeInsert." WHERE videoId=".$urlVideoId;
                            mysqli_query($connect, $updateLikeQuery) or die(mysqli_error($connect));

                        } elseif(empty($likeDislikeCheck)) {
                            $updateDislikeQuery = "UPDATE video SET dislikeCount=".$dislikeInsert." WHERE videoId=".$urlVideoId;
                            mysqli_query($connect, $updateDislikeQuery)or die(mysqli_error($connect));
                        }

                        $userLikeQuery = "UPDATE uservideolikedislike SET likeDislike= 'dislike' WHERE videoId= ".$urlVideoId." AND userId= ".$userId;
                        mysqli_query($connect, $userLikeQuery) or die(mysqli_error($connect));
                    }
                    
                    if(isset($_GET['undislike'])) {
                        $dislikeCount = $_GET['dislikeCount'];
                        $dislikeCountQuery = "SELECT dislikeCount FROM video WHERE videoId = ". $urlVideoId;
                        $dislikeCountResult = mysqli_query($connect, $dislikeCountQuery);
                        $dislikeCountRow = mysqli_fetch_assoc($dislikeCountResult);
                        $dislikeCountDB = $dislikeCountRow['dislikeCount'];
                        $dislikeInsert = $dislikeCount + $dislikeCountDB;
                        $userLikeQuery = "UPDATE uservideolikedislike SET likeDislike= NULL WHERE videoId= ".$urlVideoId." AND userId= ".$userId;
                        $updateDislikeQuery = "UPDATE video SET dislikeCount=".$dislikeInsert." WHERE videoId=".$urlVideoId;
                        mysqli_query($connect, $userLikeQuery) or die(mysqli_error($connect));
                        mysqli_query($connect, $updateDislikeQuery)or die(mysqli_error($connect));
                    }
                }
            }
    } else 
        header("Location: ./index.php");
        
        ?>
    </main>
</body>

</html>