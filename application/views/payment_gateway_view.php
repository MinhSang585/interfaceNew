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
						<?php if(permission_validation(PERMISSION_USER_ROLE_ADD) == TRUE):?>
							<div class="card-header">
								<h3 class="card-title"><button onclick="addData()" type="button" class="btn btn-block bg-gradient-primary btn-sm"><i class="fas fa-plus nav-icon"></i> <?php echo $this->lang->line('button_add_new');?></button></h3>
							</div>
							<!-- /.card-header -->
							<?php endif;?>
							<div class="card-body">

								<table id="payment_gateway-table" class="table table-striped table-bordered table-hover">

									<thead>

										<tr>

											<th><?php echo $this->lang->line('label_hashtag');?></th>

											<?php if(!permission_validation(PERMISSION_PAYMENT_GATEWAY_UPDATE)):?>
												<th width="295"><?php echo $this->lang->line('label_name');?></th>
											<?php else:?>
												<th width="180"><?php echo $this->lang->line('label_name');?></th>
											<?php endif;?>

											<th width="80"><?php echo $this->lang->line('label_sequence');?></th>
											<th width="50"><?php echo $this->lang->line('label_active');?></th>

											<th width="50"><?php echo $this->lang->line('label_verify');?></th>

											<th width="150"><?php echo $this->lang->line('label_type');?></th>

											<th width="80"><?php echo $this->lang->line('label_rate');?></th>

											<th width="120"><?php echo $this->lang->line('label_min_amounts');?></th>

											<th width="120"><?php echo $this->lang->line('label_max_amounts');?></th>
											
											<!--  -->
											<th width="40"><?php echo $this->lang->line('label_maintenance');?></th>

											<!-- <th width="60"><?php echo $this->lang->line('label_frontend_display');?></th> -->

											<th width="60"><?php echo $this->lang->line('label_fixed_maintenance');?></th>
											<th width="70"><?php echo $this->lang->line('label_day');?></th>
											<th width="80"><?php echo $this->lang->line('label_from_time');?></th>
											<th width="80"><?php echo $this->lang->line('label_to_time');?></th>
											<th width="60"><?php echo $this->lang->line('label_urgent_maintenance');?></th>
											<th width="120"><?php echo $this->lang->line('label_date');?></th>
											<!--  -->

											<th width="120"><?php echo $this->lang->line('label_updated_by');?></th>

											<th width="150"><?php echo $this->lang->line('label_updated_date');?></th>

											<?php if(permission_validation(PERMISSION_PAYMENT_GATEWAY_UPDATE) == TRUE):?>

											<th width="70"><?php echo $this->lang->line('label_action');?></th>

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

		$(document).ready(function() {

			$('#payment_gateway-table').DataTable({

				"processing": true,

				"serverSide": true,

				"scrollX": true,

				"responsive": false,

				"filter": false,

				"pageLength" : 10,

				"order": [[0, "desc"]],

				"ajax": {

					"url": "<?php echo site_url('paymentgateway/listing');?>",

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

					{"targets": [0], "visible": false}

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

		});

		

		function updateData(id) {

			layer.open({

				type: 2,

				area: [((browser_width < 600) ? '100%': '600px'), ((browser_width < 600) ? '100%': '800px')],

				fixed: false,

				maxmin: true,

				scrollbar: false,

				title: '<?php echo $this->lang->line('title_payment_gateway_setting');?>',

				content: '<?php echo base_url('paymentgateway/edit/');?>' + id

			});

		}

		function addData() {
			layer.open({
			type: 2,
			area: [((browser_width < 600) ? '100%': '600px'), ((browser_width < 600) ? '100%': '700px')],
			fixed: false,
			maxmin: true,
			scrollbar: false,
			title: '<?php echo $this->lang->line('title_payment_gateway_setting');?>',
			content: '<?php echo base_url('paymentgateway/add/');?>'
			});
		}

		function deleteData(id) {
			layer.confirm('<?php echo $this->lang->line('label_confirm_to_proceed');?>', {
				title: '<?php echo $this->lang->line('label_info');?>',
				btn: ['<?php echo $this->lang->line('status_yes');?>', '<?php echo $this->lang->line('status_no');?>']
			}, function() {
				$.get('<?php echo base_url('paymentgateway/delete/');?>' + id, function(data) {
					var json = JSON.parse(JSON.stringify(data));
					var message = json.msg;
					var msg_icon = 2;
					if(json.status == '<?php echo EXIT_SUCCESS;?>') {
						msg_icon = 1;
						$('#payment_gateway-table').DataTable().ajax.reload();
					}
					layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
				});
			});
			}

	</script>	

</body>

</html>

