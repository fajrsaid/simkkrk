<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | SIMKKRK</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo_sk.png') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animate/animate.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/select2/select2.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/main.css') ?>">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form action="<?php echo base_url('login/aksi_login'); ?>" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-55">
						Login
					</span>
					<?php if ($this->session->flashdata('alert_gagal')) {?>
						<div class="alert alert-danger wrap-input100 validate-input m-b-16">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php echo $this->session->flashdata('alert_gagal'); ?>
						</div>
					<?php } ?>
					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					<div class="text-center w-full p-t-115">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="<?php echo base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/popper.js') ?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/login/vendor/select2/select2.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/login/js/main.js') ?>"></script>

</body>
</html>