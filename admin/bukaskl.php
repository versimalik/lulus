<?php
session_start();

include "../database.php";

if(isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
    
} else {
	header('Location: ./login.php');
}

$nisn = $_GET['id'];

$skl_update_status_skl = "UPDATE un_siswa SET skl = 1 where skl = 0 AND nisn = '$nisn'";
$update_status_skl = mysqli_query($db_conn,$skl_update_status_skl);

// var_dump($update_status_skl);
// die();

header('Location: ./data.php');
?>