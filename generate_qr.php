<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $qr_code = $_POST['qr_code'];
    $date = date('Y-m-d H:i:s');
    
    $stmt = $conn->prepare("INSERT INTO qr_codes (subject, qr_code, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $subject, $qr_code, $date);
    $stmt->execute();
    $stmt->close();
    
    echo $qr_code;
}
?>
