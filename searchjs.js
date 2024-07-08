
const homeNavLink = document.querySelector('.search-nav');
homeNavLink.classList.add('active');

const buttons=document.querySelectorAll('.btn-primary');
buttons.forEach(button => {
    button.addEventListener('click',()=>{
        buttons.forEach(btn => 
            btn.classList.remove('active')
        );
        button.classList.add('active');
    });
});

$(document).ready(function(){
    // Function to generate a random string
    function generateRandomString(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    // Event listener for the button
    $('#generateQR').on('click', function(){
        const randomText = generateRandomString(10); // Generate a random string of length 10
        // Open a new window with the QR code
        window.open('displayQR.php?data=' + encodeURIComponent(randomText), 'QR Code', 'width=400,height=400');
    });
});