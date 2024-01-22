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

					<div id="card-panel" class="col-12">

						<div id="card-table-1" class="card">

							<div class="card-header">

								<form action="<?php echo site_url('user/search');?>" id="user-form" name="user-form" class="form-horizontal" method="post" accept-charset="utf-8" novalidate="novalidate">

									<div class="form-group row">

										<div class="col-md-3">

											<div class="row mb-2">

												<label class="col-4 col-form-label col-form-label-sm font-weight-normal"><?php echo $this->lang->line('label_username');?></label>

												<div class="col-8">

													<input type="text" class="form-control form-control-sm" id="username" name="username" value="">

												</div>

											</div>											

										</div>

										<div class="col-md-3">

											<div class="row mb-2">

												<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search nav-icon"></i> <?php echo $this->lang->line('button_search');?></button>

											</div>											

										</div>

									</div>

								</form>

							</div>

							<!-- /.card-header -->

							<div class="card-body">

								<table id="user-table-1" class="table table-striped table-bordered table-hover" style="width:100%;">

									<thead>

										<tr>

											<th><?php echo $this->lang->line('label_username');?></th>

											<th><?php echo $this->lang->line('label_nickname');?></th>

											<!-- <th><?php echo $this->lang->line('title_user_role');?></th> -->

											<th><?php echo $this->lang->line('label_upline');?></th>

											<th><?php echo $this->lang->line('label_credit_points');?></th>

											<th><?php echo $this->lang->line('label_user_domain');?></th>

											<th><?php echo $this->lang->line('label_status');?></th>

											<th><?php echo $this->lang->line('label_registered_date');?></th>

											<th><?php echo $this->lang->line('label_last_login_date');?></th>

											<?php if(permission_validation(PERMISSION_CHANGE_PASSWORD) == TRUE OR permission_validation(PERMISSION_USER_ADD) == TRUE):?>

											<th><?php echo $this->lang->line('label_action');?></th>

											<?php endif;?>

										</tr>

									</thead>

									<tbody>
									</tbody>

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

		$(document).ready(function() {

			$('#user-table-1').DataTable({

				"paging": false,

				"lengthChange": false,

				"scrollX": ((browser_width < 600) ? true: false),

				"responsive": false,

				"filter": false,

				"pageLength" : 10,

			"order": [[0, "desc"]],

			"ajax": {

				"url": "<?php echo base_url('user/listing/1/newgxwlpt');?>",

				"dataType": "json",

				"type": "POST",

				"data": function (d) {

					d.csrf_bctp_bo_token = $('meta[name=csrf_token]').attr('content');

				},

				"complete": function(response) {

					var json = JSON.parse(JSON.stringify(response));
					console.log(json);

					if(json.status == 200) {

						$('meta[name=csrf_token]').attr('content', json.responseJSON.csrfHash);

					}

				},

			},

			"columnDefs": [

				//{"targets": [0], "visible": false}
				{"targets": [5], "visible": false}
				//{"targets": [7], "visible": false}

			]

			});

			

			var form = $('#user-form');

			

			form.submit(function(e) {

				if(is_allowed == true) {

					is_allowed = false;

					

					$.ajax({url: form.attr('action'),

						data: { csrf_bctp_bo_token : $('meta[name=csrf_token]').attr('content'), username : $('#username').val() },

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

							

							if(json.status == '<?php echo EXIT_SUCCESS;?>') {

								if(json.msg != '') {

									for(var i=2;i<=table_num;i++) {

										$('#card-table-' + i).remove();

									}

								

									table_num = json.msg.num;

									$('#card-panel').append(json.msg.table);

									$('html, body').animate({scrollTop:$(document).height()}, 500);

								}	

							}

							else {

								var message = '';

								

								if(json.msg.username_error != '') {

									message = json.msg.username_error;

								}

								else if(json.msg.general_error != '') {

									message = json.msg.general_error;

								}

								

								parent.layer.alert(message, {icon: 2, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});

							}

							

							$('meta[name=csrf_token]').attr('content', json.csrfHash);

						},

						error: function (request,error) {

						}

					});  

				}

				

				return false;

			});

		});

		

		function updateData(id) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_user_setting');?>',

				content: '<?php echo base_url('user/edit/');?>' + id

			});

		}

		

		function permissionSetup(id) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '610px'), ((browser_width < 600) ? '100%': '500px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_set_permissions');?>',

				content: '<?php echo base_url('user/permission/');?>' + id

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

				content: '<?php echo base_url('user/password/');?>' + id

			});

		}

		

		function addDownline(username) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '500px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_add_downline');?>',

				content: '<?php echo base_url('user/add/');?>' + username

			});

		}

		

		function depositPoints(id) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_deposit_point_to_downline');?>',

				content: '<?php echo base_url('user/deposit/');?>' + id

			});

		}

		

		function withdrawPoints(id) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '500px'), ((browser_width < 600) ? '100%': '460px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_withdraw_point_from_downline');?>',

				content: '<?php echo base_url('user/withdraw/');?>' + id

			});

		}

		

		var is_allowed = true;

		var table_num = 1;

		

		function getDownline(username, num) {

			if(is_allowed == true) {

				is_allowed = false;

				

				var next_num = (num + 1);

				for(var i=next_num;i<=table_num;i++) {

					$('#card-table-' + i).remove();

				}

			

				table_num = next_num;

				

				$.ajax({url: '<?php echo base_url('user/downline/');?>' + table_num + '/' + username,

					type: 'get',                  

					async: 'true',

					beforeSend: function() {

						layer.load(1);

					},

					complete: function() {

						is_allowed = true;

					},

					success: function (data) {

						if(data != '') {

							$('#card-panel').append(data);

							$('html, body').animate({scrollTop:$(document).height()}, 500);

						}	

					},

					error: function (request,error) {

					}

				});  

			}

		}

	</script>	

</body>

</html>

