<?php
include 'db.php';
require 'phpqrcode/qrlib.php';  // Ensure this path is correct

$success = "";
$name = $course = $issue_date = "";
$cert_id = "";
$qr_image_path = "";

if (isset($_POST['generate'])) {
    // 1️⃣ Get input values safely
    $name = $_POST['name'] ?? '';
    $course = $_POST['course'] ?? '';
    $issue_date = $_POST['issue_date'] ?? '';

    // 2️⃣ Validate inputs
    if (!empty($name) && !empty($course) && !empty($issue_date)) {

        // 3️⃣ Generate certificate ID and verify URL
        $cert_id = strtoupper(uniqid("CERT"));
        $verify_url = "http://localhost/certificate-system/verify.php?cert_id=$cert_id";

        // 4️⃣ Create QR code folder if not exists
        $qr_folder = "qrcodes/";
        if (!file_exists($qr_folder)) {
            mkdir($qr_folder, 0777, true);
        }

        // 5️⃣ Check if folder is writable
        if (is_writable($qr_folder)) {
            // 6️⃣ Generate QR code image
            $qr_image_path = $qr_folder . "$cert_id.png";
            QRcode::png($verify_url, $qr_image_path, QR_ECLEVEL_L, 4);

            // 7️⃣ Save certificate data to DB
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
</head>
<body>
    <h2>🎓 Certificate Generator</h2>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Course:</label><br>
        <input type="text" name="course" required><br><br>

        <label>Issue Date:</label><br>
        <input type="date" name="issue_date" required><br><br>

        <button type="submit" name="generate">Generate Certificate</button>
    </form>

    <br>
    <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <?php if (!empty($cert_id)): ?>
        <hr>
        <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Course:</strong> <?= htmlspecialchars($course) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($issue_date) ?></p>
        <p><strong>Certificate ID:</strong> <?= $cert_id ?></p>

        <p>👇 Scan this QR to Verify:</p>
        <img src="<?= $qr_image_path ?>" alt="QR Code" width="150"><br><br>

        <a href="verify.php?cert_id=<?= $cert_id ?>" target="_blank">🔗 Verify Now</a>
        <hr>
    <?php endif; ?>
</body>
</html>
