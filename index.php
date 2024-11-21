<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="icon" href="img/logo_upgris.png" type="image/png">
</head>
<title>Inventaris Robotic UPGRIS</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <img src="img/logo_upgris.png" alt="Logo Upgris" class="navbar-brand mb-0 h1" style="width: 50px; height: auto; margin-right: 10px;">
        <span class="navbar-brand mb-0 h1">Tim Robotic UPGRIS</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR INVENTARIS</center></h4>
        <h6><center>ROBOTIKA UNIVERSITAS PGRI SEMARANG PERIODE 2024/2025</center></h6>
        <?php
            include "koneksi.php";

            //Cek apakah ada kiriman form dari method post
            if (isset($_GET['id_item'])) {
                $id_item = htmlspecialchars($_GET["id_item"]);

                $sql = "delete from inventaris where id_item='$id_item' ";
                $hasil = mysqli_query($kon, $sql);

                //Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                }
            }
        ?>

        <tr class="table-danger">
            <br>
            <thead>
            <tr>
            <table class="my-3 table table-bordered">
                <tr class="table-primary">           
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Jumlah Dipinjam</th>
                    <th>Dipinjam Oleh</th>
                    <th>No. HP</th>
                    <th colspan='2'>Aksi</th>
                </tr>
                </thead>

                <?php
                include "koneksi.php";
                $sql = "select * from inventaris order by id_item desc";

                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $data["item"]; ?></td>
                        <td><?php echo $data["jumlah"]; ?></td>
                        <td><?php echo $data["kondisi"]; ?></td>
                        <td><?php echo $data["jumlah_pinjam"]; ?></td>
                        <td><?php echo $data["ygpinjam"]; ?></td>
                        <td><?php echo $data["no_hp"]; ?></td>
                        <td>
                            <a href="update.php?id_item=<?php echo htmlspecialchars($data['id_item']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_item=<?php echo $data['id_item']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                }
                ?>
            </table>
            <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
        </div>
    </body>
</html>