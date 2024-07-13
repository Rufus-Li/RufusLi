<?php
session_start();
include('connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("Please log in first."); window.location.href = "login.php";</script>';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare('SELECT * FROM studenttable WHERE Reg_No = ?');
$stmt->bind_param('s', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Display</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        #qrcode {
            border: 1px solid #000;
            padding: 20px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div id="qrcode"></div>

    <!-- Include the QR Code library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script>
        $(document).ready(function(){
            // Get the data from the URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const data = urlParams.get('data');
            
            // Generate and display the QR code
            if (data) {
                $('#qrcode').qrcode({
                    text: data,
                    width: 300,
                    height: 300
                });

                // Log the scanned data
                $.ajax({
                    type: 'POST',
                    url: 'log_qr_scan.php',
                    data: { data: data },
                    success: function(response) {
                        alert('QR code scanned successfully.');
                    }
                });
            } else {
                alert('No data provided for QR code.');
            }
        });
    </script>
</body>
</html>
