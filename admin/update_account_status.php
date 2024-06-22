<?php
// update_account_status.php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve account_id and status from POST
    $account_id = $_POST['account_id'];
    $acc_status = $_POST['acc_status'];

    // Example: Update database with new status
    // This part depends on your database structure and how you handle updates
    // Example SQL query:
    $query = "UPDATE ib_bankaccounts SET acc_status = '$acc_status' WHERE account_id = $account_id";
    $stmt = $mysqli->prepare($query);


    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "iBank Account";
    } else {
        $err = "Please Try Again Or Try Later";
    }
    // Example: Redirect back to the page displaying accounts after update
    header("Location: pages_manage_pending_acc_openings.php");
    // exit;
}
?>
