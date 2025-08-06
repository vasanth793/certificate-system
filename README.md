# 🎓 Online Certificate Issue and QR Verification System

This is a final year BBA/IT project that allows admin to generate certificates with QR codes and users to verify their authenticity online using a unique certificate ID.

## 🚀 Features

- Admin can:
  - Issue certificates with student name, course, and date.
  - Automatically generate unique certificate ID and QR code.
  - Save certificate details in the database.
- User can:
  - Verify certificate using the ID or QR code.
- QR Code links directly to the certificate verification page.

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **QR Code Library**: `phpqrcode` or `QRCode.php`

---

## 📁 Folder Structure

/project-root/
│
├── index.html # Home page
├── generate.php # Certificate creation script
├── verify.php # Certificate verification script
├── db.php # Database connection file
├── style.css # CSS styles
├── /qrcodes/ # QR code image folder
└── /certificates/ # Optional: Downloadable certificates


---

## 🔧 Setup Instructions

### 1. ✅ Clone the Project
git clone https://github.com/yourusername/qr-certificate-system.git


Or simply upload files to your hosting server.

---

### 2. ✅ Create MySQL Database

Create a MySQL database and import the following table:

```sql
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    course VARCHAR(100),
    date_issued DATE,
    cert_id VARCHAR(100) UNIQUE,
    verify_url VARCHAR(255)
);

✅ Configure db.php
Edit your db.php file to match your hosting/database credentials:

php
Copy
Edit
<?php
$servername = "sqlXXX.epizy.com"; // or localhost for XAMPP
$username = "epiz_XXXXX";
$password = "your_db_password";
$dbname = "epiz_XXXXX_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
Upload to Hosting
Use free PHP hosting like:

000webhost

InfinityFree

Upload all files and folders using their File Manager or FTP.

✅ How It Works
🎓 Certificate Generation
Admin enters student name and course.

PHP script:

Generates unique cert_id.

Saves data in database.

Creates QR code linked to verify.php?cert_id=XYZ.

Certificate is generated with embedded QR code.

🔍 Certificate Verification
User enters certificate ID or scans QR.

PHP checks if ID exists in DB.

If valid, details shown.

If not found, shows error message.

<img width="1752" height="786" alt="image" src="https://github.com/user-attachments/assets/61a658f7-2d18-47b5-81a3-d80932433dd4" />
<img width="1536" height="751" alt="image" src="https://github.com/user-attachments/assets/5c957c77-ac32-4881-ba19-afbae83f557e" />
<img width="1509" height="755" alt="image" src="https://github.com/user-attachments/assets/d5f509f1-3b2a-4dbf-88f6-ba594ad6dd6b" />
<img width="1736" height="582" alt="image" src="https://github.com/user-attachments/assets/2974b9bc-75d9-4be6-805e-96c66cbf5d7c" />

📄 License
This project is for educational purposes only.
You can use, modify, or share with credit.

👨‍💻 Developed By
Vasanthakumar G
BBA Student | Web Developer
📧 vasanthakumar0790@gmail.com
🌐 GitHub | LinkedIn


---

Would you like this as a downloadable `.md` file? I can generate it for you too.
