<?php
session_start();
if(isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
include "../database.php";
include '_header.php';
?>

<div class="container">
	<h2>Daftar Siswa yang belum bisa download SKL</h2><hr>
	<div class="row col-sm-8">
		<!--<form class="form-horizontal well" method="post" action="data_upload.php" enctype="multipart/form-data">-->
		<!--	<div class="form-group">-->
		<!--		<label for="importCsv" class="col-sm-3 control-label">CSV/Excel File</label>-->
		<!--		<div class="col-sm-9">-->
		<!--			<div class="fileinput fileinput-new input-group" data-provides="fileinput">-->
		<!--				<div class="form-control" data-trigger="fileinput">-->
		<!--					<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>-->
		<!--				</div>-->
		<!--				<span class="input-group-addon btn btn-default btn-file">-->
		<!--					<span class="fileinput-new">Pilih file</span>-->
		<!--					<span class="fileinput-exists">Ganti</span>-->
		<!--					<input type="file" name="file">-->
		<!--				</span>-->
		<!--				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Buang</a>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--	<div class="form-group">-->
		<!--		<div class="col-sm-offset-3 col-sm-9">-->
		<!--			<button type="submit" name="submit" class="btn btn-default">Upload</button>-->
		<!--		</div>-->
		<!--	</div>-->
		<!--</form>-->
	</div>
</div>
<div class="row">
	<div class="container table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No. Ujian</th>
					<th>NISN</th>
					<th>Nama Siswa</th>
					<th>Unit - Kompetensi Keahlian</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
    			$qsiswa = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE skl =0");
    			
    			if(mysqli_num_rows($qsiswa) > 0){
    				while($data = mysqli_fetch_array($qsiswa)){
    					echo '<tr>';
    					echo '<td>'.$data['no_ujian'].'</td>';
    					echo '<td>'.$data['nisn'].'</td>';
    					echo '<td>'.$data['nama'].'</td>';
    					echo '<td>'.strtoupper($data['instansi']).($data['komli']='' ? '':' - '.$data['komli']).'</td>';
    					echo '<td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target=#modal-'.$data['nisn'].'>Buka SKL</button>'.'</td>';
    					echo '</tr>';
    					echo '
    					        <div class="modal fade" id=modal-'.$data['nisn'].' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                            Buka SKL untuk <strong>'.strtoupper($data['nama']).' - '.$data['nisn'].' - '.strtoupper($data['instansi']).'?</strong>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <a href=bukaskl.php?id='.$data['nisn'].' type="button" class="btn btn-primary">Buka SKL</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
    					';
    				}
    			} else {
    				echo '<tr><td colspan="19"><em>Belum ada data! Segera lakukan upload data.</em></td></tr>';
    			}
			?>
			</tbody>
		</table>
	</div>
</div>
<?php
include '_footer.php';
} else {
	header('Location: ./login.php');
}
?>