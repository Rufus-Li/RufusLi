<?php
session_start();
include('connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Sanitize input
    $name = htmlspecialchars($_POST['Name']);
    $department = htmlspecialchars($_POST['Dept']);
    $subject = htmlspecialchars($_POST['Subject']);
    $reg_no = htmlspecialchars($_POST['Reg-No']);
    $roll_no = htmlspecialchars($_POST['Roll']);

    // Get current user's email from session
    $email = $_SESSION['email'];

    // Prepare and execute the SQL statement to update user details
    $stmt = $conn->prepare('UPDATE studenttable SET `Student Name` = ?, `Department` = ?, `Subject` = ?, `Reg_No` = ?, `Roll_No` = ? WHERE `Email` = ?');
    $stmt->bind_param('ssssss', $name, $department, $subject, $reg_no, $roll_no, $email);

    if ($stmt->execute()) {
        // Update session with new data (optional)
        $_SESSION['student_name'] = $name;
        $_SESSION['reg_no'] = $reg_no;
        $_SESSION['roll_no'] = $roll_no;

        echo '<script>alert("Profile updated successfully"); window.location.href = "studentpage.php";</script>';
    } else {
        echo '<script>alert("Update failed"); window.location.href = "studentpage.php";</script>';
    }

    $stmt->close();
}

// Fetch user details from the database using $_SESSION['email']
$stmt = $conn->prepare('SELECT * FROM studenttable WHERE Email = ?');
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    // $user now contains details like $user['Student Name'], $user['Department'], etc.
} else {
    // Handle case where user is not found (optional)
    echo 'User not found.';
}

$stmt->close();
$conn->close();
?>
