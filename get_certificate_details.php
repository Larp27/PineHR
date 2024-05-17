<?php
include "DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cert_id = $_POST['cert_id'];

  $sql =  "SELECT * FROM `certificate` c INNER JOIN `employee` e ON e.em_id = c.em_id  INNER JOIN `department` d ON d.dep_id = e.dep_id  WHERE cert_id = $cert_id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
      $r_cert_title = $row['cert_title'];
      $r_cert_description = $row['cert_description'];
      $r_cert_media = $row['cert_media'];
      $r_cert_date = date('Y-m-d', strtotime($row['cert_date']));
      $r_cert_uploaded = date('Y-m-d', strtotime($row['cert_uploaded']));
      $r_first_name = $row['first_name'];
      $r_last_name = $row['last_name'];
      $r_dep_name = $row['dep_name'];
    
      $modalContent = "
      <p><strong>Employee Name:</strong> $r_last_name, $r_first_name</p>
      <p><strong>Certificate Title:</strong> $r_cert_title</p>
      <p><strong>Description:</strong> $r_cert_description</p>
      <p><strong>Certificate Image:</strong>";
    
      // Check if cert_media field is empty or null
      if (!empty($r_cert_media)) {
        $modalContent .= "<img src='../PINEHR/" . substr($r_cert_media, 3) . "' style='width:450px; height: 250px; border: 2px solid #2468a0;'>";
      } else {
        // If cert_media is empty, display a placeholder image
        $modalContent .= "<img src='bgimages/blank.png' style='width:450px; height: 250px; border: 2px solid #2468a0;'>";
      }
    
      $modalContent .= "</p>";
    
      echo $modalContent;
    } else {
      echo "No details found for the selected employee.";
    }
  }
}
?>