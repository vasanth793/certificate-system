<?php
// 1️⃣ Include DB connection
include('db.php');

// 2️⃣ Get cert_id from URL
$cert_id = $_GET['cert_id'] ?? '';
$certificate = null;
$error = null;

// 3️⃣ Check cert_id and fetch certificate
if (!empty($cert_id)) {
    $stmt = $conn->prepare("SELECT * FROM certificates WHERE cert_id = ?");
    $stmt->bind_param("s", $cert_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $certificate = $result->fetch_assoc();
    } else {
        $error = "❌ Invalid Certificate. No match found.";
    }

    $stmt->close();
} else {
    $error = "⚠️ No Certificate ID Provided.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Certificate Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
            background-color: #f5f5f5;
        }
        .valid, .invalid, .warning {
            font-size: 20px;
            padding: 10px;
            border-radius: 8px;
            width: 60%;
            margin: 0 auto 20px;
        }
        .valid {
            background-color: #d4edda;
            color: #155724;
        }
        .invalid {
            background-color: #f8d7da;
            color: #721c24;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 60%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .details p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<?php if ($certificate): ?>
    <div class="valid">✅ Certificate Verified</div>
    <div class="details">
        <p><strong>Name:</strong> <?= htmlspecialchars($certificate['name']) ?></p>
        <p><strong>Course:</strong> <?= htmlspecialchars($certificate['course']) ?></p>
        <p><strong>Date Issued:</strong> <?= htmlspecialchars($certificate['issue_date']) ?></p>
        <p><strong>Certificate ID:</strong> <?= htmlspecialchars($certificate['cert_id']) ?></p>
    </div>
<?php else: ?>
    <div class="<?= strpos($error, '⚠️') !== false ? 'warning' : 'invalid' ?>">
        <?= $error ?>
    </div>
<?php endif; ?>

</body>
</html>
