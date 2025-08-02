<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Scan QR to Verify Certificate</title>
    <!-- html5-qrcode library CDN -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            padding-top: 30px;
        }
        #reader {
            width: 300px;
            margin: auto;
        }
    </style>
</head>
<body>

    <h2>📷 Scan Certificate QR Code</h2>
    <div id="reader"></div>

    <script>
        // Function triggered when QR is successfully scanned
        function onScanSuccess(qrMessage) {
            console.log("Scanned: " + qrMessage);

            // Example QR content: http://localhost/certificate-system/verify.php?cert_id=CERT12345
            if (qrMessage.includes("verify.php?cert_id=")) {
                // Redirect to the scanned URL
                window.location.href = qrMessage;
            } else {
                alert("Invalid QR Code!");
            }

            // Stop the scanner after successful scan
            html5QrcodeScanner.clear();
        }

        function onScanError(errorMessage) {
            // Optional: log scan errors to console
            console.warn("Scan error: ", errorMessage);
        }

        // Create scanner and render it
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", 
            { fps: 10, qrbox: 250 }  // fps = frames per second, qrbox = size
        );
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>

</body>
</html>
