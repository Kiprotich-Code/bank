<?php
// Replace with your actual database credentials
$dbuser = "root";
$dbpass = "";
$host = "localhost";
$dbname = "internetbanking";

// Establish MySQLi connection
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("MySQLi Connection failed: " . $mysqli->connect_error);
}

try {
    // Establish PDO connection using the existing MySQLi connection details
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $message = $_POST['message'];
        $status = $_POST['status'];

        // Prepare SQL statement to insert message into database using PDO
        $stmt = $pdo->prepare("INSERT INTO messages (email, message, status) VALUES (:email, :message, 'unread')");
        $stmt->execute(['email' => $email, 'message' => $message]);

        // Redirect to a thank you page or perform any other post-submission action
        header("Location: thank_you.php");
        exit();
    }
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
} finally {
    // Close MySQLi connection
    $mysqli->close();
}
?>
