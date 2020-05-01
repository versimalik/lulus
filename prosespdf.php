<?php 
include "database.php";
$nopes = $_POST['nopes'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$nolap = str_replace("-", "_", $nopes);
$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$nopes'");
if(mysqli_num_rows($hasil) > 0)
{
	$data = mysqli_fetch_array($hasil);

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

	$instansi="";
	if($data['instansi']=="smp")
	{
		$instansi = "SMP";
	}
	elseif($data['instansi']=="sma")
	{
		$instansi = "SMA";
	}
	elseif($data['instansi']=="smk")
	{
		$instansi = "SMK";
	}

$html = '
		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

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
						margin:5px 120px 0px 120px;
						border-collapse: collapse;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 5px;
					}

					.ttd
					{
						border-collapse: collapse;
						margin:10px 50px 0px 50px;
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
				<table border="0" width="100%" style="margin:0px 50px 0px 50px;">
						<tr>
							<td text-align:"center"><img src="img/logoippi.png" style="width:130px;"/>
							</td>
							<td align="center">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>

								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>';
	if($data['instansi']=='sma')
	{
		$html.= '<span class="kopsedang">SEKOLAH MENENGAH ATAS (SMA) YP IPPI PETOJO</span><br/>';
	}
	elseif ($data['instansi']=='smk')
	{
		$html.= '<span class="kopsedang">SEKOLAH MENENGAH KEJURUAN (SMK) YP IPPI PETOJO</span><br/>';
	}
	elseif ($data['instansi']=='smp')
	{
		$html.= '<span class="kopsedang">SEKOLAH MENENGAH PERTAMA (SMP) YP IPPI PETOJO</span><br/>';
	}

$html.=	'

							<span class="kopsedang">JAKARTA PUSAT</span><br/>

								<span class="kopbesar">AKREDITASI : "A"</span><br/>

								<span class="kopkecil">Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055</span><br/>
								<span class="kopkecil">Email : smaypippi_1951@yahoo.com</span>
							</td>
						</tr>
				</table>
				<div></div>
				<table class="fontnormal" border="0">
						<tr>
							<td colspan="3">
								<hr style="border-width:2px; width:100%;">
							</td>
						</tr>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN</span>
								<span><hr style="width:35%;"></span>';
	if($data['instansi']=="smp")
	{
		$html.='<span>Nomor : 1 / 111 / SMPYPIPPI / III / 2020</span>';
	}
	elseif($data['instansi']=="sma")
	{
		$html.='<span>Nomor : 083 / SK-AP / V / 2020</span>';
	}
	elseif($data['instansi']=="smk")
	{
		$html.='<span>Nomor : 135 / SK / E / V / 2020</span>';
	}

$html.='				
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;"><br/>Yang bertanda tangan di bawah ini Kepala ';
	if($data['instansi']=="smp")
	{
		$html.='Sekolah Menengah Pertama';
	}
	elseif($data['instansi']=="sma")
	{
		$html.='Sekolah Menengah Atas';
	}
	elseif($data['instansi']=="smk")
	{
		$html.='Sekolah Menengah Kejuruan';
	}						

$html.='							
									YP IPPI Petojo, menerangkan bahwa :
								</div>
								<br/>
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Nomor Ujian</td>
											<td>:</td>
											<td>'.$data['no_ujian'].'</td>
										</tr>										
										<tr>
											<td>Nama Siswa</td>
											<td>:</td>
											<td>'.strtoupper($data['nama']).'</td>
										</tr>';
	if($data['komli']=='MIPA'||$data['komli']=='IPS')
	{
		$html.='
										<tr>
											<td>Jurusan</td>
											<td>:</td>
											<td>'.$data['komli'].'</td>';
	}
	elseif($data['komli']=='TKJ'||$data['komli']=='AP'||$data['komli']=='AK'||$data['komli']=='PM')
	{
		$html.='
										<tr>
											<td>Kompetensi Keahlian</td>
											<td>:</td>
											<td>'.$jur.'</td>';
	}
										
$html.='
										</tr>
									</table>
								</div>
								<div style="margin:25px 40px 0px 40px;">Telah dinyatakan LULUS dari Satuan Pendidikan '.$instansi.' YP IPPI Petojo Tahun Pelajaran 2019/2020 dengan nilai sebagai berikut :
								</div>
							</td>
						</tr>
				</table>
						<div class="fontnormal">
							<table class="tablenilai" width="100%">';
	if($data['instansi']=="sma")
	{
$html.='
								<tr>
									<td class="text-center" width="5%">No</td>
									<td class="text-center" width="85%">Mata Pelajaran</td>
									<td class="text-center" width="10%">Nilai</td>
								</tr>
								<tr>
									<td colspan="3" class="text-center">Kelompok A (Wajib)</td>
								</tr>
								<tr>
									<td class="text-center">1</td>
									<td>Pendidikan Agama dan Budi Pekerti</td>
									<td class="text-center">'.$data['n_pai'].'</td>
								</tr>
								<tr>
									<td class="text-center">2</td>
									<td>Pendidikan Kewarganegaraan</td>
									<td class="text-center">'.$data['n_pkn'].'</td>
								</tr>
								<tr>
									<td class="text-center">3</td>
									<td>Bahasa Indonesia</td>
									<td class="text-center">'.$data['n_bindo'].'</td>
								</tr>
								<tr>
									<td class="text-center">4</td>
									<td>Matematika</td>
									<td class="text-center">'.$data['n_mtk'].'</td>
								</tr>
								<tr>
									<td class="text-center">5</td>
									<td>Sejarah Indonesia</td>
									<td class="text-center">'.$data['n_sejin'].'</td>
								</tr>
								<tr>
									<td class="text-center">6</td>
									<td>Bahasa Inggris</td>
									<td class="text-center">'.$data['n_bing'].'</td>
								</tr>
								<tr>
									<td colspan="3" class="text-center">Kelompok B (Wajib)</td>
								</tr>
								<tr>
									<td class="text-center">7</td>
									<td>Seni Budaya</td>
									<td class="text-center">'.$data['n_sen'].'</td>
								</tr>
								<tr>
									<td class="text-center">8</td>
									<td>Penjaskes</td>
									<td class="text-center">'.$data['n_penj'].'</td>
								</tr>				
								<tr>
									<td class="text-center">9</td>
									<td>Prakarya dan Kewirausahaan</td>
									<td class="text-center">'.$data['n_pkwu'].'</td>
								</tr>
								<tr>
									<td colspan="3" class="text-center">Kelompok C (Peminatan)</td>
								</tr>';
			
		if($data['komli']=="MIPA")
		{
								
$html.='
								<tr>
									<td class="text-center">10</td>
									<td>Matematika</td>
									<td class="text-center">'.$data['n_mtkp'].'</td>
								</tr>
								<tr>
									<td class="text-center">11</td>
									<td>Biologi</td>
									<td class="text-center">'.$data['n_bio'].'</td>
								</tr>
								<tr>
									<td class="text-center">12</td>
									<td>Fisika</td>
									<td class="text-center">'.$data['n_fis'].'</td>
								</tr>
								<tr>
									<td class="text-center">13</td>
									<td>Kimia</td>
									<td class="text-center">'.$data['n_kim'].'</td>
								</tr>';				

		}
		elseif ($data['komli']=="IPS") 
		{
$html.='
								<tr>
									<td class="text-center">10</td>
									<td>Geografi</td>
									<td class="text-center">'.$data['n_geo'].'</td>
								</tr>
								<tr>
									<td class="text-center">11</td>
									<td>Sejarah</td>
									<td class="text-center">'.$data['n_sej'].'</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Sosiologi</td>
									<td class="text-center">'.$data['n_sos'].'</td>
								</tr>
								<tr>
									<td class="text-center">13</td>
									<td>Ekonomi</td>
									<td class="text-center">'.$data['n_eko'].'</td>
								</tr>';
									
		}
							
$html.='						<tr>
									<td colspan="3" class="text-center">Kelompok D (Pendalaman Minat)</td>
								</tr>
								<tr>
									<td class="text-center">14</td>
									<td>Bahasa Arab</td>
									<td class="text-center">'.$data['n_barab'].'</td>
								</tr>';
	}
	elseif($data['instansi']=="smk")
	{
$html.='						
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
									<td class="text-center">1</td>
									<td>Pendidikan Agama dan Budi Pekerti</td>
									<td class="text-center">'.$data['r_pai'].'</td>
									<td class="text-center">'.$data['n_pai'].'</td>
								</tr>
								<tr>
									<td class="text-center">2</td>
									<td>Pendidikan Kewarganegaraan</td>
									<td class="text-center">'.$data['r_pkn'].'</td>
									<td class="text-center">'.$data['n_pkn'].'</td>
								</tr>
								<tr>
									<td class="text-center">3</td>
									<td>Bahasa Indonesia</td>
									<td class="text-center">'.$data['r_bindo'].'</td>
									<td class="text-center">'.$data['n_bindo'].'</td>
								</tr>
								<tr>
									<td class="text-center">4</td>
									<td>Matematika</td>
									<td class="text-center">'.$data['r_mtk'].'</td>
									<td class="text-center">'.$data['n_mtk'].'</td>
								</tr>
								<tr>
									<td class="text-center">5</td>
									<td>Sejarah Indonesia</td>
									<td class="text-center">'.$data['r_sejin'].'</td>
									<td class="text-center">'.$data['n_sejin'].'</td>
								</tr>
								<tr>
									<td class="text-center">6</td>
									<td>Bahasa Inggris</td>
									<td class="text-center">'.$data['r_bing'].'</td>
									<td class="text-center">'.$data['n_bing'].'</td>
								</tr>
								<tr>
									<td colspan="4">B. Muatan Kewilayahan</td>
								</tr>
								<tr>
									<td class="text-center">7</td>
									<td>Seni Budaya</td>
									<td class="text-center">'.$data['r_sen'].'</td>
									<td class="text-center">'.$data['n_sen'].'</td>
								</tr>
								<tr>
									<td class="text-center">8</td>
									<td>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
									<td class="text-center">'.$data['r_penj'].'</td>
									<td class="text-center">'.$data['n_penj'].'</td>
								</tr>
								<tr>
									<td colspan="4">C. Muatan Peminatan Kejuruan</td>
								</tr>
								<tr>
									<td colspan="4">C1. Bidang Keahlian</td>
								</tr>
								<tr>
									<td class="text-center">9</td>
									<td>Simulasi Digital</td>
									<td class="text-center">'.$data['r_simdig'].'</td>
									<td class="text-center">'.$data['n_simdig'].'</td>
								</tr>';

			if($data['komli']=="TKJ")
			{

$html.='
								<tr>
									<td class="text-center">10</td>
									<td>Fisika</td>
									<td class="text-center">'.$data['r_fis'].'</td>
									<td class="text-center">'.$data['n_fis'].'</td>
								</tr>
								<tr>
									<td class="text-center">11</td>
									<td>Kimia</td>
									<td class="text-center">'.$data['r_kim'].'</td>
									<td class="text-center">'.$data['n_kim'].'</td>
								</tr>';
			}
			else
			{
$html.='
								<tr>
									<td class="text-center">10</td>
									<td>Ekonomi Bisnis</td>
									<td class="text-center">'.$data['r_ekob'].'</td>
									<td class="text-center">'.$data['n_ekob'].'</td>
								</tr>
								<tr>
									<td class="text-center">11</td>
									<td>Administrasi Umum</td>
									<td class="text-center">'.$data['r_admu'].'</td>
									<td class="text-center">'.$data['n_admu'].'</td>
								</tr>
								<tr>
									<td class="text-center">13</td>
									<td>IPA</td>
									<td class="text-center">'.$data['r_ipa'].'</td>
									<td class="text-center">'.$data['n_ipa'].'</td>
								</tr>';
			}
								
$html.='
								<tr>
									<td colspan="2">C2. Dasar Program Keahlian</td>
									<td class="text-center">'.$data['r_c2'].'</td>
									<td class="text-center">'.$data['n_c2'].'</td>
								</tr>
								<tr>
									<td colspan="2">C3. Kompetensi Keahlian</td>
									<td class="text-center">'.$data['r_c3'].'</td>
									<td class="text-center">'.$data['n_c3'].'</td>
								</tr>


		';
	}
$html.='
							</table>
						</div>';

// $html.='						
// 						<div>
// 							<table width="100%" border="0" class="ttd fontnormal">
// 								<tr>
// 									<td width="33%"></td>
// 									<td width="29%"></td>
// 									<td width="38%">
// 										<div>Jakarta, 4 Mei 2020</div>
// 										<br/>';
// 	if($data['instansi']=='sma')
// 	{
// $html.='										
// 										<div>Kepala SMA</div>
// 										<div><img src="img/ttdpakyusuf.jpeg" height="90"/></div>
// 										<div>Yusup Abdul Azis, S.Pd.I</div>
// 									</td>
// 								</tr>
// 							</table>
// 						</div>';
// 	}
// 	elseif($data['instansi']=='smk')
// 	{
// $html.='										
// 										<div>Kepala SMK</div>
// 										<div><img src="img/ttdpakmukidjo1.png" height="90"/></div>
// 										<div>Drs. Mukidjo Martoyo, M.Pd</div>
// 									</td>
// 								</tr>
// 							</table>
// 						</div>';
// 	}
// 	elseif($data['instansi']=='smp')
// 	{
// $html.='										
// 										<div>Kepala SMK</div>
// 										<div><img src="img/ttdpaksutarno.png" height="90"/></div>
// 										<div>Hadi Sutarno, S.Kom</div>
// 									</td>
// 								</tr>
// 							</table>
// 						</div>';
// 	}
}
// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

$dompdf->stream('SKL_'.$nolap.'.pdf');	
// $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

// exit(0);	
			

 ?>