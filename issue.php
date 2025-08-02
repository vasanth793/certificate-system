<?php
include "db.php";
include "phpqrcode/qrlib.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $issue_date = $_POST['issue_date'];

    $cert_id = uniqid("CERT_");

    $qr_content = "http://localhost/certificate-system/verify.php?id=$cert_id";
    $qr_path = "uploads/" . $cert_id . ".png";
    QRcode::png($qr_content, $qr_path, QR_ECLEVEL_H, 4);

    $stmt = $conn->prepare("INSERT INTO users (name, email, course, issue_date, cert_id, qr_code) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $course, $issue_date, $cert_id, $qr_path);
    $stmt->execute();

   
    echo "<script>alert('Certificate Issued with QR Code!');</script>";

}

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Certificate</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Issue Certificate</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Student Name" required><br>
        <input type="email" name="email" placeholder="Student Email" required><br>
        <input type="text" name="course" placeholder="Course Name" required><br>
        <input type="date" name="issue_date" required><br>
        <button type="submit">Generate Certificate</button>
    </form>
    <a href="logout.php" style="float:right;">Logout</a>

</body>
</html>
