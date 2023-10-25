<?php
// Tabel substitusi karakter
$encryptionTable = [
    'A' => 'S',
    'B' => 'A',
    'C' => 'N',
    'D' => 'D',
    'E' => 'Y',
    'F' => 'R',
    'G' => 'T',
    'H' => 'Z',
    'I' => 'M',
    'J' => 'O',
    'K' => 'I',
    'L' => 'B',
    'M' => 'C',
    'N' => 'E',
    'O' => 'F',
    'P' => 'G',
    'Q' => 'H',
    'R' => 'J',
    'S' => 'K',
    'T' => 'L',
    'U' => 'P',
    'V' => 'Q',
    'W' => 'U',
    'X' => 'V',
    'Y' => 'W',
    'Z' => 'X'
];

// Fungsi untuk mengenkripsi teks
function encryptText($text, $table) {
    $encryptedText = "";
    $text = strtoupper($text); // Konversi teks ke huruf besar

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Periksa apakah karakter ada dalam tabel substitusi
        if (array_key_exists($char, $table)) {
            $encryptedText .= $table[$char];
        } else {
            // Jika karakter tidak ada dalam tabel substitusi, biarkan karakter asli
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}

// Fungsi untuk mendekripsi teks
function decryptText($text, $table) {
    $decryptedText = "";

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $originalChar = array_search($char, $table);
        if ($originalChar !== false) {
            $decryptedText .= $originalChar;
        } else {
            $decryptedText .= $char;
        }
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$processedText = "";
$operation = "encrypt";

// Memproses input saat formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $processedText = encryptText($text, $encryptionTable);
    } elseif ($operation == "decrypt") {
        $processedText = decryptText($text, $encryptionTable);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enkripsi dan Dekripsi Teks</title>
</head>
<body>
    <h1>Enkripsi dan Dekripsi Caesar Chiper</h1>
    <form method="post" action="">
        <label for="text">Masukkan Teks:</label>
        <input type="text" id="text" name="text" value="<?php echo $text; ?>">
        
        <input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>> Enkripsi
        <input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>> Dekripsi

        <input type="submit" value="Proses">
    </form>

    <?php if (!empty($processedText)) : ?>
        <?php if ($operation == "encrypt") : ?>
            <h2>Hasil Enkripsi:</h2>
        <?php elseif ($operation == "decrypt") : ?>
            <h2>Hasil Dekripsi:</h2>
        <?php endif; ?>
        <p><?php echo $processedText; ?></p>
    <?php endif; ?>

    <a href="UTS2_V3922051_Sandy-Aryasatya-Zamroni.php"><button>Enkripsi Tahap Kedua</button></a>
</body>
</html>