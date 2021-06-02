<?php 
// ini_set('display_errors', 1);
include "database.php";
$nopes = $_POST['nopes'];
$nisn = $_POST['nisn'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$nopes' AND nisn='$nisn'");
$konfigurasi = mysqli_query($db_conn,"SELECT * FROM un_konfigurasi");

if(mysqli_num_rows($hasil) > 0)
{

	$data = mysqli_fetch_array($hasil);
	$konfig = mysqli_fetch_array($konfigurasi);

	$lulus = ($data['status']=='1')?"LULUS":"TIDAK LULUS";
	$rataCakung = ($data['n_pai']+$data['n_pkn']+$data['n_bindo']+$data['n_mtk']+$data['n_ipa']+$data['n_ips']+$data['n_bing']+$data['n_sen']+$data['n_penj']+$data['n_pkwu']+$data['n_tik']+$data['n_barab']+$data['n_aqidah']+$data['n_tahfidz'])/14;

	// $komli = ($data['komli']=="TKJ")?"Teknik Komputer dan Jaringan":($data['komli']=="AP")?"Otomatisasi dan Tata Kelola Perkantoran":($data['komli']=="AK")?"Akuntansi dan Keuangan Lembaga":"Bisnis Daring dan Pemasaran";

	// $proli = ($data['komli']=="TKJ")?"Teknologi Komputer dan Informatika":($data['komli']=="AK")?"Akuntansi dan Keuangan":($data['komli']=="AP")?"Manajeman Perkantoran":"Bisnis dan Pemasaran";

	$komli = "";
	$proli = "";

	switch ($data['komli']) {
		case 'TKJ':
			$proli = "Teknik Komputer dan Informatika";
			$komli = "Teknik Komputer dan Jaringan";
			break;

		case 'AP':
			$proli = "Manajemen Perkantoran";
			$komli = "Otomatisasi dan Tata Kelola Perkantoran";
			break;

		case 'AK':
			$proli = "Akuntansi dan Keuangan";
			$komli = "Akuntansi dan Keuangan Lembaga";
			break;

		case 'PM':
			$proli = "Bisnis dan Pemasaran";
			$komli = "Bisnis Daring dan Pemasaran";
			break;
		
		default:
			$proli = "";
			$komli = "";
			break;
	}

	$noujian = $data['no_ujian'];
	$cabang= ($data['cabang']=="PETOJO") ? "Petojo" : "Cakung";
	$jakarta= ($data['cabang']=="PETOJO") ? "Jakarta Pusat" : "Jakarta Timur";
	$alamatippi = ($data['cabang']=="PETOJO") ? "Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055" : "Jl. P. Komarudin Ujung Krawang Kober Limo, Pulogebang, Cakung - Jakarta Timur";
	$emailsma = ($data['cabang']=="CAKUNG")?"smas.ypippickg@gmail.com":"smaypippi_1951@yahoo.com";

if ($data['instansi']=="SMA") {

$html = '
		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
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
						font-size: 12px;
					}
				</style>
			</head>
			<body>';

		if ($data['cabang']=="CAKUNG") {
			$html.='	<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
						<tr>
							<td><img src="img/logoippi.png" style="width:130px; margin-left:65px;"/>
							</td>
							<td align="center" style="padding-right:35px;">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>	
								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">SEKOLAH MENENGAH ATAS (SMA)</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">YP IPPI CAKUNG JAKARTA TIMUR</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">TERAKREDITASI "A"</span><br/>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="border-top:1px solid black; border-bottom:4px double black; font-size:12px; text-align:center">
								Jl. Ujung Krawang/ Jl. Kober Ujung RT. 006 RW. 05, Kelurahan Pulo Gebang Kecamatan Cakung Kota Administrasi Jakarta Timur
							</td>
						</tr>
						</table>



							';

		}
		else
		{
			$html.='	<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
						<tr>
							<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
							</td>
							<td align="center">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>

								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>';
		
		$it=($data['cabang']=="CAKUNG")?"SEKOLAH MENENGAH ATAS (SMA) YP IPPI ":"SEKOLAH MENENGAH ATAS (SMA) YP IPPI ";
		$html.= '<span class="kopsedang">'.$it.strtoupper($cabang).'</span><br/>';
$html.=	'

							<span class="kopsedang">'.strtoupper($jakarta).'</span><br/>

								<span class="kopbesar">AKREDITASI : "A"</span><br/>

								<span class="kopkecil">'.$alamatippi.'</span><br/>';
		
			$html.='<span class="kopkecil">Telp. (021) 48703207 Fax. (021)4808359 Email : '.$emailsma.'</span>';
								
								$html.='
							</td>
						</tr>
				</table>
				<div></div>';
			}
			$hr=($data['cabang']=="CAKUNG")?"":"<hr style=border-width:2px; width:100%;>";
			$html.='	<table class="fontnormal" border="0">
						<tr>
							<td colspan="3">
								'.$hr.'
							</td>
						</tr>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN LULUS</span>
								<br>';
			$judulskl = ($data['instansi']=="SMA" ? ($data['komli']=="IPA" ? "PEMINATAN MATEMATIKA DAN ILMU PENGETAHUAN ALAM (MIPA)" : "PEMINATAN ILMU PENGETAHUAN SOSIAL (IPS)") : "LAIN");

			$html.=$judulskl;
			$html.='<br/><span>TAHUN PELAJARAN 2020/2021</span>';
			$nomorsklsma = ($data['cabang']=="CAKUNG")?" 205/A-YP-IPPI/V/2021":" 165/SK-AP/V/2021";
			$html.='<br>Nomor:'.$nomorsklsma;

$html.='				
							</td>
						</tr>';
$skolah = ($data['cabang']=="CAKUNG")?"YP IPPI Cakung":"YP IPPI Petojo";
$html.='				<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">';
		$html.='Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Atas '.$skolah.', menerangkan dengan sesungguhnya bahwa :';					
$npsnsma = ($data['cabang']=="CAKUNG")?"20103295":"20100215";
$html.='							
									
								</div>';
		$html.='
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td>'.$data['ttl'].'</td>
										</tr>										
										<tr>
											<td>Nomor Peserta Ujian</td>
											<td>:</td>
											<td>'.$data['no_ujian'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>NPSN</td>
											<td>:</td>
											<td>'.$npsnsma.'</td>
										</tr>';
	$skolah2=($data['cabang']=="CAKUNG"?"SMA YP IPPI Cakung":"SMA YP IPPI Petojo");
 
	$html.='						</tr>
									</table>
								</div>
								<div style="margin:5px 40px 0px 40px; text-align=justify">Berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan pada Satuan Pendidikan '.$skolah2.' yang sesuai dengan peraturan perundang-undangan dan Hasil Rapat Pleno Dewan Pendidik tentang Kelulusan Peserta Didik '.$skolah2.', maka yang bersangkutan dinyatakan:
								</div>
								<div style="display:block; margin:1px 40px 0px 320px; font-weight:bolder; font-size:15;">LULUS</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil nilai sebagai berikut  :</div>
							</td>
						</tr>
				</table>';

					$html.='<table class="tablenilai" width="100%">';
$html.='
								<tr>
									<td class="text-center" width="10%">No</td>
									<td class="text-center" width="60%">Mata Pelajaran<br>(Kurikulum 2013)</td>
									<td class="text-center" width="20%">Nilai Ujian Sekolah</td>
								</tr>
								<tr>
									<td colspan="3">Kelompok A</td>
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
									<td colspan="3">Kelompok B</td>
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
									<td colspan="3">Kelompok C (Peminatan dan Lintas Minat)</td>
								</tr>';
			
		if($data['komli']=="IPA")
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
$minat = ($data['cabang']=="PETOJO")?"Bahasa Arab":"Bahasa Jepang";
$nilaiminat = ($data['cabang']=="PETOJO")?$data['n_barab']:$data['n_jpg'];			
$html.='						<tr>
									<td class="text-center">14</td>
									<td>Pilihan Lintas Minat/Pendalaman Minat: '.$minat.'</td>
									<td class="text-center">'.$nilaiminat.'</td>
								</tr>

								<tr>
									<td colspan = "2" class="text-center">Rata - Rata</td>
									<td class="text-center">'.$data['rata'].'</td>
								</tr>';
$html.='
							</table>
						</div>';
	
		$sklsalin=($data['cabang']=="PETOJO")?'<div style="background-color:#eed202; color:black; padding:10px; font-size:15px;">Ini adalah tampilan salinan SKL. SKL asli akan dibagikan pada saat pembagian rapor.</div>':"";
		$html.='
						<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify"><br/>
							Surat keterangan ini bersifat sementara sampai dikeluarkannya ijazah.
							<br><br>
							Demikian surat keterangan ini diberikan agar dapat digunakan sebagaimana mestinya. Apabila di kemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau Surat Keterangan ini tidak berlaku.
						</div>						
						<div>
							<table width="100%" border="-" class="ttd fontnormal">
								<tr>
									<td width="70%" colspan="2">'.$sklsalin.'</td>
									<td width="30%" style="padding-left:30px;">
									<div>Jakarta, 3 Mei 2021</div>';

	

$kepseksma=($data['cabang']=="CAKUNG")?"Asmiliyah, S.Pd":"Yusup Abdul Azis, S.Pd.I";
$nipkepseksma=($data['cabang']=="CAKUNG")?"NIP.-":"NUPTK. 7052764665200010";
$html.='										
										<div>Kepala SMA</div>
										<!-- <div style="margin-top:30px;"><img src="img/ttdpakyusuf.jpeg" height="90"/></div>-->
										<div style="margin-top:50px;">'.$kepseksma.'</div>
										<div>'.$nipkepseksma.'</div>
									</td>
								</tr>
							</table>
						</div>';
}

elseif ($data['instansi']=="SMK")
{
	if ($data['cabang']=="CAKUNG")
	{
		$html = '

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
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
						font-size: 12px;
					}

					.box-foto
					{
						width:100px;
						height:120px;
						text-align: center;
						font-size:16px;
						border: dotted 3px black;
						margin-left: 270px;
						margin-top: 25px;
					}
				</style>
			</head>
			<body>

			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
					<tr>
						<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
						</td>
						<td align="center" style="padding-right:35px;">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>	
								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">SEKOLAH MENENGAH KEJURUAN (SMK)</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">YP IPPI CAKUNG JAKARTA TIMUR</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">TERAKREDITASI "A"</span><br/>
							</td>
						</td>
						</tr>
						<tr>
							<td colspan="2" style="border-top:1px solid black; border-bottom:4px double black; font-size:12px; text-align:center">
								Jl. Ujung Krawang/ Jl. Kober Ujung RT. 006 RW. 05, Kelurahan Pulo Gebang Kecamatan Cakung Kota Administrasi Jakarta Timur
							</td>
						</tr>
					</tr>
			</table>
			<table class="fontnormal" border="0" width="100%">
					<tr>
						<td colspan="3">
							
						</td>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN LULUS</span><br>
								<span>TAHUN PELAJARAN 2020/2021</span><br>
								<span>NOMOR: Nomor surat belum ada</span>
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Kejuruan (SMK) YP IPPI Cakung menerangkan bahwa :
								</div>
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td>'.$data['ttl'].'</td>
										</tr>										
										<tr>
											<td>Nomor Induk</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Program Keahlian</td>
											<td>:</td>
											<td>'.$proli.'</td>
										</tr>
										<tr>
											<td>Kompetensi Keahlian</td>
											<td>:</td>
											<td>'.$komli.'</td>
										</tr>
									</table>
								</div>
							</td>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan dinyatakan:
								</div>
								<div style="display:block; margin:1px 40px 0px 320px; font-weight:bolder; font-size:15;">LULUS</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil sebagai berikut  :</div>
							</td>
						</tr>
					</tr>
			</table>
			<table class="tablenilai" width="100%">
				<tr>
					<td class="text-center" width="10%">No</td>
					<td class="text-center" width="60%">Mata Pelajaran<br>(Kurikulum 2013)</td>
					<td class="text-center" width="20%">Nilai Ujian Sekolah</td>
				</tr>
				<tr>
					<td colspan="3">Muatan Nasional</td>
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
					<td>Bahasa Inggris dan Bahasa Asing Lainnya</td>
					<td class="text-center">'.$data['n_bing'].'</td>
				</tr>
				<tr>
					<td colspan="3">Muatan Kewilayahan</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Seni Budaya</td>
					<td class="text-center">'.$data['n_sen'].'</td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Pendidikan Jasmasni, Olah Raga dan Kesehatan</td>
					<td class="text-center">'.$data['n_penj'].'</td>
				</tr>				
				<tr>
					<td colspan="3">Muatan Peminatan Kejuruan</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Simulasi dan Komunikasi Digital</td>
					<td class="text-center">'.$data['n_simdig'].'</td>
				</tr>';
		if ($data['komli']=="TKJ")
		{
			$html.='

				<tr>
					<td class="text-center">2</td>
					<td>Fisika</td>
					<td class="text-center">'.$data['n_fis'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Kimia</td>
					<td class="text-center">'.$data['n_kim'].'</td>
				</tr>

			';
		}
		else
		{
			$html.='

				<tr>
					<td class="text-center">2</td>
					<td>Ekonomi Bisnis</td>
					<td class="text-center">'.$data['n_ekob'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Administrasi Umum</td>
					<td class="text-center">'.$data['n_admu'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>IPA</td>
					<td class="text-center">'.$data['n_ipa'].'</td>
				</tr>


			';
		}	
				$html.='
				<tr>
					<td class="text-center">4</td>
					<td>Dasar Program Keahlian</td>
					<td class="text-center">'.$data['n_c2'].'</td>
				</tr>
				<tr>
					<td class="text-center">5</td>
					<td>Kompetensi Keahlian</td>
					<td class="text-center">'.$data['n_c3'].'</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><strong>Rata-Rata</strong></td>
					<td class="text-center">'.$data['rata'].'</td>
				</tr>
			</table>

			<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify">
				<br/>
				Surat keterangan ini bersifat sementara sampai dikeluarkannya ijazah.
				<br><br>
				Demikian Surat Keterangan ini diberikan agar dapat digunakan sebagaimana mestinya, apabila dikemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau Surat Keterangan ini tidak berlaku.
			</div>
			<div>
				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td width="65%" colspan="2">
							<div class="box-foto">
								Foto 3 x 4
							</div>
						</td>
						<td width="35%" style="padding-left:30px;">
							<div>Jakarta, 3 Juni 2021</div>
							<div>Kepala Sekolah,</div>
							<div style="margin-top:70px;">
								<strong>
									<u>Endah Widyastuti, M.Pd</u><br>
									NIP.-
								</strong>
							</div>
						</td>
					</tr>
				</table>
			</div>';
	}
	else
	{
		$html = '

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
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
						font-size: 12px;
					}

					.box-foto
					{
						width:100px;
						height:120px;
						text-align: center;
						font-size:16px;
						border: dotted 3px black;
						margin-left: 270px;
						margin-top: 25px;
					}
				</style>
			</head>
			<body>

			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
					<tr>
						<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
						</td>
						<td align="center">
							<span class="kopsedang">YAYASAN PERGURUAN</span><br/>

							<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
							<span class="kopsedang">SEKOLAH MENENGAH KEJURUAN (SMK) YP IPPI PETOJO</span><br/>
							<span class="kopsedang">JAKARTA PUSAT</span><br/>
							<span class="kopbesar">AKREDITASI : "A"</span><br/>
							<span class="kopkecil">JL.Petojo Barat III No.2 Jakarta Pusat Telp.6318984, 6313055 - Fax.6313055</span><br/>
							<span class="kopkecil">E-mail : smkypippip@gmail.co.id</span><br/>
						</td>
					</tr>
			</table>
			<table class="fontnormal" border="0" width="100%">
					<tr>
						<td colspan="3">
							<hr style=border-width:2px; width:100%;>
						</td>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<strong>
									<span>SURAT KETERANGAN LULUS</span><br>
									<span>NOMOR: Nomor surat belum ada</span>
								</strong>
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									Yang bertandatangan di bawah ini Kepala SMK YP IPPI Petojo (NPSN : 20100288) Kota Administrasi Jakarta Pusat Provinsi DKI Jakarta dengan ini menerangkan bahwa :
								</div>
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td>'.$data['ttl'].'</td>
										</tr>										
										<tr>
											<td>Nomor Induk</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Program Keahlian</td>
											<td>:</td>
											<td>'.$proli.'</td>
										</tr>
										<tr>
											<td>Kompetensi Keahlian</td>
											<td>:</td>
											<td>'.$komli.'</td>
										</tr>
									</table>
								</div>
							</td>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan dinyatakan:
								</div>
								<div style="display:block; margin:1px 40px 0px 320px; font-weight:bolder; font-size:15;">LULUS</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil sebagai berikut  :</div>
							</td>
						</tr>
					</tr>
			</table>
			<table class="tablenilai" width="100%">
				<tr>
					<td class="text-center" width="10%">No</td>
					<td class="text-center" width="60%">Mata Pelajaran<br>(Kurikulum 2013)</td>
					<td class="text-center" width="20%">Nilai Ujian Sekolah</td>
				</tr>
				<tr>
					<td colspan="3">Muatan Nasional</td>
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
					<td>Matematika</td>
					<td class="text-center">'.$data['n_mtk'].'</td>
				</tr>
				<tr>
					<td class="text-center">5</td>
					<td>Sejarah Indonesia</td>
					<td class="text-center">'.$data['n_sej'].'</td>
				</tr>
				<tr>
					<td class="text-center">6</td>
					<td>Bahasa Inggris dan Bahasa Asing Lainnya</td>
					<td class="text-center">'.$data['n_bing'].'</td>
				</tr>
				<tr>
					<td colspan="3">Muatan Kewilayahan</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Seni Budaya</td>
					<td class="text-center">'.$data['n_sen'].'</td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Pendidikan Jasmasni, Olah Raga dan Kesehatan</td>
					<td class="text-center">'.$data['n_penj'].'</td>
				</tr>				
				<tr>
					<td colspan="3">Muatan Peminatan Kejuruan</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Simulasi dan Komunikasi Digital</td>
					<td class="text-center">'.$data['n_simdig'].'</td>
				</tr>';

		if ($data['komli']=="TKJ")
		{
			$html.='

				<tr>
					<td class="text-center">2</td>
					<td>Fisika</td>
					<td class="text-center">'.$data['n_fis'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Kimia</td>
					<td class="text-center">'.$data['n_kim'].'</td>
				</tr>

			';
		}
		else
		{
			$html.='

				<tr>
					<td class="text-center">2</td>
					<td>Ekonomi Bisnis</td>
					<td class="text-center">'.$data['n_ekob'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>Administrasi Umum</td>
					<td class="text-center">'.$data['n_admu'].'</td>
				</tr>
				<tr>
					<td class="text-center">3</td>
					<td>IPA</td>
					<td class="text-center">'.$data['n_ipa'].'</td>
				</tr>


			';
		}

			$html.='
				<tr>
					<td class="text-center">4</td>
					<td>Dasar Program Keahlian</td>
					<td class="text-center">'.$data['n_c2'].'</td>
				</tr>
				<tr>
					<td class="text-center">5</td>
					<td>Kompetensi Keahlian</td>
					<td class="text-center">'.$data['n_c3'].'</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><strong>Rata-Rata</strong></td>
					<td class="text-center">'.$data['rata'].'</td>
				</tr>
			</table>

			<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify">
				<br/>
				Surat Keterangan ini bersifat sementara dan berlaku sampai diterbitkannya ijazah untuk siswa yang bersangkutan.
				<br><br>
				Demikian Surat Keterangan ini diberikan agar dapat dipergunakan sebagaimana mestinya.
			</div>
			<div>
				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td width="65%" colspan="2">
							<div class="box-foto">
								Foto 3 x 4
							</div>
						</td>
						<td width="35%" style="padding-left:30px;">
							<div>Jakarta, 3 Juni 2021</div>
							<div>Kepala Sekolah,</div>
							<div style="margin-top:70px;">
								<strong>
									<u>Drs, Mukidjo Martoyo, M.Pd</u>
									NIP.-
								</strong>
							</div>
						</td>
					</tr>
				</table>
			</div>';
	}
}

elseif ($data['instansi']=="SMP")
{
	if ($data['cabang']=="CAKUNG")
	{
		$html = '

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
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

					.box-foto
					{
						width:100px;
						height:120px;
						text-align: center;
						font-size:16px;
						border: dotted 3px black;
						margin-left: 270px;
						margin-top: 25px;
					}
				</style>
			</head>
			<body>

			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
					<tr>
						<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
						</td>
						<td align="center" style="padding-right:35px;">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>	
								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">SEKOLAH MENENGAH PERTAMA (SMP)</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">YP IPPI CAKUNG JAKARTA TIMUR</span><br/>
									<span class="kopsedang" style="font-size:18px; font-weight:bolder;">TERAKREDITASI "A"</span><br/>
							</td>
						</td>
						</tr>
						<tr>
							<td colspan="2" style="border-top:1px solid black; border-bottom:4px double black; font-size:12px; text-align:center">
								Jl. Ujung Krawang/ Jl. Kober Ujung RT. 006 RW. 05, Kelurahan Pulo Gebang Kecamatan Cakung Kota Administrasi Jakarta Timur
							</td>
						</tr>
					</tr>
			</table>
			<table class="fontnormal" border="0" width="100%">
					<tr>
						<td colspan="3">
							
						</td>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN LULUS</span><br>
								<span>TAHUN PELAJARAN 2020/2021</span><br>
								<span>NOMOR: Nomor surat belum ada</span>
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Pertama (SMP) YP IPPI Cakung Menerangkan bahwa :
								</div>
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td>'.ucfirst($data['ttl']).'</td>
										</tr>										
										<tr>
											<td>Nomor Induk Siswa</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Nomor Peserta Ujian</td>
											<td>:</td>
											<td>'.$data['no_ujian'].'</td>
										</tr>
									</table>
								</div>
							</td>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan dinyatakan:
								</div>
								<div style="display:block; margin:1px 40px 0px 320px; font-weight:bolder; font-size:15;">'.$lulus.'</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil sebagai berikut  :</div>
							</td>
						</tr>
					</tr>
			</table>
			<table class="tablenilai" width="100%">
				<tr>
					<td class="text-center" width="10%">No</td>
					<td class="text-center" width="60%">Mata Pelajaran<br>(Kurikulum 2013)</td>
					<td class="text-center" width="20%">Nilai Akhir</td>
				</tr>
				<tr>
					<td colspan="3">Kelompok A</td>
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
					<td>Matematika</td>
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
					<td colspan="3">Kelompok B</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Seni Budaya</td>
					<td class="text-center">'.$data['n_sen'].'</td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Pendidikan Jasmasni, Olah Raga dan Kesehatan</td>
					<td class="text-center">'.$data['n_penj'].'</td>
				</tr>				
				<tr>
					<td class="text-center">3</td>
					<td>Prakarya</td>
					<td class="text-center">'.$data['n_pkwu'].'</td>
				</tr>
				<tr>
					<td colspan="3">Kelompok C</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>TIK</td>
					<td class="text-center">'.$data['n_tik'].'</td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Aqidah</td>
					<td class="text-center">'.$data['n_aqidah'].'</td>
				</tr>				
				<tr>
					<td class="text-center">3</td>
					<td>Bahasa Arab</td>
					<td class="text-center">'.$data['n_barab'].'</td>
				</tr>
				<tr>
					<td class="text-center">4</td>
					<td>Tahfidz</td>
					<td class="text-center">'.$data['n_tahfidz'].'</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><strong>Rata-Rata</strong></td>
					<td class="text-center">'.number_format($rataCakung,2).'</td>
				</tr>
			</table>

			<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify">
				<br/>
				Surat keterangan ini bersifat sementara sampai dikeluarkannya ijazah.
				<br><br>
				Demikian Surat Keterangan ini diberikan agar dapat digunakan sebagaimana mestinya, apabila dikemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau Surat Keterangan ini tidak berlaku.
			</div>
			<div>
				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td width="65%" colspan="2">
							<div class="box-foto">
								Foto 3 x 4
							</div>
						</td>
						<td width="35%" style="padding-left:30px;">
							<div>Jakarta, 3 Juni 2021</div>
							<div>Kepala SMP YP IPPI Cakung</div>
							<div style="margin-top:70px;">
								<strong>
									<u>Drs. Marsono</u>
								</strong>
							</div>
						</td>
					</tr>
				</table>
			</div>';
	}
	else
	{
		$html = '

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
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

					.box-foto
					{
						width:100px;
						height:120px;
						text-align: center;
						font-size:16px;
						border: dotted 3px black;
						margin-left: 270px;
						margin-top: 25px;
					}
				</style>
			</head>
			<body>

			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
					<tr>
						<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
						</td>
						<td align="center">
							<span class="kopsedang">YAYASAN PERGURUAN</span><br/>

							<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
							<span class="kopsedang">SEKOLAH MENENGAH PERTAMA (SMP) YP IPPI PETOJO</span><br/>
							<span class="kopsedang">JAKARTA PUSAT</span><br/>
							<span class="kopbesar">AKREDITASI : "A"</span><br/>
							<span class="kopkecil">JL.Petojo Barat III No.2 Jakarta Pusat Telp.6313055-63855458</span><br/>
							<span class="kopkecil">Fax.6313055 E-mail : smp.ypippi_1951@yahoo.co.id</span><br/>
						</td>
					</tr>
			</table>
			<table class="fontnormal" border="0" width="100%">
					<tr>
						<td colspan="3">
							<hr style=border-width:2px; width:100%;>
						</td>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN LULUS</span><br>
								<span>TAHUN PELAJARAN 2020/2021</span><br>
								<span>NOMOR: Nomor surat belum ada</span>
							</td>
						</tr>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Pertama (SMP) YP IPPI Petojo Menerangkan bahwa :
								</div>
								<div>
									<table border="0" class="lulus">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td>:</td>
											<td>'.ucfirst($data['ttl']).'</td>
										</tr>										
										<tr>
											<td>Nomor Induk Siswa</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Nomor Peserta Ujian</td>
											<td>:</td>
											<td>'.$data['no_ujian'].'</td>
										</tr>
									</table>
								</div>
							</td>
						<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">
									berdasarkan kriteria kelulusan peserta didik yang sudah ditetapkan, maka yang bersangkutan dinyatakan:
								</div>
								<div style="display:block; margin:1px 40px 0px 320px; font-weight:bolder; font-size:15;">LULUS</div>
								<div style="display:block; margin:5px 40px 0px 40px;">dengan hasil sebagai berikut  :</div>
							</td>
						</tr>
					</tr>
			</table>
			<table class="tablenilai" width="100%">
				<tr>
					<td class="text-center" width="10%">No</td>
					<td class="text-center" width="60%">Mata Pelajaran<br>(Kurikulum 2013)</td>
					<td class="text-center" width="20%">Nilai Akhir</td>
				</tr>
				<tr>
					<td colspan="3">Kelompok A</td>
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
					<td>Matematika</td>
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
					<td colspan="3">Kelompok B</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>Seni Budaya</td>
					<td class="text-center">'.$data['n_sen'].'</td>
				</tr>
				<tr>
					<td class="text-center">2</td>
					<td>Pendidikan Jasmasni, Olah Raga dan Kesehatan</td>
					<td class="text-center">'.$data['n_penj'].'</td>
				</tr>				
				<tr>
					<td class="text-center">3</td>
					<td>Prakarya</td>
					<td class="text-center">'.$data['n_pkwu'].'</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><strong>Rata-Rata</strong></td>
					<td class="text-center">'.$data['rata'].'</td>
				</tr>
			</table>

			<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify">
				<br/>
				Surat keterangan ini bersifat sementara sampai dikeluarkannya ijazah.
				<br><br>
				Demikian Surat Keterangan ini diberikan agar dapat digunakan sebagaimana mestinya, apabila dikemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau Surat Keterangan ini tidak berlaku.
			</div>
			<div>
				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td width="65%" colspan="2">
							<div class="box-foto">
								Foto 3 x 4
							</div>
						</td>
						<td width="35%" style="padding-left:30px;">
							<div>Jakarta, 4 Juni 2021</div>
							<div>Kepala SMP YP IPPI Petojo</div>
							<div style="margin-top:70px;">
								<strong>
									<u>Sutarno, S.Kom</u>
								</strong>
							</div>
						</td>
					</tr>
				</table>
			</div>';



	}
}


}


// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

// $dompdf->stream('SKL_'.$nisn.'.pdf');	
$dompdf->stream("skl2021-".$data['nisn'].".pdf", array("Attachment" => 0));
// exit(0);



 ?>