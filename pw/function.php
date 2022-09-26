<?php
// koneksi ke database
function koneksi()
{
    return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040174_pw');
}

function query($query)
{
    $conn = koneksi();

    $result = mysqli_query($conn, $query);

    // jika hasilnya hanya 1 data
    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{

    $conn = koneksi();

    $nama = htmlspecialchars($data['nama']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $halaman = htmlspecialchars($data['halaman']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "INSERT INTO
                buku
            VALUES
            (null, '$nama', '$penulis', '$penerbit', '$halaman', '$gambar');
            ";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}


function ubah($data)
{
    $conn = koneksi();

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $halaman = htmlspecialchars($data['halaman']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "UPDATE buku SET
              nama = '$nama',
              penulis = '$penulis',
              penerbit = '$penerbit',
              halaman = '$halaman',
              gambar = '$gambar',
            WHERE id = $id";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}


function cari($keyword)
{

    $conn = koneksi();

    $query = "SELECT * FROM buku
    WHERE 
    nama LIKE '%$keyword%' OR
    penulis LIKE '%$keyword%' OR
    penerbit LIKE '%$keyword%' OR
    halaman LIKE '%$keyword%' OR
    gambar LIKE '%$keyword%'
    ";


    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}