<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="<?php echo get_language_code('iso');?>">
<head>
	<?php $this->load->view('parts/head_meta');?>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>

	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>

	<style>
		#container_player {
		height: 500px;
		/* margin-top: 75px; */
		}

	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 30px;
		max-width: 800px;
		margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #ebebeb;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
		background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
		background: #f1f7ff;
	}

	/* chart Statistics */
	#container {
    min-width: 310px;
    max-width: 800px;
    height: 500px;
    margin: 0 auto;
	}

	.buttons {
		min-width: 310px;
		text-align: center;
		margin: 1rem 0;
		font-size: 0;
	}

	.buttons button {
		cursor: pointer;
		border: 1px solid silver;
		border-right-width: 0;
		background-color: #f8f8f8;
		font-size: 1rem;
		padding: 0.5rem;
		transition-duration: 0.3s;
		margin: 0;
	}

	.buttons button:first-child {
		border-top-left-radius: 0.3em;
		border-bottom-left-radius: 0.3em;
	}

	.buttons button:last-child {
		border-top-right-radius: 0.3em;
		border-bottom-right-radius: 0.3em;
		border-right-width: 1px;
	}

	.buttons button:hover {
		color: white;
		background-color: rgb(158 159 163);
		outline: none;
	}

	.buttons button.active {
		background-color: #0051b4;
		color: white;
	}
	</style>

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
			<?php
			if(permission_validation(PERMISSION_HOME) == TRUE){
			?>
			<section class="content">
			<div class="row">
				<!-- chart Statistics -->
				<div class="clearfix col-md-6">
				<figure class="highcharts-figure">
					<div id="container"></div>
					<div class="highcharts-description">
						<div class='buttons'>
							<button id='days' class='active' style="display:none;">
								Day
							</button>
							<button id='months' style="display:none;">
								Month
							</button>
						</div>
						<input type="text" style="display:none;" id="drillDownName" name="drillDownName" value=""/>
					</div>
				</figure>
				</div>

				<div class="clearfix col-md-6">
					<figure class="highcharts-figure">
						<div id="container_player"></div>
						<div class="highcharts-description">	
							<div class='buttons'>
								<button id='last30DaysPlayer'>
									Last 30days
								</button>
								<button id='lastMonthPlayer'>
									Last Month
								</button>
								<button id='yesterdayPlayer'>
									Yesterday
								</button>
								<button id='todayPlayer' class='active'>
									Today
								</button>
								<button id='thisWeekPlayer'>
									This Week
								</button>
								<button id='thisMonthPlayer'>
									This Month
								</button>
							</div>
						</div>
					</figure>
				</div>
				
			</div>
			
			</section>
			<?php } ?>
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
	function today_deposit(){
		$.ajax({url: "<?php echo site_url('home/today_deposit'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-deposit').show();
				$('#val-deposit').html('-');
			},
			complete: function() {
				$('#load-deposit').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-deposit').html(json.result);
			}
		});
	}

	function getNewSeriesData(seriesName) {
		let value;
		$.ajax({url: "<?php echo site_url('home/profit'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: false,
			success: function(json){				
				value =  json.day;
			}
		});
		return (value);

	}

	function today_promotion(){
		$.ajax({url: "<?php echo site_url('home/today_promotion'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-promotion').show();
				$('#val-promotion').html('-');
			},
			complete: function() {
				$('#load-promotion').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-promotion').html(json.result);
			}
		});
	}
	function today_bonus(){
		$.ajax({url: "<?php echo site_url('home/today_bonus'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-bonus').show();
				$('#val-bonus').html('-');
			},
			complete: function() {
				$('#load-bonus').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-bonus').html(json.result);
			}
		});
	}
	function today_withdraw(){
		$.ajax({url: "<?php echo site_url('home/today_withdraw'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-wd').show();
				$('#val-wd').html('-');
			},
			complete: function() {
				$('#load-wd').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-wd').html(json.result);
			}
		});
	}
	function today_profit(){
		$.ajax({url: "<?php echo site_url('home/today_profit'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-profit').show();
				$('#val-profit').html('-');
			},
			complete: function() {
				$('#load-profit').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-profit').html(json.result);
			}
		});
	}
	function today_user(){
		$.ajax({url: "<?php echo site_url('home/today_user'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-nu').show();
				$('#val-nu').html('-');
			},
			complete: function() {
				$('#load-nu').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-nu').html(json.result);
			}
		});
	}
	function today_active_user(){
		$.ajax({url: "<?php echo site_url('home/today_active_user'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-active').show();
				$('#val-active').html('-');
			},
			complete: function() {
				$('#load-active').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-active').html(json.result);
			}
		});
	}
	function active_user_deposit(){
		$.ajax({url: "<?php echo site_url('home/active_user_deposit'); ?>",
			type: 'GET',
			dataType: 'json',
			cache: false,
			async: 'true',
			beforeSend: function() {
				$('#load-active').show();
				$('#val-active').html('-');
			},
			complete: function() {
				$('#load-active').hide();
			},
			error: function (request,error) {
				//console.log(request);				
			},
			success: function(json){				
				$('#val-active').html(json.result);
			}
		});
	}
	function updateChartAndButtons(data, buttonId, chart, type = 'player') {
		//console.log(buttonId);
		//console.log(data);
		//chart.series[0].setData(data);

		if(type =='player'){
			chart.series[0].setData(data);

			// Remove 'active' class from all buttons
			$('#last30DaysPlayer, #lastMonthPlayer, #yesterdayPlayer, #todayPlayer, #thisWeekPlayer, #thisMonthPlayer').removeClass('active');

			// Add 'active' class to the clicked button
			$('#' + buttonId).addClass('active');
		}else {
			// buttonId == 'days'? chart.series[0].setData(data): chart.series[0].setData(data[1].data);
			chart.series[0].setData(data)
  			//chart.series[1].setData(data[1].data);
			
			// Remove 'active' class from all buttons
			$('#days, #months, #yesterday, #today, #thisWeek, #thisMonth').removeClass('active');

			// Add 'active' class to the clicked button
			$('#' + buttonId).addClass('active');
		}
		
	}

	$(document).ready(function() {				
		today_deposit();
		today_promotion();
		today_bonus();
		today_withdraw();
		today_profit();
		today_user();
		//today_active_user();
		active_user_deposit();
	});
	</script>
</body>
</html>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var chartOptionPlayer =	{
			chart: {
				type: 'pie'
			},
			title: {
				text: 'Player'
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Players'
				}
			},
			series: [{
				name: 'Players',
				colors: [
					'#3667c9', '#00f194'
				],
				colorByPoint: true,
				groupPadding: 0,
				data: <?php echo json_encode($player_statistics[3]); ?>,
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.1f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}]
		};

		// Create the chart
		var chartPlayer = Highcharts.chart('container_player', chartOptionPlayer);

		// Add event listener to the buttons
		$('#last30DaysPlayer, #lastMonthPlayer, #yesterdayPlayer, #todayPlayer, #thisWeekPlayer, #thisMonthPlayer').on('click', function() {
		var buttonId = $(this).attr('id');
		var dataIndex;
		switch (buttonId) {
		case 'last30DaysPlayer':
			dataIndex = 0;
			break;
		case 'lastMonthPlayer':
			dataIndex = 1;
			break;
		case 'yesterdayPlayer':
			dataIndex = 2;
			break;
		case 'todayPlayer':
			dataIndex = 3;
			break;
		case 'thisWeekPlayer':
			dataIndex = 4;
			break;
		case 'thisMonthPlayer':
			dataIndex = 5;
			break;
		default:
			break;
		}

		var data = <?php echo json_encode($player_statistics); ?>[dataIndex];
		updateChartAndButtons(data, buttonId, chartPlayer);
		});

		//chart Statistics
		var chartOption = {
			chart: {
				type: 'column'
			},
			title: {
				align: 'left',
				text: ''
			},
			subtitle: {
				align: 'left',
				text: 'Click the columns to view versions.'
			},
			accessibility: {
				announceNewData: {
					enabled: true
				}
			},
			xAxis: {
				//categories: ['Depos99999its', 'Promotion', 'Bonus', 'Withdrawals', 'Profits']
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'MYR'
				}
			},
			// credits: {
			// 	enabled: false
			// },
			// plotOptions: {
			// 	column: {
			// 		borderRadius: '25%',
			// 		dataLabels: {
			// 			enabled: true,
			// 			rotation: 0,
			// 			color: '#FFFFFF',
			// 			align: 'right',
			// 			format: '{point.y:,.1f}', // Sử dụng hàm định dạng số ở đây
			// 		}
			// 	}
			// },
			legend: {
        		enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.1f} MYR'
					}
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> MYR<br/>'
			},
			series: [
				{
					name: 'Statistics',
					// colorByPoint: true,
					data: [
						{
							name: 'Deposit',
							y: <?php echo $depositDate['totalDepositDate'] ?>,
							drilldown: 'Deposit'
						},
						{
							name: 'Promotion',
							y: <?php echo $promotionDate['totalPromotionDate'] ?>,
							drilldown: 'Promotion'
						},
						{
							name: 'Profit',
							y: <?php echo $profitDate['totalProfitDate'] ?>,
							drilldown: 'Profit'
						},
						{
							name: 'Withdrawal',
							y: <?php echo $withdrawlDate['totalWithdrawlDate'] ?>,
							drilldown: 'Withdrawal'
						},
						{
							name: 'Bonus',
							y: <?php echo $bonusDate['totalBonusDate'] ?>,
							drilldown: 'Bonus'
						}
					]
				}
			],
			drilldown: {
				breadcrumbs: {
					position: {
						align: 'right'
					}
				},
				series: [
					{
						name: 'Deposit',
						id: 'Deposit',
						data: <?php echo json_encode($depositDate['depositDate']) ?>
						// data: [['18-Mar-24' , 10], ['20-Mar-24',20.1], ['21-Mar-24', 5], ['22-Mar-24',50], ['23-Mar-24',70]]
					},
					{
						name: 'Promotion',
						id: 'Promotion',
						data: <?php echo json_encode($promotionDate['promotionDate']) ?>
						//data: [['19-Mar-24' , 10], ['20-Mar-24',20.1], ['21-Mar-24', 3.36], ['22-Mar-24',5], ['23-Mar-24',79]]
					},
					{
						name: 'Profit',
						id: 'Profit',
						data: <?php echo json_encode($profitDate['profitDate']) ?>
						//data: [['19-Mar-24' , 1000], ['20-Mar-24',-200.1], ['21-Mar-24', 3000], ['22-Mar-24',-500], ['23-Mar-24',-700]]
					},
					{
						name: 'Withdrawal',
						id: 'Withdrawal',
						data: <?php echo json_encode($withdrawlDate['withdrawlDate']) ?>
						//data: [['19-Mar-24' , 1000], ['20-Mar-24',200.1], ['21-Mar-24', 3000], ['22-Mar-24',500], ['23-Mar-24',10]]
					},
					{
						name: 'Bonus',
						id: 'Bonus',
						data: <?php echo json_encode($withdrawlDate['withdrawlDate']) ?>
						//data: [['19-Mar-24' , 100], ['20-Mar-24',20.161], ['21-Mar-24', 300.143], ['22-Mar-24',500], ['23-Mar-24',700]]
					}
				]
			}
		};

		chartOption.chart.events = {
			//drilldown: handleDrilldown, // Gán hàm xử lý sự kiện vào sự kiện drilldown
			drilldown: function (e) {
				$('#days, #months').removeClass('active');
				$('#days').addClass('active');
				$('#days, #months').show();
				$('#drillDownName').val(e.point.drilldown);
				// Xác định dữ liệu mới dựa trên sự kiện drilldown
				var newSeriesData = getNewSeriesData(e.point.name);
			},
			drillup: function (e) {
				$('#days, #months').hide();

            //console.log('Drillup event triggered:', e);
			this.update({
					series: [{
						data: [
						{
							name: 'Deposit',
							y: 2,
							drilldown: 'Deposit'
						},
						{
							name: 'Promotion',
							y: -2.6,
							drilldown: 'Promotion'
						},
						{
							name: 'Profit',
							y: 1.3,
							drilldown: 'Profit'
						},
						{
							name: 'Withdrawal',
							y: -3,
							drilldown: 'Withdrawal'
						},
						{
							name: 'Bonus',
							y: 6,
							drilldown: 'Bonus'
						}
					]
					}]
				});
        	}
		};

		// Create the chart
		var chart = Highcharts.chart('container', chartOption);

		// Add event listener to the buttons
		$('#days, #months, #yesterday, #today, #thisWeek, #thisMonth').on('click', function() {
		var buttonId = $(this).attr('id');
		var data;
		
		switch (buttonId) {
		case 'days':
			switch ($('#drillDownName').val().toUpperCase()) {
				case 'Deposit'.toUpperCase():
					data = <?php echo json_encode($depositDate['depositDate']) ?>;
					break;
				case 'Promotion'.toUpperCase():
					data = <?php echo json_encode($promotionDate['promotionDate']) ?>;
					break;
				case 'Profit'.toUpperCase():
					data = <?php echo json_encode($profitDate['profitDate']) ?>;
					break;
				case 'Withdrawal'.toUpperCase():
					data = <?php echo json_encode($withdrawlDate['withdrawlDate']) ?>;
					break;
				case 'Bonus'.toUpperCase():
					data = <?php echo json_encode($bonusDate['bonusDate']) ?>;
					break;
				};
			break;
		case 'months':
			switch ($('#drillDownName').val().toUpperCase()) {
				case 'Deposit'.toUpperCase():
					data = <?php echo json_encode($depositMonth['depositMonth']) ?>;
					break;
				case 'Promotion'.toUpperCase():
					data = <?php echo json_encode($promotionMonth['promotionMonth']) ?>;
					break;
				case 'Profit'.toUpperCase():
					data = <?php echo json_encode($profitMonth['profitMonth']) ?>;
					break;
				case 'Withdrawal'.toUpperCase():
					data = <?php echo json_encode($withdrawlMonth['withdrawlMonth']) ?>;
					break;
				case 'Bonus'.toUpperCase():
					data = <?php echo json_encode($bonusMonth['bonusMonth']) ?>;
					break;
				};
			break;

		default:
			break;
		}
		updateChartAndButtons(data, buttonId, chart, 'notPlayer');
		});
	});
</script>