<?php
session_start();
include('connection.php'); // Include your database connection file

if(isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $dept = $_POST['Dept'];
    $subject = $_POST['Subject'];
    $reg_no = $_POST['Reg-No'];
    $sem = $_POST['sem'];

    // Assuming user ID is stored in session
    $user_id = $_SESSION['user_id'];

    // Update query
    $sql = "UPDATE teachertable SET TeacherName=?, Department=?, Subject=?, TeacherID=?, Semester=? WHERE TeacherID=?";

    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $name, $dept, $subject, $reg_no, $sem, $user_id);

        if($stmt->execute()) {
            echo '<script>alert("Profile updated successfully"); window.location.href = "dashboardindex.php";</script>';
        } else {
            echo '<script>alert("Update failed"); window.location.href = "dashboardindex.php";</script>';
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No data received.";
}
?>
