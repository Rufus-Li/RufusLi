<?php
session_start();
// Include the database connection file
include('connection.php');

// Function to check password strength
function checkPasswordStrength($password)
{
    // Password strength can be assessed based on various criteria, such as length, presence of uppercase, lowercase, numbers, and special characters
    // For simplicity, let's check if the password length is at least 8 characters
    if (strlen($password) < 8) {
        return "Weak"; // Password is considered weak if it's less than 8 characters
    } else {
        return "Strong"; // Password is considered strong otherwise
    }
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
            $stmt = $conn->prepare('SELECT * FROM studenttable WHERE Email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $user['Password'])) {
                    // Password is correct, set session variables
                    $_SESSION['user_id'] = $user['Reg_No']; // Assuming 'id' is the primary key
                    $_SESSION['student_name'] = $user['Student Name'];
                    $_SESSION['reg_no'] = $user['Reg_No'];
                    $_SESSION['roll_no'] = $user['Roll_No'];

                    // Redirect to student page
                    header('Location: studentpage.php');
                    exit();
                } else {
                    // Password is incorrect
                    echo '<script>alert("Invalid password"); window.location.href = "index.php";</script>';
                    exit();
                }
            } else {
                // User does not exist
                echo '<script>alert("User not found"); window.location.href = "index.php";</script>';
                exit();
            }
        } else {
            // Email is not in a valid format
            echo '<script>alert("Invalid email format or not a Gmail address"); window.location.href = "index.php";</script>';
            exit();
        }
    } else {
        // Email or password not provided
        echo 'Email or password not provided';
    }
}
?>
