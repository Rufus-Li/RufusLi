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
                        <button onclick="window.location.href='front-page.php'" class="home-nav btn-primary">
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
                            <div class="subj s1">Subject 1
                                <div class="bar bar1"></div>90%
                            </div>
                            <div class="subj s2">Subject 2
                                <div class="bar bar2"></div>80%
                            </div>
                            <div class="subj s3">Subject 3
                                <div class="bar bar3"></div>70%
                            </div>
                            <div class="subj s4">Subject 4
                                <div class="bar bar4"></div>60%
                            </div>
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
                <div class="avatar-holder">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="profile-pic">
                </div>
                <div class="name">
                    <a>
                        <div class="details">
                            <h2>NAME</h2> 
                            <h4>department</h4>
                            <h4>reg.no.</h4>
                            <h4>roll no.</h4>
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
