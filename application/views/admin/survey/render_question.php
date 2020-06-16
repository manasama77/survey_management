<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>x</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/adminlte/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/adminlte/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
	<form class="form-horizontal" method="post" action="<?=site_url();?>admin/survey/update/question"> -->
<?php
foreach ($haystack as $key) {
?>
<div class="row" id="<?=$key['id_question'];?>">
	<div class="col-sm-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<div class="pull-right">
					<button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion('<?=$key['id_question'];?>')">
						<i class="fa fa-trash fa-fw"></i>
					</button>
				</div>
			</div>
			<div class="box-body">

				<div class="form-group">
					<label for="id_question" class="col-sm-2 control-label">ID Pertanyaan</label>
					<div class="col-sm-4">
						<input type="text" class="form-control pertanyaan" id="id_question[]" name="id_question[]" placeholder="ID Pertanyaan" value="<?=$key['id_question'];?>" required readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="question" class="col-sm-2 control-label">Pertanyaan</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="question[]" name="question[]" placeholder="Pertanyaan" onchange="storeQ('<?=$key['id_question'];?>', 'question', this)" value="<?=$key['pertanyaan'];?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="desc_question" class="col-sm-2 control-label">Deskripsi Pertanyaan</label>
					<div class="col-sm-8">
						<textarea class="form-control" id="desc_question[]" name="desc_question[]" placeholder="Deskripsi Pertanyaan" onchange="storeQ('<?=$key['id_question'];?>', 'desc_question', this)"><?=$key['desc_pertanyaan'];?></textarea>
					</div>
				</div>

				<div class="form-group" data-id="<?=$key['id_question'];?>">
					<label for="type_respon" class="col-sm-2 control-label">Jenis Pertanyaan</label>
					<div class="col-sm-2">
						<?php
						$p1 = NULL;
						$p2 = NULL;
						$p3 = NULL;
						$p4 = NULL;
						if($key['type_respon'] == '1'){
							$p1 = 'selected';
						}elseif($key['type_respon'] == '2'){
							$p2 = 'selected';
						}elseif($key['type_respon'] == '3'){
							$p3 = 'selected';
						}elseif($key['type_respon'] == '4'){
							$p4 = 'selected';
						}
						?>
						<select class="form-control" id="type_respon[]" name="type_respon[]" required>
							<option value=""></option>
							<option value="1" <?=$p1;?>>Ya / Tidak</option>
							<option value="2" <?=$p2;?>>Pilihan Ganda</option>
							<option value="3" <?=$p3;?>>Rating</option>
							<option value="4" <?=$p4;?>>Essay</option>
						</select>
					</div>
				</div>

				<div class="dynamic_answer">
					<?php
					if($key['type_respon'] == '1'){
						$id_a = NULL;
						$a_a  = NULL;
						$id_b = NULL;
						$a_b  = NULL;

						$id_a = $key['jawabans'][0]['id_jawaban'];
						$a_a  = $key['jawabans'][0]['jawaban'];
						$id_b = $key['jawabans'][1]['id_jawaban'];
						$a_b  = $key['jawabans'][1]['jawaban'];

						echo '
						<div class="form-group">
							<div class="col-sm-2 col-sm-offset-2">
								<div class="input-group">
									<span class="input-group-addon" style="background-color: #ccc;">A.</span>
									<input type="text" class="form-control" id="satu_a[]" name="satu_a[]" value="'.$a_a.'" onchange="updateASatu(\''.$id_a.'\', this)" required>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<span class="input-group-addon" style="background-color: #ccc;">B.</span>
									<input type="text" class="form-control" id="satu_b[]" name="satu_b[]" value="'.$a_b.'" onchange="updateASatu(\''.$id_b.'\', this)" required>
								</div>
							</div>
						</div>
						';
					}elseif($key['type_respon'] == '2'){
						foreach ($key['jawabans'] as $a) {
							echo '
							<div class="form-group" id="'.$a['id_jawaban'].'">
								<div class="col-sm-6 col-sm-offset-2">
									<input type="text" class="form-control" name="dua_a[]" value="'.$a['jawaban'].'" onchange="updateASatu(\''.$a['id_jawaban'].'\', this)" required>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-danger" onclick="deletePG(\''.$a['id_jawaban'].'\')"><i class="fa fa-trash"></i></button>
								</div>
							</div>
							';
						}
					}elseif($key['type_respon'] == '3'){
						$id_min = NULL;
						$a_min  = NULL;
						$id_max = NULL;
						$a_max  = NULL;

						array_multisort(array_column($key['jawabans'], 'jawaban'), SORT_ASC, $key['jawabans']);

						$id_min = $key['jawabans'][0]['id_jawaban'];
						$a_min  = $key['jawabans'][0]['jawaban'];
						$id_max = $key['jawabans'][1]['id_jawaban'];
						$a_max  = $key['jawabans'][1]['jawaban'];

						echo '
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<div class="input-group">
									<input type="number" class="form-control" id="tiga_a[]" name="tiga_a[]" value="'.$a_min.'" onchange="updateASatu(\''.$id_min.'\', this)" required>
									<span class="input-group-addon" style="background-color: #ccc;">S/d.</span>
									<input type="number" class="form-control" id="tiga_b[]" name="tiga_b[]" value="'.$a_max.'" onchange="updateASatu(\''.$id_max.'\', this)" required>
								</div>
							</div>
						</div>
						';

					}
					?>
				</div>

			</div>
		</div>
	</div>
</div>

<?php
}
?>
<!-- </form>

<script src="<?=base_url();?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url();?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>vendor/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url();?>vendor/adminlte/js/adminlte.min.js"></script>
<script src="<?=base_url();?>vendor/adminlte/js/demo.js"></script>
<script src="<?=base_url();?>vendor/blockui/jquery.blockUI.js"></script>

</body>
</html> -->