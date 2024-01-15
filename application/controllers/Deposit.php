<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('deposit_model', 'player_model','promotion_model','player_promotion_model', 'miscellaneous_model', 'game_model','currencies_model','promotion_apply_model','promotion_approve_model','message_model','tag_model','bank_model'));
		
		$is_logged_in = $this->is_logged_in();
		if( ! empty($is_logged_in)) 
		{
			echo '<script type="text/javascript">parent.location.href = "' . site_url($is_logged_in) . '";</script>';
		}
	}

	public function index()
	{
		if(permission_validation(PERMISSION_DEPOSIT_VIEW) == TRUE)
		{
			$this->save_current_url('deposit');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_deposit');
			$this->session->unset_userdata('search_deposits');
			$data_search = array(
				'from_date' => date('Y-m-d 00:00:00',strtotime('first day of -3 month',time())),
				'to_date' => date('Y-m-d 23:59:59'),
				'deposit_type' => "",
				'username' => "",
				'status' => "0",
				'ip_address' => "",
			);

			if(permission_validation(PERMISSION_DEPOSIT_VIEW_ALL) == TRUE)
			{
				$data_search['status'] = "-1";
			}
			
			if($_GET){
				$deposit_id = (isset($_GET['id'])?$_GET['id']:'');
				$deposit_data = $this->deposit_model->get_deposit_data($deposit_id);
				if(!empty($deposit_data)){
					$data_search['from_date'] = date('Y-m-d 00:00:00',strtotime('first day of -3 month',$deposit_data['created_date']));
					$data_search['to_date'] = date('Y-m-d 23:59:59',strtotime('last day of this month',time()));
					$data_search['status'] = STATUS_PENDING;

					//set prevent alarm
					if($deposit_data['deposit_type'] == DEPOSIT_OFFLINE_BANKING){
						$this->session->set_userdata('alert_deposits_offline',time());
					}else if($deposit_data['deposit_type'] == DEPOSIT_ONLINE_BANKING){
						$this->session->set_userdata('alert_deposits_online',time());
					}else if($deposit_data['deposit_type'] == DEPOSIT_CREDIT_CARD){
						$this->session->set_userdata('alert_deposits_credit',time());
					}else{
						$this->session->set_userdata('alert_deposits_hypermart',time());
					}
				}
			}
			$data['data_search'] = $data_search;
			$this->session->set_userdata('search_deposits', $data_search);
			$this->load->view('deposit_view', $data);
		}
		else
		{
			redirect('home');
		}
	}
	
	public function search()
	{
		if(permission_validation(PERMISSION_DEPOSIT_VIEW) == TRUE)
		{
			//Initial output data
			$json = array(
					'status' => EXIT_ERROR, 
					'msg' => array(
										'from_date_error' => '',
										'to_date_error' => '',
										'general_error' => ''
									),
					'csrfTokenName' => $this->security->get_csrf_token_name(), 
					'csrfHash' => $this->security->get_csrf_hash()
				);
			
			//Set form rules
			$config = array(
							array(
									'field' => 'from_date',
									'label' => strtolower($this->lang->line('label_from_date')),
									'rules' => 'trim|required|callback_full_datetime_check',
									'errors' => array(
														'required' => $this->lang->line('error_invalid_datetime_format'),
														'full_datetime_check' => $this->lang->line('error_invalid_datetime_format')
												)
							),
							array(
									'field' => 'to_date',
									'label' => strtolower($this->lang->line('label_to_date')),
									'rules' => 'trim|required|callback_full_datetime_check',
									'errors' => array(
														'required' => $this->lang->line('error_invalid_datetime_format'),
														'full_datetime_check' => $this->lang->line('error_invalid_datetime_format')
												)
							)
						);		
						
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			
			//Form validation
			if ($this->form_validation->run() == TRUE)
			{
				$from_date = strtotime(trim($this->input->post('from_date', TRUE)));
				$to_date = strtotime(trim($this->input->post('to_date', TRUE)));
				$days = $this->cal_days_in_year(date('Y', $from_date));
				$date_range = ($days * 86400);
				$time_diff = ($to_date - $from_date);
				
				if($time_diff < 0 OR $time_diff > $date_range)
				{
					$json['msg']['general_error'] = $this->lang->line('error_invalid_year_range');
				}
				else
				{
					$data = array( 
						'from_date' => trim($this->input->post('from_date', TRUE)),
						'to_date' => trim($this->input->post('to_date', TRUE)),
						'deposit_type' => trim($this->input->post('deposit_type', TRUE)),
						'username' => trim($this->input->post('username', TRUE)),
						'status' => trim($this->input->post('status', TRUE)),
						'ip_address' => trim($this->input->post('ip_address', TRUE)),
						'deposit_id' => trim($this->input->post('deposit_id', TRUE)),
						'agent' => trim($this->input->post('agent', TRUE)),
						'payment_gateway_id' => array_filter(explode(',',$this->input->post('payment_gateway_id', TRUE))),

					);
					
					$this->session->set_userdata('search_deposits', $data);
					
					$json['status'] = EXIT_SUCCESS;
				}
			}
			else 
			{
				$json['msg']['from_date_error'] = form_error('from_date');
				$json['msg']['to_date_error'] = form_error('to_date');
			}
			
			//Output
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();	
		}
	}
	
	public function listing() {
		if(permission_validation(PERMISSION_DEPOSIT_VIEW) == TRUE) {
			$limit = trim($this->input->post('length', TRUE));
			$start = trim($this->input->post("start", TRUE));
			$order = $this->input->post("order", TRUE);
			#Table Columns
			$columns = array(
				0 => 'a.deposit_id',
				1 => 'a.created_date',
				2 => 'a.deposit_type',
				3 => 'b.username',
				4 => 'b.tag_ids',
				5 => 'a.payment_gateway_id',
				6 => 'a.transaction_code',
				7 => 'a.payment_info',
				8 => 'a.amount_apply',
				9 => 'a.rate',
				10 => 'a.amount',
				11 => 'a.status',
				12 => 'a.deposit_ip',
				13 => 'a.remark',
				14 => 'a.updated_by',
				15 => 'a.updated_date',
				16 => 'a.transaction_code_alias',
				17 => 'a.order_no',
				18 => 'a.bank_name',
				19 => 'a.bank_account_name',
				20 => 'a.bank_account_no',
				21 => 'a.player_bank_name',
				22 => 'a.player_bank_account_name',
				23 => 'a.player_bank_account_no',
				24 => 'a.promotion_id',
				25 => 'a.player_id',
				26 => 'b.tag_id',
				27 => 'a.whitelist_status',
			);

			$sum_columns = array( 
				0 => 'SUM(a.amount_apply) AS total_deposit_apply',
				1 => 'SUM(a.amount) AS total_deposit_amount',
				2 => 'SUM(a.rate_amount) AS total_deposit_rate',
				3 => 'SUM(a.amount_rate) AS total_deposit_amount_rate',
			);
			
			$col = 0;
			$dir = "";
				
			if( ! empty($order))
			{
				foreach($order as $o)
				{
					$col = $o['column'];
					$dir = $o['dir'];
				}
			}

			if($dir != "asc" && $dir != "desc")
			{
				$dir = "desc";
			}
			
			if( ! isset($columns[$col]))
			{
				$order = $columns[0];
			}
			else
			{
				$order = $columns[$col];
			}
			
			$arr = $this->session->userdata('search_deposits');
			
			$where = '';		
			
			if( ! empty($arr['agent']))
			{
				$where = "AND a.player_id = 'ABC'";
				$agent = $this->user_model->get_user_data_by_username($arr['agent']);
				if(!empty($agent)){
					$response_upline = $this->user_model->get_downline_data($agent['username']);
					if(!empty($response_upline)){
						$where = "AND b.upline_ids LIKE '%," . $response_upline['user_id'] . ",%' ESCAPE '!'";
					}
				}
			}else{
				$where = "AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!'";
			}

			if(isset($arr['from_date']))
			{
				if( ! empty($arr['from_date']))
				{
					$where .= ' AND a.created_date >= ' . strtotime($arr['from_date']);
				}
				
				if( ! empty($arr['to_date']))
				{
					$where .= ' AND a.created_date <= ' . strtotime($arr['to_date']);
				}
				
				if($arr['deposit_type'] >= 1 && $arr['deposit_type'] <= sizeof(get_deposit_type()))
				{
					$where .= ' AND a.deposit_type = ' . $arr['deposit_type'];
				}
				
				if( ! empty($arr['username']))
				{
					$where .= " AND b.username LIKE '%" . $arr['username'] . "%' ESCAPE '!'";	
				}
				
				if($arr['status'] == STATUS_PENDING OR $arr['status'] == STATUS_APPROVE OR $arr['status'] == STATUS_CANCEL OR $arr['status'] == STATUS_ON_PENDING)
				{
					$where .= ' AND a.status = ' . $arr['status'];
				}
				
				if( ! empty($arr['ip_address']))
				{
					$where .= " AND a.ip_address LIKE '%" . $arr['ip_address'] . "%' ESCAPE '!'";	
				}

				if( ! empty($arr['deposit_id']))
				{
					$where .= " AND a.deposit_id = '" . $arr['deposit_id']."'";	
				}

				if(!empty($arr['payment_gateway_id']))
				{
					$payment_gateway_id = '"'.implode('","', $arr['payment_gateway_id']).'"';
					$where .= " AND a.payment_gateway_id IN(" . $payment_gateway_id . ")";
				}
			}	
			
			$select = implode(',', $columns);
			$dbprefix = $this->db->dbprefix;
			
			$posts = NULL;
			$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b WHERE (a.player_id = b.player_id) $where)";
			$query_string_2 = " ORDER by {$order} {$dir} LIMIT {$start}, {$limit}";
			$query = $this->db->query($query_string . $query_string_2);
			if($query->num_rows() > 0)
			{
				$posts = $query->result();  
			}
			
			$query->free_result();
			$query = $this->db->query($query_string);
			$totalFiltered = $query->num_rows();
			
			$query->free_result();

			$player_withdrawal_count_list = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$player_list[] = $post->player_id;
					$player_withdrawal_count_list[$post->player_id] = 0;
				}
				$player_bank_data = $this->bank_model->get_player_bank_data_by_player_array($player_list);
				if(!empty($player_bank_data)){
					foreach($player_bank_data as $player_bank_data_key => $player_bank_data_row) {
						if(isset($player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK]) && sizeof($player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK]) > 0){
							for($i=0;$i<sizeof($player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK]);$i++){
								if($i == 0){
									$player_withdrawal_count_list[$player_bank_data_key] = $player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK][$i]['withdrawal_count'];
								}else{
									if($player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK][$i]['withdrawal_count'] < $player_withdrawal_count_list[$player_bank_data_key]){
										$player_withdrawal_count_list[$player_bank_data_key] = $player_bank_data_row[BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK][$i]['withdrawal_count'];
									}
								}
							}
						}
					}
				}
			}
			
			//Prepare data
			$data = array();
			if(!empty($posts))
			{
				$tag_list = $this->tag_model->get_tag_list();
				$tag_player_list = $this->tag_model->get_tag_player_list();
				foreach ($posts as $post)
				{
					$status = "";
					$withdrawal_limit = "";
					$button = "";
					$tag = "";
					if(isset($tag_list[$post->tag_id])){
						$tag = '<span class="badge bg-success" id="uc21_' . $post->player_id . '" style="background-color: '.$tag_list[$post->tag_id]['tag_background_color'].' !important;color: '.$tag_list[$post->tag_id]['tag_font_color'].' !important;font-weight: '.(($tag_list[$post->tag_id]['is_bold'] == STATUS_ACTIVE) ? "bold": "normal").' !important;">' . $tag_list[$post->tag_id]['tag_code'] . '</span>';						
					}

					$tags = '<div id="uc22_' . $post->player_id . '">';
					$tags_option = "";
					if(!empty($post->tag_ids)){
						$tags_array = array_values(array_filter(explode(',',  $post->tag_ids)));
						foreach($tags_array as $tags_row){
							if(isset($tag_player_list[$tags_row])){
								$tags_option .= '<span class="badge bg-success" style="background-color: '.$tag_player_list[$tags_row]['tag_player_background_color'].' !important;color: '.$tag_player_list[$tags_row]['tag_player_font_color'].' !important;font-weight: '.(($tag_player_list[$tags_row]['is_bold'] == STATUS_ACTIVE) ? "bold": "normal").' !important;"">' . $tag_player_list[$tags_row]['tag_player_code'] . '</span>&nbsp;';
							}
						}
						if(!empty($tags_option)){
							$tags_option .= '</br>';
						}
					}
					$tags .= $tags_option;
					$tags .= "</div>";
					if(permission_validation(PERMISSION_TAG_PLAYER_MODIFY) == TRUE){
						$tags .= '<div id="uc23_' . $post->player_id . '" class="col-12 text-center">';
						$tags .= '<i onclick="modifyPlayerTagData(' . $post->player_id . ')" class="fas fa-user-tag nav-icon text-fuchsia" title="' . $this->lang->line('button_tag_player')  . '"></i>';
						$tags .= "</div>";
					}

					$row = array();
					$row[] = ((floor(log10($post->deposit_id) + 1) > DEPOSIT_PAD_0) ? substr((string) $post->deposit_id, (DEPOSIT_PAD_0*-1)): str_pad($post->deposit_id, DEPOSIT_PAD_0, '0', STR_PAD_LEFT));
					$row[] = (($post->created_date > 0) ? date('Y-m-d H:i:s', $post->created_date) : '-');
					$row[] = $this->lang->line(get_deposit_type($post->deposit_type));
					$row[] = $post->username.'&nbsp;<i class="fas fa-copy nav-icon text-purple clipboard" data-clipboard-text="'.$post->username.'"></i>&nbsp;'.$tag;
					$row[] = $tags;
					if($post->deposit_type != DEPOSIT_OFFLINE_BANKING){
						$row[] =  $this->lang->line(get_payment_gateway($post->payment_gateway_id));
					}
					else{
						$html = "";
						if( ! empty($post->bank_name))
						{
							$html = $post->bank_name . '<br />';
						}
						
						if( ! empty($post->bank_account_name))
						{
							$html .= $post->bank_account_name . '<br />';
						}
						
						if( ! empty($post->bank_account_no))
						{
							$html .= $post->bank_account_no . '<br />';
						}
						$row[] = $html;
					}
					if(!empty($post->transaction_code_alias)){
						$row[] =  $post->transaction_code_alias."<br/>".$post->bank_account_name;						
					}
					else{
						$row[] =  $post->transaction_code."<br/>".$post->bank_account_name;
					}
					$white_status = "";
					$player_bank_image = "";
					$payment_status = "";

					if($post->deposit_type != DEPOSIT_OFFLINE_BANKING){
						if($post->status != STATUS_ON_PENDING){
							if(!empty($post->payment_info)){
								switch($post->whitelist_status)
								{
									case STATUS_ACTIVE: $white_status = '<span class="badge bg-success">' . $this->lang->line('whitelist_status_active'). '</span> &nbsp;&nbsp'; break;
									case STATUS_INACTIVE: $white_status = '<span class="badge bg-secondary">' . $this->lang->line('whitelist_status_inactive'). '</span> &nbsp;&nbsp'; break;
									default:  $white_status = '<span class="badge bg-secondary">' . $this->lang->line('whitelist_status_inactive'). '</span> &nbsp;&nbsp'; break;
								}

								if(permission_validation(PERMISSION_WHITELIST_ADD) == TRUE)
								{
									$white_status .= '<i onclick="add_whitelist(' ."'". $post->username ."'". ',' ."'". $post->deposit_type ."'". ',' ."'". $post->payment_info ."'". ')" class="fas fa-user-shield nav-icon text-navy" title="' . $this->lang->line('button_add_whitelist')  . '"></i> &nbsp;&nbsp';	
								}
							}
						}

						if(permission_validation(PERMISSION_PLAYER_BANK_IMAGE) == TRUE)
						{
							$player_bank_image .= '<i onclick="viewImageData(' . $post->player_id . ')" class="fas fa-id-card nav-icon text-warning" title="' . $this->lang->line('button_view')  . '"></i> &nbsp;&nbsp; ';
						}

						$payment_status = $post->payment_info;
						if(empty($payment_status)){
							$payment_status .= $white_status;
						}
						else{
							$payment_status .= '<br/>'.$white_status;
						}

						if(empty($white_status)){
							$payment_status .= '<br/>'.$player_bank_image;
						}else{
							$payment_status .= $player_bank_image;
						}
						$row[] = $payment_status;
					}else{
						$html = "";
						if( ! empty($post->player_bank_name))
						{
							$html .= $post->player_bank_name . '<br />';
						}
						
						if( ! empty($post->player_bank_account_name))
						{
							$html .= $post->player_bank_account_name . '<br />';
						}
						
						if( ! empty($post->player_bank_account_no))
						{
							$html .= $post->player_bank_account_no . '<br />';
						}

						if(permission_validation(PERMISSION_PLAYER_BANK_IMAGE) == TRUE)
						{
							$player_bank_image .= '<i onclick="viewImageData(' . $post->player_id . ')" class="fas fa-id-card nav-icon text-warning" title="' . $this->lang->line('button_view')  . '"></i> &nbsp;&nbsp; ';
						}
						$payment_status = $html.$player_bank_image;
						$row[] = $payment_status;
					}
					$row[] = '<span class="text-' . (($post->amount_apply > 0) ? 'primary' : 'dark') . '">' . number_format($post->amount_apply, 0, '.', ',') . '</span>';
					$row[] = $post->rate;
					$row[] = '<span class="text-' . (($post->amount > 0) ? 'primary' : 'dark') . '">' . number_format($post->amount, 0, '.', ',') . '</span>';
					if(isset($player_withdrawal_count_list[$post->player_id]) && $player_withdrawal_count_list[$post->player_id] < NEW_MEMBER_WITHDRAWAL_LIMIT){
						$withdrawal_limit = '<span class="badge bg-teal">' . $this->lang->line('label_new_players') . '</span>';
					}
					switch($post->status)
					{
						case STATUS_ON_PENDING: $status = '<span class="badge bg-info" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('deposit_status_on_pending') . '</span>'; break;
						case STATUS_APPROVE: $status = '<span class="badge bg-success" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('status_approved') . '</span>'; break;
						case STATUS_CANCEL: $status = '<span class="badge bg-danger" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('status_cancelled') . '</span>'; break;
						default: $status = '<span class="badge bg-secondary" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('deposit_status_pending') . '</span>'; break;
					}
					$row[] = $withdrawal_limit.((!empty($withdrawal_limit)) ?  "<br/>".$status : $status);
					$row[] = $post->deposit_ip;
					$row[] = '<span id="uc2_' . $post->deposit_id . '">' . ( ! empty($post->remark) ? $post->remark : '-') . '</span>';
					if($post->whitelist_status == STATUS_ACTIVE){
						$row[] = '<span id="uc6_' . $post->deposit_id . '">' . SYSTEM_DEFAULT_NAME . '</span>';
					}else{
						$row[] = '<span id="uc6_' . $post->deposit_id . '">' . (( ! empty($post->updated_by)) ? $post->updated_by : '-') . '</span>';
					}
					$row[] = '<span id="uc7_' . $post->deposit_id . '">' . (($post->updated_date > 0) ? date('Y-m-d H:i:s', $post->updated_date) : '-') . '</span>';
					if(permission_validation(PERMISSION_DEPOSIT_UPDATE) == TRUE && $post->status == STATUS_PENDING)
					{
						$button .= '<i id="uc3_' . $post->deposit_id . '" onclick="updateData(' . $post->deposit_id . ')" class="fas fa-edit nav-icon text-primary" title="' . $this->lang->line('button_edit')  . '"></i> &nbsp;&nbsp; ';
					}

					if(permission_validation(PERMISSION_PLAYER_PROMOTION_VIEW) && !empty($post->promotion_id)){
						$button .= '<i id="uc10_' . $post->deposit_id . '" onclick="promotionData(' . $post->deposit_id . ')" class="fas fa-gifts nav-icon text-danger" title="' . $this->lang->line('button_promotion')  . '"></i> &nbsp;&nbsp; ';
					}
					
					$row[] = $button;
					$data[] = $row;
				}
			}
			
			//Output
			$json_data = array(
				"draw"            => intval($this->input->post('draw')),
				"recordsFiltered" => intval($totalFiltered), 
				"data"            => $data,
				"csrfHash" 		  => $this->security->get_csrf_hash()					
			);
				
			echo json_encode($json_data); 
			exit();
		}	
    }

    public function total(){
    	if(permission_validation(PERMISSION_DEPOSIT_VIEW) == TRUE)
		{
			$arr = $this->session->userdata('search_deposits');
			$dbprefix = $this->db->dbprefix;
			//Declaration Total
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => '',
				'total_data' => '',
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);
			$json['total_data'] = array(
				'total_deposit_apply' => 0,
				'total_deposit_amount' => 0,
			);

			if(!empty($arr)){
				$json['status'] = EXIT_SUCCESS;
				$data = array();

				//Get total
				$where = '';

				if( ! empty($arr['agent']))
				{
					$where = "AND a.player_id = 'ABC'";
					$agent = $this->user_model->get_user_data_by_username($arr['agent']);
					if(!empty($agent)){
						$response_upline = $this->user_model->get_downline_data($agent['username']);
						if(!empty($response_upline)){
							$where = "AND b.upline_ids LIKE '%," . $response_upline['user_id'] . ",%' ESCAPE '!'";
						}
					}
				}else{
					$where = "AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!'";
				}
				if(isset($arr['from_date']))
				{
					if( ! empty($arr['from_date']))
					{
						$where .= ' AND a.created_date >= ' . strtotime($arr['from_date']);
					}
					
					if( ! empty($arr['to_date']))
					{
						$where .= ' AND a.created_date <= ' . strtotime($arr['to_date']);
					}
					
					if($arr['deposit_type'] >= 1 && $arr['deposit_type'] <= sizeof(get_deposit_type()))
					{
						$where .= ' AND a.deposit_type = ' . $arr['deposit_type'];
					}
					
					if( ! empty($arr['username']))
					{
						$where .= " AND b.username LIKE '%" . $arr['username'] . "%' ESCAPE '!'";	
					}
					
					if($arr['status'] == STATUS_PENDING OR $arr['status'] == STATUS_APPROVE OR $arr['status'] == STATUS_CANCEL OR $arr['status'] == STATUS_ON_PENDING)
					{
						$where .= ' AND a.status = ' . $arr['status'];
					}
					
					if( ! empty($arr['ip_address']))
					{
						$where .= " AND a.ip_address LIKE '%" . $arr['ip_address'] . "%' ESCAPE '!'";	
					}

					if( ! empty($arr['deposit_id']))
					{
						$where .= " AND a.deposit_id = '" . $arr['deposit_id']."'";	
					}

					if( ! empty($arr['payment_gateway_id']))
					{
						$payment_gateway_id = '"'.implode('","', $arr['payment_gateway_id']).'"';
						$where .= " AND a.payment_gateway_id IN(" . $payment_gateway_id . ")";
					}
				}

				$sum_columns = array( 
					0 => 'SUM(a.amount_apply) AS total_deposit_apply',
					1 => 'SUM(a.amount) AS total_deposit_amount',
				);
				$sum_select = implode(',', $sum_columns);
				
				$total_query_string = "SELECT {$sum_select} FROM {$dbprefix}deposits a, {$dbprefix}players b WHERE (a.player_id = b.player_id) $where";
				$total_query = $this->db->query($total_query_string);
				if($total_query->num_rows() > 0)
				{
					foreach($total_query->result() as $row)
					{
						$json['total_data'] = array(
							'total_deposit_apply' => (($row->total_deposit_apply > 0) ? $row->total_deposit_apply : 0),
							'total_deposit_amount' => (($row->total_deposit_amount > 0) ? $row->total_deposit_amount : 0),
						);
					}
				}
				$total_query->free_result();
			}
			
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();
		}
    }
	
	public function edit($id = NULL)
    {
		if(permission_validation(PERMISSION_DEPOSIT_UPDATE) == TRUE)
		{
			$data = $this->deposit_model->get_deposit_data($id);
			if( ! empty($data) && $data['status'] == STATUS_PENDING)
			{
				
				if(!empty($data['promotion_id'])){
					$data['promotion_response']['result'] = $this->promotion_approve_model->deposit_promotion_on_pending($data);
					$data['promotion_response'] = $this->promotion_approve_model->deposit_promotion_approve_decision($data['promotion_response']['result']);
				}
				
				$data['player'] = $this->player_model->get_player_data($data['player_id']);
				$this->load->view('deposit_update', $data);
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}
	}
	
	public function update() {
		if(permission_validation(PERMISSION_DEPOSIT_UPDATE) == TRUE) {
			#Initial output data
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => '',
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);
			
			#Set form rules
			$config = array(
				array(
					'field' => 'remark',
					'label' => strtolower($this->lang->line('label_remark')),
					'rules' => 'trim'
				)
			);		
			
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			
			#Form validation
			if ($this->form_validation->run() == TRUE) {
				$deposit_id = trim($this->input->post('deposit_id', TRUE));
				$oldData 	= $this->deposit_model->get_deposit_data($deposit_id);
				
				if( ! empty($oldData) && $oldData['status'] == STATUS_PENDING) {

					$player 				= $this->player_model->get_player_data($oldData['player_id']);
					$oldData['username'] 	= $player['username'];
					
					#########CUSTOM CHECK MASTER POINT########
					$depo_status 	= $this->input->post('status', TRUE);
					$uplineacc 		= $this->user_model->get_downline_data(SYSTEM_API_AGENT_ID);
					if($depo_status == STATUS_APPROVE) {
						$master_flag = ($uplineacc['points'] > $oldData['amount']) ? TRUE : FALSE;	
					}
					else {
						$master_flag = TRUE;
					}
					##########################################
					
					if($master_flag) {						
						#Database update
						$this->db->trans_start();
						$newData = $this->deposit_model->update_deposit($oldData);
						
						if($newData['status'] == STATUS_APPROVE) {
							$pending_promotion_data = $this->player_promotion_model->get_unsattle_promotion($oldData);
							if(!empty($pending_promotion_data)){
								$player_pending_bet = $this->player_model->player_pending_bet_amount($oldData['player_id']);
								if(empty($player_pending_bet)){
									$player_current_wallet = $this->get_member_total_wallet($oldData['player_id']);
									$game_balance_check = ((isset($player_current_wallet['game_balance'])) ? $player_current_wallet['game_balance'] : 0);
									$main_balance_check = ((isset($player_current_wallet['main_wallet_balance'])) ? $player_current_wallet['main_wallet_balance'] : 0);
									$balance_check = $game_balance_check + $main_balance_check;
									if($balance_check < PLAYER_PROMOTION_SURRENDER){
										$remark = $this->lang->line('label_main_wallet')." : ".number_format($main_balance_check, 0, '.', ',')."<br/>".$this->lang->line('label_game_wallet')."：".number_format($game_balance_check, 0, '.', ',');
										$this->promotion_approve_model->force_bulk_cancel_player_promotion($oldData['player_id'],$remark);
									}
								}
							}

							switch($oldData['deposit_type'])
							{
								case DEPOSIT_ONLINE_BANKING: $transfer_type = TRANSFER_PG_DEPOSIT; break;
								case DEPOSIT_CREDIT_CARD: $transfer_type = TRANSFER_CREDIT_CARD_DEPOSIT; break;
								case DEPOSIT_HYPERMART: $transfer_type = TRANSFER_HYPERMART_DEPOSIT; break;
								default: $transfer_type = TRANSFER_OFFLINE_DEPOSIT; break;
							}

							$this->player_model->update_player_wallet($newData);
							#########DEDUCT MASTER POINT########
							$table = $this->db->dbprefix . 'users';
							$this->db->query("UPDATE {$table} SET points = (points - ?) WHERE username = ? LIMIT 1", array($oldData['amount'], SYSTEM_API_AGENT_ID));
							####################################
							$RnewData = $this->player_model->update_player_turnover($player, $oldData['amount'], (($player['turnover_total_required'] == 0) ? STATUS_ACTIVE: STATUS_INACTIVE), (($player['turnover_total_required'] == 0) ? STATUS_ACTIVE: STATUS_INACTIVE));

							$array = array(
								'payment_info' => $oldData['payment_info'],
								'remark' => $this->input->post('remark', TRUE),
							);
							
							if($transfer_type == TRANSFER_OFFLINE_DEPOSIT){
								$this->general_model->insert_cash_transfer_report($player, $oldData['amount'], $transfer_type);	
							}else{
								$this->general_model->insert_cash_transfer_report($player, $oldData['amount'], $transfer_type,$array);
							}
							
							
							if(!empty($oldData['promotion_id'])){
								$PromotionDepositPending = $this->promotion_approve_model->deposit_promotion_on_pending($oldData);
								if(!empty($PromotionDepositPending)){
									$member_total_wallet = $this->get_member_total_wallet($player['player_id']);
									$promotion_response = $this->promotion_approve_model->deposit_promotion_approve_decision($PromotionDepositPending,$member_total_wallet);
									$this->promotion_approve_model->update_deposit_promotion_status($oldData, $promotion_response['code']);
									if($promotion_response['status'] == EXIT_SUCCESS){
										$this->promotion_approve_model->update_player_promotion_after_deposit($PromotionDepositPending,$member_total_wallet,$PromotionDepositPending['deposit_amount'],1);
										if($PromotionDepositPending['reward_on_apply'] == STATUS_ACTIVE){
											$player = $this->player_model->get_player_data($oldData['player_id']);
											$insert_wallet_data = array(
												"player_id" => $newData['player_id'],
												"username" => $newData['username'],
												"amount" => $PromotionDepositPending['reward_amount'],
											);
											$array = array(
												'promotion_name' => $PromotionDepositPending['promotion_name'],
												'remark' => $this->input->post('remark', TRUE),
											);
											$this->player_model->update_player_wallet($insert_wallet_data);
											$this->general_model->insert_cash_transfer_report($player, $PromotionDepositPending['reward_amount'], TRANSFER_PROMOTION,$array);
											$this->promotion_approve_model->update_player_promotion_reward_claim($PromotionDepositPending,$member_total_wallet);
										}
									}
								}
							}else{
								if($oldData['amount'] >= 1000){
									$promotion_add_list = array();
									$promotion_capture_list = array();
									$promotion_ids = array();
									$player_data = $player;
									if(!empty($player_data['referrer'])){
										$referral_data = $this->player_model->get_player_data_by_username($player_data['referrer']);
										if(!empty($referral_data)){
											$promotion_data = $this->player_promotion_model->get_promotion_list_data_apply_system_genre_code(PROMOTION_TYPE_RF);
											if(!empty($promotion_data)){
												foreach($promotion_data as $promotionData){
													$promotion_ids[] = $promotionData['promotion_id'];
												}
												$promotion_capture_list = $this->player_promotion_model->get_promotion_list_data_refferer_duplicate($player_data['player_id'],$promotion_ids);
											}
											if(!empty($promotion_data)){
												$get_member_total_wallet  =  array(
													'balance_valid' => TRUE,
													'balance_amount' => 0,
												);
												foreach($promotion_data as $promotionData){
													if(!isset($promotion_capture_list[$promotionData['promotion_id']])){
														$DBdata = array(
															'promotion_id' => $promotionData['promotion_id'],
															'amount' => 0,
															'reward_amount' => 0,
															'achieve_amount' => 0,
															'bonus_multiply' => 0,
															'player_id' => $referral_data['player_id'],
														);
														$newData = $this->promotion_apply_model->add_player_promotion($DBdata,$get_member_total_wallet,$player_data);
														$insert_wallet_data = array(
															"player_id" => $newData['player_id'],
															"username" => $referral_data['username'],
															"amount" => $newData['reward_amount'],
														);
														if($newData['reward_on_apply'] == STATUS_ACTIVE){
															$array = array(
																'promotion_name' => $newData['promotion_name'],
																'remark' => $this->input->post('remark', TRUE),
															);
															$promotion_add_list[] = $newData;
															$this->player_model->update_player_wallet($insert_wallet_data);
															$this->general_model->insert_cash_transfer_report($referral_data, $newData['reward_amount'], TRANSFER_PROMOTION,$array);
															$rewardData = $this->promotion_approve_model->update_player_promotion_reward_claim($newData,0);
														}
														
														$this->promotion_approve_model->force_update_player_promotion($newData,STATUS_ENTITLEMENT);
														$newData['is_reward'] = $rewardData['is_reward'];
														$newData['reward_date'] = $rewardData['reward_date'];
														if($this->session->userdata('user_group') == USER_GROUP_USER)
														{
															$this->user_model->insert_log(LOG_PLAYER_PROMOTION_ADD, $newData);
														}
														else
														{
															$this->account_model->insert_log(LOG_PLAYER_PROMOTION_ADD, $newData);
														}
													}
												}
											}
										}
									}

									if(!empty($promotion_add_list)){
										foreach($promotion_add_list as $promotion_add_row){
											$promotion_lang = $this->promotion_model->get_promotion_lang_data($promotion_add_row['promotion_id']);
											$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_SUCCESS_PROMOTION);
											if(!empty($system_message_data)){
												if(!empty($system_message_data)){
													$system_message_id = $system_message_data['system_message_id']; 
													$oldLangData = $this->message_model->get_message_lang_data($system_message_id);
													$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
													$create_time = time();
													$username = $referral_data['username'];
													$array_key = array(
														'system_message_id' => $system_message_data['system_message_id'],
														'system_message_genre' => $system_message_data['system_message_genre'],
														'player_level' => "",
														'bank_channel' => "",
														'username' => $username,
													);
													$Bdatalang = array();
													$Bdata = array();
													$player_message_list = $this->message_model->get_player_all_data_by_message_genre($array_key);
													if(!empty($player_message_list)){
														if(sizeof($player_message_list)>0){
															foreach($player_message_list as $row){
																$PBdata = array(
																	'system_message_id'	=> $system_message_id,
																	'player_id'			=> $row['player_id'],
																	'username'			=> $row['username'],
																	'active' 			=> STATUS_ACTIVE,
																	'is_read'			=> MESSAGE_UNREAD,
																	'created_by'		=> $this->session->userdata('username'),
																	'created_date'		=> $create_time,
																);
																array_push($Bdata, $PBdata);
															}
														}
														if( ! empty($Bdata))
														{
															$this->db->insert_batch('system_message_user', $Bdata);
														}

														$success_message_data = $this->message_model->get_message_bluk_data($system_message_id,$create_time);
														if(sizeof($lang)>0){
															if(!empty($player_message_list) && sizeof($player_message_list)>0){
																foreach($player_message_list as $player_message_list_row){
																	if(isset($success_message_data[$player_message_list_row['player_id']])){
																		foreach($lang as $k => $v){
																			$reward = $promotion_add_row['reward_amount'];
																			$promotion_name = $promotion_add_row['promotion_name'];
																			if(isset($promotion_lang[$v])){
																				$promotion_name = $promotion_lang[$v]['promotion_title'];
																			}

																			$replace_string_array = array(
																				SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
																				SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
																				SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD => $reward,
																				SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_NAME => $promotion_name,
																				SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_MULTIPLY => $promotion_add_row['bonus_multiply'],
																			);

																			$PBdataLang = array(
																				'system_message_user_id'	=> $success_message_data[$player_message_list_row['player_id']],
																				'system_message_title'		=> $oldLangData[$v]['system_message_title'],
																				'system_message_content'	=> get_system_message_content($oldLangData[$v]['system_message_content'],$replace_string_array),
																				'language_id' 				=> $v
																			);
																			array_push($Bdatalang, $PBdataLang);
																		}
																	}
																}	
															}
														}
														$this->db->insert_batch('system_message_user_lang', $Bdatalang);
													}
												}
											}
										}
									}
								}
							}
						}
						
						if($this->session->userdata('user_group') == USER_GROUP_USER) {
							$this->user_model->insert_log(LOG_DEPOSIT_UPDATE, $newData, $oldData);
						}
						else {
							$this->account_model->insert_log(LOG_DEPOSIT_UPDATE, $newData, $oldData);
						}
						
						$this->db->trans_complete();
						
						if ($this->db->trans_status() === TRUE) {
							$json['status'] = EXIT_SUCCESS;
							$json['msg'] = $this->lang->line('success_updated');
							
							switch($newData['status']) {
								case STATUS_APPROVE: $status = $this->lang->line('status_approved'); break;
								case STATUS_CANCEL: $status = $this->lang->line('status_cancelled'); break;
								default: $status = $this->lang->line('deposit_status_pending'); break;
							}

							if($newData['status'] == STATUS_APPROVE){
								if(TELEGRAM_STATUS == STATUS_ACTIVE){
									send_amount_telegram(TELEGRAM_MONEY_FLOW,$player['username'],$newData['updated_by'],$oldData['amount'],$transfer_type);
								}
							}

							if($newData['status'] == STATUS_APPROVE){
								//Send System message
								$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_SUCCESS_DEPOSIT);
								if(!empty($system_message_data)){
									$system_message_id = $system_message_data['system_message_id']; 
									$oldLangData = $this->message_model->get_message_lang_data($system_message_id);
									$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
									$create_time = time();
									$username = $player['username'];
									$array_key = array(
										'system_message_id' => $system_message_data['system_message_id'],
										'system_message_genre' => $system_message_data['system_message_genre'],
										'player_level' => "",
										'bank_channel' => "",
										'username' => $username,
									);
									$Bdatalang = array();
									$Bdata = array();
									$player_message_list = $this->message_model->get_player_all_data_by_message_genre($array_key);
									if(!empty($player_message_list)){
										if(sizeof($player_message_list)>0){
											foreach($player_message_list as $row){
												$PBdata = array(
													'system_message_id'	=> $system_message_id,
													'player_id'			=> $row['player_id'],
													'username'			=> $row['username'],
													'active' 			=> STATUS_ACTIVE,
													'is_read'			=> MESSAGE_UNREAD,
													'created_by'		=> $this->session->userdata('username'),
													'created_date'		=> $create_time,
												);
												array_push($Bdata, $PBdata);
											}
										}
										if( ! empty($Bdata))
										{
											$this->db->insert_batch('system_message_user', $Bdata);
										}

										$success_message_data = $this->message_model->get_message_bluk_data($system_message_id,$create_time);
										if(sizeof($lang)>0){
											if(!empty($player_message_list) && sizeof($player_message_list)>0){
												foreach($player_message_list as $player_message_list_row){
													if(isset($success_message_data[$player_message_list_row['player_id']])){
														foreach($lang as $k => $v){
															$replace_string_array = array(
																SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
																SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
															);

															$PBdataLang = array(
																'system_message_user_id'	=> $success_message_data[$player_message_list_row['player_id']],
																'system_message_title'		=> $oldLangData[$v]['system_message_title'],
																'system_message_content'	=> get_system_message_content($oldLangData[$v]['system_message_content'],$replace_string_array),
																'language_id' 				=> $v
															);
															array_push($Bdatalang, $PBdataLang);
														}
													}
												}	
											}
										}
										$this->db->insert_batch('system_message_user_lang', $Bdatalang);
									}
								}
							}
							
							#Prepare for ajax update
							$json['response'] = array(
								'id' => $newData['deposit_id'],
								'remark' => $newData['remark'],
								'status' => $status,
								'status_code' => $newData['status'],
								'updated_by' => $newData['updated_by'],
								'updated_date' => date('Y-m-d H:i:s', $newData['updated_date']),
							);
						}
						else {
							$json['msg'] = $this->lang->line('error_failed_to_deposit');
						}						
					}
					else {						
						$json['msg'] = $this->lang->line('error_company_insufficient_points');
					}					
				}
				else {
					$json['msg'] = $this->lang->line('error_failed_to_deposit');
				}		
			}
			else {
				$json['msg'] = $this->lang->line('error_failed_to_deposit');
			}
			
			#Output
			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($json))
				->_display();
			unset($json);
			exit();	
		}	
	}

	public function deposit_offline_add($id = NULL){
		if(permission_validation(PERMISSION_DEPOSIT_ADD) == TRUE)
		{
			$data = $this->player_model->get_player_data($id);
			if( ! empty($data))
			{
				$response = $this->user_model->get_downline_data($data['upline']);
				if( ! empty($response))
				{
					$data['promotion_data'] = array();
					$data['currencies_data'] = $this->currencies_model->get_currencies_list();
					if($data['is_promotion'] == STATUS_ACTIVE){
						$member_total_wallet = $this->get_member_total_wallet($data['player_id']);
						/*if($data['promotion_type'] == PROMOTION_TYPE_STRICT_BASED){
							$data['promotion_data'] = $this->promotion_model->get_player_deposit_promotion_available_strict_with_detail($data,1,$member_total_wallet);
						}else{
							$data['promotion_data'] = $this->promotion_model->get_player_deposit_promotion_available_unstrict_with_detail($data,1,$member_total_wallet);
						}*/
					}
					$this->load->view('deposit_offline_add', $data);
				}
				else
				{
					redirect('home');
				}
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}
	}

	public function deposit_offline_submit(){
		if(permission_validation(PERMISSION_DEPOSIT_ADD) == TRUE) {
			#Initial output data
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => array(
					'points_error' => '',
					'currency_id_error' => '',
					'general_error' => ''
				),
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);
			
			$player_id 		= trim($this->input->post('player_id', TRUE));
			$currency_id 	= trim($this->input->post('currency_id', TRUE));
			$oldData 		= $this->player_model->get_player_data($player_id);
			$currenciesData = $this->currencies_model->get_currencies_active_data($currency_id);
			if( ! empty($oldData) && !empty($currenciesData)) {
				$response = $this->user_model->get_downline_data($oldData['upline']);
				if( ! empty($response)) {					
				
					#Set form rules
					$config = array(
						array(
							'field' => 'points',
							'label' => strtolower($this->lang->line('label_points')),
							'rules' => 'trim|greater_than[0]',
							'errors' => array(
								'greater_than' => $this->lang->line('error_greater_than')
							)
						),
						array(
							'field' => 'currency_id',
							'label' => strtolower($this->lang->line('label_currency')),
							'rules' => 'trim|required',
							'errors' => array(
								'greater_than' => $this->lang->line('error_select_currencies')
							)
						)
					);		
					
					$this->form_validation->set_rules($config);
					$this->form_validation->set_error_delimiters('', '');
					
					#Form validation
					if ($this->form_validation->run() == TRUE) {
						$points 		= $this->input->post('points', TRUE);
						$promotion_id 	= $this->input->post('promoId', TRUE);
						$allow_to_add 	= TRUE;
						
						#########CUSTOM CHECK MASTER POINT########
						$uplineacc 		= $this->user_model->get_downline_data(SYSTEM_API_AGENT_ID);
						$master_flag 	= ($uplineacc['points'] > $points) ? TRUE : FALSE;						
						##########################################
						
						if($master_flag) {
							$data = array(
								'transaction_code' => 'D' . $oldData['player_id'] . time() . rand(10000, 99999),
								'amount_apply' => $points,
								'amount' => $points,
								'player_id' => $oldData['player_id'],
								'username' => $oldData['username'],
								'promotion_id' => $promotion_id,
								'promotion_name' => "",
								'currency_id' => $currenciesData['currency_id'],
								'currency_code' => $currenciesData['currency_code'],
								'currency_rate' => $currenciesData['d_currency_rate'],
								'amount_rate' => bcdiv(($points * $currenciesData['d_currency_rate']) , 1, 2),
							);
							if(!empty($data['promotion_id'])){
								if($oldData['is_promotion'] == STATUS_ACTIVE){
									$get_member_total_wallet  = $this->get_member_total_wallet($oldData['player_id']);
									$promotion_response = NULL;
									if($oldData['promotion_type'] == PROMOTION_TYPE_STRICT_BASED){
										$promotion_response = $this->promotion_model->deposit_promotion_strict_apply_decision($data,$get_member_total_wallet);
									}else{
										$promotion_response = $this->promotion_model->deposit_promotion_unstrict_apply_decision($data,$get_member_total_wallet);
									}
									if($promotion_response['status'] != EXIT_SUCCESS){
										$allow_to_add = FALSE;
										$json['msg']['general_error'] = $promotion_response['msg'];
									}else{
										$data['promotion_name'] = $promotion_response['promotion_name'];
									}
								}else{
									$allow_to_add = FALSE;
									$json['msg']['general_error'] = $this->lang->line('error_promotion_not_allow');
								}
							}
							if($allow_to_add){
								//Database update
								$this->db->trans_start();
								$newData = $this->deposit_model->add_deposit_offline($data);
								if(!empty($data['promotion_id'])){
									$DnewData = $this->promotion_model->add_player_promotion($newData,$get_member_total_wallet);
								}
								if($this->session->userdata('user_group') == USER_GROUP_USER)
								{
									$this->user_model->insert_log(LOG_DEPOSIT_ADD, $newData);
									$this->user_model->insert_log(LOG_PLAYER_PROMOTION_ADD, $DnewData);
								}
								else
								{
									$this->account_model->insert_log(LOG_DEPOSIT_ADD, $newData);
									$this->account_model->insert_log(LOG_PLAYER_PROMOTION_ADD, $DnewData);
								}	
								$this->db->trans_complete();

								if ($this->db->trans_status() === TRUE)
								{
									$json['status'] = EXIT_SUCCESS;
									$json['msg'] = $this->lang->line('success_deposit_points');
								}
								else
								{
									$json['msg']['general_error'] = $this->lang->line('error_failed_to_deposit');
								}
							}
						}
						else {
							$json['msg']['general_error'] = $this->lang->line('error_company_insufficient_points');
						}
					}
					else {
						$json['msg']['points_error'] = form_error('points');
						$json['msg']['currency_id_error'] = form_error('currency_id');
					}
				}
				else {
					$json['msg']['general_error'] = $this->lang->line('error_failed_to_deposit');
				}
				unset($oldData,$currenciesData);				
			}
			else {
				$json['msg']['general_error'] = $this->lang->line('error_failed_to_deposit');
			}		
			
			#Output
			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($json))
				->_display();
			unset($json);
			exit();	
		}	
	}

	public function get_member_total_wallet($id){
		$is_balance_valid = TRUE;
		$total_amount = 0;
		$game_balance = 0;
		$main_wallet_balance = 0;
		$player_data = $this->player_model->get_player_data($id);
		if( ! empty($player_data))
		{
			$game_balance = 0;
			$total_amount = $player_data['points'];
			$main_wallet_balance = $player_data['points'];
			$upline_data = $this->user_model->get_downline_data($player_data['upline']);
			if( ! empty($upline_data))
			{
				$sys_data = $this->miscellaneous_model->get_miscellaneous();
				$url = SYSTEM_API_URL;
				$account_data_list = $this->player_model->get_player_game_account_data_list($player_data['player_id']);
				if( ! empty($account_data_list))
				{
					foreach($account_data_list as $account_data){
						$signature = md5(SYSTEM_API_AGENT_ID . $account_data['game_provider_code'] . $account_data['username'] . SYSTEM_API_SECRET_KEY);

						$param_array = array(
							"method" => 'GetBalance',
							"agent_id" => SYSTEM_API_AGENT_ID,
							"syslang" => LANG_EN,
							"device" => PLATFORM_WEB,
							"provider_code" => $account_data['game_provider_code'],
							"username" => $account_data['username'],
							"password" => $account_data['password'],
							"game_id" => $account_data['game_id'],
							"player_id" => $account_data['player_id'],
							"signature" => $signature,
						);

						$response = $this->curl_json($url, $param_array);
						$result_array = json_decode($response, TRUE);
						if(isset($result_array['errorCode']) && $result_array['errorCode'] == '0')
						{
							$total_amount = ($total_amount + $result_array['result']);
							$game_balance = ($game_balance + $result_array['result']);
						}else{
							$is_balance_valid = FALSE;
						}
					}
				}
			}else{
				$is_balance_valid = FALSE;
			}
		}else{
			$is_balance_valid = FALSE;
		}

		$result = array(
			'balance_valid' => $is_balance_valid,
			'balance_amount' => $total_amount,
			'game_balance' => $game_balance,
			'main_wallet_balance' => $main_wallet_balance,
		);
		return $result;
	}

	public function agent_player_deposit(){
		if(permission_validation(PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW) == TRUE)
		{
			$this->save_current_url('deposit/agent_player_deposit');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_deposit');
			$this->session->unset_userdata('search_agent_player_deposits');
			$data_search = array(
				'from_date' => date('Y-m-d 00:00:00'),
				'to_date' => date('Y-m-d 23:59:59'),
				'deposit_type' => "",
				'username' => "",
				'status' => "-1",
				'ip_address' => "",
			);

			if($_GET){
				$deposit_id = (isset($_GET['id'])?$_GET['id']:'');
				$deposit_data = $this->deposit_model->get_deposit_data($deposit_id);
				if(!empty($deposit_data)){
					$data_search['from_date'] = date('Y-m-d 00:00:00',$deposit_data['created_date']);
					$data_search['to_date'] = date('Y-m-d 23:59:59',$deposit_data['created_date']);
					$data_search['status'] = STATUS_PENDING;


					//set prevent alarm
					$arr = $this->session->userdata('alert_deposits');
					if(!empty($arr)){
						$ids = $arr . $deposit_id . ',';
						$arr_array = explode(",",$ids);
						$arr_array = array_unique(array_values(array_filter($arr_array)));
						$ids = ','.implode(",",$arr_array).',';
					}else{
						$ids = ',' . $deposit_id . ',';
					}
					$this->session->set_userdata('alert_deposits',$ids);
				}
			}
			$data['data_search'] = $data_search;
			$this->session->set_userdata('search_agent_player_deposits', $data_search);
			$this->load->view('agent_player_deposit_view', $data);
		}
		else
		{
			redirect('home');
		}
	}

	public function agent_player_deposit_search()
	{
		if(permission_validation(PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW) == TRUE)
		{
			//Initial output data
			$json = array(
					'status' => EXIT_ERROR, 
					'msg' => array(
										'from_date_error' => '',
										'to_date_error' => '',
										'general_error' => ''
									),
					'csrfTokenName' => $this->security->get_csrf_token_name(), 
					'csrfHash' => $this->security->get_csrf_hash()
				);
			
			//Set form rules
			$config = array(
							array(
									'field' => 'from_date',
									'label' => strtolower($this->lang->line('label_from_date')),
									'rules' => 'trim|required|callback_full_datetime_check',
									'errors' => array(
														'required' => $this->lang->line('error_invalid_datetime_format'),
														'full_datetime_check' => $this->lang->line('error_invalid_datetime_format')
												)
							),
							array(
									'field' => 'to_date',
									'label' => strtolower($this->lang->line('label_to_date')),
									'rules' => 'trim|required|callback_full_datetime_check',
									'errors' => array(
														'required' => $this->lang->line('error_invalid_datetime_format'),
														'full_datetime_check' => $this->lang->line('error_invalid_datetime_format')
												)
							)
						);		
						
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			
			//Form validation
			if ($this->form_validation->run() == TRUE)
			{
				$from_date = strtotime(trim($this->input->post('from_date', TRUE)));
				$to_date = strtotime(trim($this->input->post('to_date', TRUE)));
				$days = $this->cal_days_in_year(date('Y', $from_date));
				$date_range = ($days * 86400);
				$time_diff = ($to_date - $from_date);
				
				if($time_diff < 0 OR $time_diff > $date_range)
				{
					$json['msg']['general_error'] = $this->lang->line('error_invalid_year_range');
				}
				else
				{
					$data = array( 
						'from_date' => trim($this->input->post('from_date', TRUE)),
						'to_date' => trim($this->input->post('to_date', TRUE)),
						'deposit_type' => trim($this->input->post('deposit_type', TRUE)),
						'username' => trim($this->input->post('username', TRUE)),
						'status' => trim($this->input->post('status', TRUE)),
						'ip_address' => trim($this->input->post('ip_address', TRUE)),
						'deposit_id' => trim($this->input->post('deposit_id', TRUE)),
						'agent' => trim($this->input->post('agent', TRUE)),
						'payment_gateway_id' => array_filter(explode(',',$this->input->post('payment_gateway_id', TRUE))),

					);
					
					$this->session->set_userdata('search_agent_player_deposits', $data);
					
					$json['status'] = EXIT_SUCCESS;
				}
			}
			else 
			{
				$json['msg']['from_date_error'] = form_error('from_date');
				$json['msg']['to_date_error'] = form_error('to_date');
			}
			
			//Output
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();	
		}
	}
	
	public function agent_player_deposit_listing()
    {
		if(permission_validation(PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW) == TRUE)
		{
			$limit = trim($this->input->post('length', TRUE));
			$start = trim($this->input->post("start", TRUE));
			$order = $this->input->post("order", TRUE);
			//Table Columns
			$columns = array(
				0 => 'a.deposit_id',
				1 => 'a.created_date',
				2 => 'a.deposit_type',
				3 => 'b.username',
				4 => 'a.amount_apply',
				5 => 'a.status',
				6 => 'a.deposit_ip',
			);

			$sum_columns = array( 
				0 => 'SUM(a.amount_apply) AS total_deposit_apply',
			);
			
			$col = 0;
			$dir = "";
				
			if( ! empty($order))
			{
				foreach($order as $o)
				{
					$col = $o['column'];
					$dir = $o['dir'];
				}
			}

			if($dir != "asc" && $dir != "desc")
			{
				$dir = "desc";
			}
			
			if( ! isset($columns[$col]))
			{
				$order = $columns[0];
			}
			else
			{
				$order = $columns[$col];
			}
			
			$arr = $this->session->userdata('search_agent_player_deposits');
			
			$where = '';		
			
			if( ! empty($arr['agent']))
			{
				$where = "AND a.player_id = 'ABC'";
				$agent = $this->user_model->get_user_data_by_username($arr['agent']);
				if(!empty($agent)){
					$response_upline = $this->user_model->get_downline_data($agent['username']);
					if(!empty($response_upline)){
						$where = "AND b.upline_ids LIKE '%," . $response_upline['user_id'] . ",%' ESCAPE '!'";
					}
				}
			}else{
				$where = "AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!'";
			}

			if(isset($arr['from_date']))
			{
				if( ! empty($arr['from_date']))
				{
					$where .= ' AND a.created_date >= ' . strtotime($arr['from_date']);
				}
				
				if( ! empty($arr['to_date']))
				{
					$where .= ' AND a.created_date <= ' . strtotime($arr['to_date']);
				}
				
				if($arr['deposit_type'] >= 1 && $arr['deposit_type'] <= sizeof(get_deposit_type()))
				{
					$where .= ' AND a.deposit_type = ' . $arr['deposit_type'];
				}
				
				if( ! empty($arr['username']))
				{
					$where .= " AND b.username LIKE '%" . $arr['username'] . "%' ESCAPE '!'";	
				}
				
				if($arr['status'] == STATUS_PENDING OR $arr['status'] == STATUS_APPROVE OR $arr['status'] == STATUS_CANCEL OR $arr['status'] == STATUS_ON_PENDING)
				{
					$where .= ' AND a.status = ' . $arr['status'];
				}
				
				if( ! empty($arr['ip_address']))
				{
					$where .= " AND a.ip_address LIKE '%" . $arr['ip_address'] . "%' ESCAPE '!'";	
				}

				if( ! empty($arr['deposit_id']))
				{
					$where .= " AND a.deposit_id = '" . $arr['deposit_id']."'";	
				}

				if(!empty($arr['payment_gateway_id']))
				{
					$payment_gateway_id = '"'.implode('","', $arr['payment_gateway_id']).'"';
					$where .= " AND a.payment_gateway_id IN(" . $payment_gateway_id . ")";
				}
			}	
			
			$select = implode(',', $columns);
			$dbprefix = $this->db->dbprefix;
			
			$posts = NULL;
			$query_string = "(SELECT {$select} FROM {$dbprefix}deposits a, {$dbprefix}players b WHERE (a.player_id = b.player_id) $where)";
			$query_string_2 = " ORDER by {$order} {$dir} LIMIT {$start}, {$limit}";
			$query = $this->db->query($query_string . $query_string_2);
			if($query->num_rows() > 0)
			{
				$posts = $query->result();  
			}
			
			$query->free_result();
			$query = $this->db->query($query_string);
			$totalFiltered = $query->num_rows();
			
			$query->free_result();
			
			//Prepare data
			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$button = "";

					$row = array();
					$row[] = ((floor(log10($post->deposit_id) + 1) > DEPOSIT_PAD_0) ? substr((string) $post->deposit_id, (DEPOSIT_PAD_0*-1)): str_pad($post->deposit_id, DEPOSIT_PAD_0, '0', STR_PAD_LEFT));
					$row[] = (($post->created_date > 0) ? date('Y-m-d H:i:s', $post->created_date) : '-');
					$row[] = $this->lang->line(get_deposit_type($post->deposit_type));
					$row[] = $post->username.'&nbsp;<i class="fas fa-copy nav-icon text-purple clipboard" data-clipboard-text="'.$post->username.'"></i>&nbsp;';
					$row[] = '<span class="text-' . (($post->amount_apply > 0) ? 'primary' : 'dark') . '">' . number_format($post->amount_apply, 0, '.', ',') . '</span>';
					switch($post->status)
					{
						case STATUS_ON_PENDING: $row[] = '<span class="badge bg-info" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('deposit_status_on_pending') . '</span>'; break;
						case STATUS_APPROVE: $row[] = '<span class="badge bg-success" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('status_approved') . '</span>'; break;
						case STATUS_CANCEL: $row[] = '<span class="badge bg-danger" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('status_cancelled') . '</span>'; break;
						default: $row[] = '<span class="badge bg-secondary" id="uc1_' . $post->deposit_id . '">' . $this->lang->line('deposit_status_pending') . '</span>'; break;
					}
					$row[] = $post->deposit_ip;
					$data[] = $row;
				}
			}
			
			//Output
			$json_data = array(
				"draw"            => intval($this->input->post('draw')),
				"recordsFiltered" => intval($totalFiltered), 
				"data"            => $data,
				"csrfHash" 		  => $this->security->get_csrf_hash()					
			);
				
			echo json_encode($json_data); 
			exit();
		}	
    }


	public function agent_player_deposit_total(){
		if(permission_validation(PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW) == TRUE)
		{
			$arr = $this->session->userdata('search_agent_player_deposits');
			$dbprefix = $this->db->dbprefix;
			//Declaration Total
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => '',
				'total_data' => '',
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);
			$json['total_data'] = array(
				'total_deposit_apply' => 0,
				'total_deposit_amount' => 0,
			);

			if(!empty($arr)){
				$json['status'] = EXIT_SUCCESS;
				$data = array();

				//Get total
				$where = '';

				if( ! empty($arr['agent']))
				{
					$where = "AND a.player_id = 'ABC'";
					$agent = $this->user_model->get_user_data_by_username($arr['agent']);
					if(!empty($agent)){
						$response_upline = $this->user_model->get_downline_data($agent['username']);
						if(!empty($response_upline)){
							$where = "AND b.upline_ids LIKE '%," . $response_upline['user_id'] . ",%' ESCAPE '!'";
						}
					}
				}else{
					$where = "AND b.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' ESCAPE '!'";
				}
				if(isset($arr['from_date']))
				{
					if( ! empty($arr['from_date']))
					{
						$where .= ' AND a.created_date >= ' . strtotime($arr['from_date']);
					}
					
					if( ! empty($arr['to_date']))
					{
						$where .= ' AND a.created_date <= ' . strtotime($arr['to_date']);
					}
					
					if($arr['deposit_type'] >= 1 && $arr['deposit_type'] <= sizeof(get_deposit_type()))
					{
						$where .= ' AND a.deposit_type = ' . $arr['deposit_type'];
					}
					
					if( ! empty($arr['username']))
					{
						$where .= " AND b.username LIKE '%" . $arr['username'] . "%' ESCAPE '!'";	
					}
					
					if($arr['status'] == STATUS_PENDING OR $arr['status'] == STATUS_APPROVE OR $arr['status'] == STATUS_CANCEL OR $arr['status'] == STATUS_ON_PENDING)
					{
						$where .= ' AND a.status = ' . $arr['status'];
					}
					
					if( ! empty($arr['ip_address']))
					{
						$where .= " AND a.ip_address LIKE '%" . $arr['ip_address'] . "%' ESCAPE '!'";	
					}

					if( ! empty($arr['deposit_id']))
					{
						$where .= " AND a.deposit_id = '" . $arr['deposit_id']."'";	
					}

					if( ! empty($arr['payment_gateway_id']))
					{
						$payment_gateway_id = '"'.implode('","', $arr['payment_gateway_id']).'"';
						$where .= " AND a.payment_gateway_id IN(" . $payment_gateway_id . ")";
					}
				}

				$sum_columns = array( 
					0 => 'SUM(a.amount_apply) AS total_deposit_apply',
					1 => 'SUM(a.amount) AS total_deposit_amount',
				);
				$sum_select = implode(',', $sum_columns);
				
				$total_query_string = "SELECT {$sum_select} FROM {$dbprefix}deposits a, {$dbprefix}players b WHERE (a.player_id = b.player_id) $where";
				$total_query = $this->db->query($total_query_string);
				if($total_query->num_rows() > 0)
				{
					foreach($total_query->result() as $row)
					{
						$json['total_data'] = array(
							'total_deposit_apply' => (($row->total_deposit_apply > 0) ? $row->total_deposit_apply : 0),
							'total_deposit_amount' => (($row->total_deposit_amount > 0) ? $row->total_deposit_amount : 0),
						);
					}
				}
				$total_query->free_result();
			}
			
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();
		}
	}
}