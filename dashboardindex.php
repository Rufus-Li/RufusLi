<?php
session_start();
include('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: adminlogin.php');
    exit();
}

// Fetch user details from the session
$user_id = $_SESSION['user_id'];
$name = $_SESSION['Teacher_name'];
$dept = $_SESSION['Department'];
$reg_no = $_SESSION['reg_no'];
$sem = $_SESSION['Sem'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboardcss.css">
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
            Welcome <?php echo htmlspecialchars($name); ?>
        </div>
        <nav>
            <div class="navbar-brand">
                <div class="hm">QR Attendance System</div>
            </div>
        </nav>
    </div>  
    <div class="container-fluid">
        <div class="row">
            <div class="left-col">
                <div class="navigate">
                    <div class="nav-item">
                        <a href="index.php" class="home-nav btn-primary">
                            <span class="material-symbols-outlined">home</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <button id="generateQRButton" class="btn-primary">
                            <span class="material-symbols-outlined">
                                qr_code_scanner
                            </span>
                        </button>
                    </div>
                    <div class="nav-item">
                        <a href="searchstudent.php" class="search-nav btn-primary">
                            <span class="material-symbols-outlined">
                                person_search
                            </span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="admin.php" class="btn-primary">
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="middle-body">
                <div class="card" id="card">
                    <div class="ds-top"></div>
                    <div class="avatar-holder">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="profile-pic">
                    </div>
                    <div class="name">
                        <a>
                            <div class="details">
                                <h2><b>NAME </b><?php echo htmlspecialchars($name); ?></h2>
                                <h4><b>DEPT </b><?php echo htmlspecialchars($dept); ?></h4>
                                <h4><b>ROLL-NO </b><?php echo htmlspecialchars($reg_no); ?></h4>
                            </div>
                        </a>
                        <br>
                        <div class="edit-details">
                            <button onclick="toggle()">Edit</button>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <div id="popup-edit-details">
        <form id="edit-details-form" method="POST" action="adminedit.php">
            <div class="edit-inputs">
                <a>PROFILE</a> 
                <input type="text" name="Name" placeholder="Enter your Full Name" required><br>
                <input type="text" name="Dept" placeholder="Enter your Department" required><br>
                <input type="text" name="Roll_No" placeholder="Enter your Roll Number" required><br>
                <input type="text" name="Sem" placeholder="Semester" required><br>
            </div>
            <br>
            <div class="edit-button">
                <button type="submit" name="submit">Confirm</button>
                <h1></h1>
                <button type="button" onclick="toggle()">Cancel</button>
            </div>
        </form>
    </div>

    <div id="generateQRForm" style="display:none;">
        <form id="generateQRFormContent" method="POST">
            <label for="subjectSelect">Select Subject:</label>
            <select id="subjectSelect" name="subject" required>
                <option value="">Select a subject</option>
                <option value="subject1">Subject 1</option>
                <option value="subject2">Subject 2</option>
                <option value="subject3">Subject 3</option>
                <option value="subject4">Subject 4</option>
            </select>
            <button type="button" id="generateQRButtonSubmit">Generate QR</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dashboardjs.js"></script>
    <script>
        function toggle() {
            var popup=document.getElementById('popup-edit-details');
            popup.classList.toggle('active');
        }
        function showPopUp() {
            var fpopup=document.getElementById('card');
            fpopup.classList.toggle('active');
        }

        $(document).ready(function(){
        $('#generateQRButton').click(function() {
            $('#generateQRForm').toggle();
        });

        $('#generateQRButtonSubmit').click(function() {
            var subject = $('#subjectSelect').val();
            if (subject) {
                $.ajax({
                    type: 'POST',
                    url: 'generate_qr.php',
                    data: { subject: subject },
                    success: function(response) {
                        window.open('displayQR.php?data=' + encodeURIComponent(response), 'QR Code', 'width=400,height=400');
                    }
                });
            } else {
                alert('Please select a subject.');
            }
        });
    });
    </script>
</body>
</html>