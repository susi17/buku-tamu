<?php
	session_start();
	include"../include/koneksi.php";
	if(empty ($_SESSION['namauser']) )
	{
		exit("<script> window.alert('Anda Harus Login Terlebih Dahulu');
				window.location='index.php';</script>");
	}
	session_destroy();
	exit("<script>window.alert('Thank you');
		window.location='index.php';</script>");
		?>