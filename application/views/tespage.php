<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title_pdf ?></title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
        }
        img {
            margin: 20px auto;
            display: block;
        }
    </style>
</head>
<body>
    <h1>Test Gambar di PDF</h1>

    <!-- Gambar via URL (pastikan URL ini bisa diakses via browser) -->
    <p>Gambar via URL:</p>
    <img src="<?= base_url('assets/images/logo.png') ?>" width="200" alt="Gambar dari URL">

    <!-- Gambar via Base64 (jika dikirim dari controller) -->
    <?php if (!empty($img_base64)): ?>
        <p>Gambar via Base64:</p>
        <img src="<?= $img_base64 ?>" width="200%" alt="Gambar Base64">
    <?php endif; ?>
</body>
</html>
