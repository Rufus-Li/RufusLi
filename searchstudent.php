<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="searchstyle.css">
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
                        <a href="dashboardindex.php" class="home-nav btn-primary">
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
        </div>
    </div> 

    <!-- Correct script tag to include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="searchjs.js"></script>
</body>
</html>