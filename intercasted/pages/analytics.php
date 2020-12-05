<?php
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');
$ppDir = $_SESSION['profilePhoto'];
$uID = $_SESSION['userId'];
$usernameQuery = "SELECT username FROM user WHERE id =" . $uID . "";
$nameResult = mysqli_query($connect, $usernameQuery);
$nameRow = mysqli_fetch_array($nameResult);
$username = $nameRow['username'];

if (isset($_SESSION['signId'])) {
    $uID = $_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId'] = $uID;
} elseif (isset($_SESSION['userId'])) {
    $uID = $_SESSION['userId'];
} else {
    header('Location:./index.php');
}

if (isset($_POST['signOut'])) {
    if (isset($_COOKIE['rememberMe'])) {
        $userId = decryptCookie($_COOKIE['rememberMe']);
        $sql_query = "SELECT count(*) AS cntUser,id FROM user WHERE id='" . $userId . "'";
        $result = mysqli_query($connect, $sql_query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['cntUser'];
        if ($count > 0) {
            $days = 1;
            $value = encryptCookie($userId);
            setcookie("rememberMe", $value, time() + ($days * -1 * 60 * 60));
            session_destroy();
            header('Location:./signIn.php');
        }
    } else {
        session_destroy();
        header('Location:./signIn.php');
    }
}


$vQuery = "SELECT count(uploadedById) AS VideoCount From video WHERE uploadedById = '$uID'";
$vResult = mysqli_query($connect, $vQuery);
$vRow = mysqli_fetch_array($vResult);
$vCount = $vRow['VideoCount'];
// echo $vCount;

$videoQuery = "SELECT `videoTitle`, `thumbnail`, `thumbnailDir`, `likeCount`, `dislikeCount`, `viewCount` FROM video WHERE uploadedById= $uID ";
$vQResult = mysqli_query($connect, $videoQuery);

$nQuery = "SELECT count(gender) AS one From user WHERE id IN (SELECT followerId FROM follow WHERE followedId = $uID) AND gender = 'none'";
$nResult = mysqli_query($connect, $nQuery);
$nRow = mysqli_fetch_array($nResult);
$nCount = $nRow['one'];

$mQuery = "SELECT count(gender) AS Male From user WHERE id IN (SELECT followerId FROM follow WHERE followedId = $uID) AND gender = 'male'";
$mResult = mysqli_query($connect, $mQuery);
$mRow = mysqli_fetch_array($mResult);
$mCount = $mRow['Male'];

$fQuery = "SELECT count(gender) AS Female From user WHERE id IN (SELECT followerId FROM follow WHERE followedId = $uID) AND gender = 'female'";
$fResult = mysqli_query($connect, $fQuery);
$fRow = mysqli_fetch_array($fResult);
$fCount = $fRow['Female'];

$oQuery = "SELECT count(gender) AS Other From user WHERE id IN (SELECT followerId FROM follow WHERE followedId = $uID) AND gender = 'other'";
$oResult = mysqli_query($connect, $oQuery);
$oRow = mysqli_fetch_array($oResult);
$oCount = $oRow['Other'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/profile/profile.css">
    <title>Analytics</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawView);

        function drawView() {
            var data = google.visualization.arrayToDataTable([
                ['Videos', 'Views', 'Likes', 'Dislikes'],
                <?php
                while ($videoInfo = mysqli_fetch_assoc($vQResult)) {
                    $videoTitle = $videoInfo['videoTitle'];
                    $thumbnail = $videoInfo['thumbnail'];
                    $thumbnailDir = $videoInfo['thumbnailDir'];
                    $likes = $videoInfo['likeCount'];
                    $dislikes = $videoInfo['dislikeCount'];
                    $views = $videoInfo['viewCount'];

                    echo "['$videoTitle', '$views' , '$likes' , '$dislikes']";
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Video Performance',
                    subtitle: 'Views, Likes, Dislikes per Video',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        ///////////////////////////////////////////////////////////////////////////////////////
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Male', <?php echo $mCount; ?>],
                ['Female', <?php echo $fCount; ?>],
                ['Other', <?php echo $oCount; ?>],
                ['Prefer not to disclose', <?php echo $nCount; ?>]
            ]);

            var options = {
                title: 'Follower Gender Percentage',
                is3D: true,
                slices: {
                    0: {
                        color: '#218c74'
                    },
                    1: {
                        color: '#02A164'
                    },
                    2: {
                        color: '#029E43'
                    },
                    3: {
                        color: '#00FF00'
                    }
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
            ///////////////////////////////////////////////////////////////////////////////////////
        }
    </script>
</head>

<body>
    <aside>
        <div id="option">
            <a href="./profile.php">
                <p>Profile</p>
            </a>
        </div>
        <div id="curoption">
            <a href="./analytics.php">
                <p>Analytics</p>
            </a>
        </div>

        <div id="option">
            <form action="profile.php" method="POST">
                <label for="signOut">
                    <button type="submit" name="signOut">
                        <p>Sign Out</p>
                    </button>
                </label>
            </form>
        </div>
    </aside>
    <main>
        <section>
            <div id="piechart_3d" style="width: 30vw; height: 30vw;"></div>
            <!-- TODO SCSS'da overflow:auto; olacak -->
            <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        </section>
    </main>
</body>

</html>





<?php
//$uID=$_SESSION['userId'];
include('../includes/functions.php');


if (isset($_POST['signOut'])) {
    if (isset($_COOKIE['rememberMe'])) {
        $userId = decryptCookie($_COOKIE['rememberMe']);
        $sql_query = "SELECT count(*) AS cntUser,id FROM user WHERE id='" . $userId . "'";
        $result = mysqli_query($connect, $sql_query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['cntUser'];
        if ($count > 0) {
            $days = 1;
            $value = encryptCookie($userId);
            setcookie("rememberMe", $value, time() + ($days * -1 * 60 * 60));
            session_destroy();
            header('Location:./signIn.php');
        }
    } else {
        session_destroy();
        header('Location:./signIn.php');
    }
}
?>