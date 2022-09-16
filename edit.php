<?php

$conn = mysqli_connect('localhost', 'root', '', 'crudlog');

$id = $_GET['id'];

$datas = $conn->query("SELECT * FROM anggota WHERE id = '$id'");

$data = mysqli_fetch_assoc($datas);

if (isset($_POST['submit'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $update = $conn->query("UPDATE anggota SET nama = '$nama', username = '$username', telepon = '$telepon', alamat = '$alamat' WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Update Berhasil');</script>";
        echo "<script>location.replace('input.php');</script>";
    } else {
        echo "<script>alert('Update Gagal');</script>";
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
    <title>Edit</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="header">
                                <h3>Form Pengeditan Data</h3>
                            </div>
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input autocomplete="off" type="text" required name="nama" value="<?= $data['nama'] ?>" placeholder="" class="form-control" id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" autocomplete="off" name="username" required placeholder="" value="<?= $data['username'] ?>" class="form-control" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="telp">No Telp</label>
                                <input type="number" name="telepon" autocomplete="off" required placeholder="" value="<?= $data['telepon'] ?>" class="form-control" id="telp">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" required autocomplete="off" placeholder="" value="<?= $data['alamat'] ?>" class="form-control" id="alamat">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>