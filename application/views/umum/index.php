<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Survey Umum | <?=$nama_survey;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/adminlte/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/adminlte/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="background-color: #ecf0f5;">
	<div class="container">
		<div class="page-header">
			<h3>
				<?=$nama_survey;?><br>
				<small><?=$desc_survey;?></small><br>
			</h3>
			<h4><small>Periode <?=$periode_from->format('d-M-Y');?> <small>s/d</small> <?=$periode_to->format('d-M-Y');?></small></h4>
		</div>

		<?php
		if($status_survey === FALSE){
			echo '<div class="alert alert-warning"><strong>Survey Telah Berakhir</strong></div>';
			exit;
		}
		?>

		<?php
		if($this->session->flashdata('success') === TRUE){
			echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Survey Telah Tersimpan, Terima Kasih</strong></div>';
		}
		?>

		<form method="post" action="<?=site_url().'umum/store/'.$url;?>">

			<div class="row">
				<div class="col-sm-6">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Biodata Responden</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="text" class="form-control" id="nama" name="nama" required>
							</div>
							<div class="form-group">
								<label for="jk">Jenis Kelamin</label>
								<div class="row">
									<div class="col-sm-4">
										<select class="form-control" id="jk" name="jk" required>
											<option value=""></option>
											<option value="l">Laki-Laki</option>
											<option value="p">Perempuan</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="umur">Umur</label>
								<div class="row">
									<div class="col-sm-2">
										<input type="number" class="form-control" id="umur" name="umur" min="17" max="99" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pendidikan">Pendidikan</label>
								<input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			if($question->num_rows() > 0){
				foreach ($question->result() as $key_q) {

					if(in_array($key_q->type_question, ['1', '2'])){

						$html_answer = '<div class="form-group">';
						foreach ($answer->result() as $key_a) {

							if($key_a->id_question == $key_q->id_question){
								$html_answer .= '
								<div class="radio">
									<label><input type="radio" name="'.$key_a->id_question.'" value="'.$key_a->answer.'" required> '.$key_a->answer.'</label>
								</div>
								';
							}
						}
						$html_answer .= '</div>';

						$html_render = '
						<div class="row">
							<div class="col-sm-12">
								<div class="box box-warning">
									<div class="box-body">
										<div id="row">
											<label>'.$key_q->question.'</label>
											<p class="help-block">'.$key_q->desc_question.'</p>
											'.$html_answer.'
										</div>
									</div>
								</div>
							</div>
						</div>
						';

						echo $html_render;

					}elseif($key_q->type_question == '3'){

						$html_answer = '<div class="form-group"><div class="row"><div class="col-sm-2">';

						$rating = array();
						foreach ($answer->result() as $key_a) {

							if($key_a->id_question == $key_q->id_question){
								$rating[] = $key_a->answer;
							}

						}

						$html_answer .= '
						<input type="number" class="form-control" id="'.$key_q->id_question.'" name="'.$key_q->id_question.'" min="'.min($rating).'" max="'.max($rating).'" required>
						';
						$html_answer .= '</div></div></div>';

						$html_render = '
						<div class="row">
							<div class="col-sm-12">
								<div class="box box-warning">
									<div class="box-body">
										<div id="row">
											<label>'.$key_q->question.'</label>
											<p class="help-block">'.$key_q->desc_question.'</p>
											'.$html_answer.'
										</div>
									</div>
								</div>
							</div>
						</div>
						';

						echo $html_render;
					}elseif($key_q->type_question == '4'){

						$html_answer = '<div class="form-group"><div class="row"><div class="col-sm-12"><textarea class="form-control" id="'.$key_q->id_question.'" name="'.$key_q->id_question.'" required></textarea></div></div></div>';

						$html_render = '
						<div class="row">
							<div class="col-sm-12">
								<div class="box box-warning">
									<div class="box-body">
										<div id="row">
											<label>'.$key_q->question.'</label>
											<p class="help-block">'.$key_q->desc_question.'</p>
											'.$html_answer.'
										</div>
									</div>
								</div>
							</div>
						</div>
						';

						echo $html_render;
					}
			?>

			<?php
				}
			}
			?>

			<div class="row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
				</div>
			</div>

		</form>

		<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
			<div class="col-sm-12">
				<hr>
				<div class="pull-right hidden-xs">
					<b>Survey Management Version</b> 0.0.1
				</div>
				<strong>Copyright &copy; 2020 <a href="baytulikhtiar.com">Baytul Ikhtiar</a>.</strong>
			</div>
		</div>
	</div>
	
	<script src="<?=base_url();?>vendor/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url();?>vendor/fastclick/lib/fastclick.js"></script>
	<script src="<?=base_url();?>vendor/blockui/jquery.blockUI.js"></script>
	<script src="<?=base_url();?>vendor/adminlte/js/adminlte.min.js"></script>
</body>
</html>

<script>
	$(document).ready(function(){

	});
</script>