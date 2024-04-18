<?php 
require_once('DBConnection.php');

if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('Dashboard.php') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Event has been deleted successfully.'); location.replace('Dashboard.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}

$conn->close();
?>
