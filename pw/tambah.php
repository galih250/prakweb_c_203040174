<?php


if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                    alert('Data Berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
    }
}
?>

<!-- Si areel -->
<?php
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "prakweb_2022_b_203040069_pw");
    return $conn;
}

// function upload
function upload()
{
    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    // ketika tidak ada gambar yang dipilih
    if ($error == 4) {
        // echo "<script>
        //       alert('pilih gambar terlebih dahulu');
        //       </script>";
        return 'akun.png';
    }
    // cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
          alert('yang anda pilih bukan gambar');
          </script>";
        return false;
    }

    // cek type file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
          alert('yang anda pilih bukan gambar');
          </script>";
        return false;
    }

    // cek ukuran file
    // maks 5 mb
    if ($ukuran_file > 5000000) {
        echo "<script>
          alert('ukuran terlalu besar');
          </script>";
        return false;
    }

    // lolos pengecekan
    // siap uploaad file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
    return $nama_file_baru;
}

// menambahkan fungsi tambah
function tambah($data)
{
    // ambil data dari tiap elemen dalam form
    $conn = koneksi();

    $nama = htmlspecialchars($data["nama"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $penulis = htmlspecialchars($data["penulis"]);
    // $poster = htmlspecialchars($data["poster"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO buku
                VALUES
                ('', '$nama', '$gambar', '$penulis')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// cek apakah tombol sudah ditekan atau belum
if (isset($_POST["tambah"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan')
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan')
        document.location.href = 'index.php';
    </script>
";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepatu</title>
    <link rel="stylesheet" href="../pw2021_203040008/latihan4b/css/style.css">
    <style>
        section {
            min-height: 420px;
        }

        h1 {
            text-align: center;
        }

        ul,
        li {
            text-align: center;
        }

        span {
            font-family: arial;
            border: 1px solid black;
            padding: 5px;
            background-color: blue;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Form Tambah Data Produk</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="judul">judul :</label><br>
                <input type="text" name="judul" id="judul" required><br><br>
            </li>
            <li>
                <label for="penulis">Penulis :</label><br>
                <input type="text" name="penulis" id="penulis" required><br><br>
            </li>
            <li>
                <label for="tahun_terbit">tahun Terbit :</label><br>
                <input type="text" name="tahun_terbit" id="tahun_terbit" required><br><br>
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <input type="text" name="gambar" id="gambar" required><br><br>
            </li>
            <br>
            <button type="submit" name="tambah">Tambah Data!</button>
            <button type="submit">
                <a href="index.php" style="text-decoration: none; color: black;">Kembali</a>
            </button>
        </ul>
    </form>

</body>

</html>