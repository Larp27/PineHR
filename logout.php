<?php
  session_start();
  unset($_SESSION['s_first_name']);
  unset($_SESSION['s_em_email']);
  unset($_SESSION['s_em_id']);
  unset($_SESSION['s_status']);
  session_destroy();
  header ("location: login.php");
  exit();
?>