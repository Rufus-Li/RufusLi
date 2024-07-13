$(document).ready(function(){
  // Function to handle successful QR code scan
  function onScanSuccess(decodeText) {
      // Check if the decoded text is a valid URL
      if (isValidUrl(decodeText)) {
          // Redirect to the scanned URL
          window.location.href = decodeText;
      } else {
          alert("Scanned content is not a valid URL.");
      }
  }

  // Helper function to check if a string is a valid URL
  function isValidUrl(url) {
      try {
          new URL(url);
          return true;
      } catch (error) {
          return false;
      }
  }

  // Initialize the QR code scanner
  let htmlscanner = new Html5QrcodeScanner("my-qr-reader", { fps: 10, qrbox: 250 });
  htmlscanner.render(onScanSuccess);
});
