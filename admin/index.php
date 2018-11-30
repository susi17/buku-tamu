<html>
<head>
	<title>.:: Halaman Login Administrator::.</title>
	<link href="../include?style_admin.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header"><center>Form Login Adminstritaor</center></div>
	<form name="form1" method="post" action="cek_login.php">
		<table align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="30" align="center">Username</td>
				<td width="154" valign="middle"> : <input name="id_user" type="text" id="id_user"></td>
			</tr>
			<tr>
				<td align="center">Password</td>
				<td> : <input name="password" type="password" id="password"></td>
			</tr>
			<tr>
			<td colspan="3"><input type="submit" name="submit" value="Login"></td>
			</tr>
		</table>
	</form>
</body>
</html>