<?php
require_once 'phpqrcode/qrlib.php';

// Sample certificate data (replace with actual form input or database data)
$name = "John Doe";
$course = "Web Development";

// ✅ Generate unique certificate ID
$cert_id = "CERT" . strtoupper(uniqid());

// ✅ Create certificate verification URL
$cert_url = "http://localhost/certificate-system/view_certificate.php?id=$cert_id";

// ✅ Absolute path to save QR code image
$qr_file_path = __DIR__ . "/qrcodes/$cert_id.png";

// ✅ Generate QR code and save it
QRcode::png($cert_url, $qr_file_path, QR_ECLEVEL_L, 4);

// ✅ HTML output
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Certificate Generated</title>";
echo "<link rel='stylesheet' href='style.css'>";
echo "<style>
    body { font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; }
    .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
    img { margin: 15px 0; }
    a { text-decoration: none; color: blue; }
</style>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<h2>🎉 Certificate Successfully Generated</h2>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Course:</strong> $course</p>";
echo "<img src='qrcodes/$cert_id.png' alt='QR Code' width='200'>";
echo "<p><a href='view_certificate.php?id=$cert_id'>🔍 Verify / View Certificate</a></p>";
echo "</div>";
echo "</body>";
echo "</html>";
?>
