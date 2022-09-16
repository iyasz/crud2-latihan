<?php

$conn = mysqli_connect('localhost', 'root', '', 'crudlog');

$select = $conn->query("SELECT * FROM anggota");

if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $simpan = $conn->query("INSERT INTO anggota VALUES  (NULL, '$nama', '$username', '$telepon', '$alamat')");
    if ($simpan) {
        $swal = 1;
        echo '<script>
                setInterval(function () {
                    window.location.href="input.php"
                }, 1000);
            </script>';
        // echo "<script>location.replace('');</script>";
    } else {
        echo "<script>Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
          })</script>";
    }
}
if (isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST['id']);
    $delete = $conn->query("DELETE FROM anggota WHERE id = '$id'");
    if ($delete) {
        $del = 1;
        echo '<script>
                setInterval(function () {
                    window.location.href="input.php"
                }, 1000);
            </script>';
    } else {
        echo "<script>alert('Data Gagal Di hapus');</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Bootstrap demo</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="header">
                                <h3>Form Penginputan Data</h3>
                            </div>
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input autocomplete="off" type="text" required name="nama" placeholder="" class="form-control" id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" autocomplete="off" name="username" required placeholder="" class="form-control" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="telp">No Telp</label>
                                <input type="number" name="telepon" autocomplete="off" required placeholder="" class="form-control" id="telp">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" required autocomplete="off" placeholder="" class="form-control" id="alamat">
                            </div>
                            <div class="footer">
                                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                <button class="btn btn-danger" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No. Telp</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($select as $selects) { ?>
                                    <tr>
                                        <td> <?= $no++ ?> </td>
                                        <td> <?= $selects['nama'] ?> </td>
                                        <td> <?= $selects['username'] ?> </td>
                                        <td> <?= $selects['telepon'] ?> </td>
                                        <td> <?= $selects['alamat'] ?> </td>
                                        <td class=" d-flex gap-1 justify-content-center">
                                            <a href="edit.php?id=<?= $selects['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $selects['id'] ?>">
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <?php
    if (isset($swal)) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Menyimpan Data',
            showConfirmButton: false,
            timer: 1500
          })
            </script>";
    }
    if (isset($del)) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Menghapus Data',
            showConfirmButton: false,
            timer: 1500
          })
            </script>";
    }
    ?>

</body>

</html>