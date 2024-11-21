<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama id_item
    if (isset($_GET['id_item'])) {
        $id_item = input($_GET["id_item"]); // Correctly use $id_item

        $sql = "SELECT * FROM inventaris WHERE id_item=$id_item";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            $data = mysqli_fetch_assoc($hasil);
        } else {
            echo "<div class='alert alert-danger'> Error retrieving data: " . mysqli_error($kon) . "</div>";
        }
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_item = htmlspecialchars($_POST["id_item"]); // Use $id_item here
        $item = input($_POST["item"]);
        $jumlah = input($_POST["jumlah"]);
        $kondisi = input($_POST["kondisi"]);
        $jumlah_pinjam = input($_POST["jumlah_pinjam"]);
        $ygpinjam = input($_POST["ygpinjam"]);
        $no_hp = input($_POST["no_hp"]);

        // Query update data pada tabel anggota
        $sql = "UPDATE peserta SET
            item='$item',
            jumlah='$jumlah',
            kondisi='$kondisi',
            jumlah_pinjam='$jumlah_pinjam',
            ygpinjam='$ygpinjam',
            no_hp='$no_hp'
            WHERE id_item=$id_item"; // Use $id_item here

        // Mengeksekusi atau menjalankan query diatas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
            exit; // It's good practice to exit after a redirect
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan: " . mysqli_error($kon) . "</div>";
        }
    }
    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Item:</label>
            <input type="text" name="item" class="form-control" placeholder="Masukan Nama Item" required />
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="text" name="jumlah" class="form-control" placeholder="Masukan Jumlah Item" required/>
        </div>
        <div class="form-group">
            <label>Kondisi:</label>
            <input type="text" name="kondisi" class="form-control" placeholder="Masukan Kondisi Item" required/>
        </div>
        <div class="form-group">
            <label>Jumlah Dipinjam:</label>
            <input type="text" name="jumlah_pinjam" class="form-control" placeholder="Masukan Jumlah yang Dipinjam" required/>
        </div>
        <div class="form-group">
            <label>Dipin jam Oleh:</label>
            <input type="text" name="ygpinjam" class="form-control" placeholder="Masukan Siapa yang meminjam" required/>
        </div>
        <div class="form-group">
            <label>No. HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No. HP Peminjam" required/>
        </div>     

        <input type="hidden" name="id_item" value="<?php echo $data['id_item']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>