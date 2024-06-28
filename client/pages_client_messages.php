<?php
session_start();
include('conf/config.php'); // Include configuration file
include('conf/checklogin.php');
check_login();

if (!isset($_SESSION['client_id'])) {
    header("location: index.php"); // Redirect to login page if session client_id is not set
    exit();
}

$client_id = $_SESSION['client_id'];

// Check if message is provided
if (isset($_POST['message'])) {
    // Sanitize input
    $message = htmlspecialchars($_POST['message']);
    
    // Prepare insert statement
    $stmt = $mysqli->prepare("INSERT INTO client_messages (client_id, message, date_sent) VALUES (?, ?, NOW())");
    $stmt->bind_param('is', $client_id, $message); // 'is' for integer (client_id) and string (message)

    // Execute and check for success
    if ($stmt->execute()) {
        // Redirect back to messages page after successful insertion
        header("location: pages_client_messages.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch all messages for the logged-in client
$ret = "SELECT * FROM client_messages WHERE client_id = ?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $client_id);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="../dist/css/test.css" rel="stylesheet">
    <?php include("dist/_partials/head.php"); ?>
    <!-- Include CSS and JS dependencies -->
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("dist/_partials/nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("dist/_partials/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Support</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="pages_deposits">iBank Finances</a></li>
              <li class="breadcrumb-item active">Messages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Inbox<?php echo"$client_id"?></h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Message</th>
                    <th>Timestamp</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cnt = 1;
                  while ($row = $res->fetch_object()) {
                    //Trim Timestamp to DD-MM-YYYY : H-M-S
                    $date_sent = date_format(date_create($row->date_sent), 'd-m-Y H:i:s');
                  ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $row->message; ?></td>
                      <td><?php echo $date_sent; ?></td>
                    </tr>
                    <?php
                    $cnt++;
                  }
                  ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->

    <div class="fb p-3">
        <button type="button" class="btn btn-primary p-3 floating-button rounded" onclick="openSupportChat()">
            <i class="fas fa-comment-dots mr-2"></i> Feeling Lost? We're Here To Help!
        </button>
        <!-- Example modal or chat interface to be displayed -->
        <div id="supportChatModal" style="display: none;">
            <button id="closeSupportChat" style="position: absolute; top: 10px; right: 10px; background: none; border: none;">
                <i class="fas fa-times"></i>
            </button>
            <h5>Support Chat</h5>
            <form id="supportForm" method="post" action="pages_client_messages.php">
                <textarea id="message" class="form-control" placeholder="Message" name="message" rows="4" cols="50" required></textarea><br>
                <input type="submit" value="Send Message" class="btn btn-primary btn-sm">
            </form>
        </div>
    </div>
  </div><!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside><!-- /.control-sidebar -->
</div><!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables initialization -->
<script>
  $(function () {
    $("#example1").DataTable();
  });

  function openSupportChat() {
    document.getElementById('supportChatModal').style.display = 'block';
  }

  document.getElementById('closeSupportChat').addEventListener('click', function() {
    document.getElementById('supportChatModal').style.display = 'none';
  });
</script>
</body>
</html>
