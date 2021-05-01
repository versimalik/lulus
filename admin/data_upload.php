<?php
session_start();
if(isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
include "../database.php";

	if(isset($_REQUEST['submit'])){
		echo $filename=$_FILES["file"]["tmp_name"];
		
		if($_FILES["file"]["size"] > 0){
			$file = fopen($filename, "r");
			
			mysqli_query($db_conn,"un_siswa");
			
			while (($unData = fgetcsv($file, 10000, ",")) !== FALSE){

				// var_dump($unData);
				// die();
				// query insert
				$sql = "INSERT INTO un_siswa (`no_ujian`, `nis`, `nisn`, `cabang`, `instansi`, `komli`, `nama`, `ttl`, `n_pai`, `n_pkn`, `n_bindo`, `n_mtk`, `n_sejin`, `n_bing`, `n_sen`, `n_penj`, `n_pkwu`, `n_mtkp`, `n_bio`, `n_fis`, `n_kim`, `n_geo`, `n_sej`, `n_sos`, `n_eko`, `n_jpg`, `rata`)VALUES('$unData[0]','$unData[1]','$unData[2]','$unData[3]','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]','$unData[9]','$unData[10]','$unData[11]','$unData[12]','$unData[13]','$unData[14]','$unData[15]','$unData[16]','$unData[17]','$unData[18]','$unData[19]','$unData[20]','$unData[21]','$unData[22]','$unData[23]','$unData[24]','$unData[25]','$unData[26]')";
				$res = mysqli_query($db_conn,$sql);

				// var_dump($sql);
				// die();
				
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