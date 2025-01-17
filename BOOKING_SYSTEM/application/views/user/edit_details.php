<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">


</head>
  <body>
    
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center mb-3">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">UserPort</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number">4</span>
      </a><!-- End Notification Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have 4 new notifications
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-exclamation-circle text-warning"></i>
          <div>
            <h4>Lorem Ipsum</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>30 min. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-x-circle text-danger"></i>
          <div>
            <h4>Atque rerum nesciunt</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>1 hr. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-check-circle text-success"></i>
          <div>
            <h4>Sit rerum fuga</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>2 hrs. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-info-circle text-primary"></i>
          <div>
            <h4>Dicta reprehenderit</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>4 hrs. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
          <a href="#">Show all notifications</a>
        </li>

      </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number">3</span>
      </a><!-- End Messages Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
          You have 3 new messages
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="../assets/img/messages-1.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Maria Hudson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>4 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="../assets/img/messages-2.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Anna Nelson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>6 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="../assets/img/messages-3.jpg" alt="" class="rounded-circle">
            <div>
              <h4>David Muldon</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>8 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
          <a href="#">Show all messages</a>
        </li>

      </ul><!-- End Messages Dropdown Items -->

    </li><!-- End Messages Nav -->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata('username'); ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo $this->session->userdata('username'); ?></h6>
          <span>User</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/view_details'); ?>">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/edit_details'); ?>">
            <i class="bi bi-gear"></i>
            <span>Edit Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/logout'); ?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!--End Header-->

<br><br><br>
 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

<li class="nav-item">
      <a class="nav-link " href="<?= base_url('user/dashboard'); ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->




<li class="nav-heading">Pages</li>

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/view_slots'); ?>">
  <i class="bi bi-person"></i>
  <span>View slots</span>
</a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/view_bookings'); ?>">
  <i class="bi bi-person"></i>
  <span>My Booking</span>
</a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/view_details'); ?>">
  <i class="bi bi-person"></i>
  <span>My Profile</span>
</a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/add_details'); ?>">
  <i class="bi bi-person"></i>
  <span>Add To Profile</span>
</a>
</li><!-- End Profile Page Nav --> 

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/edit_details'); ?>">
  <i class="bi bi-person"></i>
  <span>Edit Profile</span>
</a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
<a class="nav-link collapsed" href="<?= base_url('user/logout'); ?>">
  <i class="bi bi-person"></i>
  <span>Logout</span>
</a>
</li><!--End Profile Page Nav-->

</ul>

</aside><!--End Sidebar-->
  <div class="container m-5 main" id="main">
  <h1 class="text-center mb-4">Edit Your Details</h1>
    <div class="card">
      <div class="card-body">
      <h5 class="card-title">Profile Details</h5>
   
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('user/edit_details'); ?>" method="post">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" id="full_name" class="form-control" value="<?= htmlspecialchars($details['full_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" id="dob" class="form-control" value="<?= htmlspecialchars($details['dob']); ?>" required>
        </div>
                <div class="mb-3">
                  <label for="IDno" class="form-label">ID number</label>
                  <input type="text" class="form-control" id="IDno" name="IDno" value="<?= htmlspecialchars($details['IDno']); ?>"required>
                </div>
                <div class="mb-3">
                  <label for="contact_number" class="form-label"> Contact number</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= htmlspecialchars($details['contact_number']); ?>" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label"> address</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($details['address']); ?>" required>
                </div>
                <div class="mb-3">
                  <label for="nationality" class="form-label">nationality</label>
                  <input type="text" class="form-control" id="nationality" name="nationality" value="<?= htmlspecialchars($details['nationality']); ?>" required>
                </div>
                <div class="mb-3">
                  <label for="occupation" class="form-label">occupation</label>
                  <input type="text" class="form-control" id="occupation" name="occupation" value="<?= htmlspecialchars($details['occupation']); ?>" required>
                </div>

                <div class="mb-3">
                  <label for="emergency_contact" class="form-label">Emergency Contact</label>
                  <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="<?= htmlspecialchars($details['emergency_contact']); ?>" required>
                </div>

                <div class="mb-3">
    <label for="medical_conditions" class="form-label">Medical Conditions</label>
    <textarea class="form-control" id="medical_conditions" name="medical_conditions" rows="3"><?= htmlspecialchars($details['medical_conditions']); ?></textarea>
</div>

        
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="<?= base_url('user/view_details'); ?>" class="btn btn-secondary">Cancel</a>
    </form>
    </div>
    </div>
</div>


<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>
</html>