<?php
include "../include/koneksi.php";
include "../include/konversi_tgl.php";

//bagian home admin
if ($_GET['module']=='home') {
	echo "<h2>Halaman Utama</h2>
	<p class=welcome>Selamat Datang <b> $_SESSION[namauser]</b>, Silahkan klik menu pilihan disebelah kiri untuk mengelola konten website<br>Terimakasih</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p class=jam align=right>Login Hari ini: ";
	echo date("d/m/y");
	echo " | ";
	echo date ("H:i:s");
	echo "</p>";
}

//bagian user
else if ($_GET['module']=='user'){
	include 'modul/user.php';
}

//bagian galeri
else if ($_GET['module']=='galeri'){
	include 'modul/galeri.php';
}

//bagian buku tamu
else if ($_GET['module']=='bukutamu'){
	include 'modul/bukutamu.php';
}
else if ($_GET['module']=='showbuku'){
	include 'modul/showbuku.php';
}
//Apabila modul tidak ditemukan
else{
	echo "<p><b>Modul Belum Ada</b></p>";
}
?>



