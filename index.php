<?php
include("admin/conf/config.php");
/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `iB_SystemSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CitiBank</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="dist/css/robust.css" rel="stylesheet">
        <link href="dist/css/test.css" rel="stylesheet">
        
    </head>

    <body>

        <nav class="navbar navbar-lg navbar-expand-lg navbar-transparant navbar-dark navbar-absolute w-100">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="dist/logo.webp" alt="" style="width: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="#">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="#features">Features</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_blank" href="#values">Values</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Signin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin/pages_index.php">Admin</a></li>
                                <li><a class="dropdown-item" href="client/pages_client_index.php">Client</a></li>
                                <li><a class="dropdown-item" href="staff/pages_staff_index.php">Staff</a></li>
                            </ul>
                        </li>
                    </ul>
                    <a class="btn btn-primary" href="client/pages_client_signup.php" target="_blank">Join Us</a>
                </div>
            </div>
        </nav>

        <div class="intro py-6 position-relative text-white">
            <div class="bg-overlay-gray">
                <img src="dist/market-analyze.webp" class="img-fluid img-cover"/>
            </div>
            <div class="intro-content py-6">
                <div class="container">
                    <div class="row"> 
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                            <h1 class="my-3 display-4 d-lg-inline-block fade-in">It's Time Unlock Your Business Potential</h1>
                            <p class="lead mb-2 d-none d-md-block fw-lighter fade-in">
                            Simplify Your Finances with Our Online Banking Services

                            Welcome to the future of banking where convenience meets security. We believe in providing you with a seamless online banking experience that caters to your financial needs.
                            </p>
                            <br>
                            <a class="btn btn-primary mr-lg-2 mb-3 fade-in" target="_blank" href="client/pages_client_signup.php" role="button">Get Started</a>
                        </div>

                        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                            <img src="./dist/smile.jpg" alt="" style="height: 400px; width:100%;" class="rounded">
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <!-- hero  -->
         <div class="py-md-5">
            <div class="row p-5">
                <div class="col fade-in">
                    <img src="./dist/test.webp" alt="" style="width: 100%;">
                </div>
                <div class="col col-12 col-md-6">
                    <h5 class="display-4 py-2 py-md-0">Take Control of Your <strong class="text-primary">Money</strong></h5>
                    <h3 class="py-3">Finances at Your Fingertips</h3>
                    <ul>
                        <li>Harness real-time transaction alerts and insights to stay informed and proactive about your financial decisions.</li><br>
                        <li>Access expert advice and resources to navigate financial milestones like buying a home or planning for retirement confidently.</li><br>
                        <li>Customize investment strategies to align with your long-term goals, maximizing returns and securing your financial future</li><br>
                    </ul>
                </div>
               
            </div>
        </div>

        <!-- Features  -->
        <section id="features">
            <div class="py-md-5">
             <div class="container-fluid  p-5">
            <h5 class="small fw-lighter d-md-none py-2 fade-in"># What Set's Us Apart</h5>
             <h2 class="px-5 py-3 w-75 display-4 d-none d-md-block fade-in">Empower Your Business With Our Cutting-Edge <strong class="text-primary">Features</strong></h2>
             <div class="d-flex flex-wrap gap-3 justify-content-around">
                <div class="card mb-3 fade-in" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="./dist/market-analyze.webp" class="img-fluid rounded-start" alt="..." style="height:100%">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Expert Advice and Support</h5>
                            <p class="card-text">Gain peace of mind with personalized financial guidance from seasoned experts, available whenever you need it, directly through our secure online platform.</p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="./dist/loans.webp" class="img-fluid rounded-start" alt="..." style="height:100%;">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Wide Range of Loan Products</h5>
                            <p class="card-text">Discover a comprehensive array of flexible loan options tailored to meet your diverse financial needs, all conveniently accessible through our intuitive online platform.</p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 fade-in" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="./dist/happy.webp" class="img-fluid rounded-start" alt="..." style="height:100%;">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Flexible Payment Options</h5>
                            <p class="card-text">Empower your financial journey with our adaptable payment solutions, designed to fit your lifestyle and goals seamlessly, ensuring convenience and peace of mind.</p>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="./dist/sman.webp" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Quick Aproval Process</h5>
                            <p class="card-text">Experience swift approvals with our streamlined process, ensuring you get the funds you need promptly and hassle-free.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- hero  -->
         <div class="container-fluid intro py-6 position-relative text-white">
            <div class="bg-overlay-gray">
                <img src="dist/market-analyze.webp" class="img-fluid img-cover"/>
            </div>
            <div class="intro-content">
                <div class="row p-5 text-center">
                    <div class="col col-md-8 m-auto">
                        <h5 class="text-dark">It's About Time! </h5>
                        <hr>
                        <h1>
                        Ready to take charge of your financial journey? Join us and discover personalized solutions designed to empower your financial success.
                        </h1>
                        <a class="btn btn-outline-light btn-lg my-3" href="client/pages_client_signup.php">Get Started</a>
                    </div>
                </div>
            </div>
         </div>

        <!-- Values  -->
        <!-- Testimonials Section -->
        <section id="values">
        <div class="testimonials-clean">
            <div class="container py-5">
            <div class="intro">
                <h2 class="text-center text-primary fade-in">Our Values </h2>
                <p class="text-center fade-in">We go above and beyond to exceed our clients' expectations and build long-lasting
                relationships based on trust and mutual respect.</p>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">We uphold honesty and ethical standards in everything we do. Integrity is the cornerstone of our relationships with customers, partners, and each other, ensuring trust and credibility in all interactions. </p>
                </div>
                <div class="author"><img class="rounded-circle" src="./dist/sman.webp">
                    <h5 class="name">Integrity</h5>
                    <p class="title text-primary"># Value 1</p>
                </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">We prioritize understanding and meeting the needs of our customers. By listening actively and responding proactively, we create valuable experiences that build long-term relationships and loyalty.</p>
                </div>
                <div class="author"><img class="rounded-circle" src="./dist/happy.webp">
                    <h5 class="name">Customer Focus</h5>
                    <p class="title text-primary"># Value 2</p>
                </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">We take ownership of our actions and commitments. Accountability ensures that we deliver on our promises, learn from mistakes, and maintain transparency and trust within our team and with those we serve.
                    </p>
                </div>
                <div class="author"><img class="rounded-circle" src="./dist/sman.webp">
                    <h5 class="name">Accountability</h5>
                    <p class="title text-primary"># Value 3</p>
                </div>
                </div>
            </div>
            </div>
        </div>
</section>

  <!-- footer  -->
  <footer>
    <div class="container-fluid bg-dark text-white">
      <div class="container py-5">
        <div class="row p-3">
          <div class="col-12 col-md-6">
            <h4 class="text-info fade-in">Why Us ?</h4>
            <p class="fade-in">
            Imagine a world where managing your finances is effortless and empowering. At our company, we provide innovative solutions that simplify financial management, ensuring you achieve your goals with confidence and ease
            </p>
          </div>
          <div class="col-12 col-md-3">
            <h5 class="text-info py-2">Useful Links</h5>
            <ul>
              <li><a class="text-decoration-none text-white" href="#">Home</a></li>
              <li><a class="text-decoration-none text-white" href="#">Features</a></li>
              <li><a class="text-decoration-none text-white" href="#">Get Started</a></li>
            </ul>
          </div>
          <div class="col-12 col-md-3">
            <h5 class="text-info py-2">Security</h5>
            <ul>
              <li><a class="text-decoration-none text-white" href="#">Policy</a></li>
              <li><a class="text-decoration-none text-white" href="#">User Agreements</a></li>
              <li><a class="text-decoration-none text-white" href="#">Copyright</a></li>
            </ul>
          </div>
        </div>
        <div class="text-center py-3">
          <h3 class="fw-lighter text-info small">CITIBANK - 2024</h3>
        </div>
      </div>
  </footer>

    <div class="fb">
        <button type="button" class="btn btn-warning p-3 floating-button" onclick="openSupportChat()">
            <i class="fas fa-comment-dots mr-2"></i> Feeling Lost? We're Here To Help!
        </button>
        <!-- Example modal or chat interface to be displayed -->
        <div id="supportChatModal" style="display: none;">
            <button id="closeSupportChat" style="position: absolute; top: 10px; right: 10px; background: none; border: none;">
                <i class="fas fa-times"></i>
            </button>
            <h5>Support Chat</h5>
            <form id="supportForm" method="post" action="send_message.php">
                <!-- <label for="username">Your Name:</label> -->
                <input type="text" class="form-control" id="email" placeholder="Email Address" name="email" required><br>
                
                <!-- <label for="message">Message:</label><br> -->
                <textarea id="message" class="form-control" placeholder="Message" name="message" rows="4" cols="50" required></textarea><br>
                
                <input type="submit" value="Ask For Help" class="btn btn-primary btn-sm">
            </form>
        </div>
    </div>
        <script src="./dist/js/test.js"></script>
        <script src="dist/js/bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    </body>

    </html>
<?php
} ?>