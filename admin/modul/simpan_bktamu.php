<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Simpan Data Buku Tamu</title>
	</head>
	<body>
		<?php
		$nama=$_POST["nama"];
		$email=$_POST["email"];
		$komentar=$_POST["komentar"];
		?>
	<h1>Proses simpan buku tamu</h1>
	<hr> 
	Nama Anda	: <?php echo $nama; ?>
	<br>
	Email address : <?php echo $email; ?>
	<br>
	komentar    : <textarea name="komentar" cols="40" rows="5"></textarea>
	<?php
	//proses simpan
	$fp=fopen("bukutamu.dat","a+");
	fputs($koneksi, $fp,$nama."|".$email."|".$komentar."\n");
	fclose($fp);
	?>
	<p>Simpan telah berhasil dilakukan!</p>

	</body>
	</html>

