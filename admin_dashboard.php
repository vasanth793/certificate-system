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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-color: #E0F7FA; /* Sky blue background */
            color: #004D40;
        }

        h2, h3 {
            color: #0077b6; /* Deep sky blue */
        }

        a {
            color: #0288d1;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .qr-box {
            margin-top: 30px;
            background: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 2px solid #0288d1;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .qr-box {
                width: 100%;
            }

            img {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <h2>✅ Welcome, Admin!</h2>
    <p><a href="generate_certificate.php">📝 Generate Certificate</a></p>
    <p><a href="logout.php">🚪 Logout</a></p>

    <div class="qr-box">
        <h3>🔗 Your Latest Generated QR</h3>
        <img src="<?php echo $qr_file; ?>" alt="QR Code">
        <p><strong>Certificate ID:</strong> <?php echo $cert_id; ?></p>
        <p><strong>Verification Link:</strong> <a href="<?php echo $cert_url; ?>" target="_blank"><?php echo $cert_url; ?></a></p>
    </div>

</body>
</html>
