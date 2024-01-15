<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="<?php echo get_language_code('iso');?>">
<head>
	<?php $this->load->view('parts/head_meta');?>
</head>
<body>
	<div class="wrapper">
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid mt-2">
				<div class="row">
					<!-- left column -->
					<div class="col-12">
						<!-- jquery validation -->
						<div class="card card-primary">
							<!-- form start -->
							<?php echo form_open_multipart('tag/submit', array('id' => 'tag-form', 'name' => 'tag-form', 'class' => 'form-horizontal'));?>
								<div class="card-body">
									<div class="form-group row">
										<label for="tag_code" class="col-5 col-form-label"><?php echo $this->lang->line('label_tag_code');?></label>
										<div class="col-7">
											<input type="text" class="form-control" id="tag_code" name="tag_code" value="">
										</div>
									</div>
									<div class="form-group row">
										<label for="tag_times" class="col-5 col-form-label"><?php echo $this->lang->line('label_maintain_membership_limit_tag');?></label>
										<div class="col-7">
											<input type="number" class="form-control col-7" id="tag_times" name="tag_times" value="">
										</div>
									</div>
									<div class="form-group row">
										<label for="tag_min" class="col-5 col-form-label"><?php echo $this->lang->line('label_min_request_amount_win_loss');?></label>
										<div class="col-7">
											<input type="number" class="form-control col-12" id="tag_min" name="tag_min" value="">
										</div>
									</div>
									<div class="form-group row">
										<label for="tag_max" class="col-5 col-form-label"><?php echo $this->lang->line('label_max_request_amount_win_loss');?></label>
										<div class="col-7">
											<input type="number" class="form-control col-12" id="tag_max" name="tag_max" value="">
											
										</div>
									</div>
									<div class="form-group row">
										<label for="tag_font_color" class="col-5 col-form-label"><?php echo $this->lang->line('label_font_color');?></label>
										<div class="col-7">
											<input type="color" class="form-control col-12" id="tag_font_color" name="tag_font_color" value="#FFFFFF">
										</div>
									</div>
									<div class="form-group row">
										<label for="tag_background_color" class="col-5 col-form-label"><?php echo $this->lang->line('label_background_color');?></label>
										<div class="col-7">
											<input type="color" class="form-control col-12" id="tag_background_color" name="tag_background_color" value="#000000">
										</div>
									</div>
									<div class="form-group row">
										<label for="is_bold" class="col-5 col-form-label"><?php echo $this->lang->line('label_bold_font');?></label>
										<div class="col-7">
											<input type="checkbox" id="is_bold" name="is_bold" value="1" data-bootstrap-switch data-off-color="secondary" data-on-color="success">
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('button_submit');?></button>
									<button type="button" id="button-cancel" class="btn btn-default ml-2"><?php echo $this->lang->line('button_cancel');?></button>
								</div>
								<!-- /.card-footer -->
							<?php echo form_close();?>
						</div>
						<!-- /.card -->
					</div>
					<!--/.col (left) -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<?php $this->load->view('parts/footer_js');?>

	<script type="text/javascript">
		$(document).ready(function() {
			var is_allowed = true;
			var form = $('#tag-form');
			
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			});
			
			var index = parent.layer.getFrameIndex(window.name);
			
			$('#button-cancel').click(function() {
				parent.layer.close(index);
			});
			
			$.validator.setDefaults({
				submitHandler: function () {
					if(is_allowed == true) {
						is_allowed = false;
						
						$.ajax({url: form.attr('action'),
							data: form.serialize(),
							type: 'post',                  
							async: 'true',
							beforeSend: function() {
								layer.load(1);
							},
							complete: function() {
								layer.closeAll('loading');
								is_allowed = true;
							},
							success: function (data) {
								var json = JSON.parse(JSON.stringify(data));
								var message = '';
								var msg_icon = 2;
								
								parent.$('meta[name=csrf_token]').attr('content', json.csrfHash);
								$("input[name='" + json.csrfTokenName + "']").val(json.csrfHash);
								
								if(json.status == '<?php echo EXIT_SUCCESS;?>') {
									message = json.msg;
									msg_icon = 1;
									parent.$('#tag-table').DataTable().ajax.reload();
									parent.layer.close(index);
								}
								else {
									if(json.msg.tag_times_error != '') {
										message = json.msg.tag_times_error;
									}
									else if(json.msg.tag_min_error != '') {
										message = json.msg.tag_min_error;
									}
									else if(json.msg.tag_max_error != '') {
										message = json.msg.tag_max_error;
									}
									else if(json.msg.tag_code_error != '') {
										message = json.msg.tag_code_error;
									}
									else if(json.msg.general_error != '') {
										message = json.msg.general_error;
									}
								}
								
								parent.layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
							},
							error: function (request,error) {
							}
						});  
					}
				}
			});

			form.validate({
				rules: {
					tag_code: {
						required: true,
					},
					tag_times: {
						required: true,
						digits: true,
					},
					tag_min: {
						required: true,
					},
					tag_max: {
						required: true,
					},
				},
				messages: {
					tag_code: {
						required: "<?php echo $this->lang->line('error_enter_tag_code');?>",
					},
					tag_times: {
						required: "<?php echo $this->lang->line('error_enter_maintain_membership');?>",
						digits: "<?php echo $this->lang->line('error_enter_maintain_membership');?>",
					},
					tag_min: {
						required: "<?php echo $this->lang->line('error_invalid_tag_min');?>",
						digits: "<?php echo $this->lang->line('error_invalid_tag_min');?>",
					},
					tag_max: {
						required: "<?php echo $this->lang->line('error_invalid_tag_max');?>",
						digits: "<?php echo $this->lang->line('error_invalid_tag_max');?>",
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}
			});
		});
	</script>
</body>
</html>
