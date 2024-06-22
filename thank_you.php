<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You</title>
<style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Set the parent's background color */
            margin: 0;
            padding: 0;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }
        
        .modal-content {
            background-color: white;
            margin: 10% auto; /* Center the modal vertically and 10% from the top */
            padding: 20px;
            border: 1px solid #888;
            width: 60%; /* Set the width of the modal */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            max-width: 500px; /* Maximum width of the modal */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
</style>
</head>
<body>
<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h1>Thank You!</h1>
    <p>Your message has been received. We'll get back to you shortly!</p>
    <!-- Add any other content or buttons here -->
    <a href="index.php" class="btn btn-sm btn-primary">Return to Home</a>
  </div>
</div>

<script>
// Function to display the modal popup
function displayModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

// Function to close the modal popup
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

// Automatically display the modal when the page loads
window.onload = function() {
    displayModal();
    // Redirect to index.php after 3 seconds (optional)
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 3000); // 3000 milliseconds = 3 seconds
}
</script>

</body>
</html>
