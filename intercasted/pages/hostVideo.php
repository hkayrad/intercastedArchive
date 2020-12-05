<?php
include('../includes/db.php');
include('../includes/head.php');
include('../includes/navBar.php');
if (isset($_SESSION['signId'])) {
    $ID = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $ID;
} elseif (isset($_SESSION['userId'])) {
    $ID = $_SESSION['userId'];
} else {
    $ID = 0;
}
?>



<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/watchVideo/watchVideo.css">

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

                $hostCheckerQuery = "SELECT uploadedById FROM video WHERE videoId = ". $urlVideoId;
                $hostCheckerResult = mysqli_query($connect, $hostCheckerQuery);
                $hostInfo = mysqli_fetch_assoc($hostCheckerResult);
                $hostId = $hostInfo['uploadedById'];

                if($ID !== $hostId) {
                    header("Location: ./watchVideo.php?v=".$urlVideoId);
                } else {
                    if(mysqli_num_rows($checkVideoResult) == 0)
                    echo "<h1 id='videoError'>Video not found.</h1>
                        <p id='errorDesc'>You'll be redirecting to home page. If nothing happens, press <a id='errorDesc' href='./index.php'>here</a></p>";

                    else {
                        $videoInfo = mysqli_fetch_assoc($videoResult);
                        $videoTitle = $videoInfo['videoTitle'];
                        $videoDesc = $videoInfo['videoDesc'];
                        $videoFile = $videoInfo['videoFile'];
                        $videoDir = $videoInfo['videoDir'];
                        $thumbnail = $videoInfo['thumbnail'];
                        $thumbnailDir = $videoInfo['thumbnailDir'];
                        $videoDuration = $videoInfo['videoDuration'];
                        $airDate = $videoInfo['airDate'];
                        $airTime = $videoInfo['airTime'];
                        
                        $rUserQuery = "SELECT `username`, `pPDir` FROM user WHERE id = '$ID'";
                        $userResult = mysqli_query($connect, $rUserQuery);
                        
                        $userInfo = mysqli_fetch_array($userResult);
                        $username = $userInfo[0];
                        $pPDir = $userInfo[1];

                        echo '
                            <div id="videoChat">
                                <div id="video">
                                <video id="videoArea" src="'.$videoDir.'" alt="" controls poster="'.$thumbnailDir.'"></video>
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
                                                    <p id="date">'.$airDate.'</p>
                                                    <input type="text" style="display:none;" value="'.$url.'" id="myInput">
                                                    <div class="tooltip">
                                                        <button onclick="myFunction()" onmouseout="outFunc()" class="share">
                                                            <img src="../img/icons/share.png" alt="">
                                                            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                                            Copy text
                                                        </button>
                                                    </div>
                                                </div>
                                            
                                                <div id="channelRow">
                                                    <a id="channelLink" href="./visitProfile.php?user='.$ID.'">
                                                        <img id="channelImg" src="'.$pPDir.'" alt="">
                                                        <p id="channel">'.$username.'</p>
                                                    </a>
                                                </div>
                                            </div>
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
                                </div>
                            </form>
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
                }
            } else 
                header("Location: ./index.php");
        ?>
    </main>
</body>

</html>