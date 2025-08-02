<?php
// 1️⃣ This will try to create a text file named test.txt inside qrcodes/ folder
$result = file_put_contents('qrcodes/test.txt', 'Check write access');

// 2️⃣ Check if it succeeded
if ($result !== false) {
    echo "✅ test.txt created successfully inside qrcodes/";
} else {
    echo "❌ Failed to create test.txt – check folder permissions!";
}
?>
