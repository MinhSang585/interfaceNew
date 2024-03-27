<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('deposit_model', 'player_model', 'withdrawal_model','bonus_model','promotion_model','miscellaneous_model','user_model','transaction_model','player_promotion_model'));
	}
	public function index()
	{
		$is_logged_in = $this->is_logged_in();
		if( ! empty($is_logged_in)) 
		{
			echo '<script type="text/javascript">parent.location.href = "' . site_url($is_logged_in) . '";</script>';
		}
		else
		{
			$this->save_current_url('home');
			$data['page_title'] = $this->lang->line('title_home');
			$data['deposit'] = 45;
			$data['withdrawal'] = $this->withdrawal_model->today_total_only_agent_withdrawal();
			$data['player'] = $this->player_model->today_total_player();
			$data['player_win_loss'] = $this->player_model->player_today_win_loss();
			$data['active_player'] = $this->player_model->player_active_five_minute();
			
			$last30Days = 
			[
				[
				  'data' => [5, -33, 4, 7, 2],
				]
			];

			$lastMonth = 
			[
				[
				  'data' => [56, -33, 4, 7, 2],
				]
			];

			$yesterday = 
			[
				[
				  'data' => [171, -3, 3, -7, 2],
				]
			];

			$today = 
			[
				[
				  'name' => 'today',
				  'data' => [2, -2.6, 1.3, -3, 6],
				],
				[
				  'name' => 'yesterday',
				  'data' => [1, -3.6, 1.3, -2, 3],
				],
			];

			$thisWeek = 
			[
				[
				  'data' => [12, -5, 5, -8, 2],
				]
			];

			$thisMonth = 
			[
				[
				  'data' => [15, -5, 15, -8, 2],
				]
			];

			$data['last30Days'] = json_encode($last30Days);
			$data['lastMonth'] = json_encode($lastMonth);
			$data['yesterday'] = json_encode($yesterday);
			$data['today'] = json_encode($today);
			$data['arrToday'] = $today;
			
			$data['depositDate'] = $this->depositDate();
			$data['promotionDate'] = $this->promotionDate();
			$data['profitDate'] = $this->profitDate();
			$data['withdrawlDate'] = $this->withdrawlDate();
			$data['bonusDate'] = $this->bonusDate();

			$data['depositMonth'] = $this->depositMonth();
			$data['promotionMonth'] = $this->promotionMonth();
			$data['profitMonth'] = $this->profitMonth();
			$data['withdrawlMonth'] = $this->withdrawlMonth();
			$data['bonusMonth'] = $this->bonusMonth();

			$data['arrDayProfit'] =
			[
				[['20-Mar-24' , 1], ['20-Mar-24',-2.1], ['21-Mar-24', 3], ['22-Mar-24',-5], ['23-Mar-24',-7]]		
			];
			$data['thisWeek'] = json_encode($thisWeek);
			$data['thisMonth'] = json_encode($thisMonth);
			
			$data['player_statistics'] =  [
				[
					['Active Players <h1>+57%</h1>', 500],
					['New Players', 600]
				]
				,
				[
					['Active Players +37%', 300],
					['New Players', 700]
				]
				,
				[
					['Active Players +87%', 200],
					['New Players', 500]
				]
				,
				[
					['Active Players +27%', 368],
					['New Players', 780]
				]
				,
				[
					['Active Players +37%', 300],
					['New Players', 800]
				]
				,
				[
					['Active Players +27%', 100],
					['New Players', 1500]
				]
			];
			$this->load->view('home_page', $data);
		}	
	}

	public function profit() {
		$data['day'] = 
				[['19-Mar-24' , 1], ['20-Mar-24',-2.1], ['21-Mar-24', 3], ['22-Mar-24',-5], ['23-Mar-24',-7]]		
			;
		json_output($data);
		free_array($data);	
		exit();	
	}
	public function verify_session()
	{
		$is_logged_in = $this->is_logged_in();
		if( ! empty($is_logged_in)) 
		{
			echo site_url($is_logged_in);
		}
	}
	public function today_deposit() {
		$deposit 	= $this->deposit_model->today_total_only_agent_deposit();
		$value		= ((isset($deposit['total']) && $deposit['total'] > 0)) ? val_decimal($deposit['total'],2) : val_decimal(0,2);
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_promotion() {
		$promotion 	= null;#$this->promotion_model->today_total_promotion();
		$value		= ((isset($promotion['total']) && $promotion['total'] > 0)) ? val_decimal($promotion['total'],2) : val_decimal(0,2);
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_bonus() {
		$bonus 	= $this->bonus_model->today_total_bonus();
		$value		= ((isset($bonus['total']) && $bonus['total'] > 0)) ? val_decimal($bonus['total'],2) : val_decimal(0,2);
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_withdraw() {
		$withdrawal = $this->withdrawal_model->today_total_only_agent_withdrawal();
		$value		= ((isset($withdrawal['total']) && $withdrawal['total'] > 0)) ? val_decimal($withdrawal['total'],2) : val_decimal(0,2);
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_profit() {
		$profit 	= $this->player_model->player_today_win_loss();
		$value		= ((isset($profit['total']) && $profit['total'] > 0)) ? val_decimal($profit['total'],2) : val_decimal(0,2);
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_user() {
		$player 	= $this->player_model->today_total_player();
		$value		= ((isset($player['total']) && $player['total'] > 0)) ? $player['total'] : 0;
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);
		free_array($player);	
		exit();	
	}
	public function active_user_deposit() {
		$start_date = strtotime(date('Y-m-d 00:00:00'));
		$end_date 	= strtotime(date('Y-m-d 23:59:59'));
		$root_id  	= $this->session->userdata('root_user_id');
		
		$player 	= $this->player_model->active_user_deposit($start_date,$end_date,$root_id);
		$value		= ((isset($player['total_player']) && $player['total_player'] > 0)) ? $player['total_player'] : 0;
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_active_user() {
		$player 	= $this->player_model->player_active_five_minute();
		$value		= ((isset($player['total_player']) && $player['total_player'] > 0)) ? $player['total_player'] : 0;
		$json 		= array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $value);
		json_output($json);
		free_array($json);	
		exit();	
	}
	public function today_active_user_by_agent(){
		$main_player 	= $this->player_model->player_active_five_minute();
		$result = array(
			'main_agent_player_count' =>  ((isset($main_player['total_player'])) ? $main_player['total_player'] : 0),
			'sub_account_data' => array(), 
		);
		$dbprefix = $this->db->dbprefix;
		$query_string = "(SELECT user_id,username FROM {$dbprefix}users WHERE upline = '" . $this->session->userdata('root_username') . "')";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			//$all_agent_data = $query->result_array();
			foreach($query->result_array() as $result_row){
				$count = $this->player_model->player_active_five_minute_by_agent_id($result_row['user_id']);
				if(!empty($count['total_player'])){
					array_push($result['sub_account_data'], array('username'=>$result_row['username'],'player_count'=>$count['total_player']));
				}
			}
		}
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'result' => $result);
		json_output($json);
		exit();
	}
	public function totalDepositOfflineInterval(){
		$arr = $this->session->userdata('alert_deposits_offline');
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$total_alert_deposit  = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.deposit_id',
			1 => 'a.created_date',
			2 => 'a.amount',
			3 => 'b.username',
			4 => 'c.avatar_image',
			5 => 'a.amount_apply',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.deposit_type = ' . DEPOSIT_OFFLINE_BANKING;
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['deposit_id'] = $result_row['deposit_id'];
				$row['created_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['amount'] = $result_row['amount'];
				$row['amount_apply'] = $result_row['amount_apply'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
				if($result_row['created_date'] > $arr){
					$total_alert_deposit += 1;
				}
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_deposit = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_deposit;
			$data['result_alert'] = $total_alert_deposit;
		}else{
			if($miscellaneous['deposit_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_deposit;
				$data['result_alert'] = $total_alert_deposit;
			}else{
				if(permission_validation(PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT) == TRUE){
					$deposit_sound_path = SOUND_SOURCE_PATH.$miscellaneous['deposit_sound'];
					if(file_exists($deposit_sound_path)){
						if(($miscellaneous['is_deposit_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_DEPOSIT_OFFLINE))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['deposit_sound'];
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_deposit;
						$data['result_alert'] = $total_alert_deposit;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_deposit;
					$data['result_alert'] = $total_alert_deposit;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalDepositOnlineInterval(){
		$arr = $this->session->userdata('alert_deposits_online');
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$total_alert_deposit  = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.deposit_id',
			1 => 'a.created_date',
			2 => 'a.amount',
			3 => 'b.username',
			4 => 'c.avatar_image',
			5 => 'a.amount_apply',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.deposit_type = ' . DEPOSIT_ONLINE_BANKING;
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['deposit_id'] = $result_row['deposit_id'];
				$row['created_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['amount'] = $result_row['amount'];
				$row['amount_apply'] = $result_row['amount_apply'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
				if($result_row['created_date'] > $arr){
					$total_alert_deposit += 1;
				}
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_deposit = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_deposit;
			$data['result_alert'] = $total_alert_deposit;
		}else{
			if($miscellaneous['online_deposit_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_deposit;
				$data['result_alert'] = $total_alert_deposit;
			}else{
				if(permission_validation(PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT) == TRUE){
					$deposit_sound_path = SOUND_SOURCE_PATH.$miscellaneous['online_deposit_sound'];
					if(file_exists($deposit_sound_path)){
						if(($miscellaneous['is_online_deposit_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_DEPOSIT_ONLINE))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['online_deposit_sound'];
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_deposit;
						$data['result_alert'] = $total_alert_deposit;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_deposit;
					$data['result_alert'] = $total_alert_deposit;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalDepositCreditCardInterval(){
		$arr = $this->session->userdata('alert_deposits_credit');
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$total_alert_deposit  = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.deposit_id',
			1 => 'a.created_date',
			2 => 'a.amount',
			3 => 'b.username',
			4 => 'c.avatar_image',
			5 => 'a.amount_apply',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.deposit_type = ' . DEPOSIT_CREDIT_CARD;
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['deposit_id'] = $result_row['deposit_id'];
				$row['created_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['amount'] = $result_row['amount'];
				$row['amount_apply'] = $result_row['amount_apply'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
				if($result_row['created_date'] > $arr){
					$total_alert_deposit += 1;
				}
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_deposit = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_deposit;
			$data['result_alert'] = $total_alert_deposit;
		}else{
			if($miscellaneous['credit_card_deposit_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_deposit;
				$data['result_alert'] = $total_alert_deposit;
			}else{
				if(permission_validation(PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT) == TRUE){
					$deposit_sound_path = SOUND_SOURCE_PATH.$miscellaneous['credit_card_deposit_sound'];
					if(file_exists($deposit_sound_path)){
						if(($miscellaneous['is_credit_card_deposit_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_DEPOSIT_CREDIT_CARD))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['credit_card_deposit_sound'];
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_deposit;
						$data['result_alert'] = $total_alert_deposit;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_deposit;
					$data['result_alert'] = $total_alert_deposit;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalDepositHypermartInterval(){
		$arr = $this->session->userdata('alert_deposits_hypermart');
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$total_alert_deposit  = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.deposit_id',
			1 => 'a.created_date',
			2 => 'a.amount',
			3 => 'b.username',
			4 => 'c.avatar_image',
			5 => 'a.amount_apply',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.deposit_type = ' . DEPOSIT_HYPERMART;
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['deposit_id'] = $result_row['deposit_id'];
				$row['created_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['amount'] = $result_row['amount'];
				$row['amount_apply'] = $result_row['amount_apply'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
				if($result_row['created_date'] > $arr){
					$total_alert_deposit += 1;
				}
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_deposit = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_deposit;
			$data['result_alert'] = $total_alert_deposit;
		}else{
			if($miscellaneous['hypermart_deposit_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_deposit;
				$data['result_alert'] = $total_alert_deposit;
			}else{
				if(permission_validation(PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT) == TRUE){
					$deposit_sound_path = SOUND_SOURCE_PATH.$miscellaneous['hypermart_deposit_sound'];
					if(file_exists($deposit_sound_path)){
						if(($miscellaneous['is_hypermart_deposit_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_DEPOSIT_HYPERMART))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['hypermart_deposit_sound'];
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_deposit;
							$data['result_alert'] = $total_alert_deposit;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_deposit;
						$data['result_alert'] = $total_alert_deposit;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_deposit;
					$data['result_alert'] = $total_alert_deposit;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalWithdrawInterval(){
		$arr = $this->session->userdata('alert_withdrawals');
		$start = 0;
		$limit = 5;
		$total_withdraw = 0;
		$total_alert_withdraw  = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.withdrawal_id',
			1 => 'a.created_date',
			2 => 'a.amount',
			3 => 'b.username',
			4 => 'c.avatar_image',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}withdrawals a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['withdrawal_id'] = $result_row['withdrawal_id'];
				$row['created_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['amount'] = $result_row['amount'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
				if($result_row['created_date'] > $arr){
					$total_alert_withdraw += 1;
				}
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_withdraw = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_withdraw;
			$data['result_alert'] = $total_alert_withdraw;
		}else{
			if($miscellaneous['withdrawal_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_withdraw;
				$data['result_alert'] = $total_alert_withdraw;
			}else{
				if(permission_validation(PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT) == TRUE){
					$withdraw_sound_path = SOUND_SOURCE_PATH.$miscellaneous['withdrawal_sound'];
					if(file_exists($withdraw_sound_path)){
						if(($miscellaneous['is_withdrawal_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_WITHDRAWAL))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['withdrawal_sound'];
							$data['result'] = $total_withdraw;
							$data['result_alert'] = $total_alert_withdraw;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_withdraw;
							$data['result_alert'] = $total_alert_withdraw;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_withdraw;
						$data['result_alert'] = $total_alert_withdraw;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_withdraw;
					$data['result_alert'] = $total_alert_withdraw;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalPlayerOnlineInterval(){
		$data = array();
		$row = array();
		$current_time = time();
		$last_five_minutes = ($current_time - 3600);
		$this->db->select('a.username,a.last_online_date,b.avatar_image');
		$this->db->from('players a');
		$this->db->join('avatar b','a.avatar = b.avatar_id');
		$this->db->where('a.last_online_date >= ',$last_five_minutes);
		$this->db->where('a.last_online_date <= ',$current_time);
		$this->db->like('a.upline_ids',$this->session->userdata('root_user_id'));
		$this->db->order_by('a.last_online_date','DESC');
		$this->db->limit(5,0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['username'] = $result_row['username'];
				$row['last_online_date'] = $result_row['last_online_date'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['last_online_date']);
				$data['list'][] = $row;
			} 
		}
		$query->free_result();
		$result = NULL;
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.last_online_date >= ' . $last_five_minutes;
		$where .= ' AND a.last_online_date <= ' . $current_time;
		$select = "COUNT(a.player_id) AS total_player";
		$pa_query_string = "SELECT {$select} FROM {$dbprefix}players a WHERE a.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where";
		$pa_query = $this->db->query($pa_query_string);
		if($pa_query->num_rows() > 0)
		{
			$result =  $pa_query->row_array();
		}
		$pa_query->free_result();
		if(!empty($result) && isset($result['total_player'])){
			$data['result'] = $result['total_player'];
		}else{
			$data['result'] = 0;
		}
		echo json_encode($data); 
		exit();
	}
	public function totalRiskInterval(){
		$start = 0;
		$limit = 5;
		$total_risk = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_risk;
		}else{
			if(!empty($miscellaneous) && ($miscellaneous['risk_management'] = STATUS_ACTIVE)){
				if($miscellaneous['risk_period'] == RISK_YEARLY){
					//Yearly
					$start_date	= date('Y-m-d 00:00:00', strtotime('first day of january this year'));
					$end_date	= date('Y-m-d 23:59:59', strtotime('last day of december this year'));
				}else if($miscellaneous['risk_period'] == RISK_MONTHLY){
					//Monthly
					$start_date	= date('Y-m-d 00:00:00', strtotime('first day of this month'));
					$end_date	= date('Y-m-d 23:59:59', strtotime('last day of this month'));
				}else{
					//Daily
					$start_date	= date('Y-m-d 00:00:00', time());
					$end_date	= date('Y-m-d 23:59:59', time());
				}
				$start_time = strtotime($start_date); 
				$end_time = strtotime($end_date);
				$columns = array( 
					0 => 'a.player_risk_id',
					1 => 'a.updated_date',
					2 => 'a.percentage',
					3 => 'b.username',
					4 => 'c.avatar_image',
				);
				$select = implode(',', $columns);
				$dbprefix = $this->db->dbprefix;
				$where = '';
				$where .= ' AND a.report_date = ' . $start_time;
				$where .= ' AND a.end_date = ' . $end_time;
				//$where .= ' AND a.suspended = ' . STATUS_ACTIVE;
				$query_string = "(SELECT {$select} FROM {$dbprefix}player_risk_report a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
				$query_string_2 = " ORDER by a.updated_date DESC LIMIT {$start}, {$limit}";
				$query = $this->db->query($query_string.$query_string_2);
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() as $result_row){
						$row = array();
						$row['player_risk_id'] = $result_row['player_risk_id'];
						$row['updated_date'] = $result_row['updated_date'];
						$row['username'] = $result_row['username'];
						$row['avatar_image'] = $result_row['avatar_image'];
						$row['percentage'] = $result_row['percentage'];
						$row['time_gaps'] = time_different_gaps($current_time,$result_row['updated_date']);
						$data['list'][] = $row;
					}
				}
				$query->free_result();	
				$query = $this->db->query($query_string);
				$total_risk = $query->num_rows();
				$query->free_result();
				if($miscellaneous['risk_sound'] == ""){
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_risk;
				}else{
					if(permission_validation(PERMISSION_PLAYER_RISK_REPORT) == TRUE){
						$risk_sound_path = SOUND_SOURCE_PATH.$miscellaneous['risk_sound'];
						if(file_exists($risk_sound_path)){
							if(($miscellaneous['is_risk_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_RISK))){
								$data['soundCode'] = 0;
								$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['risk_sound'];
								$data['result'] = $total_risk;
							}else{
								$data['soundCode'] = 1;
								$data['soundFile'] = '';
								$data['result'] = $total_risk;
							}
						}else{
							$data['soundCode'] = 408;
							$data['soundFile'] = "";
							$data['result'] = $total_risk;
						}
					}else{
						$data['soundCode'] = 404;
						$data['soundFile'] = "";
						$data['result'] = $total_risk;
					}
				}
			}else{
				$data['soundCode'] = 403;
				$data['soundFile'] = "";
				$data['result'] = $total_risk;
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalRiskFrozenInterval(){
		$start = 0;
		$limit = 5;
		$total_risk = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_risk;
		}else{
			if(!empty($miscellaneous) && ($miscellaneous['risk_management'] = STATUS_ACTIVE)){
				if($miscellaneous['risk_period'] == RISK_YEARLY){
					//Yearly
					$start_date	= date('Y-m-d 00:00:00', strtotime('first day of january this year'));
					$end_date	= date('Y-m-d 23:59:59', strtotime('last day of december this year'));
				}else if($miscellaneous['risk_period'] == RISK_MONTHLY){
					//Monthly
					$start_date	= date('Y-m-d 00:00:00', strtotime('first day of this month'));
					$end_date	= date('Y-m-d 23:59:59', strtotime('last day of this month'));
				}else{
					//Daily
					$start_date	= date('Y-m-d 00:00:00', time());
					$end_date	= date('Y-m-d 23:59:59', time());
				}
				$start_time = strtotime($start_date); 
				$end_time = strtotime($end_date);
				$columns = array( 
					0 => 'a.player_risk_id',
					1 => 'a.updated_date',
					2 => 'a.percentage',
					3 => 'b.username',
					4 => 'c.avatar_image',
				);
				$select = implode(',', $columns);
				$dbprefix = $this->db->dbprefix;
				$where = '';
				$where .= ' AND a.report_date = ' . $start_time;
				$where .= ' AND a.end_date = ' . $end_time;
				$where .= ' AND a.suspended = ' . STATUS_SUSPEND;
				$query_string = "(SELECT {$select} FROM {$dbprefix}player_risk_report a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
				$query_string_2 = " ORDER by a.updated_date DESC LIMIT {$start}, {$limit}";
				$query = $this->db->query($query_string.$query_string_2);
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() as $result_row){
						$row = array();
						$row['player_risk_id'] = $result_row['player_risk_id'];
						$row['updated_date'] = $result_row['updated_date'];
						$row['username'] = $result_row['username'];
						$row['avatar_image'] = $result_row['avatar_image'];
						$row['percentage'] = $result_row['percentage'];
						$row['time_gaps'] = time_different_gaps($current_time,$result_row['updated_date']);
						$data['list'][] = $row;
					}
				}
				$query->free_result();	
				$query = $this->db->query($query_string);
				$total_risk = $query->num_rows();
				$query->free_result();
				if($miscellaneous['risk_frozen_sound'] == ""){
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_risk;
				}else{
					if(permission_validation(PERMISSION_PLAYER_RISK_REPORT) == TRUE){
						$risk_sound_path = SOUND_SOURCE_PATH.$miscellaneous['risk_frozen_sound'];
						if(file_exists($risk_sound_path)){
							if(($miscellaneous['is_risk_frozen_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_RISK_FROZEN))){
								$data['soundCode'] = 0;
								$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['risk_frozen_sound'];
								$data['result'] = $total_risk;
							}else{
								$data['soundCode'] = 1;
								$data['soundFile'] = '';
								$data['result'] = $total_risk;
							}
						}else{
							$data['soundCode'] = 408;
							$data['soundFile'] = "";
							$data['result'] = $total_risk;
						}
					}else{
						$data['soundCode'] = 404;
						$data['soundFile'] = "";
						$data['result'] = $total_risk;
					}
				}
			}else{
				$data['soundCode'] = 403;
				$data['soundFile'] = "";
				$data['result'] = $total_risk;
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalBlacklistInterval(){
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.blacklists_report_id',
			1 => 'a.report_date',
			2 => 'a.username',
			3 => 'c.avatar_image',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.status = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}blacklists_report a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.username = b.username) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.report_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['blacklists_report_id'] = $result_row['blacklists_report_id'];
				$row['report_date'] = $result_row['report_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['report_date']);
				$data['list'][] = $row;
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_blacklist = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_blacklist;
		}else{
			if($miscellaneous['blacklist_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_blacklist;
			}else{
				if(permission_validation(PERMISSION_BLACKLIST_ANNOUNCEMENT) == TRUE){
					$blacklist_sound_path = SOUND_SOURCE_PATH.$miscellaneous['blacklist_sound'];
					if(file_exists($blacklist_sound_path)){
						if(($miscellaneous['is_blacklist_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_BLACKLIST))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['blacklist_sound'];
							$data['result'] = $total_blacklist;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_blacklist;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_blacklist;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_blacklist;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function totalPlayerBankImageInterval(){
		$start = 0;
		$limit = 5;
		$total_deposit = 0;
		$data = array();
		$row = array();
		$current_time = time();
		$columns = array( 
			0 => 'a.player_bank_image_id',
			1 => 'a.created_date',
			2 => 'b.username',
			3 => 'c.avatar_image',
		);
		$select = implode(',', $columns);
		$dbprefix = $this->db->dbprefix;
		$where = '';
		$where .= ' AND a.verify = ' . STATUS_PENDING;
		$query_string = "(SELECT {$select} FROM {$dbprefix}player_bank_image a, {$dbprefix}players b, {$dbprefix}avatar c WHERE (a.player_id = b.player_id) AND (b.avatar = c.avatar_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query_string_2 = " ORDER by a.created_date DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($query_string.$query_string_2);
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $result_row){
				$row = array();
				$row['player_bank_image_id'] = $result_row['player_bank_image_id'];
				$row['report_date'] = $result_row['created_date'];
				$row['username'] = $result_row['username'];
				$row['avatar_image'] = $result_row['avatar_image'];
				$row['time_gaps'] = time_different_gaps($current_time,$result_row['created_date']);
				$data['list'][] = $row;
			}
		}
		$query->free_result();	
		$query = $this->db->query($query_string);
		$total_player_bank_image = $query->num_rows();
		$query->free_result();
		$miscellaneous = $this->miscellaneous_model->get_miscellaneous();
		if(empty($miscellaneous)){
			$data['soundCode'] = 402;
			$data['soundFile'] = "";
			$data['result'] = $total_player_bank_image;
		}else{
			if($miscellaneous['player_bank_image_sound'] == ""){
				$data['soundCode'] = 404;
				$data['soundFile'] = "";
				$data['result'] = $total_player_bank_image;
			}else{
				if(permission_validation(PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT) == TRUE){
					$player_bank_image_sound_path = SOUND_SOURCE_PATH.$miscellaneous['player_bank_image_sound'];
					if(file_exists($player_bank_image_sound_path)){
						if(($miscellaneous['is_player_bank_image_sound'] == STATUS_ACTIVE) && empty($this->session->userdata('announcement_alert_'.ANNOUNCEMENT_PLAYER_BANK_IMAGE))){
							$data['soundCode'] = 0;
							$data['soundFile'] = base_url().SOUND_SOURCE_PATH.$miscellaneous['player_bank_image_sound'];
							$data['result'] = $total_player_bank_image;
						}else{
							$data['soundCode'] = 1;
							$data['soundFile'] = '';
							$data['result'] = $total_player_bank_image;
						}
					}else{
						$data['soundCode'] = 408;
						$data['soundFile'] = "";
						$data['result'] = $total_player_bank_image;
					}
				}else{
					$data['soundCode'] = 404;
					$data['soundFile'] = "";
					$data['result'] = $total_player_bank_image;
				}
			}
		}
		echo json_encode($data); 
		exit();
	}
	public function set_announcement($type = ANNOUNCEMENT_DEPOSIT){
		if(empty($this->session->userdata('announcement_alert_'.$type))){
			//sound
			$data = array(
				'announcement_status' => ANNOUNCEMENT_OFF,
			);
			$this->session->set_userdata('announcement_alert_'.$type, $data);
			$json = array('status'=> EXIT_SUCCESS,'code'=> ANNOUNCEMENT_OFF);
		}else{
			//mute
			$this->session->unset_userdata('announcement_alert_'.$type);
			$json = array('status'=> EXIT_SUCCESS,'code'=> ANNOUNCEMENT_ON);
		}
		echo json_encode($json); 
		exit();
	}

	public function getCurrentWeekDates() {
		$monday_of_current_week = date('Y-m-d', strtotime('monday this week'));
		$days_of_week[] = $monday_of_current_week;

		for ($i = 1; $i <= 6; $i++) {
			$days_of_week[] = date('Y-m-d', strtotime("+$i day", strtotime($monday_of_current_week)));
		}

		return $days_of_week;
	}

	function getFirstAndLastDayOfMonth() {
		$currentYear = date('Y');
		$monthDates = array();
		for ($month = 1; $month <= 12; $month++) {
			$firstDayOfMonth = date('Y-m-01', strtotime("$currentYear-$month-01"));
			$lastDayOfMonth = date('Y-m-t', strtotime("$currentYear-$month-01"));
	
			$monthDates[] = array(
				'month' => date('M', strtotime($firstDayOfMonth)).'-'.substr(date('Y'), -2),
				'first_day' => $firstDayOfMonth,
				'last_day' => $lastDayOfMonth
			);
		}
	
		return $monthDates;
	}

	public function depositDate() {
		$depositDate = [];
		$totalDepositDate = 0;
		foreach ($this->getCurrentWeekDates() as $key => $date) {
			$deposit 	= $this->deposit_model->total_only_agent_deposit($date, $date);
			$depositDate[] = [$date, $deposit['total']];
			$totalDepositDate +=  $deposit['total'];
		}

		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'depositDate' => $depositDate, 'totalDepositDate' => $totalDepositDate);
		return $json;
	}

	public function depositMonth() {
		$depositMonth = [];
		$totalDepositMonth = 0;
		foreach ($this->getFirstAndLastDayOfMonth() as $key => $month) {
			$deposit 	= $this->deposit_model->total_only_agent_deposit($month['first_day'], $month['last_day']);
			$depositMonth[] = [$month['month'], $deposit['total']];
			$totalDepositMonth +=  $deposit['total'];
		}

		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'depositMonth' => $depositMonth, 'totalDepositMonth' => $totalDepositMonth);
		return $json;
	}

	public function promotionDate() {
		$promotionDate = [];
		$totalPromotionDate = 0;
		foreach ($this->getCurrentWeekDates() as $key => $date) {
			$promotion 	= null; //$this->promotion_model->today_total_promotion($date, $date);
			$promotionDate[] = [$date, $promotion['total']];
			$totalPromotionDate += $promotion['total'];
		}
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'promotionDate' => $promotionDate, 'totalPromotionDate' => $totalPromotionDate);
		return $json;
	}

	public function promotionMonth() {
		$promotionMonth = [];
		$totalPromotionMonth = 0;
		foreach ($this->getFirstAndLastDayOfMonth() as $key => $month) {
			$promotion 	= null; //$this->promotion_model->today_total_promotion($month['first_day'], $month['last_day']);
			$promotionMonth[] = [$month['month'], $promotion['total']];
			$totalPromotionMonth += $promotion['total'];
		}
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'promotionMonth' => $promotionMonth, 'totalPromotionMonth' => $totalPromotionMonth);
		return $json;
	}

	public function profitDate() {
		$userData 	= $this->user_model->get_user_data($this->session->userdata('root_user_id'));
		$profitDate = [];
		$totalProfitDate = 0;
		foreach ($this->getCurrentWeekDates() as $key => $date) {

			$getTotalWinLoss = $this->transaction_model->getTotalWinLoss($userData['user_id'], $date, $date);	
			$getRewardAmount 	= $this->player_promotion_model->getRewardAmount($this->session->userdata('root_user_id'), $date, $date);

			$possess_win_loss = (($getTotalWinLoss['total_win_loss'] * $userData['possess']) / 100);
			$possess_promotion = (($getRewardAmount['total_reward_amount'] * $userData['possess']) / 100);

			$value = $possess_win_loss*-1 + $possess_promotion*-1;
			$profitDate[] = [$date, $value];
			$totalProfitDate += $value;
		}
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'profitDate' => $profitDate, 'totalProfitDate' => $totalProfitDate);
		return $json;
	}

	public function profitMonth() {
		$userData 	= $this->user_model->get_user_data($this->session->userdata('root_user_id'));
		$profitMonth = [];
		$totalProfitMonth = 0;
		foreach ($this->getFirstAndLastDayOfMonth() as $key => $month) {

			$getTotalWinLoss = $this->transaction_model->getTotalWinLoss($userData['user_id'], $month['first_day'], $month['last_day']);	
			$getRewardAmount 	= $this->player_promotion_model->getRewardAmount($this->session->userdata('root_user_id'), $month['first_day'], $month['last_day']);

			$possess_win_loss = (($getTotalWinLoss['total_win_loss'] * $userData['possess']) / 100);
			$possess_promotion = (($getRewardAmount['total_reward_amount'] * $userData['possess']) / 100);

			$value = $possess_win_loss*-1 + $possess_promotion*-1;
			$profitMonth[] = [$month['month'], $value];
			$totalProfitMonth += $value;
		}
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'profitMonth' => $profitMonth, 'totalProfitMonth' => $totalProfitMonth);
		return $json;
	}

	public function withdrawlDate() {
		$withdrawlDate = [];
		$totalWithdrawlDate = 0;
		foreach ($this->getCurrentWeekDates() as $key => $date) {
			$withdrawal 	= $this->withdrawal_model->today_total_only_agent_withdrawal($date, $date);
			$withdrawlDate[] = [$date, $withdrawal['total']];
			$totalWithdrawlDate += $withdrawal['total'];
		}
		
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'withdrawlDate' => $withdrawlDate, 'totalWithdrawlDate' => $totalWithdrawlDate);
		return $json;
	}

	public function withdrawlMonth() {
		$withdrawlMonth = [];
		$totalWithdrawlMonth = 0;
		foreach ($this->getFirstAndLastDayOfMonth() as $key => $month) {
			$withdrawal 	= $this->withdrawal_model->today_total_only_agent_withdrawal($month['first_day'], $month['last_day']);
			$withdrawlMonth[] = [$month['month'], $withdrawal['total']];
			$totalWithdrawlMonth += $withdrawal['total'];
		}
		
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'withdrawlMonth' => $withdrawlMonth, 'totalWithdrawlMonth' => $totalWithdrawlMonth);
		return $json;
	}

	public function bonusDate() {
		$bonusDate = [];
		$totalBonusDate = 0;
		foreach ($this->getCurrentWeekDates() as $key => $date) {
			$bonus 	= $this->bonus_model->today_total_bonus($date, $date);
			$bonusDate[] = [$date, (float)$bonus['total']];
			$totalBonusDate += $bonus['total'];
		}
		
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'bonusDate' => $bonusDate, 'totalBonusDate' => $totalBonusDate);
		return $json;
	}

	public function bonusMonth() {
		$bonusMonth = [];
		$totalBonusMonth = 0;
		foreach ($this->getFirstAndLastDayOfMonth() as $key => $month) {
			$bonus 	= $this->bonus_model->today_total_bonus($month['first_day'], $month['last_day']);
			$bonusMonth[] = [$month['month'], (float)$bonus['total']];
			$totalBonusMonth += $bonus['total'];
		}
		
		$json = array('status' => EXIT_SUCCESS,'msg' => $this->lang->line('label_successful'),'bonusMonth' => $bonusMonth, 'totalBonusMonth' => $totalBonusMonth);
		return $json;
	}
}