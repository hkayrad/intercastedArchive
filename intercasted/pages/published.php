<?php 
include('../includes/head.php');
include('../includes/navBar.php');
header('Refresh: 5; URL=./index.php');
if(isset($_SESSION['signId'])){
    $ID=$_SESSION['signId'];
    unset($_SESSION['signId']);
    $_SESSION['userId']=$ID;
} elseif(isset($_SESSION['userId'])){
    $ID=$_SESSION['userId'];
} else{
    header('Location:./index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../styles/published/published.css">
<body>
    <main>
        <h1>Your video has published successfully. We will cast it on selected date.</h1>
        <p>You will be redirected to homepage. If nothing happened, press <a href="./index.php">here</a>.</p>
    </main>
</body>
</html>

