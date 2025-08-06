<?php
include 'db.php';
require 'phpqrcode/qrlib.php';

$success = "";
$name = $course = $issue_date = "";
$cert_id = "";
$qr_image_path = "";

if (isset($_POST['generate'])) {
    $name = $_POST['name'] ?? '';
    $course = $_POST['course'] ?? '';
    $issue_date = $_POST['issue_date'] ?? '';

    if (!empty($name) && !empty($course) && !empty($issue_date)) {
        $cert_id = strtoupper(uniqid("CERT"));
        $verify_url = "http://localhost/certificate-system/verify.php?cert_id=$cert_id";

        $qr_folder = "qrcodes/";
        if (!file_exists($qr_folder)) {
            mkdir($qr_folder, 0777, true);
        }

        if (is_writable($qr_folder)) {
            $qr_image_path = $qr_folder . "$cert_id.png";
            QRcode::png($verify_url, $qr_image_path, QR_ECLEVEL_L, 4);

            $stmt = $conn->prepare("INSERT INTO certificates (cert_id, name, course, issue_date, verify_url) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $cert_id, $name, $course, $issue_date, $verify_url);

            if ($stmt->execute()) {
                $success = "✅ Certificate Generated!";
            } else {
                $success = "❌ Database Error!";
            }

            $stmt->close();
            $conn->close();
        } else {
            $success = "❌ 'qrcodes' folder is not writable.";
        }
    } else {
        $success = "❗ All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Generate Certificate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f2ff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #007acc;
            margin-bottom: 25px;
            font-size: 22px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            font-size: 15px;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 15px;
        }
        button {
            background-color: #00aaff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #007acc;
        }
        .result {
            margin-top: 20px;
            text-align: center;
            font-size: 15px;
        }
        .qr img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }
        a {
            color: #007acc;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Responsive tweaks */
        @media (max-width: 480px) {
            .container {
                margin: 20px 10px;
                padding: 20px;
            }
            h2 {
                font-size: 20px;
            }
            label,
            input,
            button,
            .result {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🎓 Certificate Generator</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Course:</label>
        <input type="text" name="course" required>

        <label>Issue Date:</label>
        <input type="date" name="issue_date" required>

        <button type="submit" name="generate">Generate Certificate</button>
    </form>

    <?php if (!empty($success)): ?>
        <div class="result">
            <p><?= $success ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($cert_id)): ?>
        <hr>
        <div class="result">
            <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Course:</strong> <?= htmlspecialchars($course) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($issue_date) ?></p>
            <p><strong>Certificate ID:</strong> <?= $cert_id ?></p>

            <p>👇 Scan this QR to Verify:</p>
            <div class="qr">
                <img src="<?= $qr_image_path ?>" alt="QR Code" width="150">
            </div>
            <br>
            <a href="verify.php?cert_id=<?= $cert_id ?>" target="_blank">🔗 Verify Now</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
