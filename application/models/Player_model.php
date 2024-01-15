<?php
class Player_model extends CI_Model {
	//Declare database tables
	protected $table_players = 'players';
	public function update_profile_group($id = NULL)
	{	
		$this->db->set('profile_group_id', NULL);
		$this->db->where('profile_group_id', $id);
		$this->db->update($this->table_players);
	}
	public function update_bank_group($id = NULL)
	{	
		$dbprefix = $this->db->dbprefix;
		$player_table = $dbprefix.$this->table_players;
		$query = $this->db->query("SELECT player_id, username, bank_group_id FROM {$player_table} WHERE bank_group_id LIKE '%,{$id},%'");
		if($query->num_rows() > 0)
        {
        	foreach($query->result() as $row)
			{
				$arr = explode(',', $row->bank_group_id);
				$arr = array_values(array_filter($arr));
				$new_arr = array_values(array_filter(array_diff($arr, array($id))));
				$new_bank_group = "";
				if(!empty($new_arr)){
					$new_bank_group = ','.implode(',', $new_arr).',';
				}
				$this->db->query("UPDATE {$player_table} SET bank_group_id = ? WHERE player_id = ? LIMIT 1", array($new_bank_group, $row->player_id));
			}
        }
	}
	public function today_total_player() {
		$start_date = strtotime(date('Y-m-d 00:00:00'));
		$end_date 	= strtotime(date('Y-m-d 23:59:59'));
		$result = NULL;
		$query = $this
				->db
				->select('COUNT(player_id) AS total')
				->where('created_date >=', $start_date)
				->where('created_date <=', $end_date)
				->like('upline_ids', $this->session->userdata('root_user_id'))				
				->get($this->table_players);
		
		$result = ($query->num_rows() > 0) ? $query->row_array() : array();
		$query->free_result();
		return $result;
	}
	public function active_user_deposit($start=null,$end=null,$rootid=null) {
		$query = $this
				->db
				->select('player_id')
				->like('upline_ids', $rootid)
				->get('players');
		if($query->num_rows() > 0) {
			$list = array();
			foreach($query->result() as $row) {
				array_push($list,$row->player_id);
			}
		}
		else {
			$list = array();
		}
		$query->free_result();
		
		if(sizeof($list)>0) {
			$this->db->distinct();
			$this->db->select('COUNT(player_id) AS total');
			$this->db->where('created_date >=', $start);
			$this->db->where('created_date <=', $end);
			$this->db->where_in('player_id', $list);					
			$query = $this->db->get('deposits');
			
			$result = ($query->num_rows() > 0) ? $query->row_array() : array();
			$query->free_result();
		}
		else {
			$result = array();
		}
		
		return $result;
	}
	public function get_player_data($id = NULL)
	{	
		$result = NULL;
		$query = $this
				->db
				->where('player_id', $id)
				->limit(1)
				->get($this->table_players);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function get_player_data_by_username($username = NULL)
	{	
		$result = NULL;
		$query = $this
				->db
				->where('username', $username)
				->limit(1)
				->get($this->table_players);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function add_player($user = NULL)
	{
		$this->load->library('rng');
		$referral_code = $this->rng->get_token(12);
		#Check for referral code availbility
		//$referral_code = $this->input->post('username', TRUE);
		$is_loop = TRUE;
		while($is_loop == TRUE) {
			$rs = $this->get_player_data_by_referral_code($referral_code);
			if( ! empty($rs)) {
				$referral_code = $this->rng->get_token(10);
			}
			else {
				$is_loop = FALSE;
			}
		}
		$new_password = $this->input->post('password', TRUE);
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		$DBdata = array(
			'mobile' => '',
			'email' => '',
			'username' => $this->input->post('username', TRUE),
			'password' => $new_password,
			'active' => STATUS_ACTIVE,
			'nickname' => '',
			'line_id' => '',
			'is_promotion' => (($this->input->post('is_promotion', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_player_bank_account' => (($this->input->post('is_player_bank_account', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_fingerprint' => (($this->input->post('is_fingerprint', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_level' => (($this->input->post('is_level', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'avatar' => $this->input->post('avatar', TRUE),
			'profile_group_id' => $this->input->post('profile_group_id', TRUE),
			'bank_group_id' => (($this->input->post('bank_group_id[]', TRUE)) ? ','.implode(',', $this->input->post('bank_group_id[]', TRUE)).',' : ''),
			'referrer' => $this->input->post('referrer', TRUE),
			'upline' => $user['username'],
			'upline_ids' => (empty($user['upline_ids']) ? ',' . $user['user_id'] . ',' : $user['upline_ids'] . $user['user_id'] . ','),
			'win_loss_suspend_limit' => $this->input->post('win_loss_suspend_limit', TRUE),
			'player_type' => $this->input->post('player_type', TRUE),
			'game_type' => (($this->input->post('game_type[]', TRUE)) ? ','.implode(',', $this->input->post('game_type[]', TRUE)).',' : ''),
			'promotion_type' => $this->input->post('promotion_type', TRUE),
			'referral_code' => $referral_code,
			'is_offline_deposit' => (($this->input->post('is_offline_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_online_deposit' => (($this->input->post('is_online_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_credit_card_deposit' => (($this->input->post('is_credit_card_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_hypermart_deposit' => (($this->input->post('is_hypermart_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'online_deposit_channel' => (($this->input->post('online_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('online_deposit_channel[]', TRUE)).',' : ''),
			'credit_card_deposit_channel' => (($this->input->post('credit_card_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('credit_card_deposit_channel[]', TRUE)).',' : ''),
			'hypermart_deposit_channel' => (($this->input->post('hypermart_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('hypermart_deposit_channel[]', TRUE)).',' : ''),
			'is_player_change_password' => STATUS_INACTIVE,
			'created_ip' => $this->input->ip_address(),
			'created_by' => $this->session->userdata('username'),
			'created_date' => time()
		);
		if(permission_validation(PERMISSION_PLAYER_NICKNAME) == TRUE){
			$DBdata['nickname'] = $this->input->post('nickname', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_LINE_ID) == TRUE){
			$DBdata['line_id'] = $this->input->post('line_id', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_MOBILE) == TRUE){
			$DBdata['mobile'] = $this->input->post('mobile', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_EMAIL) == TRUE){
			$DBdata['email'] = $this->input->post('email', TRUE);
		}
		$this->db->insert($this->table_players, $DBdata);
		return $DBdata;
	}
	public function update_player($arr = NULL)
	{	
		$DBdata = array(
			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_SUSPEND),
			'is_promotion' => (($this->input->post('is_promotion', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_player_bank_account' => (($this->input->post('is_player_bank_account', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_fingerprint' => (($this->input->post('is_fingerprint', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_level' => (($this->input->post('is_level', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'avatar' => $this->input->post('avatar', TRUE),
			'profile_group_id' => $this->input->post('profile_group_id', TRUE),
			'bank_group_id' => (($this->input->post('bank_group_id[]', TRUE)) ? ','.implode(',', $this->input->post('bank_group_id[]', TRUE)).',' : ''),
			'referrer' => $this->input->post('referrer', TRUE),
			'bank_id' => $this->input->post('bank_id', TRUE),
			//'bank_account_name' => $this->input->post('bank_account_name', TRUE),
			'bank_account_no' => $this->input->post('bank_account_no', TRUE),
			'win_loss_suspend_limit' => $this->input->post('win_loss_suspend_limit', TRUE),
			'player_type' => $this->input->post('player_type', TRUE),
			'game_type' => (($this->input->post('game_type[]', TRUE)) ? ','.implode(',', $this->input->post('game_type[]', TRUE)).',' : ''),
			'promotion_type' => $this->input->post('promotion_type', TRUE),
			'is_offline_deposit' => (($this->input->post('is_offline_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_online_deposit' => (($this->input->post('is_online_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_credit_card_deposit' => (($this->input->post('is_credit_card_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'is_hypermart_deposit' => (($this->input->post('is_hypermart_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'online_deposit_channel' => (($this->input->post('online_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('online_deposit_channel[]', TRUE)).',' : ''),
			'credit_card_deposit_channel' => (($this->input->post('credit_card_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('credit_card_deposit_channel[]', TRUE)).',' : ''),
			'hypermart_deposit_channel' => (($this->input->post('hypermart_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('hypermart_deposit_channel[]', TRUE)).',' : ''),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		if(permission_validation(PERMISSION_PLAYER_NICKNAME) == TRUE){
			$DBdata['nickname'] = $this->input->post('nickname', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_LINE_ID) == TRUE){
			$DBdata['line_id'] = $this->input->post('line_id', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_MOBILE) == TRUE){
			$DBdata['mobile'] = $this->input->post('mobile', TRUE);
		}
		if(permission_validation(PERMISSION_PLAYER_EMAIL) == TRUE){
			$DBdata['email'] = $this->input->post('email', TRUE);
		}
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		if(permission_validation(PERMISSION_PLAYER_NICKNAME) == FALSE){
			$DBdata['nickname'] = $arr['nickname'];
		}
		if(permission_validation(PERMISSION_PLAYER_LINE_ID) == FALSE){
			$DBdata['line_id'] = $arr['line_id'];
		}
		if(permission_validation(PERMISSION_PLAYER_MOBILE) == FALSE){
			$DBdata['mobile'] = $arr['mobile'];
		}
		if(permission_validation(PERMISSION_PLAYER_EMAIL) == FALSE){
			$DBdata['email'] = $arr['email'];
		}
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		$DBdata['bank_account_name'] = $this->input->post('bank_account_name', TRUE);
		return $DBdata;
	}
	public function update_player_password($arr = NULL)
	{	
		$new_password = $this->input->post('password', TRUE);
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		$DBdata = array(
			'password' => $new_password,
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_referrer($arr = NULL, $referrer = NULL)
	{
		$DBdata = array(
			'referrer' => $referrer,
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function point_transfer($arr = NULL, $points = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'points' => $points,
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET points = (points + ?) WHERE player_id = ? LIMIT 1", array($DBdata['points'], $DBdata['player_id']));
		return $DBdata;
	}
	public function reward_transfer($arr = NULL,$amount = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'rewards' => $amount,
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET rewards = (rewards + ?) WHERE player_id = ? LIMIT 1", array($DBdata['rewards'], $DBdata['player_id']));
		return $DBdata;
	}
	public function update_player_wallet($arr = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'points' => $arr['amount'],
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET points = (points + ?) WHERE player_id = ? LIMIT 1", array($DBdata['points'], $DBdata['player_id']));
		return $DBdata;
	}
	public function update_player_reward($arr = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'rewards' => $arr['reward_amount'],
			'updated_date' => time()
		);
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET rewards = (rewards + ?) WHERE player_id = ? LIMIT 1", array($DBdata['rewards'], $DBdata['player_id']));
		return $DBdata;
	}
	public function get_player_game_account_data($provider_code = NULL, $player_id = NULL)
	{
		$result = NULL;
		$query = $this
				->db
				->where('game_provider_code', $provider_code)
				->where('player_id', $player_id)
				->limit(1)
				->get('player_game_accounts');
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function player_today_win_loss(){
		$result = NULL;
		$start_date = strtotime(date('Y-m-d 00:00:00'));
		$end_date = strtotime(date('Y-m-d 23:59:59'));
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.status = ' . STATUS_COMPLETE;
		$where .= ' AND a.payout_time >= ' . $start_date;
		$where .= ' AND a.payout_time <= ' . $end_date;
		$select = "COUNT(a.transaction_id) AS total_bet, COALESCE(SUM(a.bet_amount),0) AS total_bet_amount, COALESCE(SUM(a.win_loss),0) AS total_win_loss, COALESCE(SUM(a.bet_amount_valid),0) AS total_rolling_amount";			
		$wl_query_string = "SELECT {$select} FROM {$dbprefix}transaction_report a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where";
		$wl_query = $this->db->query($wl_query_string);
		if($wl_query->num_rows() > 0)
		{
			$result =  $wl_query->row_array();  
		}
		$wl_query->free_result();
		return $result;
	}
	public function player_all_win_loss($player_id = NULL){
		$result = NULL;
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.status = ' . STATUS_COMPLETE;
		$where .= ' AND a.player_id = ' . $player_id;
		$select = "COUNT(a.transaction_id) AS total_bet, COALESCE(SUM(a.bet_amount),0) AS total_bet_amount, COALESCE(SUM(a.win_loss),0) AS total_win_loss, COALESCE(SUM(a.bet_amount_valid),0) AS total_rolling_amount";			
		$wl_query_string = "SELECT {$select} FROM {$dbprefix}transaction_report a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where";
		$wl_query = $this->db->query($wl_query_string);
		if($wl_query->num_rows() > 0)
		{
			$result =  $wl_query->row_array();  
		}
		$wl_query->free_result();
		return $result;
	}
	public function player_active_five_minute(){
		$result = NULL;
		$current_time = time()+300;
		$last_five_minutes = ($current_time - 600);
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
		return $result;
	}
	public function player_active_five_minute_by_agent_id($agent_id = NULL){
		$result = NULL;
		$current_time = time()+300;
		$last_five_minutes = ($current_time - 600);
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.last_online_date >= ' . $last_five_minutes;
		$where .= ' AND a.last_online_date <= ' . $current_time;
		$select = "COUNT(a.player_id) AS total_player";
		$pa_query_string = "SELECT {$select} FROM {$dbprefix}players a WHERE a.upline_ids LIKE '%," . $agent_id . ",%' ESCAPE '!' $where";
		$pa_query = $this->db->query($pa_query_string);
		if($pa_query->num_rows() > 0)
		{
			$result =  $pa_query->row_array();  
		}
		$pa_query->free_result();
		return $result;
	}
	public function get_player_data_by_referral_code($referral_code = NULL)
	{	
		$result = NULL;
		$query = $this
				->db
				->select('username')
				->where('referral_code', $referral_code)
				->limit(1)
				->get('players');
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function get_player_game_account_data_list($player_id = NULL)
	{
		$result = NULL;
		$query = $this
				->db
				->where('player_id', $player_id)
				->get('player_game_accounts');
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();  
		}
		$query->free_result();
		return $result;
	}
	public function clear_login_token($oldData = NULL)
	{
		$this->db->set('login_token', '');
		$this->db->where('username', $oldData['username']);
		$this->db->limit(1);
		$this->db->update('players');
		$oldData['login_token'] = '';
		return $oldData;
	}
	public function update_player_mark($arr = NULL,$mark_id = NULL)
	{	
		$DBdata = array(
			'mark' => $mark_id,
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_additional_info($arr = NULL){
		$DBdata = array(
			'additional_info' => $this->input->post('additional_info', TRUE),
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_version_two($arr = NULL){
		$DBdata = array(
			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_SUSPEND),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		$DBdata['nickname'] = $arr['nickname'];
		$DBdata['player_type'] = $arr['player_type'];
		$DBdata['win_loss_suspend_limit'] = $arr['win_loss_suspend_limit'];
		return $DBdata;
	}
	public function player_total_pending_bet_amount($player_id = NULL)
	{
		$result = NULL;
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.player_id = "' . $player_id . '"';
		$where .= ' AND a.status = '. STATUS_PENDING;
		$result = NULL;
		$query_string = "(SELECT COALESCE(SUM(a.bet_amount),0) AS total FROM {$dbprefix}transaction_report a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function update_player_turnover($arr = NULL, $turnover_total = NULL, $is_update_time = NULL, $is_reset = NULL){
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'turnover_start_date' => $arr['turnover_start_date'],
			'turnover_total_required' => $arr['turnover_total_required'] + $turnover_total,
			'turnover_total_current' => $arr['turnover_total_current'],
		);
		if($is_update_time == STATUS_ACTIVE){
			$DBdata['turnover_start_date'] = time();
		}
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET turnover_total_current = (turnover_total_current + ?), turnover_start_date = ?, turnover_total_required = ? WHERE player_id = ? LIMIT 1", array($turnover_total, $DBdata['turnover_start_date'], $DBdata['turnover_total_required'], $DBdata['player_id']));
		return $DBdata;
	}
	public function reset_player_turnover($arr = NULL){
		$DBdata = array(
			'turnover_start_date' => 0,
			'turnover_total_required' => 0,
			'turnover_total_current' => 0,
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		return $DBdata;
	}
	public function turnover_adjust($arr = NULL, $turnover = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'turnover' => $turnover,
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET turnover_total_current = (turnover_total_current + ?) WHERE player_id = ? LIMIT 1", array($DBdata['turnover'], $DBdata['player_id']));
		return $DBdata;
	}
	public function update_player_wallet_lock($player_id = NULL,$wallet_status = NULL){
		$DBdata = array(
			'wallet_lock' => $wallet_status,
		);
		$this->db->where('player_id', $player_id);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
	}
	public function add_player_agent($user = NULL)
	{
		$this->load->library('rng');
		$referral_code = $this->rng->get_token(12);
		#Check for referral code availbility
		//$referral_code = $this->input->post('username', TRUE);
		$is_loop = TRUE;
		while($is_loop == TRUE) {
			$rs = $this->get_player_data_by_referral_code($referral_code);
			if( ! empty($rs)) {
				$referral_code = $this->rng->get_token(10);
			}
			else {
				$is_loop = FALSE;
			}
		}
		$new_password = $this->input->post('password', TRUE);
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		$DBdata = array(
			'mobile' => '',
			'email' => '',
			'username' => $this->input->post('username', TRUE),
			'password' => $new_password,
			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_SUSPEND),
			'nickname' => '',
			'line_id' => '',
			'is_promotion' => STATUS_INACTIVE,
			'is_player_bank_account' => STATUS_ACTIVE,
			'is_fingerprint' => STATUS_INACTIVE,
			'is_level' => STATUS_ACTIVE,
			'avatar' => 1,
			'profile_group_id' => '',
			'bank_group_id' => '',
			'referrer' => $this->input->post('referrer', TRUE),
			'upline' => $user['username'],
			'upline_ids' => (empty($user['upline_ids']) ? ',' . $user['user_id'] . ',' : $user['upline_ids'] . $user['user_id'] . ','),
			'win_loss_suspend_limit' => 0,
			'player_type' => PLAYER_TYPE_CASH_MARKET,
			'game_type' => '',
			'promotion_type' => PROMOTION_TYPE_STRICT_BASED,
			'referral_code' => $referral_code,
			'is_offline_deposit' => STATUS_INACTIVE,
			'is_online_deposit' => STATUS_ACTIVE,
			'is_credit_card_deposit' => STATUS_INACTIVE,
			'is_hypermart_deposit' => STATUS_INACTIVE,
			'is_player_change_password' => STATUS_INACTIVE,
			'created_ip' => $this->input->ip_address(),
			'created_by' => $this->session->userdata('username'),
			'created_date' => time()
		);
		$DBdata['line_id'] = $this->input->post('line_id', TRUE);
		$DBdata['mobile'] = $this->input->post('mobile', TRUE);
		$this->db->insert($this->table_players, $DBdata);
		return $DBdata;
	}
	public function update_player_agent($arr = NULL)
	{	
		$DBdata = array(
			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_SUSPEND),
			'referrer' => $this->input->post('referrer', TRUE),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$DBdata['mobile'] = $this->input->post('mobile', TRUE);
		$DBdata['line_id'] = $this->input->post('line_id', TRUE);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_tagids($arr = NULL,$tags_ids = NULL){
		$DBdata = array(
			'tag_ids' => $tags_ids,
		);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_tagid($arr = NULL,$tag_id = NULL){
		$DBdata = array(
			'tag_id' => $tag_id,
			//'tag_times' => $this->input->post('tag_times', TRUE),
			'tag_force' => (($this->input->post('tag_force', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
		);
		if($arr['tag_id'] != $tag_id){
			$DBdata['tag_times'] = 0;
		}else{
			if($arr['tag_force'] == STATUS_INACTIVE){
				if($DBdata['tag_force'] == STATUS_ACTIVE){
					$DBdata['tag_times'] = 0;
				}
			}
		}
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		return $DBdata;
	}
	public function update_player_bank_account_name($player_id = NULL,$bank_account_name = NULL){
		$DBdata = array(
			'bank_account_name' => $bank_account_name,
		);
		$this->db->where('player_id', $player_id);
		$this->db->limit(1);
		$this->db->update($this->table_players, $DBdata);
		return $DBdata;
	}
	public function player_active_by_type($array = NULL){
		$result = NULL;
		if($array['type_genre'] == MESSAGE_GENRE_ALL){
			$this->db->select('player_id,username');
			$this->db->where('active',STATUS_ACTIVE);
			$query =  $this->db->get($this->table_players);
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();	
			}
			$query->free_result();
		}else if($array['type_genre'] == MESSAGE_GENRE_USER_ALL){
			$this->db->select('player_id,username');
			$this->db->where('active',STATUS_ACTIVE);
			$this->db->where('upline',$array['agent']);
			$query =  $this->db->get($this->table_players);
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();	
			}
			$query->free_result();
		}else{
			$username_array = array_filter(explode('#',strtolower($array['username'])));
			if(!empty($username_array)){
				if(sizeof($username_array) == 1){
					$this->db->select('player_id,username');
					$this->db->where('active',STATUS_ACTIVE);
					$this->db->where('username',$username_array[0]);
					$this->db->limit(1);
				}else{
					$this->db->select('player_id,username');
					$this->db->where('active',STATUS_ACTIVE);
					$this->db->where_in('username',$username_array);
				}
				$query =  $this->db->get($this->table_players);
				if($query->num_rows() > 0)
				{
					$result = $query->result_array();	
				}
				$query->free_result();
			}
		}
		return $result;
	}
	public function get_all_player_data_by_ids($player_ids = NULL){
		$result = NULL;
		$query = $this
				->db
				->select('player_id,username,points')
				->where_in('player_id', $player_ids)
				->get($this->table_players);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row) {
				$result[$row->player_id] = (array) $row;						
			}
		}
		$query->free_result();
		return $result;
	}
	public function player_pending_bet_amount($player_id = NULL)
	{
		$result = NULL;
		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= 'WHERE player_id = "' . $player_id . '"';
		$where .= ' AND status = '. STATUS_PENDING;
		$result = NULL;
		$query_string = "(SELECT transaction_id FROM {$dbprefix}transaction_report $where LIMIT 1)";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	public function get_player_username_by_array($player_list = NULL){
		$username_array = array_filter(explode('#',strtolower($player_list)));
		$result = array();
		if(!empty($username_array)){
			if(sizeof($username_array) == 1){
				$this->db->select('player_id,username');
				$this->db->like('upline_ids', "," . $this->session->userdata('root_user_id') . ",");
				$this->db->where('username',$username_array[0]);
				$this->db->limit(1);
			}else{
				$this->db->select('player_id,username');
				$this->db->like('upline_ids', "," . $this->session->userdata('root_user_id') . ",");
				$this->db->where_in('username',$username_array);
			}
			$query =  $this->db->get($this->table_players);
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();	
			}
			$query->free_result();
		}
		return $result;
	}
	public function bulk_update_player_setting_by_type($type = NULL, $arr = NULL){
		$DBdata = array();
		if($this->input->post('modify_option_1', TRUE) == STATUS_ACTIVE){
			$DBdata['active'] = (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_SUSPEND);
		}
		if($this->input->post('modify_option_2', TRUE) == STATUS_ACTIVE){
			$DBdata['is_offline_deposit'] = (($this->input->post('is_offline_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE);
		}
		if($this->input->post('modify_option_3', TRUE) == STATUS_ACTIVE){
			$DBdata['bank_group_id'] = (($this->input->post('bank_group_id[]', TRUE)) ? ','.implode(',', $this->input->post('bank_group_id[]', TRUE)).',' : '');
		}
		if($this->input->post('modify_option_4', TRUE) == STATUS_ACTIVE){
			$DBdata['is_online_deposit'] = (($this->input->post('is_online_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE);
		}
		if($this->input->post('modify_option_5', TRUE) == STATUS_ACTIVE){
			$DBdata['online_deposit_channel'] = (($this->input->post('online_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('online_deposit_channel[]', TRUE)).',' : '');
		}
		if($this->input->post('modify_option_6', TRUE) == STATUS_ACTIVE){
			$DBdata['is_credit_card_deposit'] = (($this->input->post('is_credit_card_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE);
		}
		if($this->input->post('modify_option_7', TRUE) == STATUS_ACTIVE){
			$DBdata['credit_card_deposit_channel'] = (($this->input->post('credit_card_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('credit_card_deposit_channel[]', TRUE)).',' : '');
		}
		if($this->input->post('modify_option_8', TRUE) == STATUS_ACTIVE){
			$DBdata['is_hypermart_deposit'] = (($this->input->post('is_hypermart_deposit', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE);
		}
		if($this->input->post('modify_option_9', TRUE) == STATUS_ACTIVE){
			$DBdata['hypermart_deposit_channel'] = (($this->input->post('hypermart_deposit_channel[]', TRUE)) ? ','.implode(',', $this->input->post('hypermart_deposit_channel[]', TRUE)).',' : '');
		}
		if(!empty($DBdata)){
			$DBdata['updated_by'] = $this->session->userdata('username');
			$DBdata['updated_date'] = time();
			if($type == "1"){
				$this->db->where('upline', $arr['username']);
				$this->db->update($this->table_players, $DBdata);
			}else if($type == "2"){
				$this->db->like('bank_group_id', ','.$arr['group_id'].',');
				$this->db->update($this->table_players, $DBdata);
			}else if($type == "3"){
				$this->db->where('tag_id', $arr['tag_id']);
				$this->db->update($this->table_players, $DBdata);
			}else if($type == "4"){
				$this->db->like('tag_ids', ','.$arr['tag_player_id'].',');
				$this->db->update($this->table_players, $DBdata);
			}else if($type == "5"){
				$this->db->where('level_id', $arr['level_number']);
				$this->db->update($this->table_players, $DBdata);
			}else if($type == "6"){
				$updateData = array();
				if(!empty($arr) && sizeof($arr) > 0){
					foreach($arr as $arr_row){
						array_push($updateData, $arr_row['player_id']);
					}
				}
				$this->db->where_in('player_id', $updateData);
				$this->db->update($this->table_players, $DBdata);
			}
		}
		$DBdata['type'] = $type;
		return $DBdata;
	}
}