<?php
// ✅ Start session and check admin login
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// ✅ Include QR Code Library
require_once 'phpqrcode/qrlib.php';

// ✅ Generate Certificate ID and QR Code URL
$cert_id = "CERT" . strtoupper(uniqid());
$cert_url = "http://localhost/certificate-system/verify.php?id=$cert_id";

// ✅ Create folder if not exists
$qr_folder = "qrcodes/";
if (!file_exists($qr_folder)) {
    mkdir($qr_folder, 0777, true);
}

// ✅ Generate QR Code and save
$qr_file = "$qr_folder$cert_id.png";
QRcode::png($cert_url, $qr_file, QR_ECLEVEL_L, 4);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            margin-top: 50px;
        }
        img {
            margin-top: 20px;
            border: 2px solid #444;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <h2>✅ Welcome, Admin!</h2>

    <p><a href="certificate_form.html">📝 Generate Certificate</a></p>
    <p><a href="logout.php">🚪 Logout</a></p>

    <h3>🔗 Your Latest Generated QR</h3>
    <img src="<?php echo $qr_file; ?>" alt="QR Code">

    <p><strong>Certificate ID:</strong> <?php echo $cert_id; ?></p>
    <p><strong>Verification Link:</strong> <a href="<?php echo $cert_url; ?>"><?php echo $cert_url; ?></a></p>

</body>
</html>
