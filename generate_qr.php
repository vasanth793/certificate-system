<?php
require_once 'phpqrcode/qrlib.php'; // Include the QR library

// Step 1: Create unique certificate ID
$cert_id = "CERT" . strtoupper(uniqid());

// Step 2: Create the verification URL
$cert_url = "http://localhost/certificate-system/view_certificate.php?id=$cert_id";

// Step 3: Set filename and path to save the QR image
$qr_file = "qrcodes/$cert_id.png";

// Step 4: Generate and save the QR code image
QRcode::png($cert_url, $qr_file, QR_ECLEVEL_L, 4);

// Step 5: Output confirmation
echo "QR code generated successfully!<br>";
echo "Certificate ID: $cert_id<br>";
echo "<img src='$qr_file' alt='QR Code'>";
?>
