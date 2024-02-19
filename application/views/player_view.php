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
								<form action="<?php echo site_url('player/search');?>" id="player-form" name="player-form" class="form-horizontal" method="post" accept-charset="utf-8" novalidate="novalidate">
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
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_mobile');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="mobile" name="mobile" value="">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row mb-1">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_agent');?></label>
												<div class="col-8">
													<select class="form-control select2bs4 col-12" id="agent" name="agent">
													</select>
												</div>
											</div>
											<div class="row mb-1">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_status');?></label>
												<div class="col-8">
													<select class="form-control form-control-sm select2bs4 col-12" id="status" name="status">
														<option value="0"><?php echo $this->lang->line('label_all');?></option>
														<option value="<?php echo STATUS_ACTIVE;?>"><?php echo $this->lang->line('status_active');?></option>
														<option value="<?php echo STATUS_SUSPEND;?>"><?php echo $this->lang->line('status_suspend');?></option>
													</select>
												</div>
											</div>
											<div class="row mb-2" style="display: none;">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_upline');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="upline" name="upline" value="">
												</div>
											</div>
											<div class="row mb-2">
												<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search nav-icon"></i> <?php echo $this->lang->line('button_search');?></button>&nbsp;
												<button type="button" onclick="fastSetDateSearch('<?php echo $data_search['from_date'];?>','<?php echo $data_search['to_date'];?>')" class="btn btn-sm btn-info"><i class="fas fa-eraser nav-icon"></i> <?php echo $this->lang->line('label_quick_search_clear');?></button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row mb-1">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_tag_code');?></label>
												<div class="col-8">
													<select class="select2 col-12" id="tag" name="tag[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('label_select');?>"></select>
												</div>
											</div>
											<div class="row mb-1">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_tag_player');?></label>
												<div class="col-8">
													<select class="select2 col-12" id="tag_player" name="tag_player[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('label_select');?>"></select>
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_referrer');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="referrer" name="referrer" value="">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_bank_account_name');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="bank_account_name" name="bank_account_name" value="">
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_bank_account_no');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="bank_account_no" name="bank_account_no" value="">
												</div>
											</div>
											<div class="row mb-2">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('im_line');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="line_id" name="line_id" value="">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row mb-2" style="display: none;">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_type');?></label>
												<div class="col-8">
													<select class="form-control form-control-sm select2bs4 col-12" id="player_type" name="player_type">
														<option value="0"><?php echo $this->lang->line('label_all');?></option>
														<?php
															foreach(get_player_type() as $k => $v)
															{
																echo '<option value="' . $k . '">' . $this->lang->line($v) . '</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="row mb-2" style="display: none;">
												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_upline');?></label>
												<div class="col-8">
													<input type="text" class="form-control form-control-sm" id="upline" name="upline" value="">
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
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_last_month_from;?>','<?php echo $date_last_month_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_last_month');?></button>
												</div>
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_last_week_from;?>','<?php echo $date_last_week_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_last_week');?></button>
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
											<div class="row mb-2" style="display: none;">
												<div class="col-md-2 col-2">
													<button type="button" onclick="fastSetDateSearch('<?php echo $date_clear_from;?>','<?php echo $date_clear_to;?>')" class="btn btn-block btn-info"><?php echo $this->lang->line('label_quick_search_clear');?></button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- /.card-header -->
							<?php if(permission_validation(PERMISSION_PLAYER_ADD) == TRUE || permission_validation(PERMISSION_PLAYER_REPORT_EXPORT_EXCEL) == TRUE):?>
							<div class="card-header">
								<h3 class="card-title">
									<?php if(permission_validation(PERMISSION_PLAYER_REPORT_EXPORT_EXCEL) == TRUE):?>
									<button onclick="exportData()" type="button" class="btn bg-gradient-success btn-sm"><i class="fas fa-plus nav-icon"></i> <?php echo $this->lang->line('button_export');?></button>
									<?php endif;?>
									<?php if(permission_validation(PERMISSION_PLAYER_ADD) == TRUE):?>
									<button onclick="addData()" type="button" class="btn bg-gradient-primary btn-sm"><i class="fas fa-plus nav-icon"></i> <?php echo $this->lang->line('button_add_new');?></button>
									<?php endif;?>
								</h3>
							</div>
							<!-- /.card-header -->
							<?php endif;?>
							<?php if(permission_validation(PERMISSION_PLAYER_REPORT_EXPORT_EXCEL) == TRUE):?>
							<?php echo form_open('export/player_report_export', 'class="export" id="export_form"');?>
							<?php echo form_close(); ?>
							<?php endif;?>
							<div class="card-body" style="display:none;">
								<table id="player-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th width="60"><?php echo $this->lang->line('label_hashtag');?></th>
											<th width="180"><?php echo $this->lang->line('label_player_username');?></th>
											<th width="80"><?php echo $this->lang->line('label_nickname');?></th>
											<th width="30"><?php echo $this->lang->line('label_ranking');?></th>
											<th width="80"><?php echo $this->lang->line('label_tag_player');?></th>
											<th width="60"><?php echo $this->lang->line('label_upline');?></th>
											<th width="80"><?php echo $this->lang->line('label_type');?></th>
											<th width="60"><?php echo $this->lang->line('label_main_wallet');?></th>
											<th width="80"><?php echo $this->lang->line('label_rewards');?></th>
											<th width="80"><?php echo $this->lang->line('label_account_status');?></th>
											<th width="80"><?php echo $this->lang->line('label_mark');?></th>
											<th width="180"><?php echo $this->lang->line('label_bank_channel_status');?></th>
											<th width="200"><?php echo $this->lang->line('label_bank_name');?></th>
											<th width="80"><?php echo $this->lang->line('label_bank_group');?></th>
											<th width="150"><?php echo $this->lang->line('label_registered_date')." / ".$this->lang->line('label_ip');?></th>
											<th width="120"><?php echo $this->lang->line('label_last_login_date')." / ".$this->lang->line('label_ip');?></th>
											<th width="120"><?php echo $this->lang->line('label_withdrawal_turnover');?></th>
											<?php if(permission_validation(PERMISSION_PLAYER_UPDATE) == TRUE OR permission_validation(PERMISSION_VIEW_PLAYER_CONTACT) == TRUE OR permission_validation(PERMISSION_CHANGE_PASSWORD) == TRUE OR permission_validation(PERMISSION_DEPOSIT_POINT_TO_DOWNLINE) == TRUE OR permission_validation(PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE) == TRUE OR permission_validation(PERMISSION_PLAYER_POINT_ADJUSTMENT) == TRUE OR permission_validation(PERMISSION_DEPOSIT_ADD) == TRUE OR permission_validation(PERMISSION_WITHDRAWAL_ADD) == TRUE OR permission_validation(PERMISSION_REWARD_DEDUCT) == TRUE OR permission_validation(PERMISSION_PLAYER_DAILY_REPORT) == TRUE OR permission_validation(PERMISSION_WHITELIST_ADD) == TRUE OR (permission_validation(PERMISSION_PLAYER_PROMOTION_VIEW) == TRUE  && permission_validation(PERMISSION_PLAYER_PROMOTION_UPDATE) == TRUE)):?>
											<th width="400"><?php echo $this->lang->line('label_action');?></th>
											<?php endif;?>
										</tr>
									</thead>
									<tbody></tbody>
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
			$('#player-form').submit();
		}
		$(document).ready(function() {
			var is_allowed = true;
			var form = $('#player-form');
			$('.select2').select2();
			$('#agent').select2({
				placeholder: '<?php echo $this->lang->line('label_select');?>',
				allowClear: true,
			});
			$('#from_date_click').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
                buttons: {
	                showToday: true,
	                showClear: true,
	                showClose: true
	            },
	            icons: {
	                today: 'fas fa-caret-square-right',
	                time: "fa fa-clock",
	                clear: 'fa fa-trash',
	                close: 'fas fa-times-circle'
	            },
            });
            $('#to_date_click').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss',
				buttons: {
	                showToday: true,
	                showClear: true,
	                showClose: true
	            },
	            icons: {
	                today: 'fas fa-caret-square-right',
	                time: "fa fa-clock",
	                clear: 'fa fa-trash',
	                close: 'fas fa-times-circle'
	            },
            });
			form.submit(function(e) {
				if(is_allowed == true) {
					is_allowed = false;
					$.ajax({url: form.attr('action'),
						data: { 
								csrf_bctp_bo_token : $('meta[name=csrf_token]').attr('content'), 
								upline:  $('#upline').val(),
								username : $('#username').val(),
								status : $('#status').val(),
								player_type : $('#player_type').val(),
								mobile : $('#mobile').val(),
								bank_account_name : $('#bank_account_name').val(),
								agent : $('#agent').val(),
								referrer : $('#referrer').val(),
								from_date:  $('#from_date').val(),
								to_date:  $('#to_date').val(),
								line_id:  $('#line_id').val(),
								tag_player:  $('#tag_player').val(),
								tag:  $('#tag').val(),
								bank_account_no:  $('#bank_account_no').val(),
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
								$('#player-table').DataTable().ajax.reload();
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
			call_tag_data();
			call_tag_player_data();
		});
		function callloadtable(){
			var obj = $('.card-body');
			if (obj.is(':visible')) {
				$('#player-table').DataTable().ajax.reload();
			}
			else {
				obj.show();
				loadTotal();
			}
		}
		function loadTotal(){
			$('#player-table').DataTable({
				"processing": true,
				"serverSide": true,
				"scrollX": true,
				"responsive": false,
				"filter": false,
				"pageLength" : 10,
				"order": [[0, "desc"]],
				"ajax": {
					"url": "<?php echo base_url('player/listing/');?>",
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
					"error": function(xhr,req) {
						console.log(xhr);
						//$('#player-table_processing').hide();
					},
				},
				"columnDefs": [
					{"targets": [0], "visible": false},
					{"targets": [2], "visible": false},
					{"targets": [6], "visible": false},
					{"targets": [8], "visible": false},
					{"targets": [10], "visible": false},
					{"targets": [15], "visible": false},
					{"targets": [16], "visible": false},
					<?php /*if(permission_validation(PERMISSION_VIEW_PLAYER_TURNOVER) == FALSE):?>
					{"targets": [16], "visible": false},
					<?php endif;*/ ?>
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
		};
		function addData() {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '480px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_player');?>',
				content: '<?php echo base_url('player/add/');?>'
			});
		}
		function updateData(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_setting');?>',
				content: '<?php echo base_url('player/edit/');?>' + id
			});
		}
		function viewData(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_details');?>',
				content: '<?php echo base_url('player/view/');?>' + id
			});
		}
		function viewData2(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_details');?>',
				content: '<?php echo base_url('player/view_version2/');?>' + id
			});
		}
		function changePassword(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '380px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_change_password');?>',
				content: '<?php echo base_url('player/password/');?>' + id
			});
		}
		function depositPoints(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '510px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_deposit_point_to_downline');?>',
				content: '<?php echo base_url('player/deposit/');?>' + id
			});
		}
		function withdrawPoints(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '510px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_withdraw_point_from_downline');?>',
				content: '<?php echo base_url('player/withdraw/');?>' + id
			});
		}
		function adjustPoints(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_point_adjustment');?>',
				content: '<?php echo base_url('player/adjust/');?>' + id
			});
		}
		function viewWallets(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '100%'), ((browser_width < 600) ? '100%': '100%')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_wallet_balances');?>',
				//content: '<?php echo base_url('player/wallet/');?>' + id
				content: '<?php echo base_url('player/wallet_enhance/');?>' + id
			});
		}
		function withdrawal_offline(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_withdrawal_offline');?>',
				content: '<?php echo base_url('withdrawal/withdrawal_offline_add/');?>' + id
			});
		}
		function deposit_offline(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_deposit_offline');?>',
				content: '<?php echo base_url('deposit/deposit_offline_add/');?>' + id
			});
		}
		function withdrawal_offline_approve(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_withdrawal_offline');?>',
				content: '<?php echo base_url('withdrawal/withdrawal_offline_approve_add/');?>' + id
			});
		}
		function deposit_offline_approve(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '700px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_deposit_offline');?>',
				content: '<?php echo base_url('deposit/deposit_offline_approve_add/');?>' + id
			});
		}
		function reward_deduct(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_deduct_reward');?>',
				content: '<?php echo base_url('reward/deduct/');?>' + id
			});
		}
		function getDownline(username){
			window.open("<?php echo base_url('user/?upline=')?>"+username, "_blank"); 
		}
		function player_daily(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '100%'), ((browser_width < 600) ? '100%': '100%')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_withdrawal_verify');?>',
				content: '<?php echo base_url('player/player_daily_report/');?>' + id
			});
		}
		function kick_player(id){
			layer.confirm('<?php echo $this->lang->line('label_confirm_to_proceed');?>', {
				title: '<?php echo $this->lang->line('label_info');?>',
				btn: ['<?php echo $this->lang->line('status_yes');?>', '<?php echo $this->lang->line('status_no');?>']
			}, function() {
				$.get('<?php echo base_url('player/kick/');?>' + id, function(data) {
					var json = JSON.parse(JSON.stringify(data));
					var message = json.msg;
					var msg_icon = 2;
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						msg_icon = 1;
					}
					layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
				});
			});
		}
		function add_player_bank(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '480px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_player_bank');?>',
				content: '<?php echo base_url('player/add_player_bank/');?>' + id
			});
		}
		function view_player_bank(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '90%'), ((browser_width < 600) ? '100%': '90%')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_bank_player');?>',
				content: '<?php echo base_url('player/view_player_bank/');?>' + id
			});
		}
		function change_player_mark(player_id,mark_id){
			$.ajax({url: "<?php echo base_url('player/change_player_mark/');?>"+player_id+"/"+mark_id,
				type: 'get',                  
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
						$("#uc10_"+player_id).html(json.response.mark);
					}else{
						message = json.msg.general_error;
						layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
					}
				}
			});
		}
		function add_whitelist(username) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '400px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_add_whitelist');?>',
				content: '<?php echo base_url('whitelist/add?');?>'+"username="+username
			});
		}
		function player_additional_info(player_id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_setting');?>',
				content: '<?php echo base_url('player/additional_info/');?>' + player_id
			});
		}
		function player_additional_detail_info(player_id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_setting');?>',
				content: '<?php echo base_url('player/additional_detail_info/');?>' + player_id
			});
		}
		function exportData(){
			$.ajax({url: '<?php echo base_url("export/player_report_export_check");?>',
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
		function adjust_turnover(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_player_turnover_adjustment');?>',
				content: '<?php echo base_url('player/turnover_adjust/');?>' + id
			});
		}
		function calculate_promotion_turnover(id){
			$("#uc7_"+id).html('<i class="fas fa-spinner fa-pulse"></i>');
			$.ajax({url: '<?php echo base_url("playerpromotion/calculate_current_player_turnover/");?>'+ id,
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
						$('#uc7_' + id).html(json.turnover_total_current+" : "+json.turnover_total_required+"<br/>"+'<?php echo $this->lang->line('label_turnover_remaining');?>'+" : "+json.turnover_total_balance);
					}
				},
				error: function (request,error){
				}
			});
		}
		function promotionUnsattleData(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '100%'), ((browser_width < 600) ? '100%': '100%')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_withdrawal_setting');?>',
				content: '<?php echo base_url('withdrawal/promotion_unsattle/');?>' + id
			});
		}
		function updatePlayerBankData(id) {
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_bank_account_setting');?>',
				content: '<?php echo base_url('bank/player_edit_player/');?>' + id
			});
		}
		function display_player_bank_account(player_id,bank_length){
			$("#uc80_"+player_id).hide();
			$("#uc81_"+player_id).hide();
			$("#uc82_"+player_id).hide();
			$("#uc83_"+player_id).hide();
			$("#uc84_"+player_id).hide();
			$("#uc85_"+player_id).hide();
			var player_bank_account_data_json = $('#player_bank_account_data_json_' + player_id).html();
			var player_bank_data = JSON.parse(player_bank_account_data_json);
			if(player_bank_data.length >= bank_length){
				$('#uc84_'+player_id).show();
				<?php  
					if(permission_validation(PERMISSION_BANK_PLAYER_USER_UPDATE) == TRUE)
					{
				?>
				document.getElementById('uc84_'+player_id).setAttribute("onClick", "updatePlayerBankData("+player_bank_data[bank_length-1]['player_bank_id']+");");
				<?php } ?>
				$('#uc80_'+player_id).show();
				$('#uc80_'+player_id).html(player_bank_data[bank_length-1]['bank_name']);
				$('#uc82_'+player_id).show();
				$('#uc82_'+player_id).html(player_bank_data[bank_length-1]['bank_account_name']);
				$('#uc83_'+player_id).show();
				$('#uc83_'+player_id).html(player_bank_data[bank_length-1]['bank_account_no']);
				if(player_bank_data[bank_length-1]['verify'] == "<?php echo STATUS_VERIFY;?>"){
					$('#uc81_'+player_id).show();
					$('#uc81_'+player_id).html("<?php echo $this->lang->line('status_verify');?>");
					$('#uc81_'+player_id).removeClass('bg-secondary').addClass('bg-success');
				}else{
					$('#uc81_'+player_id).show();
					$('#uc81_'+player_id).html("<?php echo $this->lang->line('status_unverify');?>");
					$('#uc81_'+player_id).removeClass('bg-success').addClass('bg-secondary');
				}
			}else{
				$("#uc85_"+player_id).show();
			}
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
		function call_tag_data(){
			$.ajax({url: '<?php echo base_url("tag/get_all_tag_data");?>',
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
							$("#tag").append($('<option></option>').val(json.response[i]['tag_id']).html(json.response[i]['tag_code']));
						}
						$("#tag").val('');
					}
				},
				error: function (request,error){
				}
			});
		}
		function call_tag_player_data(){
			$.ajax({url: '<?php echo base_url("tag/get_all_tag_player_data");?>',
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
							$("#tag_player").append($('<option></option>').val(json.response[i]['tag_player_id']).html(json.response[i]['tag_player_code']));
						}
						$("#tag_player").val('');
					}
				},
				error: function (request,error){
				}
			});
		}
		function tagModify(id){
			layer.open({
				type: 2,
				area: [((browser_width < 600) ? '100%': '450px'), ((browser_width < 600) ? '100%': '400px')],
				fixed: false,
				maxmin: true,
				scrollbar: false,
				title: '<?php echo $this->lang->line('title_tag');?>',
				content: '<?php echo base_url('player/tag_modify/');?>' + id
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