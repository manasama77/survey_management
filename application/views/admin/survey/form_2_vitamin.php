<script>
	let dynamic_question = $('#dynamic_question');
	let add_question     = $('#add_question');
	let total_question   = $('#total_question');
	let pertanyaan       = 0;
	let submit           = $('#submit');
	let id_master_survey = $('#id_master_survey');
	let id_question      = null;

	$(document).ready(function(){

		submit.on('click change', function(){
			if(total_question.val() == 0){
				alert('Silahkan tambah pertanyaan');
				return false;
			}
		});

		add_question.on('click', function(){

			$.ajax({
				url: `<?=site_url();?>admin/survey/generate_id_question`,
				method: 'get',
				data: { id_survey: id_master_survey.val() },
				dataType: 'json',
				beforeSend(){
					$.blockUI();
					id_question = null;	
				}
			})
			.done(function(data){

				html = `
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-warning">
							<div class="box-body">

								<div class="form-group">
									<label for="id_question" class="col-sm-2 control-label">ID Pertanyaan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control pertanyaan" id="id_question[]" name="id_question[]" placeholder="ID Pertanyaan" value="${data.res}" required readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="question" class="col-sm-2 control-label">Pertanyaan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="question[]" name="question[]" placeholder="Pertanyaan" onchange="storeQ('${data.res}', 'question', this)" required>
									</div>
								</div>

								<div class="form-group">
									<label for="desc_question" class="col-sm-2 control-label">Deskripsi Pertanyaan</label>
									<div class="col-sm-8">
										<textarea class="form-control" id="desc_question[]" name="desc_question[]" placeholder="Deskripsi Pertanyaan" onchange="storeQ('${data.res}', 'desc_question', this)"></textarea>
									</div>
								</div>

								<div class="form-group" data-id="${data.res}">
									<label for="type_respon" class="col-sm-2 control-label">Jenis Pertanyaan</label>
									<div class="col-sm-2">
										<select class="form-control" id="type_respon[]" name="type_respon[]" required>
											<option value=""></option>
											<option value="1">Ya / Tidak</option>
											<option value="2">Pilihan Ganda</option>
											<option value="3">Rating</option>
											<option value="4">Essay</option>
										</select>
									</div>
								</div>

								<div class="dynamic_answer"></div>

							</div>
						</div>
					</div>
				</div>
				`;

				dynamic_question.append(html);
				pertanyaan = $('.pertanyaan').length;
				total_question.val(pertanyaan);

				$.unblockUI();
			});
		});

		$('#dynamic_question').on('change', 'select', function(){
			let i = $(this).parent().parent();
			let v = $(this).find(':selected').val();

			i.next('.dynamic_answer').hide('slow').html(null);

			if(v == '1'){
				$.ajax({
					url: `<?=site_url();?>admin/survey/gen_a_satu`,
					method: 'get',
					data: {
						id_survey: id_master_survey.val(),
						id_question: i.data('id')
					},
					dataType: 'json',
					beforeSend(){
						$.blockUI();
						emptyAnswer(i.data('id'));
					}
				})
				.done(function(res){
					$.unblockUI();
					console.log(res);

					html = `
					<div class="form-group">
						<div class="col-sm-2 col-sm-offset-2">
							<div class="input-group">
								<span class="input-group-addon" style="background-color: #ccc;">A.</span>
								<input type="text" class="form-control" id="satu_a[]" name="satu_a[]" value="${res.value_a}" onchange="updateASatu('${res.id_a}', this)" required>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-addon" style="background-color: #ccc;">B.</span>
								<input type="text" class="form-control" id="satu_b[]" name="satu_b[]" value="${res.value_b}" onchange="updateASatu('${res.id_b}', this)" required>
							</div>
						</div>
					</div>
					`;

					i.next('.dynamic_answer').html(html).show('slow');
				});
			}else if(v == '2'){
				html = `
				<div class="dynamic_pg"></div>
				`;

				html += `
				<div class="form-group" data-id="a">
					<div class="col-sm-2 col-sm-offset-2" data-id="b">
						<button type="button" class="btn btn-danger add_pg"><i class="fa fa-plus fa-fw"></i> Tambah Pilihan Ganda</button>
					</div>
				</div>
				`;

				i.next('.dynamic_answer').html(html).show('fast');

				$('.add_pg').on('click', function(){
					let add_pg = $(this);
					$.ajax({
						url: `<?=site_url();?>admin/survey/generate_id_answer_pg`,
						method: 'get',
						data: {
							id_survey: id_master_survey.val(),
							id_question: i.data('id')
						},
						dataType: 'json',
						beforeSend(){
							$.blockUI();
							emptyAnswer(i.data('id'));
						}
					})
					.done(function(res){
						console.log(res);
						$.unblockUI();
						let html = ``;
						html = `
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-2">
								<input type="text" class="form-control" id="dua_a[]" name="dua_a[]" onchange="updateASatu('${res.id}', this)" required>
							</div>
						</div>
						`;
						add_pg.parent().parent().prev().append(html);
						console.log(add_pg.parent().parent().prev());

					});


				});
			}

		});
	});

	function storeQ(id_question, field_question, value_question)
	{
		$.ajax({
			url: `<?=site_url();?>admin/survey/store_q`,
			method: 'post',
			data: {
				id_question				: id_question,
				field_question		: field_question,
				value_question		: value_question.value
			},
			dataType: 'json',
			beforeSend(){
				$.blockUI();
			}
		})
		.done(function(data){
			$.unblockUI();
			if(data.code == 500){
				alert(`<?=GA_KONEK;?>`);
			}

		});
	}

	function updateASatu(id, x)
	{
		$.ajax({
			url: `<?=site_url();?>admin/survey/update_a_satu`,
			method: 'post',
			data: {
				id: id,
				desc_respon: x.value
			},
			beforeSend(){
				$.blockUI();
			},
			complete(){
				$.unblockUI();
			}
		});
	}

	function emptyAnswer(id_question)
	{
		console.log(id_question);

	}
</script>