<?php
require_once 'phpqrcode/qrlib.php';

// Create a unique certificate ID
$cert_id = "CERT" . strtoupper(uniqid());

// Certificate Verification URL
$cert_url = "http://localhost/certificate-system/view_certificate.php?id=$cert_id";

// ✅ ABSOLUTE PATH TO SAVE the QR file
$qr_file_path = __DIR__ . "/qrcodes/$cert_id.png";

// ✅ GENERATE QR and SAVE it to qrcodes folder
QRcode::png($cert_url, $qr_file_path, QR_ECLEVEL_L, 4);

// ✅ DISPLAY the QR in browser (RELATIVE path for browser)
echo "<h2>QR Code Generated</h2>";
echo "<img src='qrcodes/$cert_id.png' alt='QR Code' width='200'>";
echo "<br><a href='view_certificate.php?id=$cert_id'>View Certificate</a>";
?>
