<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		/*html { margin: 0px}*/
		.img
		{
			width: 120px;
		}

		#pagemargin
		{
			border: 1px red;
		}
	</style>
</head>
<body>
	
	<img src="img/kopsmp.jpg" class="img">
	<table>
	<tr>
		<td>Nama</td>
		<td><?php $data['nama'] ?></td>
	</tr>
	<tr>
		<td>Nomor Peserta</td>
		<td><?php $nopes ?></td>
	</tr>
	<tr>
		<td>Jurusan</td>
		<td><?php $data['komli'] ?></td>
	</tr>
</table>
</body>
</html>
