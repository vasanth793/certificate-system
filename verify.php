<?php
include "db.php";

if (isset($_GET['id'])) {
    $cert_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE cert_id = ?");
    $stmt->bind_param("s", $cert_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Certificate Verification</title>
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
            <h2>Certificate Verified ✅</h2>
            <p><strong>Name:</strong> <?= $row['name'] ?></p>
            <p><strong>Email:</strong> <?= $row['email'] ?></p>
            <p><strong>Course:</strong> <?= $row['course'] ?></p>
            <p><strong>Issue Date:</strong> <?= $row['issue_date'] ?></p>
            <img src="<?= $row['qr_code'] ?>" width="150" alt="QR Code">
        </body>
        </html>
        <?php
    } else {
        echo "<h3>Invalid Certificate ID ❌</h3>";
    }
} else {
    echo "<h3>No Certificate ID Provided!</h3>";
}
?>
