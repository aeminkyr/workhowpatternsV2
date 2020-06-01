<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<?php $this->load->view("dependencies/css");
	$this->load->view("components/headelements");?>
	<style type="text/css">
		.navbar{
			background-color: white;
			color: black;
		}
		.card{
			background-color: #8DE4AF;
			transition: all 0.3s ease-in-out;
		}
		.listikon {
			display: none;


		}
		.card li:hover  .listikon {
			display: block;	

		}
		.card li:hover {
			transition: all 0.3s ease-in-out;
			background-color: #C3F6C0;
			border: 1px solid grey; 
			border-radius: 5px;
			padding:3px; 
		}
		.card li{
			font-family: 'Titillium Web';
			font-size: 18px;
		}
		i{
			cursor: pointer;
			text-decoration: none !important;
			border-bottom-style: none;
		}
		h4{
			font-family: 'Bowlby One SC';
		}
		.scroll {
			max-height:70vh;
			overflow-y: auto;
			margin-top: 15px;
			transition: .5s all 5s
		}
		::-webkit-scrollbar
		{
			width: 3px;
			background-color: #F5F5F5;			transition: .5s all 5s

		}
		::-webkit-scrollbar-thumb
		{
			border-radius: 10px;
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
			background-color: #555;			transition: .5s all 5s

		}
		.w3-blue{
			background: linear-gradient(339deg, rgba(8,192,255,1) 0%, rgba(90,255,164,1) 40%, rgba(25,15,52,1) 74%);
			color:black;
		}
	</style>
</head>
<body onload="addactive('home');" style="height: 100vh">
	<?php 
	$this->load->view('components/navbar');?>
	<div class="container mt-4">
		<h2><?=$single_data->cat_name?></h2>
		<small>Genel ilerleme</small>
		<div class="w3-light-grey w3-round-xlarge mb-2">
			<div class="w3-container w3-blue w3-round-xlarge" style="width:50%">50%</div>
		</div>
		<div class="col-md-6">
			<h4><button class="card" data-toggle="modal" data-target="#addlist">
				<i class="fa fa-plus-circle float-left" aria-hidden="true" >Liste oluştur</i></button></h4>
			</div>
			<div class="row">
				<?php  foreach ($select as $row) {
					?>
					<div class="col-md-4 scroll">
						<div class="card shadow mb-4">
							<div class="card-body p-3">
								<h4 class="mb-4" style="font-family: 'Bowlby One SC'; ">
									<?=$row->list_name?>
									<i class="fa fa-plus-circle float-right ml-2" aria-hidden="true" data-toggle="modal" data-target="#exampleModalCenter" data-listid="<?=$row->list_type?>" data-listname="<?=$row->list_name?>" ></i>
									<a href="<?=base_url('/main/delete_w/'.$row->cat_id."/".$row->lists_id);?>"><i class="fa fa-trash float-right" aria-hidden="true"></i></a>
								</h4>
								<ul class="list-unstyled">
									<?php 
									$list_type =$row->list_type; 
									foreach ($select_content as $row) {?>
										<?php if($list_type==$row->list_type){ ?>
											<li class="mb-2"><?=$row->content?>
											<div class="edit pl-3">
												<div class="row">
													<!--functions will come here -->
													<a href="<?=base_url("main/delete_content/".$row->cat_id."/".$row->contents_id)?>"><i class="fa fa-trash-o listikon mr-2" aria-hidden="true"></i></a>
													<a href="<?=base_url("main/adopt/".$row->cat_id."/".$row->contents_id)?>"><i class="fa fa-heart listikon pr-1" aria-hidden="true"></i></a>

												</div>
											</div>
											<div align="right">
												<a class="" href="#"><small style="text-align: right; font-style: italic;"><?=$row->name?></small></a>
											</div>
										</li>
									<?php } } 
									?>	

								</ul>
							</div>
						</div>
					</div>

				<?php	}?>
				
			</div>
			<!--row-->
		</div>
		<?php $this->load->view("dependencies/js");
		$this->load->view("components/modals");   ?>
		<script type="text/javascript">
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});
			$('#exampleModalCenter').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var listid = button.data('listid') // Extract info from data-* attributes
  var listname = button.data('listname')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(listname+ " için veri ekle")
 // modal.find('.modal-body input').val(recipient)
 list_id.setAttribute("value", listid);

})
</script>
<!--temrorary modal--->
<div class="modal fade" id="addlist" tabindex="-1" role="dialog" aria-labelledby="addlist" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addlist">Yeni liste oluştur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body card">
				<form method="post" action="<?=base_url('main/insert')?>">
					<div class="row p-3">
						<div class="col">
							<div class="form-group">
								<label for="content">Liste adı</label>
								<input name="content" class="form-control rounded-pill border-0 shadow-lg px-4" placeholder="Yapılacaklar" required></input>
							</div>
							<div class="form-group">
								<label for="roleselect">Liste Rolü Seçimi</label>
								<select class="form-control rounded-pill border-0 shadow-lg px-4" id="roleselect" name="selectrole">
									<option value="0">Yapılacaklar</option>
									<option value="1">İşlemdekiler</option>
									<option value="2">Bitenler</option>
									<option value="3">Sorun Çıkaranlar</option>
									<option value="4">Tamamen Ayrı</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
						<button type="submit" class="btn btn-success">Kaydet</button>
					</div>
					<input type="text" name="where" value="lists" hidden>
					<input type="text" name="category_id" value="<?=$single_data->cat_id?>" hidden>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>