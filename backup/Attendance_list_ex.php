<?php
    session_start();
    include "DBConnection.php";
    if(isset($_SESSION['s_em_email'])){
      ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Import Excel To MySQL</title>
	</head>
	<body>
    <form class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
			<button type="submit" name="import">Import</button>
		</form>
		<hr>
		<table class="table" id="example">
        <colgroup>
        <col width="5%">
        <col width="20%">
        <col width="10%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        </colgroup>
        <thead class="" style ="background-color: rgb(255, 206, 46)">
			<tr>
				<th>#</th>
				<th>Employee Name</th>
				<th>Attendance Date</th>
				<th>Sign In</th>
				<th>Sign Out</th>
				<th>Working Hour</th>
			</tr>
    </thead>
			<?php
			$i = 1;
			$rows = mysqli_query($conn, "SELECT * FROM attendance");
			foreach($rows as $row) :
			?>
			<tr>
				<td> <?php echo $i++; ?> </td>
				<td> <?php echo $row["em_name"]; ?> </td>
				<td> <?php echo $row["att_date"]; ?> </td>
				<td> <?php echo $row["att_s_in"]; ?> </td>
				<td> <?php echo $row["att_s_out"]; ?> </td>
				<td> <?php echo $row["att_total_hr"]; ?> </td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "csv_uploads/"    . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$em_name = $row[0];
				$att_date = $row[1];
				$att_s_in = $row[2];
				$att_s_out = $row[3];
				$att_total_hr = $row[4];
				mysqli_query($conn, "INSERT INTO attendance VALUES('', '$em_name', '$att_date', '$att_s_in', '$att_s_out', '$att_total_hr')");
			}

			echo
			"
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
		}
		?>
        <?php
    }else{
        header("location: login.php");
        exit();
    }
?>
	</body>
</html>
    