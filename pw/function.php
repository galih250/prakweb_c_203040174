<?php
// fungsi untuk melakukan koneksi ke database
function koneksi()
{
    
        return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040174_pw');
    
}

// function untuk melakukan query dan memasukannya kedalam array
function query($query)
{
	$conn = koneksi();

	$result = mysqli_query($conn, $query);

	// Jika hasilnya hanya 1 data
	if (mysqli_num_rows($result) == 1) {
		return mysqli_fetch_assoc($result);
	}

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

// function untuk menambah data produk
function tambah($data)
{
	$conn = koneksi();

	$nama_buku = htmlspecialchars($data['nama_buku']);
	$nama_pengarang = htmlspecialchars($data['nama_pengarang']);
	$jumlah_lembar = htmlspecialchars($data['jumlah_lembar']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$gambar_buku = htmlspecialchars($data['gambar_buku']);
	$query = "INSERT INTO
	            buku
	            VALUES
	          (null, '$nama_buku', '$nama_pengarang', '$jumlah_lembar', '$penerbit', '$gambar_buku');
	          ";
	mysqli_query($conn, $query);
	
	return mysqli_affected_rows($conn);
}

// function untuk menghapus data produk
function hapus($id)
{
	$conn = koneksi();
	mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_query($conn));
	return mysqli_affected_rows($conn);
}

// function untuk mengubah data produk
function ubah($data)
{
	$conn = koneksi();

	$id = ($data['id']);
	$nama_buku = htmlspecialchars($data['nama_buku']);
	$nama_pengarang = htmlspecialchars($data['nama_pengarang']);
	$jumlah_lembar = htmlspecialchars($data['jumlah_lembar']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$gambar_buku = htmlspecialchars($data['gambar_buku']);
	
	$query = "UPDATE buku SET
				nama_buku = '$nama_buku',
				nama_pengarang= '$nama_pengarang',
				jumlah_lembar = '$jumlah_lembar',
				penerbit = '$penerbit',
				gambar_buku = '$gambar_buku'
				WHERE id = $id";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM buku
              WHERE 
            nama_buku LIKE '%$keyword%' OR
            nama_pengarang LIKE '%$keyword%'
            ";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
?>
