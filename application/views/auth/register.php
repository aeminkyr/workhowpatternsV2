<!DOCTYPE html>
<html>
<head>
	<?php if(isset($_SESSION['logged_in'])) {redirect('main/home');} ?>
	<title><?=$title?></title>
	<?php $this->load->view("dependencies/css");
	$this->load->view("components/headelements");?>
	<style type="text/css">
		.login,
		.image {
			min-height: 100vh;
		}
		.bg-image {
			background-image: url('<?=$logourl?>');
			background-size: 60%;
			background-repeat: no-repeat;
			background-position: center center;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row no-gutter">
			<!-- The image half -->
			<div class="col-md-6 d-none d-md-flex bg-image"></div>
			<!-- The content half -->
			<div class="col-md-6 bg-light">
				<div class="login d-flex align-items-center py-5">
					<!-- Demo content-->
					<div class="container">
						<div class="row">
							<div class="col-lg-10 col-xl-7 mx-auto">
								<h3 class="display-4">SQUADRON</h3>
								<p class="text-muted mb-4">Ekip üyeliğinizi tamamlamak için bilgilerinizi doğru giriniz. Sistemde kayıtlı olmayanlar üye olamamaktadır.</p>
								<form method="post" action="<?=$actionurl?>">
									<div class="form-group mb-3">
										<input id="inputName" name="name" type="text" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" placeholder="Resmi tam adınızı giriniz">
									</div>
									<div class="form-group mb-3">
										<input id="inputEmail" name="email" type="email" placeholder="Email adresinizi giriniz" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
									</div>
									<div class="form-group mb-3">
										<input id="inputPassword" name="password" type="password" placeholder="Şifre" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
									</div>
									<div class="form-group mb-3">
										<input id="inputPassword" name="password2" type="password" placeholder="Şifre tekrar" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
									</div>
									<div class="form-group mb-3">
										<h4 style="color:red; font-size: 15px;"><?=$this->session->flashdata('error');?></h4>
									</div>
									
									<button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">KAYIT OL</button>
									<a class="text-muted" href="<?=base_url('main')?>">Giriş yap!</a>
									<!--<div class="text-center d-flex justify-content-between mt-4 float-right"><p>Powered by <a href="https://inlineon.com" class="font-italic text-muted"> 
										<u>inlineon</u></a></p></div>--->
									</form>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
		<?php $this->load->view("dependencies/js");?>
	</body>
	</html>