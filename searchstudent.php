<?php
session_start();
include('connection.php');
?>

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
                <img src="https://salesiancollege.ac.in/Admission201819/Logo/logo.png" alt="Salesian College (Autonomous) Siliguri & Sonada" class="logo" />
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
    <div class="dummy-header"></div>
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
            <div class="right-col">
                <div class="search-bar">
                    <form action="searchstudent.php" method="GET">
                        <select class="Select-Department" name="department" id="department">
                            <option value="">Select-Department</option>
                            <option value="B.Sc Computer Science">B.Sc Computer Science</option>
                            <option value="BCA">BCA</option>
                            <option value="B.Sc Mathematics">B.Sc Mathematics</option>
                        </select>
                        <div class="gap"></div>
                        <div class="grp">
                            <select class="Select-Semester" name="semester" id="semester">
                                <option value="">Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                            </select>
                            <select class="Subject" name="subject" id="subject">
                                <option value="">Subject</option>
                                <option value="CC 1">CC 1</option>
                                <option value="CC 2">CC 2</option>
                                <option value="DSE 3">DSE 3</option>
                                <option value="DSE 4">DSE 4</option>
                            </select>
                            <div class="gap"></div>
                            <button type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="show-result">
                    <table class="attendance-details">
                        <thead>
                            <tr>
                                <th class="col-1" scope="col">Roll No.</th>
                                <th class="col-2" scope="col">Name</th>
                                <th class="col-3" scope="col">Classes Attended</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['department']) && isset($_GET['semester']) && isset($_GET['subject'])) {
                                    // Get selected values
                                    $department = $_GET['department'];
                                    $semester = $_GET['semester'];
                                    $subject = $_GET['subject'];

                                    // SQL query to fetch attendance
                                    $sql = "SELECT `Roll_No.`, StudentName, COUNT(*) as classes_attended
                                            FROM `attendance table` 
                                            WHERE `Attendance Status` = 'Present' 
                                            AND Department = ?
                                            AND Semester = ? 
                                            AND SubjectName = ?
                                            GROUP BY `Roll_No.`, `StudentName`";

                                    // Prepare and bind
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("sss", $department, $semester, $subject);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . htmlspecialchars($row["Roll_No."]) . "</td>
                                                <td>" . htmlspecialchars($row["StudentName"]) . "</td>
                                                <td>" . htmlspecialchars($row["classes_attended"]) . "</td>
                                            </tr>";
                                    }
                                    $stmt->close();
                                }
                                $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Correct script tag to include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="searchjs.js"></script>
</body>
</html>
