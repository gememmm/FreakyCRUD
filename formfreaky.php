<?php
require 'koneksi.php';
require 'crud.php'; // pastikan file functions.php yang berisi fungsi CRUD dimasukkan di sini

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_makhluk'])) {
        $nama_makhluk = $_POST['nama_makhluk'];
        $jumlah_makhluk = $_POST['jumlah_makhluk'];

        // Anda bisa menambahkan validasi atau pengecekan lainnya di sini
        // Misalnya, mengecek apakah makhluk dengan nama yang sama sudah ada di database
        $existingMakhluk = getFreakyByName($nama_makhluk); // Asumsi Anda memiliki fungsi untuk mengecek keberadaan makhluk berdasarkan nama
        if ($existingMakhluk) {
            $error = "Makhluk sudah terdapat di database";
        } else {
            createMakhluk($nama_makhluk, $jumlah_makhluk);
            header("Location: index.php");
            exit;
        }
    }
}

function getFreakyByName($nama) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM makhluk WHERE nama = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();
    $makhluk = $result->fetch_assoc();
    $stmt->close();
    return $makhluk;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Makhluk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Daftarkan Makhluk Ini -w-</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nama_makhluk">Nama</label>
                <input type="text" class="form-control" name="nama_makhluk" required>
            </div>
            <div class="form-group">
                <label for="jumlah_makhluk">Jumlah</label>
                <input type="text" class="form-control" name="jumlah_makhluk" required>
            </div>
            <button type="submit" name="submit_makhluk" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
