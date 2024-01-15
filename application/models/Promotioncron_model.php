<?php
class Promotioncron_model extends CI_Model {
	protected $table_promotion = 'promotion';
	protected $table_promotion_genre = 'promotion_genre';
	protected $table_promotion_result_logs = 'promotion_result_logs';
	protected $table_promotion_bonus_range = 'promotion_bonus_range';
	protected $table_player_promotion = 'player_promotion';
	protected $table_cash_transfer_report = 'cash_transfer_report';
	protected $table_players = 'players';


	public function get_promotion_genre_data($promotion_genre_code = NULL){
		$result = NULL;
		$query = $this
				->db
				->select('sync_lock')
				->where('genre_code', $promotion_genre_code)
				->where('active',STATUS_ACTIVE)
				->limit(1)
				->get($this->table_promotion_genre);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;	
	}

	public function update_promotion_cron_sync_lock($promotion_genre_code = NULL,$sync_status = NULL){
		$result = array('sync_lock' => $sync_status);
		$this->db->where('genre_code', $promotion_genre_code);
		$this->db->limit(1);
		$this->db->update($this->table_promotion_genre, $result);
	}

	public function promotion_data_list($promotion_genre_code = NULL){

		$result = NULL;
		$current_time = time();
		$query = $this
				->db
				->where('promotion.start_date <= ',$current_time)
				->like('promotion.apply_type', ','.PROMOTION_USER_TYPE_SYSTEM.',')
				->group_start()
				->where('promotion.end_date >= ',$current_time)
				->or_where('promotion.end_date',0)
				->group_end()
				->where('genre_code', $promotion_genre_code)
				->where('active',STATUS_ACTIVE)
				->order_by('promotion_id',"DESC")
				->get($this->table_promotion);
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();  
		}
		$query->free_result();
		return $result;
	}

	public function get_promotion_result_logs($promotion_genre_code = NULL, $promotion_sync_type = NULL, $promotion_id = NULL){
		$result = NULL;
		$query = $this
				->db
				->select('promotion_time')
				->where('promotion_genre_code', $promotion_genre_code)
				->where('promotion_sync_type',$promotion_sync_type)
				->where('promotion_id',$promotion_id)
				->order_by('promotion_result_logs_id', 'DESC')
				->limit(1)
				->get($this->table_promotion_result_logs);

		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}

	public function get_all_player_turnover_by_game_type($start_time = NULL, $end_time = NULL, $promotionData = NULL,$game_type = NULL){
		$result = NULL;
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN){
			$this->db->select_sum('win_loss','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS){
			$this->db->select_sum('win_loss','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}
		else{
			//PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL
			$this->db->select_sum('promotion_amount','current_amount');
			$this->db->select('player_id');
			$this->db->select('game_provider_type_code');
		}

		if($game_type == GAME_LIVE_CASINO){
			$this->db->group_start();
			$this->db->where('game_type_code', GAME_LIVE_CASINO);
			if(strpos($promotionData['live_casino_type'], (string)LIVE_CASINO_BACCARAT) === false){
				$this->db->where('game_code != ', 'Baccarat');
			}
			if(strpos($promotionData['live_casino_type'], (string)LIVE_CASINO_NON_BACCARAT) === false){
				$this->db->where('game_code', 'Baccarat');
			}
			$this->db->group_end();
		}else{
			$this->db->where('game_type_code !=', GAME_LIVE_CASINO);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL){
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS){
			$this->db->where('win_loss != ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN){
			$this->db->where('win_loss > ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS){
			$this->db->where('win_loss < ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN){
			$this->db->where('win_loss > ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS){
			$this->db->where('win_loss < ',0);
		}
		else{
			//PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL
		}
		$this->db->where('status', STATUS_COMPLETE);
		$this->db->where('bet_time >= ', $start_time);
		$this->db->where('bet_time <= ', $end_time);
		$this->db->group_by('player_id',"DESC");
		$this->db->group_by('game_provider_type_code',"DESC");
		$query = $this->db->get('transaction_report');
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();  
		}
		$query->free_result();
		return $result;
	}

	public function get_all_player_turnover($start_time = NULL, $end_time = NULL, $promotionData = NULL,$game_type = NULL){
		$result = NULL;
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS){
			$this->db->select_sum('bet_amount_valid','current_amount');
			$this->db->select('player_id');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN){
			$this->db->select_sum('win_loss','current_amount');
			$this->db->select('player_id');
		}
		else if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS){
			$this->db->select_sum('win_loss','current_amount');
			$this->db->select('player_id');
		}
		else{
			//PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL
			$this->db->select_sum('promotion_amount','current_amount');
		}

		if($promotionData['game_ids'] != "0"){
			$game_ids = array_filter(explode(',', $promotionData['game_ids']));
			$this->db->where_in('game_provider_type_code', $game_ids);
		}
		if($game_type == GAME_LIVE_CASINO){
			$this->db->group_start();
			$this->db->where('game_type_code', GAME_LIVE_CASINO);
			if(strpos($promotionData['live_casino_type'], (string)LIVE_CASINO_BACCARAT) === false){
				$this->db->where('game_code != ', 'Baccarat');
			}
			if(strpos($promotionData['live_casino_type'], (string)LIVE_CASINO_NON_BACCARAT) === false){
				$this->db->where('game_code', 'Baccarat');
			}
			$this->db->group_end();
		}else{
			$this->db->where('game_type_code !=', GAME_LIVE_CASINO);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL){
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS){
			$this->db->where('win_loss != ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_WIN){
			$this->db->where('win_loss > ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS){
			$this->db->where('win_loss < ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN){
			$this->db->where('win_loss > ',0);
		}
		if($promotionData['calculate_type'] == PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS){
			$this->db->where('win_loss < ',0);
		}
		else{
			//PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL
		}
		$this->db->where('status', STATUS_COMPLETE);
		$this->db->where('bet_time >= ', $start_time);
		$this->db->where('bet_time <= ', $end_time);
		$this->db->group_by('player_id',"DESC");
		$query = $this->db->get('transaction_report');
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();  
		}
		$query->free_result();
		return $result;
	}

	public function get_level_data(){
		$list = array();
		$query = $this
				->db
				->get($this->table_level);
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();	
			foreach($result as $row) {
				$list[$row['level_number']] = $row;					
			}
		}
		$query->free_result();
		return $list;
	}

	public function get_promotion_bonus_range_data($promotion_id = NULL){
		$list = array();
		$query = $this
				->db
				->where('promotion_id',$promotion_id)
				->where('active',STATUS_ACTIVE)
				->order_by('bonus_index','ASC')
				->get($this->table_promotion_bonus_range);
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();	
			foreach($result as $row) {
				$list[$row['bonus_index']] = $row;					
			}
		}
		$query->free_result();
		return $list;
	}

	public function get_all_pending_promotion($promotion_id = NULL){
		$result = NULL;	
		$this->db->select('player_promotion_id,promotion_name,reward_amount,status,is_auto_complete,is_reward,player_id,reward_on_apply');
		$this->db->where('active',STATUS_ACTIVE);
		$this->db->where('status',STATUS_PENDING);
		$this->db->where('promotion_id', $promotion_id);
		$query = $this->db->get($this->table_player_promotion);

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
		}
		$query->free_result();
		return $result;
	}

	public function get_player_list_array()
	{
		$lists = array();
		
		$query = $this
				->db
				->select('player_id, username, points')
				->get($this->table_players);
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row) {
				$lists[$row->player_id]['player_id'] = $row->player_id;
				$lists[$row->player_id]['username'] = $row->username;
				$lists[$row->player_id]['points'] = (double) $row->points;				
			}
		}
		
		$query->free_result();
		
		return $lists;
	}

	public function update_entitle_player_promotion($arr = NULL){
		$DBdata = array(
			'starting_date' => time(),
			'status' => STATUS_ENTITLEMENT,
			'updated_date' => time()
		);

		$this->db->where('player_promotion_id', $arr['player_promotion_id']);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_player_promotion, $DBdata);
		return $DBdata;
	}

	public function insert_cash_transfer_report($arr = NULL, $points = NULL, $type = NULL,$remark = NULL)
	{	
		if(!empty($remark)){
			$remark = json_encode($remark,true);
		}else{
			$remark = $this->input->post('remark', TRUE);
		}

		$DBdata = array(
			'transfer_type' => $type,
			'username' => $arr['username'],
			'remark' => $remark,
			'report_date' => time(),
		);
		
		if($type == TRANSFER_POINT_IN OR $type == TRANSFER_ADJUST_IN OR $type == TRANSFER_OFFLINE_DEPOSIT OR $type == TRANSFER_PG_DEPOSIT OR $type == TRANSFER_WITHDRAWAL_REFUND OR $type == TRANSFER_PROMOTION OR $type == TRANSFER_BONUS OR $type == TRANSFER_COMMISSION OR $type == TRANSFER_TRANSACTION_IN  OR $type == TRANSFER_CREDIT_CARD_DEPOSIT  OR $type == TRANSFER_HYPERMART_DEPOSIT)
		{
			$DBdata['deposit_amount'] = $points;
			$DBdata['balance_before'] = $arr['points'];
			$DBdata['balance_after'] =  ($arr['points'] + $points);
		}
		else
		{
			$DBdata['withdrawal_amount'] = $points;
			$DBdata['balance_before'] = $arr['points'];
			$DBdata['balance_after'] =  ($arr['points'] - $points);
		}
		
		$this->db->insert($this->table_cash_transfer_report, $DBdata);
	}

	public function update_player_wallet($arr = NULL)
	{	
		$DBdata = array(
			'player_id' => $arr['player_id'],
			'username' => $arr['username'],
			'points' => $arr['amount'],
			'updated_date' => time()
		);
		
		$table = $this->db->dbprefix . $this->table_players;
		$this->db->query("UPDATE {$table} SET points = (points + ?) WHERE player_id = ? LIMIT 1", array($DBdata['points'], $DBdata['player_id']));
		return $DBdata;
	}

	public function update_player_promotion_reward_claim($arr = NULL){
		$DBdata = array(
			'is_reward' => STATUS_APPROVE,
			'reward_accumulate' => $arr['reward_amount'],
			'reward_date' => time(),
			'updated_date' => time()
		);

		$this->db->where('player_promotion_id', $arr['player_promotion_id']);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->limit(1);
		$this->db->update($this->table_player_promotion, $DBdata);
	}
}