<?php  
require 'function.php';

// query isi tabel
$buku = query("SELECT * FROM buku");

//ketika tombol cari di klik
if (isset($_POST['cari'])) {
	$buku = cari($_POST['keyword']);
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Novel</title>
	<link rel="stylesheet" href="style.css">
</head> 
<body>
	<h3>Daftar Novel</h3>

	<a href="tambah.php">Tambah Data buku</a>
  	<br><br>

  	<form action="" method="post">
  		<input type="text" name="keyword" size="30" placeholder="masukkan keyword pencarian..." autocomplete="off" autofocus>
  		<button type="submit" name="cari">Cari!</button>
  	</form>
  	<br>

	<table border="1" cellpadding="10" cellspacing="0s">
		<tr>
			<th>Id</th>
			<th>Nama Buku</th>
			<th>Pengarang</th>
			<th>Jumlah Halaman</th>
            <th>Penerbit</th>
            <th>Gambar</th>
			<th>Opsi</th>
		</tr>

		<?php if(empty($buku)) : ?>
		<tr>
			<td colspan="4">
				<p style="color: red; font-style: italic;">data buku tidak ditemukan!</p>
			</td>
		</tr>
		<?php endif; ?>

		<?php $i = 1; 
		foreach($buku as $b) : ?>
		<tr>
			<td><?= $i++; ?></td>
			<td><?= $b['nama_buku']; ?></td>
            <td><?= $b['nama_pengarang']; ?></td>
            <td><?= $b['jumlah_lembar']; ?></td>
            <td><?= $b['penerbit']; ?></td>
            <td><img src="img/<?= $b['gambar_buku']; ?>" width ="90"></td>
			<td>
				<a href="ubah.php?id=<?= $b['id']; ?>">ubah</a>
				<a href="hapus.php?id=<?= $b['id']; ?>">hapus</a>
			</td>   
		</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>