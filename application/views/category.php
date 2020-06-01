<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<?php $this->load->view("dependencies/css");
	$this->load->view("components/headelements");?>
</head>
<body>
	<?php $this->load->view('components/navbar');?>
	<div class="container" style="height: 100vh;">
		<div class="row">
			<div class="col-md-6">
				<h4><button class="card" data-toggle="modal" data-target="#addcategory">
					<i class="fa fa-plus-circle float-left" aria-hidden="true" ></i></button></h4>
				</div>
			</div>
			

			<div class="row">
				<?php $s="0"; foreach ($select as $row) { ?>
					<div class="col-md-6">
						<div class="card shadow mb-4 mt-4">

							<div class="card-body p-3">
								<a href="<?=base_url("main/lists/".$row->cat_id)?>"><h4><?=$row->cat_name?></h4></a>
								<small><?=$row->cat_description?></small>
							</div>
							<div class="edit pl-4 p-2">
								<div class="row">
									<!--functions will come here -->
									<a href="<?=base_url('main/delete_category/'.$row->cat_id)?>"><i class="fa fa-trash-o listikon mr-2" aria-hidden="true"></i></a>

								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>

		</div>
		<?php $this->load->view("dependencies/js");?>
		<!-- Modal -->
		<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addcategory">Yeni liste kategorisi oluştur</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body card">
						<form method="post" action="<?=base_url('main/insert')?>">
							<div class="row p-3">
								<div class="col">
									<input name="content" class="form-control rounded-pill border-0 shadow-lg px-4" placeholder="Vortex SM Ön Rapor" required></input>
									<small>İşi tanımlayan en etkili cümleyi yazınız</small>
									<input name="description" class="form-control rounded-pill border-0 shadow-lg px-4" placeholder="Yarışmaya katılmak için gereken ön rapor hazırlanma işlemleri" required></input>
									<small>Kısa bir açıklama giriniz.</small>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
								<button type="submit" class="btn btn-success">Kaydet</button>
							</div>
							<input type="text" name="where" value="category" hidden>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>