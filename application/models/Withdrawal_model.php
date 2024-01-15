<?php
class Withdrawal_model extends CI_Model {

	//Declare database tables
	protected $table_withdrawals = 'withdrawals';
	protected $table_withdrawals_fee_rate = 'withdrawal_fee_rate';
	
	public function today_total_withdrawal()
	{
		$start_date = strtotime(date('Y-m-d 00:00:00'));
		$end_date = strtotime(date('Y-m-d 23:59:59'));
		
		$result = NULL;
		
		$query = $this
				->db
				->select('SUM(withdrawal_amount) AS total')
				->where('report_date >=', $start_date)
				->where('report_date <=', $end_date)
				->where_in('transfer_type', array(TRANSFER_POINT_OUT, TRANSFER_ADJUST_OUT, TRANSFER_WITHDRAWAL))
				->get('cash_transfer_report');
		
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		
		$query->free_result();
		
		return $result;
	}

	public function player_total_withdrawal_by_type($username = NULL,$type = NULL)
	{
		$result = NULL;
		
		$query = $this
				->db
				->select('COALESCE(SUM(withdrawal_amount),0) AS total')
				->where('username', $username)
				->where_in('transfer_type', $type)
				->get('cash_transfer_report');
		
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		
		$query->free_result();
		
		return $result;
	}

	public function player_total_withdrawal($username = NULL)
	{
		$result = NULL;
		$dbprefix = $this->db->dbprefix;

		$where = "";
		$where .= ' AND b.username = "' . $username . '"';
		$where .= ' AND a.status = '. STATUS_APPROVE;
		$result = NULL;
		$query_string = "(SELECT COALESCE(SUM(a.amount),0) AS total FROM {$dbprefix}withdrawals a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}

	public function player_total_withdrawal_pending($username = NULL)
	{
		$result = NULL;
		$dbprefix = $this->db->dbprefix;

		$where = "";
		$where .= ' AND b.username = "' . $username . '"';
		$where .= ' AND a.status = '. STATUS_PENDING;
		$result = NULL;
		$query_string = "(SELECT COALESCE(SUM(a.amount),0) AS total FROM {$dbprefix}withdrawals a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		$query->free_result();
		return $result;
	}
	
	public function add_withdrawal_offline($arr = NULL)
	{	
		$remark = $this->input->post('remark', TRUE);
		$DBdata = array(
			'withdrawal_type' => $arr['withdrawal_type'],
			'amount' => $arr['amount'],
			'remark' => $remark,
			'status' => STATUS_PENDING,
			'transaction_code' => $arr['transaction_code'],
			'player_id' => $arr['player_id'],
			'currency_id' => $arr['currency_id'],
			'currency_code' => $arr['currency_code'],
			'currency_rate' => $arr['currency_rate'],
			'amount_rate' => $arr['amount_rate'],
			'withdrawal_ip' => $this->input->ip_address(),
			'created_date' => time(),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		$this->db->insert($this->table_withdrawals, $DBdata);
		return $DBdata;
	}
	
	public function get_withdrawal_data($id = NULL)
	{	
		$result = NULL;
		
		$query = $this
				->db
				->where('withdrawal_id', $id)
				->limit(1)
				->get($this->table_withdrawals);
		
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		
		$query->free_result();
		
		return $result;
	}
	
	public function update_withdrawal($arr = NULL)
	{	
		$DBdata = array(
			'status' => (($this->input->post('status', TRUE) == STATUS_APPROVE) ? STATUS_APPROVE : STATUS_CANCEL),
			'remark' => $this->input->post('remark', TRUE),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		
		$this->db->where('withdrawal_id', $arr['withdrawal_id']);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->where('status', STATUS_PENDING);
		$this->db->limit(1);
		$this->db->update($this->table_withdrawals, $DBdata);
		
		$DBdata['withdrawal_id'] = $arr['withdrawal_id'];
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		$DBdata['amount'] = $arr['amount'];
		
		return $DBdata;
	}

	public function update_withdrawal_online($arr = NULL,$updateData = NULL){
		$DBdata = array(
			'payment_gateway_id' => $updateData['payment_gateway_id'],
			'payment_gateway_bank' => $updateData['payment_gateway_bank'],
			'transaction_code_alias' => $updateData['transaction_code_alias'],
			'order_no' => $updateData['order_no'],
			'status' => $updateData['status'],
			'remark' => $this->input->post('remark', TRUE),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		
		$this->db->where('withdrawal_id', $arr['withdrawal_id']);
		$this->db->where('player_id', $arr['player_id']);
		$this->db->where('status', STATUS_PENDING);
		$this->db->limit(1);
		$this->db->update($this->table_withdrawals, $DBdata);
		
		$DBdata['withdrawal_id'] = $arr['withdrawal_id'];
		$DBdata['player_id'] = $arr['player_id'];
		$DBdata['username'] = $arr['username'];
		$DBdata['amount'] = $arr['amount'];
		
		return $DBdata;
	}

	public function today_total_only_agent_withdrawal(){
		$result['total'] = 0;
		$result_row = array();
		
		$dbprefix = $this->db->dbprefix;
		$start_date = strtotime(date('Y-m-d 00:00:00'));
		$end_date = strtotime(date('Y-m-d 23:59:59'));
		$where = "";
		$where .= ' AND a.updated_date >= ' . $start_date;
		$where .= ' AND a.updated_date <= ' . $end_date;
		$where .= ' AND a.status = '. STATUS_APPROVE;
		$result = NULL;
		$query_string = "(SELECT SUM(a.amount) AS total FROM {$dbprefix}withdrawals a, {$dbprefix}players b WHERE (a.player_id = b.player_id) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where)";
		/*
		$dbprefix = $this->db->dbprefix;
		$where .= ' AND a.report_date >= ' . strtotime(date('Y-m-d 00:00:00'));
		$where .= ' AND a.report_date <= ' . strtotime(date('Y-m-d 23:59:59'));
		$where .= ' AND a.transfer_type IN (' . TRANSFER_POINT_OUT . ', ' . TRANSFER_ADJUST_OUT . ', ' . TRANSFER_WITHDRAWAL . ')';
		$query_string = "SELECT SUM(a.withdrawal_amount) AS total FROM {$dbprefix}cash_transfer_report a, {$dbprefix}players b WHERE (a.username = b.username) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where";
		*/
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result_row = $query->row_array();  
			if(!empty($result_row['total'])){
			    $result['total'] += $result_row['total'];   
			}
		}
		$query->free_result();

		$dbprefix = $this->db->dbprefix;
		$where = "";
		$where .= ' AND a.report_date >= ' . strtotime(date('Y-m-d 00:00:00'));
		$where .= ' AND a.report_date <= ' . strtotime(date('Y-m-d 23:59:59'));
		$where .= ' AND a.transfer_type IN (' . TRANSFER_POINT_OUT . ')';
		$query_string = "SELECT SUM(a.withdrawal_amount) AS total FROM {$dbprefix}cash_transfer_report a, {$dbprefix}players b WHERE (a.username = b.username) AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!' $where";
		$query = $this->db->query($query_string);
		if($query->num_rows() > 0)
		{
			$result_row = $query->row_array();  
			if(!empty($result_row['total'])){
			    $result['total'] += $result_row['total'];   
			} 
		}
		
		$query->free_result();
		return $result;
	}

	public function add_fee_setting(){
		$DBdata = array(
			'withdrawal_times' => $this->input->post('withdrawal_times', TRUE),
			'withdrawal_min' => $this->input->post('withdrawal_min', TRUE),
			'withdrawal_max' => $this->input->post('withdrawal_max', TRUE),
			'withdrawal_rate_type' => $this->input->post('withdrawal_rate_type', TRUE),
			'withdrawal_rate_amount' => $this->input->post('withdrawal_rate_amount', TRUE),
			'active' => STATUS_ACTIVE,
			'created_by' => $this->session->userdata('username'),
			'created_date' => time()
		);

		$this->db->insert($this->table_withdrawals_fee_rate, $DBdata);
		$DBdata['withdrawal_fee_rate_id'] = $this->db->insert_id();
		return $DBdata;
	}

	public function get_withdrawal_fee_setting_data($id = NULL)
	{	
		$result = NULL;
		
		$query = $this
				->db
				->where('withdrawal_fee_rate_id', $id)
				->limit(1)
				->get($this->table_withdrawals_fee_rate);
		
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();  
		}
		
		$query->free_result();
		
		return $result;
	}

	public function update_fee_setting($id = NULL){
		$DBdata = array(
			'withdrawal_times' => $this->input->post('withdrawal_times', TRUE),
			'withdrawal_min' => $this->input->post('withdrawal_min', TRUE),
			'withdrawal_max' => $this->input->post('withdrawal_max', TRUE),
			'withdrawal_rate_type' => $this->input->post('withdrawal_rate_type', TRUE),
			'withdrawal_rate_amount' => $this->input->post('withdrawal_rate_amount', TRUE),
			'active' => (($this->input->post('active', TRUE) == STATUS_ACTIVE) ? STATUS_ACTIVE : STATUS_INACTIVE),
			'updated_by' => $this->session->userdata('username'),
			'updated_date' => time()
		);
		
		$this->db->where('withdrawal_fee_rate_id', $id);
		$this->db->limit(1);
		$this->db->update($this->table_withdrawals_fee_rate, $DBdata);
		
		$DBdata['withdrawal_fee_rate_id'] = $id;
		
		return $DBdata;
	}

	public function delete_fee_setting($id = NULL){
		$this->db->where('withdrawal_fee_rate_id', $id);
		$this->db->delete($this->table_withdrawals_fee_rate);
	}
}