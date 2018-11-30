<?php 
switch(@$_GET['act']){
//tampil galeri 
default:
echo "<h2>Galeri</h2>
<form method=post action='?module=galeri&act=tambahgaleri'>
<input type=submit value='Tambah Galeri'>
</form>
<table border=1>
<tr>
<th>No</th>
<th>Nama Galeri</th>
<th>Tgl</th>
<th>Galeri</th>
<th>Aksi</th>
</tr>";
$tampil=mysqli_query($koneksi, "select * from galeri order by id_galeri");
$no=1;
while ($r=mysqli_fetch_array($tampil))
{
echo "<tr><td>$no</td>
<td>$r[nm_galeri]</td>
<td>$r[tgl_galeri]</td>
<td><img src='galeri/$r[gambar]' width='50'></td>
<td><a href=?module=galeri&act=editgaleri&id=$r[id_galeri]>Edit</a> |
<a href=\"aksi.php?module=galeri&act=hapus&id=$r[id_galeri]\" onClick=\"return confirm('apakah anda benar akan menghapus galeri $r[id_galeri]?')\">Hapus</a>
</td></tr>";
$no++;
}
echo "</table>"; 
break;

//tambah galeri
case "tambahgaleri":
echo "<h2>Tambah galeri</h2>
<form name='form1' method='post' action='aksi.php?module=galeri&act=input' enctype='multipart/form-data'>
<table>
<tr><td>Nama Galeri</td>
 
<td> : <input name='nm_gal' type='text' size='35' /></td></tr>
<tr><td>Keterangan</td>
<td> : <textarea name='ket' cols='35' rows='4'></textarea>
</td></tr>
<tr><td>File Gambar</td>
<td> : <input name='gam' type='file' size='30' /></td></tr>
<tr><td colspan=2><input type=submit value=Simpan>
<input type=button value=Batal onclick=self.history.back()>
</td></tr>
</table> </form>"; 
break;

//edit galeri
case "editgaleri":
$edit=mysqli_query($koneksi, "select * from galeri where id_galeri='$_GET[id]'");
$r=mysqli_fetch_array($edit); 
?><h2>Edit galeri</h2>

<form name='form1' method='post' action='aksi.php?module=galeri&act=update' enctype='multipart/form-data'>
	<input type=hidden name=id value='<?=$r['id_galeri']?>'>
	<table>
		<tr>
			<td>Nama Galeri</td>
			<td> : <input name='nm_gal' type='text' size='35' value='<?=$r['nm_galeri']?>'></td>
		</tr>
		<!-- <tr>
			<td>Keterangan</td>
			<td> : <textarea name='ket' cols='35' rows='4'><?=$r['ket']?></textarea></td>
		</tr> -->
		<tr>
			<td>File Gambar</td>
			<td> : <img src='galeri/<?=$r['gambar']?>' width='50'><br>
				<input name='gam_baru' type='file' size='30' />
			</td>
		</tr>
			<tr>
			<td colspan=2><input type=submit value=Update>
				<input type=button value=Batal onclick=self.history.back()>
			</td>
		</tr>
	</table>
</form> 

<?php
break;
}
?>
