<?php ob_start();

$connect = mysqli_connect('*cencored*','*cencored*','*cencored*','*cencored*');

$initQuery = "SET NAMES 'utf8'";
mysqli_query($connect, $initQuery);

ini_set('upload_max_filesize', '10000M');
ini_set('post_max_size', '10001M');
ini_set('max_input_time', 30000000);
ini_set('max_execution_time', 30000000);

if($connect) {
    // echo "yey";
}
?>
