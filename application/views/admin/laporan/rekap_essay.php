<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Rekap Essay <?=$nama_survey;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12" class="text-center">
				<h2>KSPPS Baytul Ikhiar</h2>
				<h3>Rekap Essay - <?=$nama_survey;?></h3>
				<h4><small><?=$desc_survey;?></small></h4>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<table class="table">
					<tr>
						<td>Responden </td>
						<td> : </td>
						<td> <?=ucfirst($jenis_responden);?></td>
					</tr>
					<tr>
						<td>Periode </td>
						<td> : </td>
						<td> <?=$periode_1_obj->format('d-M-Y').' s/d '.$periode_2_obj->format('d-M-Y');?></td>
					</tr>
					<tr>
						<td>Sumber </td>
						<td> : </td>
						<td><a href="<?=site_url().$url;?>"><?=site_url().$url;?></a></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<?php
				foreach ($arr_question->result() as $q) {
					$where_result = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
					];
					$arr_result = $this->mcore->get('result', '*', $where_result, 'answer', 'ASC', NULL, NULL);
				?>
					<table class="table table-bordered table-hover">
						<tr>
							<td width="150px">No</td>
							<td><?=$q->no_urut;?></td>
						</tr>
						<tr>
							<td width="150px">Pertanyaan</td>
							<td><?=$q->desc;?><br><small><?=$q->desc_respon;?></small></td>
						</tr>
						<tr>
							<td>Total Responden</td>
							<td><?=$arr_result->num_rows();?></td>
						</tr>
						<tr>
							<td colspan="2">
								<ol>
									<?php
									foreach ($arr_result->result() as $r) {
									?>
										<li><?=trim($r->answer);?></li>
									<?php } ?>
								</ol>
							</td>
						</tr>
					</table>
					<hr>
				<?php } ?>
			</div>
		</div>
	</div>

</body>
</html>

<script src="<?=base_url();?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url();?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>vendor/fastclick/lib/fastclick.js"></script>