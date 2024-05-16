<?php
session_start();
include "../DBConnection.php";

function updateEmploymentStatus() {
    global $conn;

    $es_id = $_POST['es_id'];
    $es_name = $_POST['es_name'];
    $es_income = $_POST['es_income'];

    $query = "UPDATE employment_status SET es_name='$es_name', es_income='$es_income' WHERE es_id = $es_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "success";
      } else {
        echo "Error updating employment status: " . mysqli_error($conn);
      }
    }
  ?>
