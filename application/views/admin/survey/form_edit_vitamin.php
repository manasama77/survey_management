<script>
	let jenis_responden = $('#jenis_responden')
	$(document).ready(function(){
		jenis_responden.val(`<?=$arr_master->row()->jenis_responden;?>`);
	});
</script>