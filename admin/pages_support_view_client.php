<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];

if (isset($_POST['update_client_account'])) {
    // Update client details
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_id = $_GET['client_id']; // Updated to use client_id
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Handle profile picture upload
    $profile_pic = $_FILES["profile_pic"]["name"];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "dist/img/" . $_FILES["profile_pic"]["name"]);

    // Update query to use client_id
    $query = "UPDATE iB_clients SET name=?, national_id=?, phone=?, email=?, address=?, profile_pic=? WHERE client_id = ?";
    $stmt = $mysqli->prepare($query);
    // Bind parameters
    $stmt->bind_param('ssssssi', $name, $national_id, $phone, $email, $address, $profile_pic, $client_id);
    $stmt->execute();

    // Handle success or error
    if ($stmt) {
        $success = "Client Account Updated";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

// Change password
if (isset($_POST['change_client_password'])) {
    $password = sha1(md5($_POST['password']));
    $client_id = $_GET['client_id']; // Updated to use client_id

    // Update query to use client_id
    $query = "UPDATE iB_clients SET password=? WHERE client_id=?";
    $stmt = $mysqli->prepare($query);
    // Bind parameters
    $stmt->bind_param('si', $password, $client_id);
    $stmt->execute();

    // Handle success or error
    if ($stmt) {
        $success = "Client Password Updated";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

// Send Message to Client
if (isset($_POST['send_message'])) {
    $message = mysqli_real_escape_string($mysqli, $_POST['message']);
    $client_id = $_GET['client_id']; // Updated to use client_id

    // Insert message into client_messages table
    $query = "INSERT INTO client_messages (client_id, message, date_sent) VALUES (?, ?, NOW())";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('is', $client_id, $message);

    if ($stmt->execute()) {
        $success = "Message sent successfully!";
    } else {
        $err = "Error sending message: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
        <?php
        $client_id = $_GET['client_id'];
        $ret = "SELECT * FROM iB_clients WHERE client_id = ?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {
            // Set default profile picture if not updated
            if ($row->profile_pic == '') {
                $profile_picture = "<img class='img-fluid' src='dist/img/user_icon.png' alt='User profile picture'>";
            } else {
                $profile_picture = "<img class='img-fluid' src='dist/img/$row->profile_pic' alt='User profile picture'>";
            }
        ?>
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?php echo $row->name; ?> Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_manage_clients.php">iBanking Clients</a></li>
                                <li class="breadcrumb-item"><a href="pages_manage_clients.php">Manage</a></li>
                                <li class="breadcrumb-item active"><?php echo $row->name; ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="card card-purple card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <?php echo $profile_picture; ?>
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $row->name; ?></h3>
                                    <p class="text-muted text-center">Client @iBanking</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>ID No.: </b> <a class="float-right"><?php echo $row->national_id; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Email: </b> <a class="float-right"><?php echo $row->email; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phone: </b> <a class="float-right"><?php echo $row->phone; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Client ID: </b> <a class="float-right"><?php echo $row->client_id; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address: </b> <a class="float-right"><?php echo $row->address; ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#update_Profile" data-toggle="tab">Update Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#send_message" data-toggle="tab">Send Message</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- Update Profile -->
                                        <div class="tab-pane active" id="update_Profile">
                                            <form method="post" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="name" required class="form-control" value="<?php echo $row->name; ?>" id="inputName">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="email" required value="<?php echo $row->email; ?>" class="form-control" id="inputEmail">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Contact</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" required name="phone" value="<?php echo $row->phone; ?>" id="inputName2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">National ID Number</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" required name="national_id" value="<?php echo $row->national_id; ?>" id="inputName2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" required name="address" value="<?php echo $row->address; ?>" id="inputName2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Profile Picture</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="profile_pic" id="inputName2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" name="update_client_account" class="btn btn-warning">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                            
                                        <!-- /.tab-pane -->

                                        <!-- Send Message -->
                                        <div class="tab-pane" id="send_message">
                                            <form method="post" class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Message</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="message" required class="form-control" rows="5" placeholder="Type your message here"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" name="send_message" class="btn btn-success">Send Message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        <?php } ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include("dist/_partials/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
