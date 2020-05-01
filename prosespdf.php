<?php 
include "database.php";
$nopes = $_POST['nopes'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$nopes'");
$html = '
		<html>
			<head>
				<style>
					html { margin: 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 20px;
					}

					.kopsedang
					{
						font-size: 16px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 11px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.tablenilai
					{
						margin:20px 50px 0px 50px;
						border-collapse: collapse;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 0px;
					}

					.ttd
					{
						border-collapse: collapse;
						margin:20px 50px 0px 50px;
						padding: 0px;
					}

					.text-center
					{
						text-align:center;
					}

					.fontnormal
					{
						font-size: 13px;
					}
				</style>
			</head>
			<body>
				<table border="1" width="100%" style="margin:0px 50px 0px 50px;">
						<tr>
							<td text-align:"center"><img src="img/logoippi.png" style="width:130px;"/>
							</td>
							<td align="center">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>

								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>

								<span class="kopsedang">SEKOLAH MENENGAH KEJURUAN (SMK) YP IPPI PETOJO</span><br/>

								<span class="kopsedang">JAKARTA PUSAT</span><br/>

								<span class="kopbesar">AKREDITASI : "A"</span><br/>

								<span class="kopkecil">Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055</span><br/>
								<span class="kopkecil">Email : smaypippi_1951@yahoo.com</span>
							</td>
						</tr>
				</table>
				<div></div>
				<table class="fontnormal" border="1">
						<tr>
							<td colspan="3">
								<hr style="border-width:2px; width:100%;">
							</td>
						</tr>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN</span>
								<span><hr style="width:35%;"></span>
								<span>Nomor : 1 / 063 / SMKYPIPPI / V / 2020</span>
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Kejuruan YP IPPI Petojo, menerangkan bahwa :
								</div>
								<br/>
								<div>
									<table border="1" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td></td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td></td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa</td>
											<td>:</td>
											<td></td>
										</tr>
										<tr>
											<td>Nomor Peserta Ujian</td>
											<td>:</td>
											<td></td>
										</tr>
									</table>
								</div>
								<div style="margin:25px 40px 0px 40px;">Telah dinyatakan LULUS dari Satuan Pendidikan SMK YP IPPI Petojo Tahun Pelajaran 2019/2020 dengan nilai sebagai berikut :
								</div>
							</td>
						</tr>
				</table>
						<div class="fontnormal">
							<table class="tablenilai text-center" width="100%">
								<tr>
									<td rowspan="2">NO</td>
									<td rowspan="2">MATA PELAJARAN</td>
									<td colspan="2">NILAI</td>
								</tr>
								<tr>
									<td>Rata-Rata Raport</td>
									<td>Ujian Sekolah</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
							</table>
						</div>
						<div>
							<table width="100%" border="1" class="ttd fontnormal">
								<tr>
									<td width="33%"></td>
									<td width="33%"></td>
									<td width="33%">
										<div>Jakarta, 4 Mei 2020</div>
										<br/>
										<div>Kepala SMK</div>
										<div><img src="img/ttdpakyusuf.jpeg" height="90"/></div>
										<div>Drs. Mukidjo Martoyo, M.Pd</div>
									</td>
								</tr>
							</table>
						</div>						
		';
// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

// $dompdf->stream('testLaporan.pdf');	
$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

exit(0);	
			

 ?>