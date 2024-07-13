<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("Please log in first."); window.location.href = "login.php";</script>';
    exit();
}

if (isset($_POST['submit'])) {
    // Get form data and sanitize
    $name = htmlspecialchars($_POST['Name']);
    $department = htmlspecialchars($_POST['Dept']);
    $subject = htmlspecialchars($_POST['Subject']);
    $reg_no = htmlspecialchars($_POST['Reg-No']);
    $roll_no = htmlspecialchars($_POST['Roll']);
    $semester = htmlspecialchars($_POST['sem']);
    // Get current user registration number from session
    $current_reg_no = $_SESSION['reg_no'];

    // Update the student's information
    $stmt = $conn->prepare('UPDATE studenttable SET `Student Name` = ?, `Department` = ?, `Subject` = ?, `Reg_No` = ?, `Roll_No` = ?,`Semester` = ? WHERE `Reg_No` = ?');
    $stmt->bind_param('sssssss', $name, $department, $subject, $reg_no, $roll_no, $semester, $current_reg_no);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Update session with new data
        $_SESSION['student_name'] = $name;
        $_SESSION['reg_no'] = $reg_no;
        $_SESSION['roll_no'] = $roll_no;
        
        echo '<script>alert("Profile updated successfully"); window.location.href = "studentpage.php";</script>';
    } else {
        echo '<script>alert("Update failed"); window.location.href = "studentpage.php";</script>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
