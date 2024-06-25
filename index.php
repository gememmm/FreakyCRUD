<?php
require 'koneksi.php';
require 'crud.php';

$makhluk = getMakhluk();

if(isset($_GET['delete_makhluk_id'])){
    $delete_makhluk_id = $_GET['delete_makhluk_id'];
    deleteMakhluk($delete_makhluk_id);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Makhluk Freakyy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table th, table td {
            text-align: left;
        }
        .fixed-width-action {
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Daftar Makhluk Freakyy ;)</h2>
        <a href="formfreaky.php" class="btn btn-success">Tambah Makhluk Freakyy</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th class="fixed-width-action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($makhluk as $makhluk): ?>
                <tr>
                    <td><?php echo $makhluk['nama']; ?></td>
                    <td><?php echo $makhluk['jumlah']; ?></td>
                    <td class="fixed-width-action">
                        <a href="updatefreaky.php?id=<?php echo $makhluk['id']; ?>" class="btn btn-primary">Update</a>
                        <a href="index.php?delete_makhluk_id=<?php echo $makhluk['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>