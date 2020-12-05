<?php 
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');

if(isset($_SESSION['signId'])){
    $ID=$_SESSION['signId'];
    unset($_SESSION['signId']);
}
elseif(isset($_SESSION['userId'])){
    $ID=$_SESSION['userId'];
}
else{
    $ID=0;
}

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/visitProfile/visitProfile.css">
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->

<body>
    <main>
        <?php 
            $urlProfileId = $_GET['user'];

            if($ID===$urlProfileId) {
                header("Location: ./profile.php");
            } else {
                $checkUserQuery = "SELECT * FROM `user` WHERE `id` = ".$urlProfileId." LIMIT 1";

                if(isset($urlProfileId) && !empty($urlProfileId)) {
                    $rUserQuery = "SELECT * FROM `user` WHERE `id` = " . $urlProfileId;
                    $userResult = mysqli_query($connect, $rUserQuery);
                    $checkUserResult = mysqli_query($connect, $checkUserQuery);
                    if(mysqli_num_rows($checkUserResult) == 0) {
                        echo "<h1 id='userError'>User Not Found</h1>
                            <p id='errorDesc'> You'll be redirecting to home page. If nothing happens, press <a id='errorLink' href=''>here</a>.</p>";
                        header('Refresh: 5; URL=./index.php');
                    } else {
                        $userInfo = mysqli_fetch_assoc($userResult);
                        $username = $userInfo['username'];
                        $bio = $userInfo['userBio'];      
                        $userId = $userInfo['id'];
                        $pPDir = $userInfo['pPDir'];

                        $followQuery = "SELECT * FROM follow WHERE `followerId`= ". $ID ." AND `followedId` = ". $userId;
                        $followResult = mysqli_query($connect, $followQuery);
        
                        if (mysqli_num_rows($followResult)>0) {
                            $followButton = "Followed";
                            $clickBool = "true";
                        }
                        else {
                            $followButton = "Follow";
                            $clickBool = "false";
                        }
                        if(strlen($bio)==0){
    
                            $biography="";
                        }
                        else{
                            $biography=$bio;
                        }
                        echo '<div id="profile">
                        <img src="'.$pPDir.'" alt="">
                        <div id="profileColumn">
                            <div id="name">';
                            if ($ID===0) {
                                echo '
                                <h1 id="username">'.$username.'</h1>
                            </div>
                            <p id="desc">'.$biography.'
                                </p>
                                </div>
                            </div>';
                            } else {
                                echo '
                                <h1 id="username">'.$username.'</h1>
                                <button id="'.$userId.'" type="submit">'.$followButton.'</button>
                                </div>
                                <p id="desc">'.$biography.'</p>
                                    </div>
                                </div>';
                            }

                    echo "<h1>$username's Videos</h1>";
                        $checkUserVideoQuery = "SELECT * FROM `video` WHERE `uploadedById` = " . $userId . " LIMIT 1";
                        $userVideoQuery = "SELECT * FROM `video` WHERE `uploadedById` = " . $userId;
                        $checkUserVideoResult = mysqli_query($connect, $checkUserVideoQuery);
                        $userVideoResult = mysqli_query($connect, $userVideoQuery);
                        if(mysqli_num_rows($checkUserVideoResult) == 0) {
                            echo "<h1 id='userError'>" . $username . " hasn't uploaded a video yet.</h1>";
                        } else {
                        
                            while ($videoInfo = mysqli_fetch_assoc($userVideoResult))
                            {
                                $videoTitle = $videoInfo['videoTitle'];
                                $videoDesc = $videoInfo['videoDesc'];
                                $videoFile = $videoInfo['videoFile'];
                                $videoDir = $videoInfo['videoDir'];
                                $thumbnail = $videoInfo['thumbnail'];
                                $thumbnailDir = $videoInfo['thumbnailDir'];
                                $videoDuration = $videoInfo['videoDuration'];
                                $videoDate = $videoInfo['airDate'];
                                $videoId = $videoInfo['videoId'];

                                $userCalendarQuery = "SELECT * FROM uservideocalendar WHERE `userId`= ". $userId ." AND `videoId` = ". $videoId;
                                $userCalendarResult = mysqli_query($connect, $userCalendarQuery);
            
                                if (mysqli_num_rows($userCalendarResult)>0) {
                                    $calendarButton = "Added to Calendar";
                                    $clickCalendarBool = "true";
                                }
                                else {
                                    $calendarButton = "Add to Calendar";
                                    $clickCalendarBool = "false";
                                }

                                echo "
                                <div id='videos'>
                                    <div id='videoPost'>
                                        <a id='thumbnailLink' href='./watchVideo.php?v=".$videoId."'><img id='thumbnail' src='".$thumbnailDir."' alt='video'></a>
                                        <p id='duration'>".$videoDuration."</p> 
                                        <div id='videoDesc'>
                                            <a href='./watchVideo.php?v=".$videoId."'>
                                                <h2>".$videoTitle."</h2>
                                            </a>
                                            <p id='desc'>
                                                ".$videoDesc."
                                            </p>";
                                if($ID===0) {
                                        echo "
                                        </div>
                                    </div>
                                </div>";
                                } else {
                                    if ((strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))>=0 && (strtotime($todayDate)+strtotime($time))-(strtotime($airDate)+strtotime($airTime))<86400) {
                                        echo "</div>
                                        </div>
                                    </div>
                                    
                                    ";
                                } else {
                                    echo "
                                        <button type='submit' class='addToCalendar' id='".$videoId."'>".$calendarButton."</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
                                    $('#".$videoId."').data('clicked', ".$clickCalendarBool.");
                                    $('#".$videoId."').data('id', ".$videoId.");
                                    console.log($('#".$videoId."').data('clicked'));
                                    var log = [];

                                    $('#".$videoId."').click(function() {
                                        if ($('#".$videoId."').data('clicked') == false) {
                                            $('#".$videoId."').text('Added to Calendar');
                                            $('#".$videoId."').data('clicked', true);
                                            log[0] = $('#".$videoId."').data('clicked');
                                            log[1] = $('#".$videoId."').data('id');

                                            $.ajax ({
                                                type: 'POST',
                                                data: {
                                                    'save': 1,
                                                    'videoId': ".$videoId."
                                                } 
                                            });
                                            

                                        } else {
                                            $('#".$videoId."').text('Add to Calendar');
                                            $('#".$videoId."').data('clicked', false);
                                            log[0] = $('#".$videoId."').data('clicked');
                                            log[1] = $('#".$videoId."').data('id');

                                            $.ajax ({
                                                type: 'GET',
                                                data: {
                                                    'delete': 1,
                                                    'videoId': ".$videoId."
                                                } 
                                            });
                                        }
                                    });
                                </script>";
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
                }
                echo "
                    <script>
                        $('#".$userId."').data('clicked', ".$clickBool.");
                        $('#".$userId."').data('id', ".$userId.");
                        console.log($('#".$userId."').data('clicked'));
                        var log = [];

                        $('#".$userId."').click(function() {
                            if ($('#".$userId."').data('clicked') == false) {
                                $('#".$userId."').text('Followed');
                                $('#".$userId."').data('clicked', true);
                                log[0] = $('#".$userId."').data('clicked');
                                log[1] = $('#".$userId."').data('id');
                            
                                $.ajax ({
                                    type: 'POST',
                                    data: {
                                        'saveUser': 1,
                                        'followedId': ".$userId."
                                    }
                                });
                            
                            } else {
                                $('#".$userId."').text('Follow');
                                $('#".$userId."').data('clicked', false);
                                log[0] = $('#".$userId."').data('clicked');
                                log[1] = $('#".$userId."').data('id');
                            
                                $.ajax ({
                                    type: 'GET',
                                    data: {
                                        'deleteUser': 1,
                                        'followedId': ".$userId."
                                    }
                                });
                            }
                        });
                    </script>";

                    if(isset($_POST['saveUser'])) {
                        $followedId = $_POST['followedId'];
                        $insertFollowQuery = "INSERT INTO follow (`followerId`, `followedId`) VALUES (".$ID.", ".$followedId.")";
                        mysqli_query($connect, $insertFollowQuery);
                    }
                    if(isset($_GET['deleteUser'])) {
                        $deleteFollowId = $_GET['followedId'];
                        $deleteFollowQuery = "DELETE FROM follow WHERE `followerId` = ".$ID." AND `followedId` = ". $deleteFollowId;
                        mysqli_query($connect, $deleteFollowQuery);
                    }
            }

                } else {
                    header("Location: ./index.php");
                }
            }
        ?>
    </main>
</body>

</html>