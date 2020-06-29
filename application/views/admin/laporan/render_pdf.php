<?php
$color_array = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399', '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933', '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];
?>
<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap/dist/css/bootstrap.min.css">
<style>
	.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
		border:0 !important;
		padding:0 !important;
		margin-left:-0.00001 !important;
	}

	.bold { font-weight: bold; }
</style>
<body>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2 class="text-center">KSPPS Baytul Ikhtiar</h2>
			<h3 class="text-center">Rekap Survey <?=$nama_survey;?></h3>
			<h4 class="text-center"><small><?=$desc_survey;?></small></h4>
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
					<td><a href=""><?=site_url().$url;?></a></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php
			$where_question = ['id_survey' => $id_master_survey];
			$arr_question   = $this->mcore->get('question', '*', $where_question, 'no_urut', 'ASC', NULL, NULL);
			$total_question = $arr_question->num_rows();
			$end_count = 1;
			foreach ($arr_question->result() as $q) {
				$no              = $q->no_urut;
				$pertanyaan      = $q->desc;
				$deskripsi       = $q->desc_respon;

				$tp = NULL;
				if($q->type_respon == '1'){
					$tp = 'Ya / Tidak';
				}elseif($q->type_respon == '2'){
					$tp = 'Pilihan Ganda';
				}elseif($q->type_respon == '3'){
					$tp = 'Rating';
				}elseif($q->type_respon == '4'){
					$tp = 'Essay';
				}

				$tipe_pertanyaan = $tp;
			?>
			<table border="1" width="100%">
				<tr>
					<td width="100px" style="padding:5px;">No</td>
					<td style="padding:5px;"><?=$no;?></td>
				</tr>
				<tr>
					<td width="100px" style="padding:5px;">Pertanyaan</td>
					<td style="padding:5px;"><?=$pertanyaan;?></td>
				</tr>
				<tr>
					<td width="100px" style="padding:5px;">Deskripsi</td>
					<td style="padding:5px;"><?=$deskripsi;?></td>
				</tr>
				<tr>
					<td class="text-center bold" style="padding:5px;" colspan="2">Jawaban</td>
				</tr>
				<?php
				if(in_array($q->type_respon, ['1', '2'])){

					echo '<tr><td style="padding:5px;" colspan="2" class="text-center">';

					$where_answer = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
					];
					$arr_answer = $this->mcore->get('answer', '*', $where_answer, 'no_urut', 'ASC', NULL, NULL);

					$data = array();
					foreach ($arr_answer->result() as $a) {
						$jawaban = $a->desc_respon;

						$where_result = [
							'id_survey'   => $id_master_survey,
							'id_question' => $q->id,
							'answer'      => $jawaban,
						];
						$count_result = $this->mcore->count('result', $where_result);

						$data[$jawaban] = $count_result;
						
					}

					$settings = array(
					  'back_colour' => '#fff',
					  'graph_title' => $pertanyaan,
					  'show_grid' => false,
					  'axis_min_h' => 0,
					  'grid_division_h' => 1,
					  'auto_fit' => false,
					  'back_stroke_width' => 0,
					  'axis_font' => 'Arial',
					  'show_data_labels' => TRUE,
					  'data_label_type' => 'linesquare',
					  'data_label_space' => 10,
					  'data_label_tail_length' => 'auto'
					);
					$graph = new Goat1000\SVGGraph\SVGGraph(650, 300, $settings);

					$graph->colours($color_array);
					$graph->values($data);
					echo $graph->Render('HorizontalBarGraph', FALSE);
					echo'</td></tr>';

				}elseif($q->type_respon == '3'){

					echo '<tr><td style="padding:5px;" colspan="2" class="text-center">';

					$where_result = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id
					];
					$arr_result = $this->mcore->get('result', 'answer', $where_result, 'answer', 'ASC', NULL, NULL, 'answer');
					$arr   = $arr_result->result();
					$count = $arr_result->num_rows();


					$ans = array();

					for ($i=0; $i < $count; $i++) { 
						$ans[$i] = $arr[$i];
					}

					array_multisort($ans, SORT_ASC);

					$ca = count($ans);
					
					$data = array();
					for($z=0; $z < $ca; $z++){
						$where_result_count = [
							'id_survey'   => $id_master_survey,
							'id_question' => $q->id,
							'answer'      => $ans[$z]->answer
						];
						$result_count = $this->mcore->count('result', $where_result_count);

						$data['Rate '.$ans[$z]->answer] = $result_count;

					}

					$settings = array(
					  'back_colour' => '#fff',
					  'graph_title' => $pertanyaan,
					  'show_grid' => false,
					  'axis_min_h' => 0,
					  'grid_division_h' => 1,
					  'auto_fit' => false,
					  'back_stroke_width' => 0,
					  'axis_font' => 'Arial',
					  'show_data_labels' => TRUE,
					  'data_label_type' => 'linesquare',
					  'data_label_space' => 10,
					  'data_label_tail_length' => 'auto'
					);
					$graph = new Goat1000\SVGGraph\SVGGraph(650, 300, $settings);

					$graph->colours($color_array);
					$graph->values($data);
					echo $graph->Render('HorizontalBarGraph', FALSE);
					echo'</td></tr>';

				}elseif($q->type_respon == '4'){
					echo '<tr><td style="padding:5px; font-size:12px;" colspan="2" class="text-center">';
					echo '<a href="">'.site_url()."admin/laporan/result_essay/".$id_master_survey.'</a>';
					echo'</td></tr>';
				}
				?>
			</table>
			<?php
				if($end_count != $total_question){
					echo '<pagebreak>';
				}
				$end_count++;
			}
			?>
		</div>
	</div>
</div>
</body>