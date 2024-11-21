<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $item=input($_POST["item"]);
        $jumlah=input($_POST["jumlah"]);
        $kondisi=input($_POST["kondisi"]);
        $jumlah_pinjam=input($_POST["jumlah_pinjam"]);
        $ygpinjam=input($_POST["ygpinjam"]);
        $no_hp=input($_POST["no_hp"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into inventaris (item, jumlah, kondisi, jumlah_pinjam, ygpinjam, no_hp) values
		('$item','$jumlah','$kondisi','$jumlah_pinjam','$ygpinjam','$no_hp')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
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
                </p>
        <div class="form-group">
            <label>Jumlah Dipinjam:</label>
            <input type="text" name="jumlah_pinjam" class="form-control" placeholder="Masukan Jumlah yang Dipinjam" required/>
        </div>
        <div class="form-group">
            <label>Dipinjam Oleh:</label>
            <input type="text" name="ygpinjam" class="form-control" placeholder="Masukan Siapa yang meminjam" required/>
        </div>  
        <div class="form-group">
            <label>No. HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No. HP Peminjam" required/>
        </div>        

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>