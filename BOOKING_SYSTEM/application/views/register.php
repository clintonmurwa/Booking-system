<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
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
<body class="d-flex justify-content-center align-items-center vh-100">

<!-- Loader Element -->
<div class="loader-container" id="loaderContainer">
    <div class="loader"></div>
    <div class="loader-text">Registering...</div>
</div>
<div class="container">

<div class="card">
	<div class="row justify-content-center">
		<div class="col-4">
			<?php
		    	if(validation_errors()){
		    		?>
		    		<div class="alert alert-info text-center">
		    			<?php echo validation_errors(); ?>
		    		</div>
		    		<?php
		    	}
 
				if($this->session->flashdata('message')){
					?>
					<div class="alert alert-info text-center">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
					<?php
					unset($_SESSION['message']);
				}
		    ?>
         
            <div class="card-body">
            <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
			<form id="signupForm" method="POST" action="<?php echo base_url().'user/register'; ?>">
				<div class="col-12">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" required value="<?= set_value('username'); ?>" />
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
				</div>
				<div class="form-group">
					<label for="password_confirm">Confirm Password:</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>">
				</div>
				<button type="submit" class="btn btn-primary">Register</button>
				
				<p>Already have an account? <a href="<?php echo base_url('user/login'); ?>">Login</a></p>


			</form>
            </div>
            
		</div>
		
	</div>
	</div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

<!-- JavaScript to handle loader and form submit -->
<script>
    document.getElementById('signupForm').addEventListener('submit', function() {
        // Show loader and message when form is submitted
        document.getElementById('loaderContainer').style.display = 'flex';
        
        // Disable form submission to prevent multiple clicks
        this.classList.add('form-submitting');
    });
</script>
</body>
</html>