<?php
function koneksi() {
    // Koneksi ke MySQL & memilih DB
    $connect = mysqli_connect('localhost', 'root', '3zcOIk@fB8wCwkG@Ok^J', 'pw') or die('Koneksi ke Database Gagal!');

    return $connect;
}

function query($query) {
    $connect = koneksi();
    // query untuk mengambil seluruh isi dari tabel buku
    $result = mysqli_query($connect, $query) or die('Query Gagal!' . mysqli_error($connect));

    // looping untuk mengambil setiap data buku satu persatu
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    }

    return $rows;
}

// Function Tambah
function tambah($data) {

    $connect = koneksi();

    // sanitasi data
    $judul = mysqli_real_escape_string($connect, htmlspecialchars($data["judul"]));
    $penulis = mysqli_real_escape_string($connect, htmlspecialchars($data["penulis"]));
    $penerbit = mysqli_real_escape_string($connect, htmlspecialchars($data["penerbit"]));
    $kategori = mysqli_real_escape_string($connect, htmlspecialchars($data["kategori"]));
    // $gambar = mysqli_real_escape_string($connect, htmlspecialchars($data["gambar"]));

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // siapkan query insert data
    $query = "INSERT INTO buku
                VALUES (null, '$judul', '$penulis', '$penerbit', '$kategori', '$gambar')";
    
    // insert data ke tabel buku
    mysqli_query($connect, $query) or die('Query Gagal!' . mysqli_error($connect));
    
    // kembalikan nilai keberhasilan
    return mysqli_affected_rows($connect);
}

// Function Hapus
function hapus($id) {
    $connect = koneksi();

    // hapus file gambar jika bukan default.jpg
    $buku = query("SELECT * FROM buku WHERE id = '$id'")[0];
    if ($buku['gambar'] !== 'default.jpg') {
        unlink('img/' . $buku['gambar']);
    }
    mysqli_query($connect, "DELETE FROM buku WHERE id = '$id'") or die('Query Gagal!' . mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

// Function Ubah
function ubah($data) {
    $connect = koneksi();

    // sanitasi data
    $id = $data['id'];
    $judul = mysqli_real_escape_string($connect, htmlspecialchars($data["judul"]));
    $penulis = mysqli_real_escape_string($connect, htmlspecialchars($data["penulis"]));
    $penerbit = mysqli_real_escape_string($connect, htmlspecialchars($data["penerbit"]));
    $kategori = mysqli_real_escape_string($connect, htmlspecialchars($data["kategori"]));
    $gambarLama = mysqli_real_escape_string($connect, htmlspecialchars($data["gambarLama"]));

    // upload gambar
    $gambar = upload();
    // jika tidak ada gambar baru yang di upload
    if ($gambar === 'default.jpg') {
        $gambar = $gambarLama;
    } else {
        // hapus gambar lama
        // cek jika covernya default
        if ($gambarLama !== 'default.jpg') {
            unlink('../img/' . $gambarLama); 
        }
    }

    // siapkan query insert data
    $query ="UPDATE buku
                SET
                judul = '$judul',
                penulis = '$penulis',
                penerbit = '$penerbit',
                kategori = '$kategori',
                gambar = '$gambar'
                WHERE id = $id
            ";
    
    // update data dari tabel buku
    mysqli_query($connect, $query) or die('Query Gagal!' . mysqli_error($connect));
    
    // kembalikan nilai keberhasilan
    return mysqli_affected_rows($connect);
}

// Upload Gambar
function upload() {
    // Ambil data gambar
    $namaFile = $_FILES['gambar']['name'];
    $tipeFile = $_FILES['gambar']['type'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

    // Cek apakah ada gambar yang di upload
    if ($error === 4) {
        return 'default.jpg';
    }

    // Cek apakah file yang di upload oleh user adalah gambar
    $tipeGambarValid = ['image/jpg','image/jpeg', 'image/png'];
    if(!in_array($tipeFile, $tipeGambarValid)) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar');
                document.location.href = 'index.php';
            </script>";
        
        return false;
    }

    // Cek ukuran file, max 1MB
    if($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar');
                document.location.href = 'index.php';
            </script>";
        
        return false;
    }

    // Lolos pengecekan, gambar siap diupload
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    // Upload gambar
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
?>