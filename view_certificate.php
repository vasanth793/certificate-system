<?php
// view_certificate.php

// Step 1: Get certificate ID from URL
$cert_id = $_GET['id'] ?? '';

// Step 2: Sample static values (in real app, fetch from DB)
$name = "Vasanth Kumar";
$course = "Full Stack Web Development";
$date = date("d-m-Y");

// Step 3: Path to QR image
$qr_image = "qrcodes/$cert_id.png";
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Certificate</title>
  <style>
    body { font-family: Arial; text-align: center; padding: 30px; background-color: #f4f4f4; }
    .certificate {
      border: 2px solid #333;
      padding: 20px;
      width: 600px;
      margin: auto;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 { color: #006699; }
    .info { font-size: 18px; margin: 10px 0; }
    .qr { margin-top: 20px; }
  </style>
</head>
<body>

<div class="certificate">
  <h1>Certificate of Completion</h1>

  <div class="info"><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></div>
  <div class="info"><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></div>
  <div class="info"><strong>Date:</strong> <?php echo htmlspecialchars($date); ?></div>
  <div class="info"><strong>Certificate ID:</strong> <?php echo htmlspecialchars($cert_id); ?></div>

  <div class="qr">
    <h3>Scan to Verify</h3>
    <?php if (file_exists($qr_image)): ?>
      <img src="<?php echo $qr_image; ?>" alt="QR Code" width="150">
    <?php else: ?>
      <p style="color:red;">QR Code not found!</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
