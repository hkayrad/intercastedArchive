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
    <link rel="stylesheet" href="../styles/searchResults/searchResults.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <main>
        <aside>
        </aside>
        <section>
            
            <?php
                $search = $_SESSION["search"];
                $sQuery = $_SESSION["sQuery"];
                $searchResults = mysqli_query($connect, $sQuery);
                $searchResultsCount = mysqli_num_rows($searchResults);

                if($searchResultsCount > 0){
                    while ($searchResultArray = mysqli_fetch_array($searchResults)){
                        $videoTitle = $searchResultArray['videoTitle'];
                        $videoDesc = $searchResultArray['videoDesc'];
                        $videoFile = $searchResultArray['videoFile'];
                        $videoDir = $searchResultArray['videoDir'];
                        $thumbnail = $searchResultArray['thumbnail'];
                        $thumbnailDir = $searchResultArray['thumbnailDir'];
                        $videoDuration = $searchResultArray['videoDuration'];
                        $uploadedById = $searchResultArray['uploadedById'];
                        $videoId = $searchResultArray['videoId'];
                        $airDate = $searchResultArray['airDate'];
                        $airTime = $searchResultArray['airTime'];
                        $airTime = substr($airTime, 0, 5);

                        if($userId===$uploadedById || (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>86400) {
                            echo '<h1>Not Found</h1>';
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
                                <h1>Search Results: '.$search.'</h1>
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
                                        </a>';
                            if($userId===0){
                                echo'
                                        </div>
                                </div>';
                            } else {
                                if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) {
                                    echo '
                                        </div>
                                    </div>';
                                } else {
                                    echo '
                                        <button id="'.$videoId.'" class="addToCalendar">'.$calendarButton.'</button>
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
                    }
                } else {
                    echo "<h1>Not Found</h1>";
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
                    
            ?>
        </section>
    </main>
</body>
</html>