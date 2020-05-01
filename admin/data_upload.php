<?php
session_start();
if(isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
include "../database.php";

	if(isset($_REQUEST['submit'])){
		echo $filename=$_FILES["file"]["tmp_name"];
		
		if($_FILES["file"]["size"] > 0){
			$file = fopen($filename, "r");
			
			mysqli_query($db_conn,"un_siswa");
			
			while (($unData = fgetcsv($file, 10000, ";")) !== FALSE){

				// var_dump($unData);
				// die();
				//query insert
				$sql = "INSERT INTO un_siswa VALUES('$unData[0]','$unData[1]','$unData[2]','$unData[3]','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]','$unData[9]','$unData[10]','$unData[11]','$unData[12]','$unData[13]','$unData[14]','$unData[15]','$unData[16]','$unData[17]','$unData[18]','$unData[19]','$unData[20]','$unData[21]','$unData[22]','$unData[23]','$unData[24]','$unData[25]','$unData[26]','$unData[27]','$unData[28]','$unData[29]','$unData[30]','$unData[31]','$unData[32]','$unData[33]','$unData[34]','$unData[35]','$unData[36]','$unData[37]','$unData[38]','$unData[39]','$unData[40]','$unData[41]','$unData[42]','$unData[43]','$unData[44]','$unData[45]','$unData[46]','$unData[47]','$unData[48]','$unData[49]','$unData[50]','$unData[51]','$unData[52]','$unData[53]','$unData[54]','$unData[55]')";
				$res = mysqli_query($db_conn,$sql);
				
				if(! $res){
					echo "<script type=\"text/javascript\">alert(\"Invalid File!Please Upload CSV File.\");window.location = \"data.php\"</script>";
				}
			}
			
			fclose($file);
			
			echo "<script type=\"text/javascript\">alert(\"CSV File has been successfully Imported.\");window.location = \"data.php\"</script>";
		}
	} else {
		header('Location: data.php');
	}


} else {
	header('Location: ./login.php');
}
?>