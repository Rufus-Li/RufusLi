<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            QR Code Attendance System Login
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
            <div style="text-align:center;padding: 5rem;opacity:0">
            </div>
        </div>

        <form class="login-block" action="login.php" method="POST" autocomplete="on">
            <div class="contents">
                <div class="upper">
                    <h1>Login</h1>
                    <div class="input-box">
                        <label for="email"></label>
                        <input type="text" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-box">
                        <label for="password"></label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="remember-forgot">
                        <!--                           
                        <label><input type="checkbox">Remember me
                        -->
                        <a onclick="togglepassword()">forgot password?</a>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" name="submit" class="btn">Log-in</button>
                    <button type="submit" class="btn sign" onclick="toggle()">Sign-In</button>
                    <br><a href="admin.php">Not a student?<br>Click here!</a>
                </div>       
            </div>
        </form>
    </div>
    <div id="popup">
        <form action="signup.php" method="POST" class="form-container">
            <div class="container-1">
                <div class="upper">
                    <h1>Sign In</h1>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <input type="Name" name="Name" placeholder="Enter your Full Name" required>
                    <input type="Dept" name="Dept" placeholder="Enter your Department" required>
                    <input type="Subj" name="Subject" placeholder="Bachelor/Masters in **your subject**" required>
                    <input type="Reg-No" name="Reg-No" placeholder="Enter your Registration Number" required>
                    <input type="Roll" name="Roll" placeholder="Enter your Roll No." required>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <input type="password" placeholder="Renter Password" name="rpsw" required>
                </div>
                <br>
                <div class="buttons2">
                    <button type="submit" name="signup" class="btn">Submit</button>
                    <button type="button" class="btn cancel" onclick="toggle()">Close</button>
                </div>
            </div>
        </form>
    </div>
    <div id="forgot-password-popup">
        <form action="forgot_password.php" method="post" class="form-pass-container">
            <div class="container-2">
                <h1>Forgot Password?</h1>
                <br>
            </div>
            <div class="error"><?php echo $email_err; ?></div>
            <input type="email" name="forgot_email" placeholder="Enter your email" required>
            <br><br>
            <div class="f-p-p-buttons2">
                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn cancel" onclick="togglepassword()">Close</button>
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
    function togglepassword() {
        var blur=document.getElementById('blur');
        blur.classList.toggle('active');
        var fpopup=document.getElementById('forgot-password-popup');
        fpopup.classList.toggle('active');
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

    var email=document.forms['form']['email'];
    var password=document.forms['form']['password'];
    var email_error=document.getElementById('email_error');
    var pass_error=document.getElementById('pass_error');

    email.addEventListener('textInput', email_Verify);
    password.addEventListener('textInput', pass_Verify);

    function validated(){
        if (email.value.length < 9) {
            email.style.border = "1px solid red";
            email_error.style.display = "block";
            email.focus();
            return false;
        }
        if (password.value.length < 6) {
            password.style.border = "1px solid red";
            pass_error.style.display = "block";
            password.focus();
            return false;
        }

    }
    function email_Verify(){
        if (email.value.length >= 8) {
            email.style.border = "1px solid silver";
            email_error.style.display = "none";
            return true;
        }
    }
    function pass_Verify(){
        if (password.value.length >= 5) {
            password.style.border = "1px solid silver";
            pass_error.style.display = "none";
            return true;
        }
    }


</script>
</html>