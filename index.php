<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MYSQL PHP</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<?php
// koneksi
include 'koneksi.php';

// Data Info
$nim = "";
$nama = "";
$prodi = "";
$alamat = "";
$nohp = "";
$berhasil   = "";
$error      = "";
$errorInput = "";

// getdata Onclik
if (isset($_GET['xx'])) {
    $xx = $_GET['xx'];
} else {
    $xx = "";
}

// Ubah
if ($xx == 'ubah') {
    $nim    = $_GET['nim'];
    $query  = "select * from mhs where nim = '$nim'";
    $edit   = mysqli_query($koneksi, $query);
    $editTampil = mysqli_fetch_array($edit);
    $nim = $editTampil['nim'];
    $nama = $editTampil['nama_mhs'];
    $prodi = $editTampil['prodi'];
    $alamat = $editTampil['alamat'];
    $nohp = $editTampil['no_hp'];
    if ($nim == "") {
        $error = "Data Tidak Ada";
    }
}

// Hapus
if ($xx == 'hapus') {
    $nim    = $_GET['nim'];
    $query  = "delete from mhs where nim = '$nim'";
    $hapus   = mysqli_query($koneksi, $query);
    if ($hapus) {
        $error = "Data Berhasil Dihapus";
        $nim = "";
    } else {
        $error = "Data Gagal Dihapus";
    }
}

// Simpan
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];

    if ($xx == 'ubah') {
        $query = "update mhs set nama_mhs='$nama', prodi='$prodi', alamat='$alamat', no_hp='$nohp' where nim='$nim'";
        $edit = mysqli_query($koneksi, $query);
        if ($edit) {
            $nim = "";
            $nama = "";
            $prodi = "";
            $alamat = "";
            $nohp = "";
            $berhasil = "Edit Berhasil";
        } else {
            $errorInput = "Gagal Update";
        }
    } else {
        if ($nim && $nama && $prodi && $alamat && $nohp) {
            $query  = "insert into mhs values ('$nim','$nama','$prodi','$alamat','$nohp')";
            $simpan = mysqli_query($koneksi, $query);
            if ($simpan) {
                $nim = "";
                $nama = "";
                $prodi = "";
                $alamat = "";
                $nohp = "";
                $berhasil = "Simpan Berhasil";
            } else {
                $errorInput = "Gagal Simpan";
            }
        }
    }
}


?>

<body>
    <div class="container">
        <div class="container-2">

            <div class="form-input-data">
                <h2 class="form-title-data bg_hijau">Form Create / Edit</h2>
                <div class="form-data">
                    <?php
                    if ($errorInput) {
                    ?>
                        <div class="error-save bg_merah">
                            <?php echo $errorInput ?>
                        </div>
                    <?php } ?>
                    <form action="" method="POST">
                        <div class="form-input">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" id="nim" value="<?php echo $nim ?>" />
                        </div>
                        <div class="form-input">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" value="<?php echo $nama ?>" />
                        </div>
                        <div class="form-input">
                            <label for="prodi">Prodi</label>
                            <select name="prodi" id="prodi">
                                <option value="">-- Pilih Prodi --</option>
                                <option value="Teknik Informatika" <?php if ($prodi == 'Teknik Informatika') echo "selected";  ?>>Teknik Informatika</option>
                                <option value="Teknik Industri" <?php if ($prodi == 'Teknik Industri') echo "selected";  ?>>Teknik Industri</option>
                                <option value="Teknik Komputer" <?php if ($prodi == 'Teknik Komputer') echo "selected";  ?>>Teknik Komputer</option>
                                <option value="Teknik Elektro" <?php if ($prodi == 'Teknik Elektro') echo "selected";  ?>>Teknik Elektro</option>
                                <option value="Sistem Informasi" <?php if ($prodi == 'Sistem Informasi') echo "selected";  ?>>Sistem Informasi</option>
                            </select>
                        </div>
                        <div class="form-input">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="3" rows="3">
                            <?php echo $alamat ?>
                            </textarea>
                        </div>
                        <div class="form-input">
                            <label for="nohp">No. Handphone</label>
                            <input type="text" name="nohp" id="nohp" value="<?php echo $nohp ?>" />
                        </div>
                        <div class="form-btn">
                            <input type="submit" name="simpan" class="bg_hijau" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Batas [END] -->
            <div class="form-output-data">
                <?php
                if ($berhasil) {
                ?>
                    <div class="succes-save bg_hijau">
                        <?php echo $berhasil ?>
                    </div>
                <?php
                }
                if ($error) {
                ?>
                    <div class="error-save bg_merah">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <h2 class="form-title-data bg_biru">Form Output Data</h2>
                <div class="form-data">
                    <div class="table-data">
                        <table class="form-tabel">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Alamat</th>
                                    <th>No. Handphone</th>
                                    <th>Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = "select * from mhs order by nim asc";
                                $show   = mysqli_query($koneksi, $query);
                                $sortir = "1";
                                while ($result = mysqli_fetch_array($show)) {
                                    $nim = $result['nim'];
                                    $nama = $result['nama_mhs'];
                                    $prodi = $result['prodi'];
                                    $alamat = $result['alamat'];
                                    $nohp = $result['no_hp'];

                                ?>
                                    <tr>
                                        <td><?php echo $sortir++; ?></td>
                                        <td><?php echo $nim; ?></td>
                                        <td><?php echo $nama; ?></td>
                                        <td><?php echo $prodi; ?></td>
                                        <td><?php echo $alamat; ?></td>
                                        <td><?php echo $nohp; ?></td>
                                        <td>
                                            <a class="btn-handle bg_kuning" href="index.php?xx=ubah&nim=<?php echo $nim; ?>">Ubah</a>
                                            <a class="btn-handle bg_merah" href="index.php?xx=hapus&nim=<?php echo $nim; ?>">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>