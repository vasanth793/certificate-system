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
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile Responsive -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding: 20px;
            margin: 0;
            background-color: #e0f7ff; /* Sky Blue background */
        }

        .valid, .invalid, .warning {
            font-size: 18px;
            padding: 12px;
            border-radius: 8px;
            max-width: 500px;
            margin: 20px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .valid {
            background-color: #c0f3e2;
            color: #065f46;
        }

        .invalid {
            background-color: #ffd6d6;
            color: #a10000;
        }

        .warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .details {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .details p {
            font-size: 16px;
            margin: 10px 0;
        }

        @media (max-width: 600px) {
            .valid, .invalid, .warning, .details {
                width: 90%;
                padding: 15px;
            }

            .details p {
                font-size: 15px;
            }
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
