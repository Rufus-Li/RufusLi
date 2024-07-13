<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $user_id = $_SESSION['user_id'];
    
    // Fetch user details
    $stmt = $conn->prepare('SELECT * FROM studenttable WHERE Reg_No = ?');
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    $student_name = $user['Student Name'];
    $roll_no = $user['Roll_No'];
    $date = date('Y-m-d H:i:s');

    // Log attendance
    $stmt = $conn->prepare("INSERT INTO attendance table(StudentName, Roll_no, SubjectName, Date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_name, $roll_no, $data, $date);
    $stmt->execute();
    $stmt->close();
}
?>
