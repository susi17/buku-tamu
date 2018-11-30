<?php
.
.
.
//Script tambahan di ketik di paling bawah
//BAGIAN GALERI
//upload photo
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
//tentukan tipe file harus image if ($tipe_file != "image/gif" and
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
//replace di server if($save_file)
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
$nm_galeri=$_POST[nm_gal];
$ket=$_POST[ket];
$tgl=date('d n Y');
$sql=mysqli_query($koneksi, "insert into galeri(nm_galeri,ket,tgl_galeri,gambar)values('$nm_galeri','$ket'
,'$tgl','$nama_file')");
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
//tentukan tipe file harus image if ($tipe_file != "image/gif" and
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
$CekLink=mysqli_fetch_array($unlink); if(!empty($CekLink[gambar]))
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
$id=$_POST[id];
$nm_galeri=$_POST[nm_gal];
$ket=$_POST[ket];

if(empty($lokasi_file))
{
mysqli_query($koneksi, "update galeri set nm_galeri='$nm_galeri',
ket='$ket'
where id_galeri='$id'");
}else{
mysqli_query($koneksi, "update galeri set nm_galeri='$nm_galeri',
ket='$ket', gambar='$nama_file'
where id_galeri='$id'");
}
$msg= $msg.'Update Galeri Sukses..'; print "<meta http-equiv=\"refresh\"
content=\"1;URL=server.php?module=galeri\">";
}
echo "$msg";
}

//hapus record Galeri
elseif ($module=='galeri' and $act=='hapus')
{
$unlink=mysqli_query($koneksi, "select * from galeri where id_galeri='$_GET[id]'");
$CekLink=mysqli_fetch_array($unlink); if(!empty($CekLink[gambar]))
{
unlink("galeri/$CekLink[gambar]");
}
mysqli_query($koneksi, "delete from galeri where id_galeri='$_GET[id]'"); header('location:server.php?module='.$module);
}
?>
