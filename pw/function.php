<?php
// fungsi untuk melakukan koneksi ke database
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, 'prakweb_c_203040174_pw');

    return $conn;
}

// function untuk melakukan query dan memasukannya kedalam array
function query($sql)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "$sql");
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

    $nama = htmlspecialchars($data['nama']);
    $gambar = htmlspecialchars($data['gambar']);
    $penulis = htmlspecialchars($data['penulis']);

    $query = "INSERT INTO buku VALUES
                ('', '$nama', '$gambar', '$penulis')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// function untuk menghapus data produk
function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE * FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// function untuk mengubah data produk
function ubah($data)
{
    $conn = koneksi();
    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $query = "UPDATE buku
                SET 
                nama = '$nama',
                gambar = '$gambar',
                penulis = '$penulis'
                WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
