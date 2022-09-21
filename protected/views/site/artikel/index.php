 <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/sweetalert2/sweetalert2.min.css">
 <!-- Start Content-->
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<form class="d-flex">
						<button type="button" class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-cloud-upload me-1"></i> <span>Import Excel</span> </button>
						<button type="button" class="btn btn-info" onClick="download();"><i class="mdi mdi-cloud-download me-1"></i> <span>Download Excel</span> </button>
					</form>
				</div>
				<h4 class="page-title">Artikel</h4>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="data-Artikel" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<th class="text-center">Kode Artikel</th>
							<th>Judul Artikel</th>
							<th>Kategori</th>
							<th class="text-center">Status</th>
							<th class="text-center">Free / Member</th>
							<th class="text-center">Actions</th>
						</thead>					
						<tbody>
							
						</tbody>
					</table>     

				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div> <!-- end row-->

	
	<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="standard-modalLabel">Import Excel</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
				</div>
				<div class="modal-body">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title">Dropzone File Upload</h4>
							<p class="text-muted font-14">
								DropzoneJS is an open source library that provides drag’n’drop file uploads with image previews.
							</p>

							<input class="form-control btn-sm mb-2 dropify" id="media1" name="media1" placeholder="File Saham" type="file" accept=".xlsx,.xls">
							<div class="help-block msg"><i>*Pilih Files disini atau klik untuk mengupload.</i></div>
							<div class="progress" style="display:none;margin-bottom: 0px;">
								<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									<span class="sr-only">0%</span>
								</div>								
							</div>

							
						</div>
						<!-- end card-body -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary simpan" onClick="execute()">Upload</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div> <!-- container -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/sweetalert2/sweetalert2.min.js"></script>
<script href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/vendor/dropzone/min/dropzone.min.js"></script>
<script href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/ui/component.fileupload.js"></script>

<script>
$(document).ready(function () {
	actionData();	
});

function actionData(){
	var table = $('#data-Artikel').DataTable();
	table.destroy();
	
	var search='';
	var tablew = $('#data-Artikel').DataTable({
		processing: true,
		"ajax": {
			"type": "POST",
			url:'<?php echo CController::createUrl('getdata'); ?>',
		},
		"columns": [
			{ "data": "kode_artikel"},
			{ "data": "judul"},
			{ "data": "tipe_id"},
			{ "data": "status"},
			{ "data": "flag_freemember"},
			{ "data": "action"}
		],
		'language':{ 
		   "loadingRecords": "&nbsp;",
		  "processing": "Silahkan tunggu..."
		},
		responsive: true,
		"info": false,
		"lengthMenu": [
			[10, 20, 25, -1],
			[10, 20, 25, "All"]
		],
		"searching": false,
		"bLengthChange": false,
		"bFilter": true,
		"bPaginate": true,
		
	});	
	
}

function execute(){
	if(document.getElementById("media1").files.length == 0){
		Swal.fire("Perhatian", "File tidak tersedia, silahkan Drag dan Drop File terlebih dahulu", "question");
	}else{ 
		upload();
	}
	
}
	
function upload() {
	var formData = new FormData(); 		
	/*formData.append('interval',  $('#interval').val());*/
	formData.append('lampiran_file', document.getElementById('media1').files[0]);	

	$('.tutup').hide();
	$('.simpan').hide();
	$('.progress').show();
	$('.progressbytes').show();
	$("#button-loading").show();
	$.ajax({
		xhr : function() {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener('progress', function(e){
				if(e.lengthComputable){
					console.log('Bytes Loaded : ' + e.loaded);
					console.log('Total Size : ' + e.total);
					console.log('Persen : ' + (e.loaded / e.total));
					
					var percent = Math.round((e.loaded / e.total) * 100);
					
					$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
					$('#bytesloaded').html('Total Size : ' + e.total + ' Bytes | Proses Upload :  ' +e.loaded);
				}
			});
			return xhr;
		},
		
		type : 'POST',
		url:"<?php echo CController::createUrl('upload'); ?>",  
		data : formData,
		processData : false,
		contentType : false,
		success : function(response){
			$('form')[0].reset();
			$('.progress').hide();
			$('.progressbytes').hide();				
			$('.tutup').hide();
			$('.simpan').show();
			$("#button-loading").hide();
			if(response == ""){
				alert('File gagal di upload');
			}else{
				var msg = 'File berhasil di upload. ID file = ' + response;
				$('.msg').html(msg);
				sukses();
			}
		}
	});
	
	function sukses() {
		swal(
			{
				title: "Berhasil",
				text: "Upload data Artikel sukses",
				type: "success",
				showCancelButton: false,
				confirmButtonText: "Ok!"
			}).then(function(result)
			{
				javascript:history.go(0);
			});
	}
}

function download(){
	window.location = "<?php echo Yii::app()->controller->createUrl('site/download'); ?>";
	
}
</script>