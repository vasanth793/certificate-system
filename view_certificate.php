<?php
// Get cert_id from URL
$cert_id = $_GET['id'] ?? '';

if (!$cert_id) {
    echo "Certificate ID missing!";
    exit;
}

$qr_image_path = "qrcodes/$cert_id.png";

// Dummy Certificate Details (you can fetch from DB instead)
$name = "Vasanth Kumar";
$course = "Web Development";
$date_issued = date("d-m-Y");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Certificate</title>
</head>
<body>
    <h2>🎓 Certificate Details</h2>
    <p><strong>Name:</strong> <?= $name ?></p>
    <p><strong>Course:</strong> <?= $course ?></p>
    <p><strong>Date Issued:</strong> <?= $date_issued ?></p>
    <p><strong>Certificate ID:</strong> <?= $cert_id ?></p>

    <h3>📎 QR Code:</h3>
    <img src="<?= $qr_image_path ?>" alt="QR Code" width="200">
</body>
</html>
