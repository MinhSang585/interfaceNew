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

							<?php echo form_open('paymentgateway/submit', array('id' => 'payment_gateway-form', 'payment_gateway' => 'game-form', 'class' => 'form-horizontal'));?>

								<div class="card-body">

									<div class="form-group row">

										<label for="payment_gateway_name" class="col-5 col-form-label"><?php echo $this->lang->line('label_name');?></label>

										<div class="col-7">
											<input type="text" class="form-control col-10" id="payment_gateway_name" name="payment_gateway_name" value="" maxlength="16">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_code" class="col-5 col-form-label"><?php echo $this->lang->line('label_code');?></label>

										<div class="col-7">
											<input type="text" class="form-control col-10" id="payment_gateway_code" name="payment_gateway_code" value="" maxlength="16">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_sequence" class="col-5 col-form-label"><?php echo $this->lang->line('label_sequence');?></label>

										<div class="col-7">

											<input type="text" class="form-control col-3" id="payment_gateway_sequence" name="payment_gateway_sequence" value="<?php echo (isset($payment_gateway_sequence) ? $payment_gateway_sequence : '');?>" maxlength="3">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_active" class="col-5 col-form-label"><?php echo $this->lang->line('label_active');?></label>

										<div class="col-7">

											<input type="checkbox" id="payment_gateway_active" name="payment_gateway_active" value="1" <?php echo ((isset($payment_gateway_admin_verification) && $payment_gateway_admin_verification == STATUS_YES) ? 'checked' : '');?> data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_admin_verification" class="col-5 col-form-label"><?php echo $this->lang->line('label_verify');?></label>

										<div class="col-7">

											<input type="checkbox" id="payment_gateway_admin_verification" name="payment_gateway_admin_verification" value="1" <?php echo ((isset($payment_gateway_admin_verification) && $payment_gateway_admin_verification == STATUS_YES) ? 'checked' : '');?> data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_rate_type" class="col-5 col-form-label"><?php echo $this->lang->line('label_type');?></label>

										<div class="col-7">

											<select class="form-control select2bs4 col-7" id="payment_gateway_rate_type" name="payment_gateway_rate_type">

												<?php

													$get_payment_gateway_rate_type = get_payment_gateway_rate_type();

													if(isset($get_payment_gateway_rate_type) && sizeof($get_payment_gateway_rate_type)>0){

														foreach($get_payment_gateway_rate_type as $k => $v)

														{

															if(isset($payment_gateway_rate_type) && $payment_gateway_rate_type == $k){

																echo '<option value="' . $k . '" selected="selected">' . $this->lang->line($v) . '</option>';

															}else{

																echo '<option value="' . $k . '">' . $this->lang->line($v) . '</option>';

															}

														}

													}

												?>

											</select>

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_rate" class="col-5 col-form-label"><?php echo $this->lang->line('label_rate');?></label>

										<div class="col-7">

											<input type="number" class="form-control col-6" id="payment_gateway_rate" name="payment_gateway_rate" value="<?php echo (isset($payment_gateway_rate) ? $payment_gateway_rate : '');?>">

										</div>

									</div>

									<div class="form-group row">

										<label for="api_data" class="col-5 col-form-label">API Data</label>

										<div class="col-7">

											<textarea class="form-control" id="api_data" name="api_data" rows="4"></textarea>

										</div>

									</div>

									<div class="form-group row">

										<label for="bank_data" class="col-5 col-form-label">Bank Data</label>

										<div class="col-7">

											<textarea class="form-control" id="bank_data" name="bank_data" rows="3"></textarea>

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_min_amount" class="col-5 col-form-label"><?php echo $this->lang->line('label_min_amounts');?></label>

										<div class="col-7">

											<input type="number" class="form-control col-6" id="payment_gateway_min_amount" name="payment_gateway_min_amount" value="<?php echo (isset($payment_gateway_min_amount) ? $payment_gateway_min_amount : '');?>">

										</div>

									</div>

									<div class="form-group row">

										<label for="payment_gateway_max_amount" class="col-5 col-form-label"><?php echo $this->lang->line('label_max_amounts');?></label>

										<div class="col-7">

											<input type="number" class="form-control col-6" id="payment_gateway_max_amount" name="payment_gateway_max_amount" value="<?php echo (isset($payment_gateway_max_amount) ? $payment_gateway_max_amount : '');?>">

										</div>

									</div>
									
									<!-- <div>
										<h2>Maint</h2>
									</div> -->

									<div class="form-group row">

										<label for="is_maintenance" class="col-5 col-form-label"><?php echo $this->lang->line('label_maintenance');?></label>

										<div class="col-7">

											<input type="checkbox" id="is_maintenance" name="is_maintenance" value="1" data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div>

									<!-- <div class="form-group row">

										<label for="is_front_end_display" class="col-5 col-form-label"><?php echo $this->lang->line('label_frontend_display');?></label>

										<div class="col-7">

											<input type="checkbox" id="is_front_end_display" name="is_front_end_display" value="1"data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div> -->

									<div class="form-group row">

										<label for="fixed_maintenance" class="col-5 col-form-label"><?php echo $this->lang->line('label_fixed_maintenance');?></label>

										<div class="col-7">

											<input type="checkbox" id="fixed_maintenance" name="fixed_maintenance" value="1" data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div>

									<div class="form-group row">

										<label for="fixed_day" class="col-5 col-form-label"><?php echo $this->lang->line('label_day');?></label>

										<div class="col-7">

											<select class="form-control select2bs4 col-6" id="fixed_day" name="fixed_day">

												<?php

													foreach(get_day() as $k => $v) 

													{

														if(isset($fixed_day)) {

															if($k == $fixed_day) {

																echo '<option value="' . $k . '" selected="selected">' . $this->lang->line($v) . '</option>';

															}

															else {

																echo '<option value="' . $k . '">' . $this->lang->line($v) . '</option>';

															}

														}

														else {

															echo '<option value="' . $k . '">' . $this->lang->line($v) . '</option>';

														}

													}

												?>

											</select>

										</div>

									</div>

									<div class="form-group row">

										<label for="fixed_from_time" class="col-5 col-form-label"><?php echo $this->lang->line('label_from_time');?></label>

										<div class="col-7">

											<div class="input-group date" id="fixed_from_time_click" data-target-input="nearest">

												<input type="text" id="fixed_from_time" name="fixed_from_time" class="form-control col-6 datetimepicker-input" value="00:00:00" data-target="#fixed_from_time_click"/>

												<div class="input-group-append" data-target="#fixed_from_time_click" data-toggle="datetimepicker">

													<div class="input-group-text"><i class="far fa-clock"></i></div>

												</div>

											</div>

										</div>

									</div>

									<div class="form-group row">

										<label for="fixed_to_time" class="col-5 col-form-label"><?php echo $this->lang->line('label_to_time');?></label>

										<div class="col-7">

											<div class="input-group date" id="fixed_to_time_click" data-target-input="nearest">

												<input type="text" id="fixed_to_time" name="fixed_to_time" class="form-control col-6 datetimepicker-input" value="00:00:00" data-target="#fixed_to_time_click"/>

												<div class="input-group-append" data-target="#fixed_to_time_click" data-toggle="datetimepicker">

													<div class="input-group-text"><i class="far fa-clock"></i></div>

												</div>

											</div>

										</div>

									</div>

									<div class="form-group row">

										<label for="urgent_maintenance" class="col-5 col-form-label"><?php echo $this->lang->line('label_urgent_maintenance');?></label>

										<div class="col-7">

											<input type="checkbox" id="urgent_maintenance" name="urgent_maintenance" value="1"  data-bootstrap-switch data-off-color="secondary" data-on-color="success">

										</div>

									</div>

									<div class="form-group row">

										<label for="urgent_date" class="col-5 col-form-label"><?php echo $this->lang->line('label_date');?></label>

										<div class="col-7">

											<div class="input-group date" id="urgent_date_click" data-target-input="nearest">

												<input type="text" id="urgent_date" name="urgent_date" class="form-control col-6 datetimepicker-input" value="" data-target="#urgent_date_click"/>

												<div class="input-group-append" data-target="#urgent_date_click" data-toggle="datetimepicker">

													<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>

												</div>

											</div>

										</div>

									</div>

								</div>					

									<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">

										<li class="nav-item">

											<a class="nav-link active" id="custom-content-below-web-tab" data-toggle="pill" href="#custom-content-below-web" role="tab" aria-controls="custom-content-below-web" aria-selected="true"><?php echo $this->lang->line('label_web');?></a>

										</li>

										<li class="nav-item">

											<a class="nav-link" id="custom-content-below-mobile-tab" data-toggle="pill" href="#custom-content-below-mobile" role="tab" aria-controls="custom-content-below-mobile" aria-selected="false"><?php echo $this->lang->line('label_mobile');?></a>

										</li>

									</ul>

									<div class="tab-content" id="custom-content-below-tabContent">

										<div class="tab-pane fade show active" id="custom-content-below-web" role="tabpanel" aria-labelledby="custom-content-below-web-tab">

											<?php if(isset($web_image_on)):?>

											<div class="form-group row mt-3">

												<label class="col-5 col-form-label">&nbsp;</label>

												<div class="col-7">

													<a href="<?php echo BANKS_SOURCE_PATH . $web_image_on;?>" target="_blank"><img src="<?php echo BANKS_SOURCE_PATH . $web_image_on;?>" width="200" border="0" /></a>

												</div>

											</div>

											<?php endif;?>

											<div class="form-group row mt-3">

												<label for="web_image_on" class="col-5 col-form-label"><?php echo $this->lang->line('label_image_on');?></label>

												<div class="col-7">

													<div class="custom-file col-10">

														<input type="file" class="custom-file-input" id="web_image_on" name="web_image_on">

														<label class="custom-file-label" for="web_image_on"><?php echo $this->lang->line('button_choose_file');?></label>

													</div>

												</div>

											</div>

											<?php if(isset($web_image_off)):?>

											<div class="form-group row mt-3">

												<label class="col-5 col-form-label">&nbsp;</label>

												<div class="col-7">

													<a href="<?php echo BANKS_SOURCE_PATH . $web_image_off;?>" target="_blank"><img src="<?php echo BANKS_SOURCE_PATH . $web_image_off;?>" width="200" border="0" /></a>

												</div>

											</div>

											<?php endif;?>

											<div class="form-group row mt-3">

												<label for="web_image_off" class="col-5 col-form-label"><?php echo $this->lang->line('label_image_off');?></label>

												<div class="col-7">

													<div class="custom-file col-10">

														<input type="file" class="custom-file-input" id="web_image_off" name="web_image_off">

														<label class="custom-file-label" for="web_image_off"><?php echo $this->lang->line('button_choose_file');?></label>

													</div>

												</div>

											</div>

										</div>

										<div class="tab-pane fade" id="custom-content-below-mobile" role="tabpanel" aria-labelledby="custom-content-below-mobile-tab">

											<?php if(isset($mobile_image_on)):?>

											<div class="form-group row mt-3">

												<label class="col-5 col-form-label">&nbsp;</label>

												<div class="col-7">

													<a href="<?php echo BANKS_SOURCE_PATH . $mobile_image_on;?>" target="_blank"><img src="<?php echo BANKS_SOURCE_PATH . $mobile_image_on;?>" width="200" border="0" /></a>

												</div>

											</div>

											<?php endif;?>

											<div class="form-group row mt-3">

												<label for="mobile_image_on" class="col-5 col-form-label"><?php echo $this->lang->line('label_image_on');?></label>

												<div class="col-7">

													<div class="custom-file col-10">

														<input type="file" class="custom-file-input" id="mobile_image_on" name="mobile_image_on">

														<label class="custom-file-label" for="mobile_image_on"><?php echo $this->lang->line('button_choose_file');?></label>

													</div>

												</div>

											</div>

											<?php if(isset($mobile_image_off)):?>

											<div class="form-group row mt-3">

												<label class="col-5 col-form-label">&nbsp;</label>

												<div class="col-7">

													<a href="<?php echo BANKS_SOURCE_PATH . $mobile_image_off;?>" target="_blank"><img src="<?php echo BANKS_SOURCE_PATH . $mobile_image_off;?>" width="200" border="0" /></a>

												</div>

											</div>

											<?php endif;?>

											<div class="form-group row mt-3">

												<label for="mobile_image_off" class="col-5 col-form-label"><?php echo $this->lang->line('label_image_off');?></label>

												<div class="col-7">

													<div class="custom-file col-10">

														<input type="file" class="custom-file-input" id="mobile_image_off" name="mobile_image_off">

														<label class="custom-file-label" for="mobile_image_off"><?php echo $this->lang->line('button_choose_file');?></label>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

								<!-- /.card-body -->

								<div class="card-footer">

									<input type="hidden" id="payment_gateway_id" name="payment_gateway_id" value="<?php echo (isset($payment_gateway_id) ? $payment_gateway_id : '');?>">

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

			var form = $('#payment_gateway-form');

			

			$("input[data-bootstrap-switch]").each(function(){

				$(this).bootstrapSwitch('state', $(this).prop('checked'));

			});

			

			$('#fixed_from_time_click').datetimepicker({

				format: 'HH:mm'

			});

			

			$('#fixed_to_time_click').datetimepicker({

				format: 'HH:mm'

			});

			

			$('#urgent_date_click').datetimepicker({

				format: 'YYYY-MM-DD HH:mm',

                icons: {

                    time: "fa fa-clock"

                }

            });

			

			var index = parent.layer.getFrameIndex(window.name);

			

			$('#button-cancel').click(function() {

				parent.layer.close(index);

			});

			

			$.validator.setDefaults({

				submitHandler: function () {

					if(is_allowed == true) {

						is_allowed = false;



						var file_form = form[0];

						var formData = new FormData(file_form);

						$.each($("input[type='file']")[0].files, function(i, file) {

							formData.append('file', file);

						});

						

						$.ajax({url: form.attr('action'),

							data: formData,

							type: 'post',	

							processData: false,

							contentType: false,	                  

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
								console.log(1111);
								console.log(json);

								var message = '';

								var msg_icon = 2;

								

								parent.$('meta[name=csrf_token]').attr('content', json.csrfHash);

								$("input[name='" + json.csrfTokenName + "']").val(json.csrfHash);

								

								if(json.status == '<?php echo EXIT_SUCCESS;?>') {

									message = json.msg;

									msg_icon = 1;

									parent.$('#payment_gateway-table').DataTable().ajax.reload();

									parent.layer.close(index);

								}

								else {

									console.log(json.msg);

									if(json.msg.payment_gateway_sequence_error != '') {

										message = json.msg.payment_gateway_sequence_error;

									}

									else if(json.msg.fixed_day_error != '') {

										message = json.msg.fixed_day_error;

									}

									else if(json.msg.fixed_from_time_error != '') {

										message = json.msg.fixed_from_time_error;

									}

									else if(json.msg.fixed_to_time_error != '') {

										message = json.msg.fixed_to_time_error;

									}

									else if(json.msg.urgent_date_error != '') {

										message = json.msg.urgent_date_error;

									}

									else if(json.msg.general_error != '') {

										message = json.msg.general_error;

									}

								}
								console.log(message);
								

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

					payment_gateway_sequence: {

						required: true,

						digits: true

					},

					fixed_day: {

						digits: true

					}

				},

				messages: {

					payment_gateway_sequence: {

						required: "<?php echo str_replace('%s', strtolower($this->lang->line('label_sequence')), $this->lang->line('error_only_digits_allowed'));?>",

						digits: "<?php echo str_replace('%s', strtolower($this->lang->line('label_sequence')), $this->lang->line('error_only_digits_allowed'));?>",

					},

					fixed_day: {

						digits: "<?php echo $this->lang->line('error_select_fixed_day');?>",

					}

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

