<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="<?php echo get_language_code('iso');?>">
<head>
	<meta name="csrf_token" content="<?php echo $this->security->get_csrf_hash(); ?>">
	<?php $this->load->view('parts/head_meta');?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('parts/navbar_page');?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('parts/sidebar_page');?>
		<!-- /.sidebar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<?php $this->load->view('parts/header_page');?>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<form action="<?php echo site_url('deposit/search');?>" id="deposit-form" name="deposit-form" class="form-horizontal" method="post" accept-charset="utf-8" novalidate="novalidate">
									<div class="form-group row">
										<div class="col-md-3">
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_from_date');?></label>
												<div class="col-8 input-group date" id="from_date_click" data-target-input="nearest">
													<input type="text" id="from_date" name="from_date" class="form-control form-control-sm col-12 datetimepicker-input" value="<?php echo (isset($data_search['from_date']) ? $data_search['from_date'] : date('Y-m-d 00:00:00'));?>" data-target="#from_date_click"/>
													<div class="input-group-append" data-target="#from_date_click" data-toggle="datetimepicker">
														<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
													</div>
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_to_date');?></label>
												<div class="col-8 input-group date" id="to_date_click" data-target-input="nearest">
													<input type="text" id="to_date" name="to_date" class="form-control form-control-sm col-12 datetimepicker-input" value="<?php echo (isset($data_search['to_date']) ? $data_search['to_date'] : date('Y-m-d 23:59:59'));?>" data-target="#to_date_click"/>
													<div class="input-group-append" data-target="#to_date_click" data-toggle="datetimepicker">
														<div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
													</div>
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_player_username');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="username" name="username" value="">
												</div>
											</div>											
										</div>
										<div class="col-md-3">
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_agent');?></label>
												<div class="col-8">
													<select class="form-control select2bs4 col-12" id="agent" name="agent">
												
													</select>
												</div>
											</div>
											<div class="row">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_type');?></label>
												<div class="col-8">
													<select class="form-control form-control-sm select2bs4 col-12" id="deposit_type" name="deposit_type">
														<option value="0"><?php echo $this->lang->line('label_all');?></option>
														<?php
															foreach(get_deposit_type() as $k => $v)
															{
																echo '<option value="' . $k . '">' . $this->lang->line($v) . '</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="row mb-2">
												<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search nav-icon"></i> <?php echo $this->lang->line('button_search');?></button>
											</div>						
										</div>
										<div class="col-md-3">
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_payment_gateway');?></label>
												<div class="col-8">
													<select class="form-control select2bs4 col-12" id="payment_gateway_id" name="payment_gateway_id">
												
													</select>
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_status');?></label>
												<div class="col-8">
													<select class="form-control form-control-sm select2bs4 col-12" id="status" name="status">
														<option value="-1" <?php echo (isset($data_search['status']) && ($data_search['status'] == "-1") ? 'selected="selected"' : '""');?>><?php echo $this->lang->line('label_all');?></option>
														<option value="<?php echo STATUS_PENDING;?>" <?php echo (isset($data_search['status']) && ($data_search['status'] == STATUS_PENDING) ? 'selected="selected"' : '""');?>><?php echo $this->lang->line('deposit_status_pending');?></option>
														<option value="<?php echo STATUS_ON_PENDING;?>" <?php echo (isset($data_search['status']) && ($data_search['status'] == STATUS_ON_PENDING) ? 'selected="selected"' : '""');?>><?php echo $this->lang->line('deposit_status_on_pending');?></option>
														<option value="<?php echo STATUS_APPROVE;?>" <?php echo (isset($data_search['status']) && ($data_search['status'] == STATUS_APPROVE) ? 'selected="selected"' : '""');?>><?php echo $this->lang->line('status_approved');?></option>
														<option value="<?php echo STATUS_CANCEL;?>" <?php echo (isset($data_search['status']) && ($data_search['status'] == STATUS_CANCEL) ? 'selected="selected"' : '""');?>><?php echo $this->lang->line('status_cancelled');?></option>
													</select>
												</div>
											</div>											
										</div>
										<div class="col-md-3">
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_ip');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="ip_address" name="ip_address" value="">
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_hashtag');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="deposit_id" name="deposit_id" value="<?php echo (isset($data_search['deposit_id']) ? $data_search['deposit_id'] : '');?>">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12 col-12">
											<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_quick_search');?></label>
										</div>
										<div class="col-md-12 col-12">
											<div class="row mb-2">
											    <div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_thirty_days_from;?>','<?php echo $date_thirty_days_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_last_thirty_day');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_last_month_from;?>','<?php echo $date_last_month_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_last_month');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_yesterday_from;?>','<?php echo $date_yesterday_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_yesterday');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_today_from;?>','<?php echo $date_today_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_today');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_current_week_from;?>','<?php echo $date_current_week_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_this_week');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_current_month_from;?>','<?php echo $date_current_month_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_this_month');?></button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- /.card-header -->
							<?php if(permission_validation(PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL) == TRUE):?>
							<div class="card-header">
								<h3 class="card-title"><button onclick="exportData()" type="button" class="btn btn-block bg-gradient-success btn-sm"><i class="fas fa-plus nav-icon"></i> <?php echo $this->lang->line('button_export');?></button></h3>
							</div>
							<?php echo form_open('export/deposit_export_excel', 'class="export" id="export_form"');?>
							<?php echo form_close(); ?>
							<!-- /.card-header -->
							<?php endif;?>
							<!-- /.card-header -->
							<div class="card-body" style="display:none;">
								<table id="deposit-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th width="50"><?php echo $this->lang->line('label_hashtag');?></th>
											<th width="50"><?php echo $this->lang->line('label_date');?></th>
											<th width="50"><?php echo $this->lang->line('label_type');?></th>
											<th width="150"><?php echo $this->lang->line('label_player_username');?></th>
											<th width="80"><?php echo $this->lang->line('label_tag_player');?></th>
											<th width="150"><?php echo $this->lang->line('label_payment_gateway');?></th>
											<th width="150"><?php echo $this->lang->line('label_transaction_code');?></th>
											<th width="150"><?php echo $this->lang->line('label_payment_info');?></th>
											<th width="80"><?php echo $this->lang->line('label_amount_apply');?></th>
											<th width="30"><?php echo $this->lang->line('label_rate');?></th>
											<th width="80"><?php echo $this->lang->line('label_actual_amount');?></th>
											<th width="50"><?php echo $this->lang->line('label_status');?></th>
											<th width="50"><?php echo $this->lang->line('label_ip');?></th>
											<th width="50"><?php echo $this->lang->line('label_remark');?></th>
											<th width="50"><?php echo $this->lang->line('label_updated_by');?></th>
											<th width="80"><?php echo $this->lang->line('label_updated_date');?></th>
											<?php if(permission_validation(PERMISSION_DEPOSIT_UPDATE) == TRUE || permission_validation(PERMISSION_PLAYER_PROMOTION_VIEW) == TRUE):?>
											<th width="90"><?php echo $this->lang->line('label_action');?></th>
											<?php endif;?>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr>
											<th colspan="8" class="text-right"><?php echo $this->lang->line('label_total');?>:</th>
											<th><span id="total_deposit_apply">0</span></th>
											<th></th>
											<th><span id="total_deposit_amount">0</span></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<?php if(permission_validation(PERMISSION_DEPOSIT_UPDATE) == TRUE || permission_validation(PERMISSION_PLAYER_PROMOTION_VIEW) == TRUE):?>
											<th></th>
											<?php endif;?>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>	
				</div>	
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<?php $this->load->view('parts/footer_page');?>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<?php $this->load->view('parts/footer_js');?>

	<script type="text/javascript">
		function fastSetDateSearch(from,to){
			$('#from_date').val(from);
			$('#to_date').val(to);
			$('#deposit-form').submit();
		}
		$(document).ready(function() {
			var is_allowed = true;
			var form = $('#deposit-form');
			$('#agent').select2({
				placeholder: '<?php echo $this->lang->line('label_select');?>',
				allowClear: true,
			});

			$('#payment_gateway_id').select2({
				placeholder: '<?php echo $this->lang->line('label_select');?>',
				allowClear: true,
			});

			$('#from_date_click').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
                icons: {
                    time: "fa fa-clock"
                }
            });
			
			$('#to_date_click').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
                icons: {
                    time: "fa fa-clock"
                }
            });
			
			form.submit(function(e) {
				if(is_allowed == true) {
					is_allowed = false;
					
					$.ajax({url: form.attr('action'),
						data: { 
								csrf_bctp_bo_token : $('meta[name=csrf_token]').attr('content'), 
								from_date:  $('#from_date').val(),
								to_date:  $('#to_date').val(),
								deposit_type:  $('#deposit_type').val(),
								username : $('#username').val(),
								status : $('#status').val(),
								ip_address : $('#ip_address').val(),
								deposit_id : $('#deposit_id').val(),
								agent: $('#agent').val(),
								payment_gateway_id: $('#payment_gateway_id').val(),
						},
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
							
							$('meta[name=csrf_token]').attr('content', json.csrfHash);
							
							if(json.status == '<?php echo EXIT_SUCCESS;?>') {
								var obj = $('.card-body');
								
								if (obj.is(':visible')) {
									$('#deposit-table').DataTable().ajax.reload();
									loadTotal();
								}
								else {
									obj.show();
									loadTable();
									loadTotal();
								}
							}
							else {
								if(json.msg.from_date_error != '') {
									message = json.msg.from_date_error;
								}
								else if(json.msg.to_date_error != '') {
									message = json.msg.to_date_error;
								}
								else if(json.msg.general_error != '') {
									message = json.msg.general_error;
								}
								
								parent.layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
							}
						},
						error: function (request,error) {
						}
					});  
				}
				
				return false;
			});

			callloadtable();
			call_user_data();
			call_payment_gateway_data();
		});

		function callloadtable(){
			var obj = $('.card-body');
			if (obj.is(':visible')) {
				$('#deposit-table').DataTable().ajax.reload();
			}
			else {
				obj.show();
				loadTable();
				loadTotal();
			}
		}

		function loadTable(){
			$('#deposit-table').DataTable({
				"processing": true,
				"serverSide": true,
				"scrollX": true,
				"responsive": false,
				"filter": false,
				"pageLength" : 10,
				"lengthMenu": [[1, 10, 25, 50, 100, 500, 1000], [1, 10, 25, 50, 100, 500, 1000]],
				"order": [[0, "desc"]],
				"ajax": {
					"url": "<?php echo site_url('deposit/listing');?>",
					"dataType": "json",
					"type": "POST",
					"data": function (d) {
						d.csrf_bctp_bo_token = $('meta[name=csrf_token]').attr('content');
					},
					"complete": function(response) {
						var json = JSON.parse(JSON.stringify(response));
						if(json.status == 200) {
							$('meta[name=csrf_token]').attr('content', json.responseJSON.csrfHash);
						}
					},
				},
				"columnDefs": [
					{"targets": [4], "visible": false},
					{"targets": [7], "visible": false},
					{"targets": [9], "visible": false},
					{"targets": [10], "visible": false},
					{"targets": [12], "visible": false},
				],
				"language": {
					"processing": "<?php echo $this->lang->line('js_processing');?>",
					"lengthMenu": "<?php echo $this->lang->line('js_length_menu');?>",
					"zeroRecords": "<?php echo $this->lang->line('js_zero_ecords');?>",
					"info": "<?php echo $this->lang->line('js_info');?>",
					"infoEmpty": "<?php echo $this->lang->line('js_info_empty');?>",
					"infoFiltered": "<?php echo $this->lang->line('info_filtered');?>",
					"search": "<?php echo $this->lang->line('js_search');?>",
					"paginate": {
						"first": "<?php echo $this->lang->line('js_paginate_first');?>",
						"last": "<?php echo $this->lang->line('js_paginate_last');?>",
						"previous": "<?php echo $this->lang->line('js_paginate_previous');?>",
						"next": "<?php echo $this->lang->line('js_paginate_next');?>"
					}	
				}
			});
		}

		function loadTotal(){
			$('span#total_deposit_apply').removeClass();
			$('span#total_deposit_apply').html("0.00");
			$('span#total_deposit_amount').removeClass();
			$('span#total_deposit_amount').html("0.00");

			$.ajax({url: '<?php echo base_url('deposit/total/');?>',
				type: 'get',                  
				async: 'true',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function (data) {
					var json = JSON.parse(JSON.stringify(data));
					$('meta[name=csrf_token]').attr('content', json.csrfHash);
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						if(json.total_data.total_deposit_apply>0){var deposit_class = "text-primary";}else{var deposit_class = "text-dark";}
						$('span#total_deposit_apply').removeClass().addClass(deposit_class);
						if(json.total_data.total_deposit_amount>0){var deposit_class = "text-primary";}else{var deposit_class = "text-dark";}
						$('span#total_deposit_amount').removeClass().addClass(deposit_class);

						$('span#total_deposit_apply').html(parseFloat(json.total_data.total_deposit_apply).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').slice(0, -3));
						$('span#total_deposit_amount').html(parseFloat(json.total_data.total_deposit_amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').slice(0, -3));
					}
				},
				error: function (request,error) {
				}
			});
		}
		
		function updateData(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '380px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_deposit_setting');?>',
				content: '<?php echo base_url('deposit/edit/');?>' + id
			});
		}

		function promotionData(id){
			window.open('<?php echo base_url('playerpromotion?id=');?>'+ id, "_blank");
		}

		function exportData(){
			$.ajax({url: '<?php echo base_url("export/deposit_export_excel_check");?>',
				type: 'get',								
				async: 'true',
				beforeSend: function() {
					layer.load(1);
				},
				complete: function() {
					layer.closeAll('loading');
				},
				success: function (data) {
					var message = '';
					var msg_icon = 2;
					var json = JSON.parse(JSON.stringify(data));
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						message = json.msg.general_error;
						msg_icon = 1;
						var form_excel = $('#export_form').submit();
					}else{
						message = json.msg.general_error;
					}
					parent.layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
				},
				error: function (request,error){
				}
			});
		}

		function call_user_data(){
			$.ajax({url: '<?php echo base_url("user/get_all_user_data");?>',
				type: 'get',								
				async: 'true',
				beforeSend: function() {
					layer.load(1);
				},
				complete: function() {
					layer.closeAll('loading');
				},
				success: function (data) {
					var json = JSON.parse(JSON.stringify(data));
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						var userData = json.result;
						for (i = 0; i < json.response.length; i++) {
							$("#agent").append($('<option></option>').val(json.response[i]['username']).html(json.response[i]['username']));
						}
						$("#agent").val('');
					}
				},
				error: function (request,error){
				}
			});
		}

		function call_payment_gateway_data(){
			$.ajax({url: '<?php echo base_url("paymentgateway/get_all_payment_gateway_data");?>',
				type: 'get',								
				async: 'true',
				beforeSend: function() {
					layer.load(1);
				},
				complete: function() {
					layer.closeAll('loading');
				},
				success: function (data) {
					var json = JSON.parse(JSON.stringify(data));
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						var userData = json.result;
						for (i = 0; i < json.response.length; i++) {
							$("#payment_gateway_id").append($('<option></option>').val(json.response[i]['payment_gateway_ids']).html(json.response[i]['payment_gateway_name']));
						}
						$("#payment_gateway_id").val('');
					}
				},
				error: function (request,error){
				}
			});
		}

		function modifyPlayerTagData(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '800px'), ((browser_width < 600) ? '100%': '600px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_tag_player');?>',
				content: '<?php echo base_url('player/player_tag_modify/');?>' + id
			});
		}

		function viewImageData(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '100%'), ((browser_width < 600) ? '100%': '100%')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_bank_account_setting');?>',
				content: '<?php echo base_url('bank/player_all_bank_image_view/');?>' + id
			});
		}

		function add_whitelist(username,type,value) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '400px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_whitelist');?>',
				content: '<?php echo base_url('whitelist/add?');?>'+"username="+username+'&type='+type+'&value='+value
			});
		}
	</script>	
	<script type="text/javascript">
		var clipboard = new ClipboardJS('.clipboard');
		clipboard.on('success', function(e) {
		   toastr.success('<?php echo $this->lang->line('error_success_copy');?>');
		});
	</script>
</body>
</html>
