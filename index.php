<?php
// ============================================
// Program Konversi Suhu Sederhana
// File: konversi_suhu.php
// ============================================

// Inisialisasi variabel untuk menyimpan hasil dan pesan error
$hasil = "";
$error = "";

// Cek apakah form sudah disubmit menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil nilai input suhu dan jenis konversi dari form
    $suhu = $_POST["suhu"];
    $konversi = $_POST["konversi"];

    // Validasi: pastikan input tidak kosong
    if ($suhu === "" || $konversi === "") {
        $error = "Silakan masukkan suhu dan pilih jenis konversi!";
    }
    // Validasi: pastikan input berupa angka
    elseif (!is_numeric($suhu)) {
        $error = "Input suhu harus berupa angka!";
    } else {
        // Ubah input ke tipe angka desimal
        $suhu = floatval($suhu);

        // Proses konversi menggunakan if dan elseif
        if ($konversi == "reamur") {
            // Rumus Celsius ke Reamur: R = C * 4/5
            $nilai = $suhu * 4 / 5;
            $hasil = "$suhu °C = " . number_format($nilai, 2) . " °R (Reamur)";
        } elseif ($konversi == "fahrenheit") {
            // Rumus Celsius ke Fahrenheit: F = (C * 9/5) + 32
            $nilai = ($suhu * 9 / 5) + 32;
            $hasil = "$suhu °C = " . number_format($nilai, 2) . " °F (Fahrenheit)";
        } elseif ($konversi == "kelvin") {
            // Rumus Celsius ke Kelvin: K = C + 273.15
            $nilai = $suhu + 273.15;
            $hasil = "$suhu °C = " . number_format($nilai, 2) . " K (Kelvin)";
        } else {
            $error = "Jenis konversi tidak valid!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Meta viewport agar tampilan responsive di HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Konversi Suhu</title>
    <style>
        /* Reset bawaan browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        /* Background sederhana berwarna biru muda */
        body {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Card di tengah halaman */
        .card {
            background-color: #ffffff;
            padding: 30px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 100, 200, 0.15);
            max-width: 450px;
            width: 100%;
        }

        /* Judul utama */
        h1 {
            color: #0369a1;
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
        }

        /* Deskripsi singkat */
        .deskripsi {
            text-align: center;
            color: #475569;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* Label form */
        label {
            display: block;
            margin-bottom: 8px;
            color: #1e40af;
            font-weight: 600;
            font-size: 14px;
        }

        /* Styling input dan select */
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 2px solid #bae6fd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border 0.2s;
        }

        input[type="number"]:focus,
        select:focus {
            border-color: #0284c7;
        }

        /* Tombol konversi */
        button {
            width: 100%;
            padding: 12px;
            background-color: #0284c7;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background-color: #0369a1;
        }

        /* Kotak hasil konversi */
        .hasil {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f9ff;
            border-left: 5px solid #0284c7;
            border-radius: 8px;
            color: #0c4a6e;
            font-weight: 600;
            text-align: center;
        }

        /* Kotak pesan error */
        .error {
            margin-top: 20px;
            padding: 15px;
            background-color: #fef2f2;
            border-left: 5px solid #ef4444;
            border-radius: 8px;
            color: #991b1b;
            text-align: center;
        }

        /* Responsive untuk HP */
        @media (max-width: 480px) {
            .card { padding: 20px; }
            h1 { font-size: 20px; }
        }
    </style>
</head>
<body>

    <!-- Card utama berisi form konversi -->
    <div class="card">
        <h1>🌡️ Program Konversi Suhu</h1>
        <p class="deskripsi">
            Program ini berfungsi untuk mengubah suhu dari satuan Celsius
            ke Reamur, Fahrenheit, atau Kelvin.
        </p>

        <!-- Form dengan method POST -->
        <form method="POST" action="">
            <label for="suhu">Suhu (Celsius):</label>
            <input
                type="number"
                step="any"
                name="suhu"
                id="suhu"
                placeholder="Contoh: 100"
                value="<?php echo isset($_POST['suhu']) ? htmlspecialchars($_POST['suhu']) : ''; ?>"
            >

            <label for="konversi">Konversi ke:</label>
            <select name="konversi" id="konversi">
                <option value="">-- Pilih Konversi --</option>
                <option value="reamur">Reamur (°R)</option>
                <option value="fahrenheit">Fahrenheit (°F)</option>
                <option value="kelvin">Kelvin (K)</option>
            </select>

            <button type="submit">Konversi</button>
        </form>

        <!-- Tampilkan hasil konversi jika ada -->
        <?php if ($hasil != ""): ?>
            <div class="hasil"><?php echo $hasil; ?></div>
        <?php endif; ?>

        <!-- Tampilkan pesan error jika ada -->
        <?php if ($error != ""): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>

</body>
</html>