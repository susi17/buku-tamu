<?php
include "../include/koneksi.php";
ini_set('date.timezone', 'Asia/Jakarta'); 
$module=$_GET['module'];
$act=$_GET['act'];
//delete data dalam database
if ($module=='user' AND $act=='hapus') {
	mysqli_query($koneksi,"delete from admin where
		id_user='$_GET[id]'");
	header('location:server.php?module=user');
}
//bagian user
//input user
elseif ($module=='user' and $act=='input'){
	$id_login=$_POST[id_user];
	$id=mysqli_query($koneksi,"select * from admin where id_user='$id_login'
		");
	$r=mysqli_fetch_array($id);
	$cek=$r[id_user];
	if($id_login = $cek) {
		print "<script>alert(\"user dengan nama $id_login sudah
		terdaftar, Silahkan Cek Kembali!!!\");
		location.href = \"server.php?module=user&act=tambahuser\";
	</script>";
}
elseif(empty($_POST[id_user])){
	print "<script>alert(\"username tidak boleh kosong!!!\");
	location.href = \"javascript:history.go(-1)\";</script>";
}
elseif(empty($_POST[password])){
	print "<script>alert(\"password tidak boleh kosong!!!\");
	location.href = \"javascript:history.go(-1)\";</script>";
}
else{
	$pass=$_POST[password];
	mysqli_query($koneksi,"insert into
		admin(id_user,password)values('$_POST[id_user]','$pass')");
	header('location:server.php?module='.$module);
}
}
//update user
elseif ($module=='user' and $act=='update') {
	if(empty($_POST[id_user])){
		print "<script>alert(\"username tidak boleh kosong!!!\");
		location.href = \"javascript:history.go(-1)\";</script>";
	}
	else{
//apabila password tidak dirubah
		if (empty($_POST[password])) {
			mysqli_query($koneksi,"update admin set id_user='$_POST[id_user]'
				where id_user='$_POST[id]'");
		}
//apabila password dirubah
		else{
			$pass=$_POST[password];
			mysqli_query($koneksi,"update admin set id_user='$_POST[id_user]',
				password='$pass' where id_user='$_POST[id]'");
		}
		header('location:server.php?module='.$module);
	}
}


//ganti password
elseif ($module=='user' and $act=='gantipwd') {
	$set = true;
	$msg = "";
	$id=$_POST['id'];
	$lama=$_POST['pwd_lama1'];
	$lama2=$_POST['pwd_lama2'];
	$baru=$_POST['pwd_baru1'];
	$baru2=$_POST['pwd_baru2'];
	$baru_banget=$baru;
	if ($lama == $lama2) {
		if ($baru == $baru2) {
			if ($set) {
				mysqli_query($koneksi,"UPDATE admin SET password='$baru_banget' WHERE id_user='$id'");
				$msg=$msg.'Ganti password Sukses... ';
				print"<meta http_equiv=\"refresh\"content\"1;URL=server.php?module=home\">";
			}
		}
		else {
			$set=false;
			$msg.'password baru tidak sama..!!';

		}
			}
			else {
			$set=false;
			$msg.'password lama tidak sama..!!';	
			}
			echo "$msg";
			print"<br><br><a href =\"javascript:history.go(-1)\"> Back</a>";
 	}
 
//galeri user
elseif ($module=='galeri' and $act=='input')
{
$set = true;
$msg = "";
//tentukan variabel file yg diupload dan tipe file
$tipe_file	= $_FILES['gam']['type'];
$lokasi_file = $_FILES['gam']['tmp_name'];
$nama_file	= $_FILES['gam']['name'];
$save_file =move_uploaded_file($lokasi_file,"galeri/$nama_file");

if(empty($lokasi_file))
{ 
$set=false;
$msg= $msg. 'Upload gagal, Anda Lupa Mengambil Gambar..';
}
else
{
//tentukan tipe file harus image 
if ($tipe_file != "image/gif" and
$tipe_file != "image/jpeg" and
$tipe_file != "image/jpg" and
$tipe_file != "image/pjpeg" and
$tipe_file != "image/png")
{

$set=false;
$msg= $msg. 'Upload gagal, tipe file harus image..';
}
else
{
isset($save_file);
}
//replace di server 
if($save_file)
{
chmod("galeri/$nama_file", 0777);
}
else
{
$msg = $msg.'Upload Image gagal..';
$set =	false;
}
}
if($set)
{
$nm_galeri=$_POST['nm_galeri'];
$ket=$_POST['ket'];
$tgl=date("d/m/Y");
$sql=mysqli_query($koneksi, "insert into galeri(id_galeri,nm_galeri,tgl_galeri,gambar)values(NULL,'$nm_galeri','$tgl','$nama_file')");
$msg= $msg.'Upload Galeri Sukses..';
 
print "<meta http-equiv=\"refresh\" content=\"1;URL=server.php?module=galeri\">";
}
echo "$msg";
}

//Update galeri
elseif ($module=='galeri' and $act=='update')
{
$set = true;
$msg = "";

//tentukan variabel file yg diupload dan tipe file
$tipe_file	= $_FILES['gam_baru']['type'];
$lokasi_file = $_FILES['gam_baru']['tmp_name'];
$nama_file	= $_FILES['gam_baru']['name'];
$save_file =move_uploaded_file($lokasi_file,"galeri/$nama_file");

if(empty($lokasi_file))
{
isset($set);
}
else
{
//tentukan tipe file harus image 
if ($tipe_file != "image/gif" and
$tipe_file != "image/jpeg" and
$tipe_file != "image/jpg" and
$tipe_file != "image/pjpeg" and
$tipe_file != "image/png")
{
$set=false;
$msg= $msg. 'Upload gagal, tipe file harus image..';
}
else
{
$unlink=mysqli_query($koneksi, "select * from galeri where id_galeri='$_POST[id]'");
$CekLink=mysqli_fetch_array($unlink); 
if(!empty($CekLink[gambar]))
{
unlink("galeri/$CekLink[gambar]");
}
isset($save_file);
}
//replace di server 
if($save_file)
{
chmod("galeri/$nama_file", 0777);
}
else
 
 
{
$msg = $msg.'Upload Image gagal..';
$set =	false;
}
}
if($set)
{
$id=$_POST['id'];
$nm_galeri=$_POST['nm_gal'];

if(empty($lokasi_file))
{
mysqli_query($koneksi, "update galeri set nm_galeri='$nm_galeri'
where id_galeri='$id'");
}else{
mysqli_query($koneksi, "update galeri set nm_galeri='$nm_galeri', gambar='$nama_file'
where id_galeri='$id'");

}
$msg= $msg.'Update Galeri Sukses..'; 
print "<meta http-equiv=\"refresh\"
content=\"1;URL=server.php?module=galeri\">";
}
echo "$msg";
}

//hapus record Galeri
elseif ($module=='galeri' and $act=='hapus')
{
$unlink=mysqli_query($koneksi, "select * from galeri where id_galeri='$_GET[id]'");
$CekLink=mysqli_fetch_array($unlink); 
if(!empty($CekLink[gambar]))
{
unlink("galeri/$CekLink[gambar]");
}
mysqli_query($koneksi, "delete from galeri where id_galeri='$_GET[id]'"); 
header('location:server.php?module='.$module);
}
?> 