<link rel="stylesheet" href="<?=base_url();?>vendor/datatables/datatables.min.css">
<script src="<?=base_url();?>vendor/datatables/datatables.min.js"></script>
<script>
	$(document).ready(function(){
		table = $('#datatables').DataTable({
			"destroy": true,
			"responsive": true,
			"processing": true, 
			"serverSide": true, 
			"scrollX": true, 
			"order": [], 
			"ajax": {
				"url": `<?=site_url('datatables/datatables_survey')?>`,
				"type": "POST"
			},
			"columns": [
				{ "data": "nama_survey" },
				{ 
					"data": null,
					"render": function(res){
						return `${res.periode_survey_1} <small>s/d</small> ${res.periode_survey_2}`;
					}
				},
				{
					"data": null,
					"render": function(res){
						if(res.status_survey == 'Aktif'){
							return `<div class="text-center"><span class="label label-success">Aktif</span></div>`;
						}else{
							return `<div class="text-center"><span class="label label-danger">Tidak Aktif</span></div>`;
						}
					}
				},
				{ 
					"data": null,
					"render": function(res){
						if(res.jenis_responden == 'Karyawan'){
							return `<div class="text-center"><span class="label label-info">Karyawan</span></div>`;
						}else if(res.jenis_responden == 'Anggota'){
							return `<div class="text-center"><span class="label label-success">Anggota</span></div>`;
						}else if(res.jenis_responden == 'Umum'){
							return `<div class="text-center"><span class="label label-warning">Anggota</span></div>`;
						}
					}
				},
				{ "data": "url" },
				{ 
					"data": null,
					"render": function(res){
						if(res.status_survey == 'Aktif'){
							aktif = `
							<button class="btn btn-warning btn-xs" onclick="changeStatus('${res.id}', '2');"><i class="fa fa-times fa-fw"></i> Non Aktifkan</button>
							`;
						}else{
							aktif = `
							<button class="btn btn-success btn-xs" onclick="changeStatus('${res.id}', '1');"><i class="fa fa-check fa-fw"></i> Aktifkan</button>
							<a href="<?=site_url();?>admin/laporan/excel/${res.id}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-file-excel-o fa-fw"></i> XLS</a>
							<a href="<?=site_url();?>admin/laporan/pdf/${res.id}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o fa-fw"></i> PDF</a>
							`;
						}
						html = `
						<div class="text-center">
							<div class="btn-group">
								<a href="<?=site_url();?>admin/survey/edit/${res.id}" class="btn btn-info btn-xs"><i class="fa fa-pencil fa-fw"></i> Edit</a>
								<button class="btn btn-danger btn-xs" onclick="deleteSurvey('${res.id}');"><i class="fa fa-trash fa-fw"></i> Delete</button>
								${aktif}
							</div>
						</div>
						`;
						return html;
					}
				},
			],
			"columnDefs": [
			{ 
				"targets": [5],
				"orderable": false,
			},
			],
		});
	});

	function changeStatus(id, new_status)
	{
		let text_c = null;
		if(new_status == '1'){
			text_c = 'Aktifkan Survey ?';
		}else{
			text_c = 'Non Aktifkan Survey ?';
		}

		let c = confirm(text_c);

		if(c == true){
			$.ajax({
				url: `<?=site_url();?>admin/survey/change_status`,
				method: 'post',
				data: {
					id: id,
					new_status: new_status,
				},
				dataType: 'json',
				beforeSend: function(){
					$.blockUI();
				}
			})
			.done(function(res){
				if(res.code == 200){
					alert('Ganti Status Berhasil');
					table.draw();
				}else{
					alert('Ganti Status Gagal');
				}
				$.unblockUI();

			});
		}
	}

	function deleteSurvey(id)
	{
		let c = confirm('Hapus Survey ?');

		if(c == true){
			$.ajax({
				url: `<?=site_url();?>admin/survey/destroy`,
				method: 'post',
				data: { id: id },
				dataType: 'json',
				beforeSend: function(){
					$.blockUI();
				}
			})
			.done(function(res){
				if(res.code == 200){
					alert('Hapus Survey Berhasil');
					table.draw();
				}else{
					alert('Hapus Survey Gagal');
				}
				$.unblockUI();

			});
		}
	}
</script>