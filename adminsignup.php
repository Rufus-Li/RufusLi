<?php
include('connection.php');

// Function to check password strength
function checkPasswordStrength($password) {
    return strlen($password) >= 8 ? "Strong" : "Weak";
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adminsignup'])) {
    // Retrieve email, password, and re-entered password from the form
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['Name']);
    $Dept = htmlspecialchars($_POST['Dept']);
    $subject = htmlspecialchars($_POST['Subject']);
    $Reg = htmlspecialchars($_POST['Roll']);
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
                $stmt = $conn->prepare('SELECT * FROM teachertable WHERE Email = ?');
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if user already exists
                if ($result->num_rows > 0) {
                    echo '<script>alert("User account already registered");</script>';
                } else {
                    // Email is not registered, proceed with sign-up
                    $stmt = $conn->prepare('INSERT INTO teachertable (TeacherName, Department, Subject, TeacherID, Email, Password) VALUES (?, ?, ?, ?, ?, ?)');
                    $stmt->bind_param('ssssss', $name, $Dept, $subject, $Reg, $email, $hashed_password);

                    if ($stmt->execute()) {
                        echo '<script>alert("Signup successful"); window.location.href = "admin.php";</script>';
                    } else {
                        echo '<script>alert("Signup failed");</script>';
                    }
                }
            } else {
                echo '<script>alert("Password too weak. It must be at least 8 characters long.");</script>';
            }
        } else {
            echo '<script>alert("Passwords do not match");</script>';
        }
    } else {
        echo '<script>alert("Invalid email format. Please enter a Gmail address");</script>';
    }
}
?>
