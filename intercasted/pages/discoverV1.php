<?php 
include('../includes/head.php');
include('../includes/navBar.php');
include('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/discoverV1/discoverV1.css">
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8026919.js"></script>
<!-- End of HubSpot Embed Code -->
</head>

<body>
    <main>
        <div id="container">
            <div id="categoryBottom">
                <p id="movie">Movies & Series</p>
                <a href="./discoverV2.php?category=1"><img id="catPhoto" src="../img/placeholders/ms.png" alt=""></a>
            </div>
            <div id="categoryBottom">
                <p id="lifeStyle">Life Style</p>
                <a href="./discoverV2.php?category=2"><img id="catPhoto" src="../img/placeholders/ls.png" alt=""></a>
            </div>
            <div id="categoryBottom">
                <p id="productOv">Product Overview</p>
                <a href="./discoverV2.php?category=3"><img id="catPhoto" src="../img/placeholders/p.png" alt=""></a>
            </div>
            <div id="categoryBottom">
                <p id="edu">Education & Conference</p>
                <a href="./discoverV2.php?category=4"><img id="catPhoto" src="../img/placeholders/ei.png" alt=""></a>
            </div>
            <div id="categoryBottom">
                <p id="hobbies">Hobbies</p>
                <a href="./discoverV2.php?category=5"><img id="catPhoto" src="../img/placeholders/hs.png" alt=""></a>
            </div>
            <div id="categoryBottom">
                <p id="media">Media</p>
                <a href="./discoverV2.php?category=6"><img id="catPhoto" src="../img/placeholders/m.png" alt=""></a>
            </div>
        </div>
    </main>
</body>

</html>