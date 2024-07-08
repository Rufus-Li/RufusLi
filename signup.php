<?php
// Include the database connection file
include('connection.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to check password strength
function checkPasswordStrength($password) {
    // Check if password length is at least 8 characters
    return strlen($password) >= 8 ? "Strong" : "Weak";
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    // Retrieve email, password, and re-entered password from the form
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['Name']);
    $department = htmlspecialchars($_POST['Dept']);
    $subject = htmlspecialchars($_POST['Subject']);
    $RegNo = htmlspecialchars($_POST['Reg-No']);
    $RollNo = htmlspecialchars($_POST['Roll']);
    $password = htmlspecialchars($_POST['psw']);
    $rpassword = htmlspecialchars($_POST['rpsw']);
    
    // Validate email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@gmail.com') !== false) {
        // Check if password and re-entered password match
        if ($password === $rpassword) {
            // Check password strength
            if (checkPasswordStrength($password) === "Strong") {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and execute the SQL statement to check if the email exists in the database
                $stmt = $conn->prepare('SELECT * FROM studenttable WHERE Email = ?');
                if ($stmt) {
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if user already exists
                    if ($result->num_rows > 0) {
                        echo '<script>alert("User account already registered"); window.location.href = "index.php";</script>';
                    } else {
                        // Email is not registered, proceed with sign-up
                        $stmt = $conn->prepare('INSERT INTO studenttable (Email, Password, `Student Name`, Department, Subject, Reg_No, Roll_No) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        if ($stmt) {
                            $stmt->bind_param('sssssss', $email, $hashed_password, $username, $department, $subject, $RegNo, $RollNo);

                            if ($stmt->execute()) {
                                echo '<script>alert("Signup successful"); window.location.href = "index.php";</script>';
                            } else {
                                echo '<script>alert("Signup failed"); window.location.href = "index.php";</script>';
                            }
                        } else {
                            echo '<script>alert("Failed to prepare statement for inserting data"); window.location.href = "index.php";</script>';
                        }
                    }
                } else {
                    echo '<script>alert("Failed to prepare statement for checking existing user"); window.location.href = "index.php";</script>';
                }
            } else {
                echo '<script>alert("Password too weak. It must be at least 8 characters long."); window.location.href = "index.php";</script>';
            }
        } else {
            echo '<script>alert("Passwords do not match"); window.location.href = "index.php";</script>';
        }
    } else {
        echo '<script>alert("Invalid email format. Please enter a Gmail address"); window.location.href = "index.php";</script>';
    }
}
?>
