<?php
session_start();
include('connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("Please log in first."); window.location.href = "login.php";</script>';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare('SELECT * FROM studenttable WHERE Reg_No = ?');
$stmt->bind_param('s', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="front-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Document</title>
</head>
<body>
    <div class="bg-bg">
        <div class="bg"></div>
        <div class="bg bg2"></div>
        <div class="bg bg3"></div>
    </div>

    <div class="header-content">
        <div class="logo-img">
            <a href="https://salesiancollege.ac.in/">
                <img src="https://salesiancollege.ac.in/Admission201819/Logo/logo.png" alt="Salesian College (Autonomous) Siliguri & Sonada" class="logo"/>
            </a>
        </div>
        <nav class="headernav">
            <div class="navbar-brand">
            </div>
            <div class="top-font">
                QR Code Attendance System 
            </div>
        </nav>
    </div>  
    <div class="container-fluid">
        <div class="row">
            <div class="left-col">
                <div class="navigate">
                    <div class="nav-item">
                        <button onclick="window.location.href='index.php'" class="home-nav btn-primary">
                            <span class="material-symbols-outlined">home</span>
                        </button>
                    </div>
                    <div class="nav-item" >
                        <a href="qr.php" class="btn-primary">
                            <span class="material-symbols-outlined">
                                qr_code_scanner
                            </span>
                        </a>
                    </div>
                    <div class="nav-item" id="prfle">
                        <a onclick="showPopUp()" class="btn-primary">
                            <span class="material-symbols-outlined">
                                edit_note
                            </span>
                        </a>
                    </div>
                    <div class="nav-item" >
                        <div class="logout-container">
                            <a href="index.php" class="btn-primary">
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="right-col">
                <div class="attendance-details">
                    <div class="at-de-heading">
                        Attendance Details
                    </div>
                    <div class="at-de-content">
                        <div class="at-de-dropdown">
                            <select class="select-box">
                                <option value="">Select your Semester</option>
                                <option value="one">Semester I</option>
                                <option value="two">Semester II</option>
                                <option value="three">Semester III</option>
                                <option value="four">Semester IV</option>
                                <option value="five">Semester V</option>
                                <option value="six">Semester VI</option>
                                <option value="seven">Semester VII</option>
                                <option value="eight">Semester VIII</option>
                            </select>
                        </div>
                    </div>

                    <div class="show-attendance">
                        <div class="at-box">
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $roll_no = $_POST['roll_no'];
                                    $semester = $_POST['semester'];

                                    // Database connection
                                    $conn = new mysqli("hostname", "username", "password", "database");

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                // Fetch attendance data
                                $sql = "SELECT subject, 
                                        COUNT(CASE WHEN attendance_status = 'present' THEN 1 END) AS present,
                                        COUNT(CASE WHEN attendance_status = 'absent' THEN 1 END) AS absent
                                        FROM attendance_table 
                                        WHERE roll_no = ? AND semester = ?
                                        GROUP BY subject";

                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ii", $roll_no, $semester);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    $total = $row['present'] + $row['absent'];
                                    $attendance_percentage = $total ? ($row['present'] / $total) * 100 : 0;
                                    $attendance_percentage = round($attendance_percentage, 2);

                                echo "<div class='bar'>
                                        <span style='width: {$attendance_percentage}%;'>{$row['subject']}: {$attendance_percentage}%</span>
                                    </div>";
                            }
                            $stmt->close();
                            $conn->close();
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="card">
                <div class="ds-top">
                    <button onclick="showPopUp()" class="cross">
                        <span class="material-symbols-outlined crs">
                            close
                        </span>
                    </button>
                </div>
                <?php
                    include 'connection.php';

                    // Get current user registration number from session
                    $current_reg_no = $_SESSION['reg_no'];

                    // Fetch the student's information based on the logged-in user
                    $sel = "SELECT * FROM studenttable WHERE `Reg_No` = '$current_reg_no'";
                    $query = mysqli_query($conn, $sel);
                    $result = mysqli_fetch_assoc($query);
                     ?>
                <div class="avatar-holder">

                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="profile-pic">
                </div>
                <div class="name">
                    <a>
                        <div class="details">
                            <h2><?php echo $result['Student Name']; ?></h2> 
                            <h4><?php echo $result['Department']; ?></h4>
                            <h4><?php echo $result['Reg_No']; ?></h4>
                            <h4><?php echo $result['Roll_No']; ?></h4>
                        </div>
                    </a>
                    <div class="edit-details">
                        <button onclick="toggle()">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-edit-details">
        <form action="studentedit.php" method="POST">
        <div class="edit-inputs">
            <a>PROFILE</a> 
            <input type="Name" name="Name" placeholder="Enter your Full Name" required><br>
            <input type="Dept" name="Dept" placeholder="Enter your Department" required><br>
            <input type="Subj" name="Subject" placeholder="Bachelor/Masters in **your subject**" required><br>
            <input type="Reg-No" name="Reg-No" placeholder="Enter your Registration Number" required><br>
            <input type="Roll" name="Roll" placeholder="Enter your Roll No." required><br>
            <input type="Sem" name="sem" placeholder="Semester" required><br>
        </div>
        <div class="edit-button">
            <button name="submit" onclick="confirm()">Confirm</button>
            <h1></h1>
            <button onclick="toggle()">Cancel</button>
            
        </div>
        </form>
    </div>
    <script src="front-page.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggle() {
            var popup=document.getElementById('popup-edit-details');
            popup.classList.toggle('active');
        }
        function showPopUp() {
            var fpopup=document.getElementById('card');
            fpopup.classList.toggle('active');
        }
    </script>
</body>
</html>
