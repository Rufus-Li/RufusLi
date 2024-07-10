<?php
session_start();
include('connection.php');

// Function to check password strength
function checkPasswordStrength($password) {
    return (strlen($password) < 8) ? "Weak" : "Strong";
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, "@gmail.com") !== false) {
            $stmt = $conn->prepare('SELECT * FROM studenttable WHERE Email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['Password'])) {
                    $_SESSION['user_id'] = $user['Reg_No'];
                    $_SESSION['student_name'] = $user['Student Name'];
                    $_SESSION['reg_no'] = $user['Reg_No'];
                    $_SESSION['roll_no'] = $user['Roll_No'];
                    header('Location: studentpage.php');
                    exit();
                } else {
                    echo '<script>alert("Invalid password"); window.location.href = "index.php";</script>';
                    exit();
                }
            } else {
                echo '<script>alert("User not found"); window.location.href = "index.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Invalid email format or not a Gmail address"); window.location.href = "index.php";</script>';
            exit();
        }
    } else {
        echo 'Email or password not provided';
    }
}
?>
