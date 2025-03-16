<?php
$nama = $email = $nomor = $mobil = $alamat = "";
$namaErr = $emailErr = $nomorErr = $alamatErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nama"])) {
        $namaErr = "Nama wajib diisi";
    } else {
        $nama = htmlspecialchars($_POST["nama"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["nomor"])) {
        $nomorErr = "Nomor Telepon wajib diisi";
    } elseif (!ctype_digit($_POST["nomor"])) {
        $nomorErr = "Nomor Telepon harus berupa angka";
    } else {
        $nomor = htmlspecialchars($_POST["nomor"]);
    }

    if (empty($_POST["alamat"])) {
        $alamatErr = "Alamat wajib diisi";
    } else {
        $alamat = htmlspecialchars($_POST["alamat"]);
    }

    $mobil = $_POST["mobil"];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Form Pembelian Mobil</h2>

        <!-- FORMULIR PEMBELIAN MOBIL -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo isset($nama) ? $nama : ''; ?>">
            <span class="error"><?php echo isset($namaErr) ? "* $namaErr" : ""; ?></span>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            <span class="error"><?php echo isset($emailErr) ? "* $emailErr" : ""; ?></span>

            <label for="nomor">Nomor Telepon:</label>
            <input type="text" id="nomor" name="nomor" value="<?php echo isset($nomor) ? $nomor : ''; ?>">
            <span class="error"><?php echo isset($nomorErr) ? "* $nomorErr" : ""; ?></span>

            <label for="mobil">Pilih Mobil:</label>
            <select id="mobil" name="mobil">
                <option value="Sedan" <?= isset($mobil) && $mobil == "Sedan" ? "selected" : ""; ?>>Sedan</option>
                <option value="SUV" <?= isset($mobil) && $mobil == "SUV" ? "selected" : ""; ?>>SUV</option>
                <option value="Hatchback" <?= isset($mobil) && $mobil == "Hatchback" ? "selected" : ""; ?>>Hatchback</option>
            </select>

            <label for="alamat">Alamat Pengiriman:</label>
            <textarea id="alamat" name="alamat"><?php echo isset($alamat) ? $alamat : ''; ?></textarea>
            <span class="error"><?php echo isset($alamatErr) ? "* $alamatErr" : ""; ?></span>

            <button type="submit">Beli Mobil</button>
        </form>

        <!-- MENAMPILKAN HASIL INPUT JIKA TIDAK ADA ERROR -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$alamatErr): ?>
        <h3>Data Pembelian:</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Mobil</th>
                    <th>Alamat Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $mobil; ?></td>
                    <td><?php echo $alamat; ?></td>
                </tr>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>
