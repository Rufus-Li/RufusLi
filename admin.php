<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
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
                <img src="https://salesiancollege.ac.in/wp-content/uploads/2023/06/Blue-Logo.svg" alt="Salesian College (Autonomous) Siliguri & Sonada" class="logo"/>
            </a>
        </div>
        <nav>
            QR Code Attendance System Admin / Teacher Login
        </nav>
    </div>
    <div class="container" id="blur">
        <div class="img-slider">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="https://salesiancollege.ac.in/wp-content/uploads/2023/03/Hero-Banner-New-Size-01.jpg" style="width:95%">
                    <div class="text"></div>
                </div>
                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="https://salesiancollege.ac.in/wp-content/uploads/2023/03/Hero-03.jpg" style="width:95%">
                    <div class="text"></div>
                </div>
                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="https://salesiancollege.ac.in/wp-content/uploads/2023/03/Hero-01.jpg" style="width:95%">
                    <div class="text"></div>
                </div>
            </div>
            <div style="text-align:center;padding: 5rem;">
                <span class="dot"></span>
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        </div>

        <form class="login-block" action="adminlogin.php" method="POST" autocomplete="on">
            <div class="contents">
                <div class="upper">
                    <h1>Login</h1>
                    <div class="input-box">
                        <label for="email"></label>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="input-box">
                        <label for="password"></label>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="remember-forgot">
                        <!--                           
                        <label><input type="checkbox">Remember me
                        -->
                        <a href="forgotpass.php">forgot password?</a>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="submit" class="btn">Log-in</button>
                    <button type="submit" class="btn sign" onclick="toggle()">Sign-Up</button>
                </div>
            </div>
        </form>
    </div>
    <div id="popup">
        <form action="adminsignup.php" method="POST" class="form-container">
            <div class="container-1">
                <div class="upper">
                    Sign Up
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <input type="password" name="psw" id="password" placeholder="Password" onkeyup="checkPasswordStrength(this.value)"><br>
                    <input type="password" placeholder="Renter Password" name="rpsw" required>
                </div>
                <div class="buttons2">
                    <button type="submit" name="signup" class="btn">Submit</button>
                    <button type="button" class="btn cancel" onclick="toggle()">Close</button>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <div class="logos-link">
            <ul>
                <li>
                    <a class="facebook" href="https://www.facebook.com/p/Salesian-College-Sonada-Siliguri-100064169104842/">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="twitter" href="https://twitter.com/CollegeSonada/status/1562798415364653057">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="instagram" href="https://www.instagram.com/collegesalesian">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="youtube" href="https://www.youtube.com/watch?v=aT3cIcsok0M/">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
                </li>
                </ul>
        </div>
    </footer>

</body>
<script>
    function toggle() {
        var blur=document.getElementById('blur');
        blur.classList.toggle('active');
        var popup=document.getElementById('popup');
        popup.classList.toggle('active');
    }
    let slideIndex = 0;
    showSlides();
    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 2 seconds 
    }
</script>
</html>