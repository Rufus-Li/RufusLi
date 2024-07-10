<?php
session_start(); // Start session
include('connection.php');

// Function to check password strength
function checkPasswordStrength($password) {
    return strlen($password) >= 8 ? "Strong" : "Weak";
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Check if both email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if email is in a valid format
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, "@gmail.com") !== false) {
            // Prepare and execute the SQL statement to fetch user from the database
            $stmt = $conn->prepare('SELECT * FROM teachertable WHERE Email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['Password'])) {
                    $_SESSION['user_id'] = $user['TeacherID'];
                    $_SESSION['Teacher_name'] = $user['TeacherName'];
                    $_SESSION['Department'] = $user['Department']; // Set Department in session
                    $_SESSION['reg_no'] = $user['TeacherID'];
                    $_SESSION['Sem'] = $user['Semester'];
                    header('Location: dashboardindex.php');
                    exit();
                } else {
                    // Password is incorrect
                    echo '<script>alert("Invalid password"); window.location.href = "admin.php";</script>';
                }
            } else {
                // User does not exist
                echo '<script>alert("User not found"); window.location.href = "admin.php";</script>';
            }
        } else {
            // Email is not in a valid format
            echo '<script>alert("Invalid email format or not a Gmail address"); window.location.href = "admin.php";</script>';
        }
    } else {
        // Email or password not provided
        echo '<script>alert("Email or password not provided"); window.location.href = "admin.php";</script>';
    }
}
?>
