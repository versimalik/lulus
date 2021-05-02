<?php

include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk menampilkan pengumuman hasil ujian nasional secara online">
    <meta name="author" content="slamet.bsan@gmail.com">
    <title>Pengumuman Kelulusan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Info Kelulusan <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <!-- <li><a href="#about">About</a></li> -->
                <!-- <li><a href="#contact">Contact</a></li> -->
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <div class="container">
        <!-- <h2 align="center">Pengumuman Kelulusan 
<?=$hsl['tahun'] ?></h2> -->
        <h3 align="center" style="font-weight: bold;">Pengumuman Surat 
Keterangan Lulus </h3>
        <h3 align="center" style="font-weight: bold;">YP IPPI Jakarta Tahun 2020/2021</h3>
		<!-- countdown -->
		
		<div id="clock" class="lead"></div>
		
		<div id="xpengumuman">
<?php
	if(isset($_REQUEST['submit']))
	{
		//tampilkan hasil queri jika ada
		$no_ujian = $_REQUEST['nomor'];
		$nisn= $_REQUEST['nisn'];
		
		$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$no_ujian' AND nisn='$nisn'");
		if(mysqli_num_rows($hasil) > 0)
		{
			$data = mysqli_fetch_array($hasil);

			$cabang = $hsl['cabang'];
			$carismp = $hsl['smpcari'];
			$carisma = $hsl['smacari'];
			$carismk = $hsl['smkcari'];

			$sklsmp = $hsl['smpnilai'];
			$sklsma = $hsl['smanilai'];
			$sklsmk = $hsl['smknilai'];

			$belum = '<div class="alert alert-danger" role="alert">Daftar Nilai untuk '.strtoupper($data['instansi']).' belum tersedia.</div>';

			if($data['instansi']=="smp")
			{
				if($carismp==0)
				{
					echo $belum;
				}
				else
				{
?>
					<table class="table table-bordered">
							<tr>
								<td>Nomor Ujian</td>
								<td><?php echo $data['no_ujian']; ?></td>
							</tr>
							<tr>
								<td>NISN</td>
								<td><?php echo $data['nisn']; ?></td>
							</tr>
							<tr>
								<td>Nama Siswa</td>
								<td><?php echo strtoupper($data['nama']); ?></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td class="text-center" width="5%">No</td>
								<td class="text-center" width="85%">Mata Pelajaran</td>
								<td class="text-center" width="10%">Nilai</td>
							</tr>
							<tr>
								<td colspan="3" class="text-center">Kelompok A</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Pendidikan Agama dan Budi Pekerti</td>
								<td class="text-center"><?php echo $data['n_pai']; ?></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Pendidikan Kewarganegaraan</td>
								<td class="text-center"><?php echo $data['n_pkn']; ?></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Bahasa Indonesia</td>
								<td class="text-center"><?php echo $data['n_bindo']; ?></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Matematika</td>
								<td class="text-center"><?php echo $data['n_mtk']; ?></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Ilmu Pengetahuan Alam</td>
								<td class="text-center"><?php echo $data['n_ipa']; ?></td>
							</tr>
							<tr>
								<td>6</td>
								<td>Ilmu Pengetahuan Sosial</td>
								<td class="text-center"><?php echo $data['n_ips']; ?></td>
							</tr>
							<tr>
								<td>7</td>
								<td>Bahasa Inggris</td>
								<td class="text-center"><?php echo $data['n_bing']; ?></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center">Kelompok B</td>
							</tr>
							<tr>
								<td>7</td>
								<td>Seni Budaya</td>
								<td class="text-center"><?php echo $data['n_sen']; ?></td>
							</tr>
							<tr>
								<td>8</td>
								<td>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
								<td class="text-center"><?php echo $data['n_penj']; ?></td>
							</tr>				
							<tr>
								<td>9</td>
								<td>Prakarya
								<td class="text-center"><?php echo $data['n_pkwu']; ?></td>
							</tr>
						</table>
						
<?php
						if( $data['status'] == 1 )
						{
							echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';
						} else 

						{
							echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
						}

						if($sklsma==0)
						{
							echo '<div class="alert alert-danger" role="alert">Pencetakan SKL untuk '.strtoupper($data['instansi']).' belum tersedia. Mohon tunggu informasi selanjutnya!</div>';
						}
						else
						{
?>
							<form method="post" action="prosespdf.php">
								<input type="hidden" name="nopes" value=<?php echo $data["no_ujian"]; ?>>
								<input type="hidden" name="nisn" value=<?php echo $data["nisn"]; ?>>
								<input type="submit" name="submit" value="Klik Untuk Download SKL" class="btn btn-primary btn-sm">
							</form>
<?php
						}?>
<?php
				}
			}
			elseif ($data['instansi']=="SMA")
			{
				if($carisma==0)
				{
					echo $belum;
				}
				else
				{
					if($data['skl']==0)
					{
						// echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';

						echo '<div class="alert alert-danger" role="alert">Daftar Nilai untuk '.strtoupper($data['nama']).' belum tersedia, silahkan hubungi wali kelas!</div>';
					}
					else
					{
?>
						<table class="table table-bordered">
							<tr>
								<td>Nomor Ujian</td>
								<td><?php echo $data['no_ujian']; ?></td>
							</tr>
							<tr>
								<td>NISN</td>
								<td><?php echo $data['nisn']; ?></td>
							</tr>
							<tr>
								<td>Sekolah</td>
								<td><?php echo ($data['cabang']=="CAKUNG")?"SMA YP IPPI Cakung":"SMA YP IPPI Petojo"; ?></td>
							</tr>
							<tr>
								<td>Nama Siswa</td>
								<td><?php echo strtoupper($data['nama']); ?></td>
							</tr>
							<tr>
								<td>Jurusan</td>
								<td><?php echo $data['komli']; ?></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<td class="text-center" width="5%">No</td>
								<td class="text-center" width="85%">Mata Pelajaran</td>
								<td class="text-center" width="10%">Nilai</td>
							</tr>
							<tr>
								<td colspan="3" class="text-center">Kelompok A</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Pendidikan Agama dan Budi Pekerti</td>
								<td class="text-center"><?php echo $data['n_pai']; ?></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Pendidikan Kewarganegaraan</td>
								<td class="text-center"><?php echo $data['n_pkn']; ?></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Bahasa Indonesia</td>
								<td class="text-center"><?php echo $data['n_bindo']; ?></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Matematika</td>
								<td class="text-center"><?php echo $data['n_mtk']; ?></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Sejarah Indonesia</td>
								<td class="text-center"><?php echo $data['n_sejin']; ?></td>
							</tr>
							<tr>
								<td>6</td>
								<td>Bahasa Inggris</td>
								<td class="text-center"><?php echo $data['n_bing']; ?></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center">Kelompok B</td>
							</tr>
							<tr>
								<td>7</td>
								<td>Seni Budaya</td>
								<td class="text-center"><?php echo $data['n_sen']; ?></td>
							</tr>
							<tr>
								<td>8</td>
								<td>Penjaskes</td>
								<td class="text-center"><?php echo $data['n_penj']; ?></td>
							</tr>				
							<tr>
								<td>9</td>
								<td>Prakarya dan Kewirausahaan</td>
								<td class="text-center"><?php echo $data['n_pkwu']; ?></td>
							</tr>
							<tr>
								<td colspan="3" class="text-center">Kelompok C (Peminatan dan Lintas Minat)</td>
							</tr>
<?php
								if($data['komli']=="IPA")
								{
?>
							<tr>
								<td>10</td>
								<td>Matematika</td>
								<td class="text-center"><?php echo $data['n_mtkp']; ?></td>
							</tr>
							<tr>
								<td>11</td>
								<td>Biologi</td>
								<td class="text-center"><?php echo $data['n_bio']; ?></td>
							</tr>
							<tr>
								<td>12</td>
								<td>Fisika</td>
								<td class="text-center"><?php echo $data['n_fis']; ?></td>
							</tr>
							<tr>
								<td>13</td>
								<td>Kimia</td>
								<td class="text-center"><?php echo $data['n_kim']; ?></td>
							</tr>				
<?php
								}
								elseif ($data['komli']=="IPS") 
								{
?>
							<tr>
								<td>10</td>
								<td>Geografi</td>
								<td class="text-center"><?php echo $data['n_geo']; ?></td>
							</tr>
							<tr>
								<td>11</td>
								<td>Sejarah</td>
								<td class="text-center"><?php echo $data['n_sej']; ?></td>
							</tr>
							<tr>
								<td>12</td>
								<td>Sosiologi</td>
								<td class="text-center"><?php echo $data['n_sos']; ?></td>
							</tr>
							<tr>
								<td>13</td>
								<td>Ekonomi</td>
								<td class="text-center"><?php echo $data['n_eko']; ?></td>
							</tr>
<?php
								
								}
							$minat = ($data['cabang']=="PETOJO")?"Bahasa Arab":"Bahasa Jepang";
?>
							<tr>
								<td>14</td>
								<td>Pilihan Lintas Minat / Pendalaman Minat : <?php echo $minat;?></td>
								<td class="text-center"><?php echo ($data['cabang']=="CAKUNG")?$data['n_jpg']:$data['n_barab'] ?></td>
							</tr>
						</table>
						
<?php
						if( $data['status'] == 1 )
						{
							echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';
						} else 

						{
							echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
						}

						if($sklsma==0)
						{
							echo '<div class="alert alert-danger" role="alert">Pencetakan SKL untuk '.strtoupper($data['instansi']).' belum tersedia. Mohon tunggu informasi selanjutnya!</div>';
						}
						else
						{
?>
							<form method="post" action="prosespdf.php">
								<input type="hidden" name="nopes" value=<?php echo $data["no_ujian"]; ?>>
								<input type="hidden" name="nisn" value=<?php echo $data["nisn"]; ?>>
								<input type="submit" name="submit" value="Klik Untuk Melihat SKL" class="btn btn-primary btn-sm">
							</form>
<?php
						}
					}
				}
			}
			elseif($data['instansi']=="smk")
			{
				if($carismk==0)
				{
					echo $belum;
				}
				else
				{
					if($data['skl']==0)
					{
						echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';

						echo '<div class="alert alert-danger" role="alert">Daftar Nilai untuk '.strtoupper($data['nama']).' belum tersedia, silahkan hubungi wali kelas!</div>';
					}
					else
					{
?>
					<table class="table table-bordered">
						<tr>
							<td>Nomor Ujian</td>
							<td><?php echo $data['no_ujian']; ?></td>
						</tr>
						<tr>
							<td>NISN</td>
							<td><?php echo $data['nisn']; ?></td>
						</tr>
						<tr>
							<td>Nama Siswa</td>
							<td><?php echo strtoupper($data['nama']); ?></td>
						</tr>
						<tr>
							<td>Kompetensi Keahlian</td>
<?php
									$jur="";
									if($data['komli']=="TKJ")
									{
										$jur="Teknik Komputer dan Jaringan";
									}
									elseif ($data['komli']=="AP")
									{
										$jur = "Otomatisasi dan Tata Kelola Perkantoran";
									}
									elseif ($data['komli']=="AK")
									{
										$jur = "Akuntansi Keuangan dan Lembaga";
									}
									elseif ($data['komli']=="PM")
									{
										$jur = "Bisnis Daring dan Pemasaran";
									}
?>
							<td><?php echo $jur; ?></td>
						</tr>
					</table>
					<table class="table table-bordered">
						<tr>
							<td class="text-center" rowspan="2" style="vertical-align: middle;">No</td>
							<td class="text-center" rowspan="2" style="vertical-align: middle;">Mata Pelajaran</td>
							<td class="text-center" colspan="2">Nilai</td>
						</tr>
						<tr>
							<td class="text-center">Rata-Rata Raport</td>
							<td class="text-center">Ujian Sekolah</td>
						</tr>
						<tr>
							<td colspan="4">A. Muatan Nasional</td>
						</tr>
						<tr>
							<td>1</td>
							<td>Pendidikan Agama dan Budi Pekerti</td>
							<td class="text-center"><?php echo $data['r_pai']; ?></td>
							<td class="text-center"><?php echo $data['n_pai']; ?></td>
						</tr>
						<tr>
							<td>2</td>
							<td>Pendidikan Kewarganegaraan</td>
							<td class="text-center"><?php echo $data['r_pkn']; ?></td>
							<td class="text-center"><?php echo $data['n_pkn']; ?></td>
						</tr>
						<tr>
							<td>3</td>
							<td>Bahasa Indonesia</td>
							<td class="text-center"><?php echo $data['r_bindo']; ?></td>
							<td class="text-center"><?php echo $data['n_bindo']; ?></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Matematika</td>
							<td class="text-center"><?php echo $data['r_mtk']; ?></td>
							<td class="text-center"><?php echo $data['n_mtk']; ?></td>
						</tr>
						<tr>
							<td>5</td>
							<td>Sejarah Indonesia</td>
							<td class="text-center"><?php echo $data['r_sejin']; ?></td>
							<td class="text-center"><?php echo $data['n_sejin']; ?></td>
						</tr>
						<tr>
							<td>6</td>
							<td>Bahasa Inggris</td>
							<td class="text-center"><?php echo $data['r_bing']; ?></td>
							<td class="text-center"><?php echo $data['n_bing']; ?></td>
						</tr>
						<tr>
							<td colspan="4">B. Muatan Kewilayahan</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Seni Budaya</td>
							<td class="text-center"><?php echo $data['r_sen']; ?></td>
							<td class="text-center"><?php echo $data['n_sen']; ?></td>
						</tr>
						<tr>
							<td>8</td>
							<td>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
							<td class="text-center"><?php echo $data['r_penj']; ?></td>
							<td class="text-center"><?php echo $data['n_penj']; ?></td>
						</tr>
						<tr>
							<td colspan="4">C. Muatan Peminatan Kejuruan</td>
						</tr>
						<tr>
							<td colspan="4">C1. Bidang Keahlian</td>
						</tr>
						<tr>
							<td>9</td>
							<td>Simulasi Digital</td>
							<td class="text-center"><?php echo $data['r_simdig']; ?></td>
							<td class="text-center"><?php echo $data['n_simdig']; ?></td>
						</tr>
<?php
							if($data['komli']=="TKJ")
							{
?>
						<tr>
							<td>10</td>
							<td>Fisika</td>
							<td class="text-center"><?php echo $data['r_fis']; ?></td>
							<td class="text-center"><?php echo $data['n_fis']; ?></td>
						</tr>
						<tr>
							<td>11</td>
							<td>Kimia</td>
							<td class="text-center"><?php echo $data['r_kim']; ?></td>
							<td class="text-center"><?php echo $data['n_kim']; ?></td>
						</tr>
<?php
							}
							else
							{
?>
						<tr>
							<td>10</td>
							<td>Ekonomi Bisnis</td>
							<td class="text-center"><?php echo $data['r_ekob']; ?></td>
							<td class="text-center"><?php echo $data['n_ekob']; ?></td>
						</tr>
						<tr>
							<td>11</td>
							<td>Administrasi Umum</td>
							<td class="text-center"><?php echo $data['r_admu']; ?></td>
							<td class="text-center"><?php echo $data['n_admu']; ?></td>
						</tr>
						<tr>
							<td>12</td>
							<td>IPA</td>
							<td class="text-center"><?php echo $data['r_ipa']; ?></td>
							<td class="text-center"><?php echo $data['n_ipa']; ?></td>
						</tr>
<?php
							}
?>
						<tr>
							<td colspan="2">C2. Dasar Program Keahlian</td>
							<td class="text-center"><?php echo $data['r_c2']; ?></td>
							<td class="text-center"><?php echo $data['n_c2']; ?></td>
						</tr>
						<tr>
							<td colspan="2">C3. Kompetensi Keahlian</td>
							<td class="text-center"><?php echo $data['r_c3']; ?></td>
							<td class="text-center"><?php echo $data['n_c3']; ?></td>
						</tr>			
					</table>
					
<?php
					
						if( $data['status'] == 1 )
						{
							echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';
						} else 

						{
							echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
						}
?>


<?php
					if($sklsmk==0)
					{
						echo '<div class="alert alert-danger" role="alert">Pencetakan SKL untuk '.strtoupper($data['instansi']).' belum tersedia. Mohon tunggu informasi selanjutnya!</div>';
					}
					else
					{
?>

						<form method="post" action="prosespdf.php">
							<input type="hidden" name="nopes" value=<?php echo $data["no_ujian"]; ?>>
							<input type="hidden" name="nisn" value=<?php echo $data["nisn"]; ?>>

							<input type="submit" name="submit" value="Klik Untuk Download SKL" class="btn btn-primary btn-sm">
						</form>
<?php
					}
				}
			}
		}
?>
			
	
<?php
		}
		else 
		{
			echo 'nomor ujian yang anda inputkan tidak ditemukan! periksa kembali nomor ujian anda.';
			//tampilkan pop-up dan kembali tampilkan form
		}
	}
	else
	{
		//tampilkan form input nomor ujian
	?>
    <p>Masukkan nomor ujianmu pada form yang disediakan.</p>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nisn" class="form-control" placeholder="NISN" required>
            <input type="text" name="nomor" class="form-control" placeholder="No. Ujian : K0101XXXXXXXXX / 01-0517-XXXX-X" required>
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Periksa!</button>
            <!-- </span> -->
        </div>
    </form>
	<?php
	}
?>
		</div>
    </div><!-- /.container -->
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah']; ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%D Hari %H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>
</body>
</html>
