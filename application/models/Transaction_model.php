<?php

class Transaction_model extends CI_Model {



	//Declare database tables

	protected $table_game_transfer_pending = 'game_transfer_pending';



	public function get_wallet_transaction_pending_data($id = NULL)

	{	

		$result = NULL;

		

		$query = $this

				->db

				->where('game_transfer_pending_id', $id)

				->limit(1)

				->get($this->table_game_transfer_pending);

		

		if($query->num_rows() > 0)

		{

			$result = $query->row_array();  

		}

		

		$query->free_result();

		

		return $result;

	}



	public function update_wallet_transaction_pending($arr = NULL){

		$DBdata = array(

			'status' => (($this->input->post('status', TRUE) == STATUS_APPROVE) ? STATUS_APPROVE : STATUS_CANCEL),

			'remark' => $this->input->post('remark', TRUE),

			'updated_by' => $this->session->userdata('username'),

			'updated_date' => time()

		);

		

		$this->db->where('game_transfer_pending_id', $arr['game_transfer_pending_id']);

		$this->db->where('player_id', $arr['player_id']);

		$this->db->where('status', STATUS_PENDING);

		$this->db->limit(1);

		$this->db->update($this->table_game_transfer_pending, $DBdata);

		

		$DBdata['game_transfer_pending_id'] = $arr['game_transfer_pending_id'];

		$DBdata['player_id'] = $arr['player_id'];

		$DBdata['username'] = $arr['username'];

		$DBdata['amount'] = $arr['deposit_amount'];

		return $DBdata;

	}

	public function getTotalWinLoss($id, $start_date = NULL, $end_date = NULL){

		$result 	= NULL;
		$start_date = !isset($start_date) ? strtotime(date('Y-m-d 00:00:00')) : strtotime(date('Y-m-d 00:00:00', strtotime($start_date)));
		$end_date 	= !isset($end_date) ? strtotime(date('Y-m-d 23:59:59')) : strtotime(date('Y-m-d 23:59:59', strtotime($end_date)));
		
		$upline = ',' . $id . ',';
		$this->db->select_sum('win_loss','total_win_loss');
		$this->db->from('transaction_report GTR');
		// $this->db->from('total_win_loss_report_day GTR');
		$this->db->join('players GP', 'GTR.player_id = GP.player_id');
		$this->db->like('GP.upline_ids', $upline, 'both');
		$this->db->where('GTR.bet_time >=', $start_date);
		$this->db->where('GTR.bet_time <=', $end_date);
		// $this->db->where('GTR.report_date >=', $start_date);
		// $this->db->where('GTR.report_date <=', $end_date);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$result = $query->row_array(); 			
		}
		$query->free_result();
		return $result;
	}
}