<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('phpexcel');
		$this->load->model('M_laporan', 'mlapor');
	}

	public function index($id_master_survey = NULL)
	{
		$where_master_survey = ['id' => $id_master_survey];
		$arr_master_survey = $this->mcore->get('master_survey', '*', $where_master_survey, NULL, 'ASC', NULL, NULL);

		if($arr_master_survey->num_rows() == 0)
		{
			show_error('Survey tidak ditemukan', 404, 'Terjadi kesalahan');
			exit;
		}

		$where_responden = ['id_survey' => $id_master_survey];
		$arr_responden   = $this->mcore->get('responden', '*', $where_responden, NULL, 'ASC', NULL, NULL);

		if($arr_responden->num_rows() == 0)
		{
			show_error('Tidak ada Responden Survey', 404, 'Terjadi kesalahan');
			exit;
		}

		$where_question = ['id_survey' => $id_master_survey];
		$arr_question   = $this->mcore->get('question', '*', $where_question, 'no_urut', 'ASC', NULL, NULL);

		foreach ($arr_question->result() as $q) {
			$pertanyaan      = $q->desc;
			$tipe_pertanyaan = $this->_tipe_pertanyaan($q->type_respon);

			echo $pertanyaan;
			echo '<br>';
			echo $tipe_pertanyaan;
			echo '<br>';

			$where_answer = [
				'id_survey' => $id_master_survey,
				'id_question' => $q->id,
			];
			$arr_answer = $this->mcore->get('answer', '*', $where_answer, 'no_urut', 'ASC', NULL, NULL);

			if(in_array($q->type_respon, ['1', '2'])){
				foreach ($arr_answer->result() as $a) {
					$jawaban = $a->desc_respon;

					$where_result = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
						'answer'      => $jawaban,
					];
					$count_result = $this->mcore->count('result', $where_result);

					echo $jawaban." = ".$count_result."<br>";
				}
			}elseif($q->type_respon == '3'){
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
				
				for($z=0; $z < $ca; $z++){
					$where_result_count = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
						'answer'      => $ans[$z]->answer
					];
					$result_count = $this->mcore->count('result', $where_result_count);
					echo $ans[$z]->answer.' = '.$result_count.'<br>';
				}

			}elseif($q->type_respon == '4'){
				// $where_result = [
				// 	'id_survey'   => $id_master_survey,
				// 	'id_question' => $q->id
				// ];
				// $arr_result = $this->mcore->get('result', '*', $where_result, 'answer', 'ASC', NULL, NULL);
				// foreach ($arr_result->result() as $r) {
				// 	echo $r->answer;
				// 	echo '<br>';
				// 	echo '<br>';
				// }
			}

			echo '<br>';
			echo '<hr>';

		}

	}

	public function export_survey_xls($id_master_survey = NULL)
	{
		$where_master_survey = ['id' => $id_master_survey];
		$arr_master_survey   = $this->mcore->get('master_survey', '*', $where_master_survey, NULL, 'ASC', NULL, NULL);

		if($arr_master_survey->num_rows() == 0)
		{
			show_error('Survey tidak ditemukan', 404, 'Terjadi kesalahan');
			exit;
		}

		$where_responden = ['id_survey' => $id_master_survey];
		$arr_responden   = $this->mcore->get('responden', '*', $where_responden, NULL, 'ASC', NULL, NULL);

		if($arr_responden->num_rows() == 0)
		{
			show_error('Tidak ada Responden Survey', 404, 'Terjadi kesalahan');
			exit;
		}

		$nama_survey     = $arr_master_survey->row()->nama_survey;
		$desc_survey     = $arr_master_survey->row()->desc_survey;
		$jenis_responden = $arr_master_survey->row()->jenis_responden;
		$url             = $arr_master_survey->row()->url;
		$periode_1_obj   = new DateTime($arr_master_survey->row()->periode_survey_1);
		$periode_2_obj   = new DateTime($arr_master_survey->row()->periode_survey_2);

		$e             = new PHPExcel();
		$cacheMethod   = PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		$cacheSettings = array('dir' => base_url());
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

		$e->getProperties()
		->setCreator("KSPPS BAIK")
		->setLastModifiedBy("KSPPS BAIK")
		->setTitle("Rekap Survey ".$nama_survey)
		->setSubject("")
		->setDescription("")
		->setKeywords("rekap,survey")
		->setCategory("survey");

		$e->createSheet(0);
		$e->createSheet(1);

		$e->setActiveSheetIndex(0);
		$e->getActiveSheet()->setTitle("Informasi Survey");

		$e->getActiveSheet()->getColumnDimension('A')->setWidth(2);
		$e->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('C')->setWidth(50);

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '16'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle("B2:E2")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B2:E2');
		$e->getActiveSheet()->setCellValue('B2', "KSPPS BAYTUL IKHTIAR");

		$e->getActiveSheet()->getStyle("B3:E3")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B3:E3');
		$e->getActiveSheet()->setCellValue('B3', "Rekap Survey ".$nama_survey);

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '12'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle("B4:E4")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B4:E4');
		$e->getActiveSheet()->setCellValue('B4', $desc_survey);

		$e->getActiveSheet()->getStyle("B5:E5")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('B5:E5');
		$e->getActiveSheet()->setCellValue('B5', NULL);

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle("B6")->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('B6', 'Responden');

		$e->getActiveSheet()->getStyle("B7")->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('B7', 'Periode');

		$e->getActiveSheet()->getStyle("B8")->applyFromArray($style);
		$e->getActiveSheet()->setCellValue('B8', 'Sumber');

		$style = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$e->getActiveSheet()->getStyle("C6:E6")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('C6:E6');
		$e->getActiveSheet()->setCellValue('C6', ucfirst($jenis_responden));

		$e->getActiveSheet()->getStyle("C7:E7")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('C7:E7');
		$e->getActiveSheet()->setCellValue('C7', $periode_1_obj->format('d-M-Y').' s/d '.$periode_2_obj->format('d-M-Y'));

		$e->getActiveSheet()->getStyle("C8:E8")->applyFromArray($style);
		$e->getActiveSheet()->mergeCells('C8:E8');
		$e->getActiveSheet()->setCellValue('C8', site_url().$url);

		// SHEET 2
		
		$e->setActiveSheetIndex(1);
		$e->getActiveSheet()->setTitle("Rekap Survey");

		$e->getActiveSheet()->getColumnDimension('A')->setWidth(2);
		$e->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$e->getActiveSheet()->getColumnDimension('C')->setWidth(50);

		$style_1 = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$style_2 = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$style_3 = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => FALSE,
				'size' => '11'
			]
		];

		$style_4 = [
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP
			],
			'font' => [
				'bold' => TRUE,
				'size' => '11'
			],
			'borders' => [
				'allborders' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => ['rgb' => '000000'],
				],
			]
		];

		$where_question = ['id_survey' => $id_master_survey];
		$arr_question   = $this->mcore->get('question', '*', $where_question, 'no_urut', 'ASC', NULL, NULL);

		$row = 2;
		foreach ($arr_question->result() as $q) {

			$no              = $q->no_urut;
			$pertanyaan      = $q->desc;
			$deskripsi       = $q->desc_respon;
			$tipe_pertanyaan = $this->_tipe_pertanyaan($q->type_respon);

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style_1);
			$e->getActiveSheet()->setCellValue('B'.$row, "No");

			$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style_2);
			$e->getActiveSheet()->setCellValue('C'.$row, $no);

			$row++;

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style_1);
			$e->getActiveSheet()->setCellValue('B'.$row, "Pertanyaan");

			$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style_2);
			$e->getActiveSheet()->setCellValue('C'.$row, $pertanyaan);

			$row++;

			$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style_1);
			$e->getActiveSheet()->setCellValue('B'.$row, "Deskripsi");

			$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style_2);
			$e->getActiveSheet()->setCellValue('C'.$row, $deskripsi);

			$row++;

			$e->getActiveSheet()->getStyle("B".$row.":C".$row)->applyFromArray($style_4);
			$e->getActiveSheet()->mergeCells("B".$row.":C".$row);
			$e->getActiveSheet()->setCellValue('B'.$row, "Jawaban");

			$row++;

			$where_answer = [
				'id_survey' => $id_master_survey,
				'id_question' => $q->id,
			];
			$arr_answer = $this->mcore->get('answer', '*', $where_answer, 'no_urut', 'ASC', NULL, NULL);

			if(in_array($q->type_respon, ['1', '2'])){
				foreach ($arr_answer->result() as $a) {
					$jawaban = $a->desc_respon;

					$where_result = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
						'answer'      => $jawaban,
					];
					$count_result = $this->mcore->count('result', $where_result);

					$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style_2);
					$e->getActiveSheet()->setCellValue('B'.$row, $jawaban);

					$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style_2);
					$e->getActiveSheet()->setCellValue('C'.$row, $count_result);

					$row++;
				}
			}elseif($q->type_respon == '3'){
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
				
				for($z=0; $z < $ca; $z++){
					$where_result_count = [
						'id_survey'   => $id_master_survey,
						'id_question' => $q->id,
						'answer'      => $ans[$z]->answer
					];
					$result_count = $this->mcore->count('result', $where_result_count);

					$e->getActiveSheet()->getStyle("B".$row)->applyFromArray($style_2);
					$e->getActiveSheet()->setCellValue('B'.$row, $ans[$z]->answer);

					$e->getActiveSheet()->getStyle("C".$row)->applyFromArray($style_2);
					$e->getActiveSheet()->setCellValue('C'.$row, $result_count);

					$row++;
				}
			}elseif($q->type_respon == '4'){
				$e->getActiveSheet()->getStyle("B".$row.":C".$row)->applyFromArray($style_4);
				$e->getActiveSheet()->mergeCells("B".$row.":C".$row);
				$e->getActiveSheet()->setCellValue('B'.$row, site_url()."laporan/result_essay/".$id_master_survey);

				$row++;
			}

			$row++;

			$e->getActiveSheet()->getStyle("B".$row.":C".$row)->applyFromArray($style_3);
			$e->getActiveSheet()->mergeCells("B".$row.":C".$row);
			$e->getActiveSheet()->setCellValue('B'.$row, NULL);

			$row++;

		}

		// END SHEET 2

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Cache-Control: max-age=0');
		header('Content-Disposition: attachment;filename="Rekap Survey '.$nama_survey.'.xlsx"');
		$objWriter = PHPExcel_IOFactory::createWriter($e, 'Excel2007');
		$objWriter->save('php://output');

		$e->disconnectWorksheets();
		unset($e);
	}

	public function export_survey_pdf($id_master_survey = NULL)
	{
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello World!</h1>');
		$mpdf->Output();
	}

	public function _tipe_pertanyaan($tp)
	{
		if($tp == '1'){
			return 'Ya / Tidak';
		}elseif($tp == '2'){
			return 'Pilihan Ganda';
		}elseif($tp == '3'){
			return 'Rating';
		}elseif($tp == '4'){
			return 'Essay';
		}


	}

}

/* End of file LaporanController.php */
/* Location: ./application/controllers/LaporanController.php */