<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboardstyle.css">
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
        <nav>
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
                        <a href="dashboardindex.html" class="home-nav btn-primary">
                            <span class="material-symbols-outlined">home</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <button id="generateQR" class="btn-primary">
                            <span class="material-symbols-outlined">
                                qr_code_scanner
                            </span>
                        </button>
                    </div>
                    <div class="nav-item">
                        <a href="searchstudent.html" class="search-nav btn-primary">
                            <span class="material-symbols-outlined">
                                person_search
                            </span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="adminindex.html" class="btn-primary">
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
    </div>
    <div id="popup-edit-details">
        <div class="edit-inputs">
            <a>PROFILE</a> 
            <input type="Name" name="Name" placeholder="Enter your Full Name" required><br>
            <input type="Dept" name="Dept" placeholder="Enter your Department" required><br>
            <input type="Subj" name="Subject" placeholder="Bachelor/Masters in **your subject**" required><br>
            <input type="Reg-No" name="Reg-No" placeholder="Enter your Registration Number" required><br>
            <input type="Roll" name="Roll" placeholder="Enter your Roll No." required><br>
        </div>
        <div class="edit-button">
            <button onclick="confirm()">Confirm</button>
            <h1></h1>
            <button onclick="toggle()">Cancel</button>
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
    </script>
</body>
</html>