<?php 
include "database.php";
$nopes = str_replace("-", "_",$_POST['nopes']);

require_once("dompdf/dompdf_config.inc.php");

			$no_ujian = $nopes;
			
			$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$no_ujian'");
			$data = mysqli_fetch_array($hasil);

$html = 

'<table class="table table-bordered">
				<thead>
				<tr>
					<th>Matan Pelajaran</th>
					<th>Nilai</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>Pendidikan Agama Islam</td>
						<td>'.$data['n_pai'].'</td>
					</tr>
					<tr>
						<td>Pendidikan Kewarganegaraan</td>
						<td>'.$data['n_pkn'].'</td>
					</tr>
					<tr>
						<td>Bahasa Indonesia</td>
						<td>'.$data['n_bindo'].'</td>
					</tr>
					<tr>
						<td>Matematika</td>
						<td>'.$data['n_mtk'].'</td>
					</tr>
					<tr>
						<td>Sejarah Indonesia</td>
						<td>'.$data['n_sejin'].'</td>
					</tr>
					<tr>
						<td>Bahasa Inggris</td>
						<td>'.$data['n_bing'].'</td>
					</tr>
					<tr>
						<td>Seni Budaya</td>
						<td>'.$data['n_sen'].'</td>
					</tr>
					<tr>
						<td>PKWU</td>
						<td>'.$data['n_pkwu'].'</td>
					</tr>
					<tr>
						<td>Pendidikan Jasmani dan Kesehatan</td>
						<td>'.$data['n_penj'].'</td>
					</tr>
					<tr>
						<td>Matematika Peminatan</td>
						<td>'.$data['n_mtkp'].'</td>
					</tr>
					<tr>
						<td>Biologi</td>
						<td>'.$data['n_bio'].'</td>
					</tr>
					<tr>
						<td>Fisika</td>
						<td>'.$data['n_fis'].'</td>
					</tr>
					<tr>
						<td>Kimia</td>
						<td>'.$data['n_kim'].'</td>
					</tr>
					<tr>
						<td>Bahasa Arab</td>
						<td>'.$data['n_barab'].'</td>
					</tr>

				</tbody>
			</table>';
var_dump($html);
die();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('laporan_'.$nopes.'.pdf');

 ?>