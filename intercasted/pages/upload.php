<?php 
session_start();
require_once '../vendor/autoload.php';
include('../includes/head.php');
include('../includes/db.php');
$message = " ";
if(isset($_SESSION['signId'])){
    $ID=$_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId']=$ID;
} elseif(isset($_SESSION['userId'])){
    $ID=$_SESSION['userId'];
} else{
    header('Location:./index.php');
}

$vmQuery="SELECT mCode FROM user WHERE id=".$ID."";
$vmResult=mysqli_query($connect,$vmQuery) or die(mysqli_error($connect));
$vmRow=mysqli_fetch_array($vmResult);
$vm=$vmRow['mCode'];
if(!empty($vm)){
    header('Location:./vmCode.php');
}

if(isset($_POST['submit'])) {
    $maxVideoSize = 10737418240;
    $maxThumbnailSize = 5242880;
    
    $videoDir = "../videos/";

    $videoFileName = $_FILES['videoFile']['name'];
    $videoName = $videoDir . $_FILES['videoFile']['name'];
    
    $thumbnailDir = "../img/thumbnails/";

    $thumbnailFileVideo = "../img/thumbnails/" . $_FILES['videoFile']['name'] . ".png";
    $thumbnailFileVideoName = $_FILES['videoFile']['name'] . '.png';

    $thumbnailFileName = $_FILES['thumbnailFile']['name'];
    $thumbnailName = $thumbnailDir . $_FILES['thumbnailFile']['name'];

    $videoFileType = strtolower(pathinfo($videoName,PATHINFO_EXTENSION));

    $add=random_int(1000000000,9999999999);
    $randVideoFileName = $add . "." .$videoFileType;
    $randVideoFile = $videoDir . $randVideoFileName;
    $randVideoFileNoExt = str_replace(".".$videoFileType, "", $randVideoFile);
    $randVideoFileNameNoExt = str_replace(".".$videoFileType, "", $randVideoFileName);
    $allVideoFiles = scandir($videoDir);

    foreach ($allVideoFiles as $file) {
        while(strstr($file, $randVideoFileName)){
            $add=random_int(1000000000,9999999999);
            $randVideoFileName = $add . "." .$videoFileType;
            $randVideoFile = $videoDir . $randVideoFileName;
            $randVideoFileNoExt = str_replace(".".$videoFileType, "", $randVideoFile);
            $randVideoFileNameNoExt = str_replace(".".$videoFileType, "", $randVideoFileName);
        }
    }

    $add=random_int(1000000000,9999999999);
    $randThumbnailFileName = $add . ".png";
    $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
    $allThumbFiles = scandir($thumbnailDir);
    foreach ($allThumbFiles as $file) {
        while(strstr($file, $randThumbnailFileName)){
            $add=random_int(1000000000,9999999999);
            $randThumbnailFileName = $add . ".png";
            $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
        }
    }
    

    if(empty($thumbnailFileName)) {
        if(($_FILES['videoFile']['size'] >= $maxVideoSize)) {
            $message = "File is too large. Video file size must be less than 10GB.";
        } else {
            if(move_uploaded_file($_FILES['videoFile']['tmp_name'], $randVideoFile)){
                if (!strpos($randVideoFile, ".mp4")) {
                    $add=random_int(1000000000,9999999999);
                    $randThumbnailFileName = $add . ".png";
                    $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
                    $allThumbFiles = scandir($thumbnailDir);
                    foreach ($allThumbFiles as $file) {
                        while(strstr($file, $randThumbnailFileName)){
                            $add=random_int(1000000000,9999999999);
                            $randThumbnailFileName = $add . ".png";
                            $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
                        }
                    }

                    $ffmpeg = FFMpeg\FFMpeg::create();
                    $video = $ffmpeg->open($randVideoFile);
                    $video
                        ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                        ->save($randThumbnailFile);
                    
                    $ffmpeg = FFMpeg\FFMpeg::create();
                    $video = $ffmpeg->open($randVideoFile);
                    $video
                    ->save(new FFMpeg\Format\Video\X264('libmp3lame'), $randVideoFileNoExt.".mp4");
                    $randVideoFileWithMP4 = $randVideoFileNoExt . ".mp4";
                    $randVideoFileNameWithMP4 = $randVideoFileNameNoExt . ".mp4";
                
                    $ffprobe = FFMpeg\FFProbe::create();
                    $duration = $ffprobe
                        ->format($randVideoFile)
                        ->get('duration');
                    $durMinSec = gmdate("H:i:s", $duration);

                    unlink($randVideoFile);

                    $_SESSION['videoFileName'] = $videoFileName;
                    $_SESSION['videoFile'] = $videoName;

                    $_SESSION['randVideoFileWithMP4'] = $randVideoFileWithMP4;
                    $_SESSION['randVideoFileNameWithMP4'] = $randVideoFileNameWithMP4;

                    $_SESSION['thumbnailFileName'] = $thumbnailFileVideoName;
                    $_SESSION['thumbnailFile'] = $thumbnailFileVideo;

                    $_SESSION['randThumbnailFileName'] = $randThumbnailFileName;
                    $_SESSION['randThumbnailFile'] = $randThumbnailFile;

                    $_SESSION['duration'] = $durMinSec; 

                    header("Location: ./publish.php?upload=".$randVideoFileNameNoExt);
                } else {
                    $add=random_int(1000000000,9999999999);
                    $randThumbnailFileName = $add . ".png";
                    $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
                    $allThumbFiles = scandir($thumbnailDir);
                    foreach ($allThumbFiles as $file) {
                        while(strstr($file, $randThumbnailFileName)){
                            $add=random_int(1000000000,9999999999);
                            $randThumbnailFileName = $add . ".png";
                            $randThumbnailFile = $thumbnailDir . $randThumbnailFileName;
                        }
                    }

                    $ffmpeg = FFMpeg\FFMpeg::create();
                    $video = $ffmpeg->open($randVideoFile);
                    $video
                        ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                        ->save($randThumbnailFile);
                    
                
                    $ffprobe = FFMpeg\FFProbe::create();
                    $duration = $ffprobe
                        ->format($randVideoFile)
                        ->get('duration');
                    $durMinSec = gmdate("H:i:s", $duration);

                    $_SESSION['videoFileName'] = $videoFileName;
                    $_SESSION['videoFile'] = $videoName;

                    $_SESSION['randVideoFileWithMP4'] = $randVideoFile;
                    $_SESSION['randVideoFileNameWithMP4'] = $randVideoFileName;

                    $_SESSION['thumbnailFileName'] = $thumbnailFileVideoName;
                    $_SESSION['thumbnailFile'] = $thumbnailFileVideo;

                    $_SESSION['randThumbnailFileName'] = $randThumbnailFileName;
                    $_SESSION['randThumbnailFile'] = $randThumbnailFile;

                    $_SESSION['duration'] = $durMinSec; 

                    header("Location: ./publish.php?upload=".$randVideoFileNameNoExt);
                }
            }
        }
    } else {
        if($_FILES['thumbnailFile']['size'] >= $maxThumbnailSize) {
            $message = "File is too large. Thumbnail file size must be less than 5MB.";
        } else {
            if(($_FILES['videoFile']['size'] >= $maxVideoSize)) {
                $message = "File is too large. Video file size must be less than 10GB.";
            } else {
                if((move_uploaded_file($_FILES['videoFile']['tmp_name'], $randVideoFile)) && (move_uploaded_file($_FILES['thumbnailFile']['tmp_name'], $randThumbnailFile))){
                    if (!strpos($randVideoFile, ".mp4")) {
                        $ffprobe = FFMpeg\FFProbe::create();
                        $duration = $ffprobe
                            ->format($randVideoFile)
                            ->get('duration');
                        $durMinSec = gmdate("H:i:s", $duration);

                        $ffmpeg = FFMpeg\FFMpeg::create();
                        $video = $ffmpeg->open($randVideoFile);
                        $video
                        ->save(new FFMpeg\Format\Video\X264('libmp3lame'), $randVideoFileNoExt.".mp4");
                        $randVideoFileWithMP4 = $randVideoFileNoExt . ".mp4";
                        $randVideoFileNameWithMP4 = $randVideoFileNameNoExt . ".mp4";

                        unlink($randVideoFile);

                        $_SESSION['videoFileName'] = $videoFileName;
                        $_SESSION['videoFile'] = $videoName;
    
                        $_SESSION['randVideoFileWithMP4'] = $randVideoFileWithMP4;
                        $_SESSION['randVideoFileNameWithMP4'] = $randVideoFileNameWithMP4;
    
                        $_SESSION['thumbnailFileName'] = $thumbnailFileName;
                        $_SESSION['thumbnailFile'] = $thumbnailFile;
    
                        $_SESSION['randThumbnailFileName'] = $randThumbnailFileName;
                        $_SESSION['randThumbnailFile'] = $randThumbnailFile;
    
                        $_SESSION['duration'] = $durMinSec; 
    
                        header("Location: ./publish.php?upload=".$randVideoFileNameNoExt);
                    } else {
                        $ffprobe = FFMpeg\FFProbe::create();
                        $duration = $ffprobe
                            ->format($randVideoFile)
                            ->get('duration');
                        $durMinSec = gmdate("H:i:s", $duration);
                        
                        $_SESSION['videoFileName'] = $videoFileName;
                        $_SESSION['videoFile'] = $videoName;

                        $_SESSION['randVideoFileWithMP4'] = $randVideoFile;
                        $_SESSION['randVideoFileNameWithMP4'] = $randVideoFileName;

                        $_SESSION['thumbnailFileName'] = $thumbnailFileName;
                        $_SESSION['thumbnailFile'] = $thumbnailFile;

                        $_SESSION['randThumbnailFileName'] = $randThumbnailFileName;
                        $_SESSION['randThumbnailFile'] = $randThumbnailFile;

                        $_SESSION['duration'] = $durMinSec; 

                        header("Location: ./publish.php?upload=".$randVideoFileNameNoExt);
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video!</title>
    <link rel="stylesheet" href="../styles/upload/upload.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>
<body>
    <main>
        <form method="post" enctype="multipart/form-data" action="./upload.php">
            <div id="fileButtons">
                <div id="columnVideoForm">
                    <?php echo '<p id="required">'.$message.'</p>';?>
                    <p id="required">*Required</p>
                    <label id="select" for="fileSelect">Upload Video</label>
                    <input type="file" id="fileSelect" name="videoFile" accept="video/*" required></input>
                </div>
                <div id="columnThumbForm"> 
                    <p id="note">Note: This is not required. If you don't pick thumbnail, a photo will be created in the beginning of video.</p>
                    <label id="selectThumbnail" for="thumbnailSelect">Upload Thumbnail</label>
                    <input type="file" id="thumbnailSelect" name="thumbnailFile" accept="img/.png,.jpg,.jpeg"></input>
                </div>
            </div>
            <input name="submit" id="submit" type="submit" value="Upload">
        </form>
    </main>
    
</body>
</html>
