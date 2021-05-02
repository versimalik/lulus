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

	$noujian = $data['no_ujian'];
	$cabang= ($data['cabang']=="PETOJO") ? "Petojo" : "Cakung";
	$jakarta= ($data['cabang']=="PETOJO") ? "Jakarta Pusat" : "Jakarta Timur";
	$alamatippi = ($data['cabang']=="PETOJO") ? "Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055" : "Jl. P. Komarudin Ujung Krawang Kober Limo, Pulogebang, Cakung - Jakarta Timur";
	$emailsma = ($data['cabang']=="CAKUNG")?"smas.ypippickg@gmail.com":"smaypippi_1951@yahoo.com";

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
			<body>
				<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
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
				<div></div>
				<table class="fontnormal" border="0">
						<tr>
							<td colspan="3">
								<hr style="border-width:2px; width:100%;">
							</td>
						</tr>
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<span>SURAT KETERANGAN LULUS</span>
								<br>';
			$judulskl = ($data['instansi']=="SMA" ? ($data['komli']=="IPA" ? "PEMINATAN MATEMATIKA DAN ILMU PENGETAHUAN ALAM (MIPA)" : "PEMINATAN ILMU PENGETAHUAN SOSIAL (IPS)") : "LAIN");

			$html.=$judulskl;
			$html.='<br/><span>TAHUN PELAJARAN 2020/2021</span>';
			$html.='<br>Nomor:';

$html.='				
							</td>
						</tr>';
$skolah = ($data['cabang']=="CAKUNG")?"YP IPPI Cakung":"YP IPPI Petojo";
$html.='				<tr align="justify">
							<td colspan="3">
								<div style="margin:0px 40px 0px 40px;">';
		$html.='Yang bertanda tangan di bawah ini Kepala Sekolah Menengah Atas '.$skolah.', menerangkan dengan sesungguhnya bahwa :';					
$npsnsma = ($data['cabang']=="CAKUNG")?"20103501":"20100215";
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
	
		$sklsalin=($data['cabang']=="PETOJO")?'<div style="background-color:#3c763d; color:white; padding:10px;">Ini adalah tampilan salinan SKL. SKL asli akan dibagikan pada saat pembagian rapor.</div>':"";
		$html.='
						<div style="margin:0px 40px 0px 40px;" class="fontnormal" align="justify"><br/>
							Surat keterangan ini bersifat sementara sampai dikeluarkannya ijazah.
							<br><br>
							Demikian surat keterangan ini diberikan agar dapat digunakan sebagaimana mestinya, apabila di kemudian hari terdapat kekeliruan, maka akan dilakukan perbaikan atau Surat Keterangan ini tidak berlaku.
						</div>						
						<div>
							<table width="100%" border="-" class="ttd fontnormal">
								<tr>
									<td width="40%"></td>
									<td width="54%">'.$sklsalin.'</td>
									<td width="38%" style="padding-left:30px;">
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
// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

// $dompdf->stream('SKL_'.$nisn.'.pdf');	
$dompdf->stream("skl2021-".$data['nisn'].".pdf", array("Attachment" => 0));
// exit(0);



 ?>