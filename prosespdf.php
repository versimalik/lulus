<?php 
include "database.php";
$nopes = $_POST['nopes'];
$nisn = $_POST['nisn'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$nopes' AND nisn='$nisn'");
if(mysqli_num_rows($hasil) > 0)
{

	$data = mysqli_fetch_array($hasil);

	$noujian = $data['no_ujian'];

	if($data['instansi']=="smk")
	{
		$noujianface1 = substr_replace(str_replace("K","4-20-",$data['no_ujian']), "-", 7, 0);
		$noujianface2 = substr_replace($noujianface1,"-",10,0);
		$noujianface3 = substr_replace($noujianface2, "-", 15,0);
		$noujian = substr_replace($noujianface3, "-", 20,0);
	}
	if($data['instansi']=="sma")
	{
		$noujianface1 = substr_replace(str_replace("K","",$data['no_ujian']), "-", 2, 0);
		$noujianface2 = substr_replace($noujianface1,"-",5,0);
		$noujianface3 = substr_replace($noujianface2, "-", 10,0);
		$noujian = substr_replace($noujianface3, "-", 15,0);
	}	

	$jur="";
	$bid="";
	$prog="";
	$komp="";
	if($data['komli']=="TKJ")
	{
		$jur="Teknik Komputer dan Jaringan";
		$bid="Teknologi Informasi dan Komunikasi";
		$prog="Teknik Komputer dan Informatika";
		$komp="Teknik Komputer dan Jaringan";
	}
	elseif ($data['komli']=="AP")
	{
		$jur = "Otomatisasi dan Tata Kelola Perkantoran";
		$bid="Bisnis dan Manajemen";
		$prog="Manajemen Perkantoran";
		$komp="Otomatisasi dan Tata Kelola Perkantoran";
	}
	elseif ($data['komli']=="AK")
	{
		$jur = "Akuntansi Keuangan dan Lembaga";
		$bid="Bisnis dan Manajemen";
		$prog="Akuntansi dan Keuangan";
		$komp="Akuntansi dan Keuangan Lembaga";
	}
	elseif ($data['komli']=="PM")
	{
		$jur = "Bisnis Daring dan Pemasaran";
		$bid="Bisnis dan Manajemen";
		$prog="Bisnis dan Pemasaran";
		$komp="Bisnis Daring dan Pemasaran";
	}

	$instansi="";
	if($data['instansi']=="smp")
	{
		$ttlex = explode(',', $data['ttl']);
	$ttl = $ttlex[0].", ".$ttlex[1];
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
						font-size: 17px;
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

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 120px 0px 120px;
						border-collapse: collapse;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 3px;
					}

					.tablenilaismk
					{
						margin:5px 120px 0px 120px;
						border-collapse: collapse;
					}

					.tablenilaismk td
					{
						border: 1px solid black;
						padding: 1px;
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

								<span class="kopkecil">Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055</span><br/>';
		if($data['instansi']=='smp')
		{
			$html.='
					<span class="kopkecil">Email : ypippi.petojo1951@gmail.com</span>';
		}
		else
		{
			$html.='
					<span class="kopkecil">Email : smaypippi_1951@yahoo.com</span>';
		}
								
								$html.='
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
								<span>SURAT KETERANGAN LULUS</span>';
	if($data['instansi']=='smp')
	{
		$html.='<br/><span>TAHUN PELAJARAN 2019/2020</span>';
	}

	$html.='
								<span><hr style="width:35%;"></span>';
	if($data['instansi']=="smp")
	{
		$html.='<span>Nomor :  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/SK-PP/VI/2020</span><br/>';
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
						</tr>';

if($data['instansi']=="smk")
{
	
$html.='						<tr>
							<td>
								<div>
									<table border="0" class="komli">
										<tr>
											<td>Bidang Keahlian</td>
											<td>:</td>
											<td>'.$bid.'</td>
										</tr>
										<tr>
											<td>Program Keahlian</td>
											<td>:</td>
											<td>'.$prog.'</td>
										</tr>
										<tr>
											<td>Kompetensi Keahlian</td>
											<td>:</td>
											<td>'.$komp.'</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>';
}
$html.='				<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">';
	if($data['instansi']=="smp")
	{
		$html.='Kepala SMP YP IPPI Petojo menerangkan dengan sesungguhnya bahwa :<br/>';
	}
	elseif($data['instansi']=="sma")
	{
		$html.='Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Atas YP IPPI Petojo, menerangkan bahwa :';
	}
	elseif($data['instansi']=="smk")
	{
		$html.='Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Kejuruan YP IPPI Petojo, menerangkan bahwa :';
	}						

$html.='							
									
								</div>';

	if($data['instansi']=='smp')
	{
		$html.=

		'<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.strtoupper($data['nama']).'</td>
										</tr>
										<tr>
											<td>Tempat dan Tanggal Lahir</td>
											<td>:</td>
											<td>'.$ttl.'</td>
										</tr>
										<tr>
											<td>NIS</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>NISN</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Kelas</td>
											<td>:</td>
											<td>'.$data['kelas'].'</td>
										</tr>
										<tr>
											<td>Nomor Peserta Ujian Sekolah</td>
											<td>:</td>
											<td>'.$noujian.'</td>
										</tr>';
	}
	else
	{
		$html.='
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
											<td>'.$noujian.'</td>
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
	}

	if($data['instansi']!='smp')
	{
		$html.='
										</tr>
									</table>
								</div>
								<div style="margin:5px 40px 0px 40px;">Telah dinyatakan LULUS dari Satuan Pendidikan '.$instansi.' YP IPPI Petojo Tahun Pelajaran 2019/2020 dengan nilai sebagai berikut :
								</div>
							</td>
						</tr>
				</table>';
	}
	else
	{
		$html.='						</tr>
									</table>
								</div>
								<div style="margin:5px 40px 0px 40px; text-align=justify">adalah peserta Ujian Sekolah (US) SMP YP IPPI Petojo Tahun Pelajaran 2019/2020 dan berdasarkan ketuntasan dari seluruh program pembelajaran pada Kurikulum 2013, kriteria kelulusan peserta didik pada Satuan Pendidikan SMP YP IPPI Petojo yang sesuai dengan peraturan perundang-undangan dan Hasil Rapat Pleno Dewan Pendidik tentang Kelulusan Peserta Didik SMP YP IPPI Petojo. Pada Tanggal 5 Juni 2020 peserta didik tersebut diatas dinyatakan :
								</div>
								<div style="display:block; margin:5px 40px 0px 320px; font-weight:bolder">LULUS</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil nilai sebagai berikut  :</div>
							</td>
						</tr>
				</table>';
	}

	if($data['instansi']!='smp')
	{
$html.='
						<div class="fontnormal">';
						if($data['instansi']=="smk")
						{
							$html.='<table class="tablenilaismk" width="100%">';
						}
						else
						{
							$html.='<table class="tablenilai" width="100%">';
						}

	if($data['instansi']=="sma")
	{
$html.='
								<tr>
									<td class="text-center" width="10%">No</td>
									<td class="text-center" width="60%">Mata Pelajaran</td>
									<td class="text-center" width="20%">Nilai</td>
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
									<td class="text-center">12</td>
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
									<td class="text-center">12</td>
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
	}
	else
	{
		$html.='
						<div class="fontnormal">
							<table class="tablenilai" width="100%">
								<tr>
									<td class="text-center" width="10%">No</td>
									<td class="text-center" width="60%">Mata Pelajaran</td>
									<td class="text-center" width="20%">Nilai</td>
								</tr>
								<tr>
									<td colspan="3" class="text-center">Kelompok A</td>
								</tr>
								<tr>
									<td class="text-center">1</td>
									<td>Pendidikan Agama dan Budi Pekerti</td>
									<td class="text-center">'.$data['n_pai'].'</td>
								</tr>
								<tr>
									<td class="text-center">2</td>
									<td>Pendidikan Pancasila dan Kewarganegaraan</td>
									<td class="text-center">'.$data['n_pkn'].'</td>
								</tr>
								<tr>
									<td class="text-center">3</td>
									<td>Bahasa Indonesia</td>
									<td class="text-center">'.$data['n_bindo'].'</td>
								</tr>
								<tr>
									<td class="text-center">4</td>
									<td>matematika</td>
									<td class="text-center">'.$data['n_mtk'].'</td>
								</tr>
								<tr>
									<td class="text-center">5</td>
									<td>Ilmu Pengetahuan Alam</td>
									<td class="text-center">'.$data['n_ipa'].'</td>
								</tr>
								<tr>
									<td class="text-center">6</td>
									<td>Ilmu Pengetahuan Sosial</td>
									<td class="text-center">'.$data['n_ips'].'</td>
								</tr>
								<tr>
									<td class="text-center">7</td>
									<td>Bahasa Inggris</td>
									<td class="text-center">'.$data['n_bing'].'</td>
								</tr>
								<tr>
									<td colspan="3" class="text-center">Kelompok B</td>
								</tr>
								<tr>
									<td class="text-center">8</td>
									<td>Seni Budaya</td>
									<td class="text-center">'.$data['n_sen'].'</td>
								</tr>
								<tr>
									<td class="text-center">9</td>
									<td>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
									<td class="text-center">'.$data['n_penj'].'</td>
								</tr>
								<tr>
									<td class="text-center">10</td>
									<td>Prakarya</td>
									<td class="text-center">'.$data['n_pkwu'].'</td>
								</tr>
								<tr>
									<td colspan=2 align=center  style="font-weight:bolder;"> JUMLAH</td>
									<td class="text-center" style="font-weight:bolder;">'.$data['jml'].'</td>
								</tr>
								<tr>
									<td colspan=2 align=center  style="font-weight:bolder;"> RATA-RATA</td>
									<td class="text-center" style="font-weight:bolder;">'.$data['rata'].'</td>
								</tr>
							</table>
						</div>
								';
	}

	if($data['instansi']!='smp')
	{
		$html.='
						<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify"><br/>
							Surat keterangan ini berlaku sampai dengan diterbitkannya Ijazah yang sah. Jika dikemudian hari terdapat kesalahan dalam penulisan surat keterangan ini, akan diperbaiki sebagaimana mestinya.
						</div>						
						<div>
							<table width="100%" border="0" class="ttd fontnormal">
								<tr>
									<td width="33%"></td>
									<td width="29%"></td>
									<td width="38%">
										<div>Jakarta, 2 Mei 2020</div>
										<br/>';
	}
	else
	{
		$html.='
						<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify"><br/>
							Surat keterangan ini bersifat sementara dan dapat digunakan sebagai pengganti Ijazah sampai
diterbitkan dokumen Ijazah aslinya.
						</div>						
						<div>
							<table width="100%" border="0" class="ttd fontnormal">
								<tr>
									<td width="40%"></td>
									<td width="24%" align=center>Pas Foto<br/>3 x 4 cm</td>
									<td width="38%" style="padding-left:30px;">
									<div>Jakarta, 5 Juni 2020</div>';

	}

	if($data['instansi']=='sma')
	{
$html.='										
										<div>Kepala SMA</div>
										<!-- <div style="margin-top:30px;"><img src="img/ttdpakyusuf.jpeg" height="90"/></div>-->
										<div style="margin-top:60px;">Yusup Abdul Azis, S.Pd.I</div>
									</td>
								</tr>
							</table>
						</div>';
	}
	elseif($data['instansi']=='smk')
	{
$html.='										
										<div>Kepala SMK</div>
										<!-- <div><img src="img/ttdpakmukidjo1.png" height="90"/></div>-->
										<div style="margin-top:50px;">Drs. Mukidjo Martoyo, M.Pd</div>
									</td>
								</tr>
							</table>
						</div>';
	}
	elseif($data['instansi']=='smp')
	{
$html.='										
										<br/><div>Kepala SMP</div>
										<!-- <div><img src="img/ttdpaksutarno.png" height="90"/></div>-->
										<div style="margin-top:50px;">Hadi Sutarno, S.Kom</div>
									</td>
								</tr>
							</table>
						</div>';
	}
}
// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

$dompdf->stream('SKL_'.$nisn.'.pdf');	
// $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
// exit(0);

 ?>