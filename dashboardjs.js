$(document).ready(function(){
    $('#generateQRButtonSubmit').on('click', function(){
        const subject = $('#subjectSelect').val();
        if (subject) {
            const randomText = generateRandomString(10); // Generate a random string of length 10
            
            // Store subject and randomText to be used in the QR code
            $.ajax({
                type: 'POST',
                url: 'generate_qr.php',
                data: { subject: subject, qr_code: randomText },
                success: function(response) {
                    window.open('displayQR.php?data=' + encodeURIComponent(response), 'QR Code', 'width=400,height=400');
                }
            });
        } else {
            alert('Please select a subject.');
        }
    });

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
});
