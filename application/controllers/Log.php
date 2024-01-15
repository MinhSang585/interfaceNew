 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model(array('game_model', 'player_model','miscellaneous_model','risk_model'));
		$this->load->model(array('log_model'));
		$is_logged_in = $this->is_logged_in();
		if( ! empty($is_logged_in)) 
		{
			echo '<script type="text/javascript">parent.location.href = "' . site_url($is_logged_in) . '";</script>';
		}
	}
	
	public function admin_log(){
    	if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE)
		{
			$this->save_current_url('log/admin_log');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_admin_log');
			$this->session->unset_userdata('search_admin_log');
			$data_search = array( 
				'from_date' => date('Y-m-d 00:00:00'),
				'to_date' => date('Y-m-d 23:59:59'),
				'type' => get_admin_log(),
				'username' => '',
				'admin' => '',
			);
			$this->session->set_userdata('search_admin_log', $data_search);
			$this->load->view('admin_log_view', $data);
		}
		else
		{
			redirect('home');
		}
    }

    public function admin_log_search(){
    	if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE)
		{
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => '',
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);

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
				$days = cal_days_in_month(CAL_GREGORIAN, date('n', $from_date), date('Y', $from_date));
				$date_range = (($days+1) * 86400);
				$time_diff = ($to_date - $from_date);
				
				if($time_diff < 0 OR $time_diff > $date_range)
				{
					$json['msg'] = $this->lang->line('error_invalid_month_range');
				}
				else
				{
					$data = array( 
						'from_date' => trim($this->input->post('from_date', TRUE)),
						'to_date' => trim($this->input->post('to_date', TRUE)),
						'type' => $this->input->post('type[]', TRUE),
						'username' => trim($this->input->post('username', TRUE)),
						'admin' => trim($this->input->post('admin', TRUE)),
					);
					
					$this->session->set_userdata('search_admin_log', $data);
					
					$json['status'] = EXIT_SUCCESS;
				}
			}
			else 
			{
				$error = array(
							'from_date' => form_error('from_date'), 
							'to_date' => form_error('to_date')
						);
					
				if( ! empty($error['from_date']))
				{
					$json['msg'] = $error['from_date'];
				}
				else if( ! empty($error['to_date']))
				{
					$json['msg'] = $error['to_date'];
				}
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

    public function admin_log_listing(){
    	if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE)
		{
			$limit = trim($this->input->post('length', TRUE));
			$start = trim($this->input->post("start", TRUE));
			$order = $this->input->post("order", TRUE);

			//Table Columns
			$columns = array( 
				0 => 'a.user_log_id',
				1 => 'a.log_date',
				2 => 'a.log_type',
				3 => 'b.username',
				4 => 'c.username as admin',
				5 => 'a.ip_address',
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
							
			$arr = $this->session->userdata('search_admin_log');

			$where = '';

			if(isset($arr['from_date']))
			{
				if( ! empty($arr['from_date']))
				{
					//$where .= ' AND a.log_date >= ' . strtotime($arr['from_date']);
				}
				
				if( ! empty($arr['to_date']))
				{
					//$where .= ' AND a.log_date <= ' . strtotime($arr['to_date']);
				}
				
				if( ! empty($arr['type']))
				{
					$type = implode(',', $arr['type']);
					$where .= " AND a.log_type IN(" . $type . ")";
				}else{
					$where .= " AND a.log_type IN ('a')";
				}
				
				if( ! empty($arr['username']))
				{
					$where .= " AND b.username = '" . $arr['username'] . "'";	
				}

				if( ! empty($arr['admin']))
				{
					$where .= " AND c.username = '" . $arr['admin'] . "'";	
				}
			}
			$select = implode(',', $columns);
			$order = substr($order, 2);
			$dbprefix = $this->db->dbprefix;

			$posts = NULL;
			$query_string = "(SELECT {$select} FROM {$dbprefix}user_logs a JOIN {$dbprefix}users c ON a.user_id = c.user_id LEFT JOIN {$dbprefix}players b ON a.player_id = b.player_id WHERE c.upline_ids LIKE '%," . $this->session->userdata('root_user_id') . ",%' OR c.user_id = " . $this->session->userdata('root_user_id') . " $where)";
			$query_string_2 = " ORDER by {$order} {$dir} LIMIT {$start}, {$limit}";
			$query = $this->db->query($query_string . $query_string_2);
			if($query->num_rows() > 0)
			{
				$posts = $query->result();  
			}
			
			$query->free_result();
			
			//Get total records
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
					$row[] = $post->user_log_id;
					$row[] = (($post->log_date > 0) ? date('Y-m-d H:i:s', $post->log_date) : '-');
					$row[] = $this->lang->line(log_type($post->log_type));
					$row[] = (( ! empty($post->admin)) ? $post->admin : '-');
					$row[] = (( ! empty($post->username)) ? $post->username : '-');
					$row[] = (( ! empty($post->ip_address)) ? $post->ip_address : '-');
					if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE)
					{
						$button .= '<i onclick="displayContent(' . $post->user_log_id . ')" class="fab fa-elementor nav-icon text-info" title="' . $this->lang->line('button_content')  . '"></i> &nbsp;&nbsp; ';
						$row[] = $button;
					}
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

    public function sub_account_log(){
    	if(permission_validation(PERMISSION_SUB_ACCOUNT_LOG_VIEW) == TRUE)
		{
			$this->save_current_url('log/sub_account_log');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_admin_log');
			$this->session->unset_userdata('search_sub_account_log');
			$data_search = array( 
				'from_date' => date('Y-m-d 00:00:00'),
				'to_date' => date('Y-m-d 23:59:59'),
				'type' => '',//admin_log(),
				'username' => '',
				'admin' => '',
			);
			$this->session->set_userdata('search_sub_account_log', $data_search);
			$this->load->view('sub_account_log_view', $data);
		}
		else
		{
			redirect('home');
		}
    }

    public function admin_player_log(){
    	if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE)
		{
			$this->save_current_url('log/admin_log');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_admin_log');
			$this->session->unset_userdata('search_admin_log');
			$data_search = array( 
				'from_date' => date('Y-m-d 00:00:00'),
				'to_date' => date('Y-m-d 23:59:59'),
				'type' => '',//admin_log(),
				'username' => '',
				'admin' => '',
			);
			$this->session->set_userdata('search_admin_log', $data_search);
			$this->load->view('admin_log_view', $data);
		}
		else
		{
			redirect('home');
		}
    }

    public function sub_account_player_log(){
    	if(permission_validation(PERMISSION_SUB_ACCOUNT_LOG_VIEW) == TRUE)
		{
			$this->save_current_url('log/sub_account_log');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_admin_log');
			$this->session->unset_userdata('search_sub_account_log');
			$data_search = array( 
				'from_date' => date('Y-m-d 00:00:00'),
				'to_date' => date('Y-m-d 23:59:59'),
				'type' => '',//admin_log(),
				'username' => '',
				'admin' => '',
			);
			$this->session->set_userdata('search_sub_account_log', $data_search);
			$this->load->view('sub_account_log_view', $data);
		}
		else
		{
			redirect('home');
		}
    }

    public function user_content($id=NULL){
    	if(permission_validation(PERMISSION_ADMIN_LOG_VIEW) == TRUE){
    		$data['log_content'] = $this->log_model->get_user_log_data($id);
    		if(!empty($data['log_content'])){
    			ad($data['log_content']);
    			exit;
    			$this->load->view('log_content_view', $data);
    		}else{
    			redirect('home');		
    		}
    	}else
		{
			redirect('home');
		}
    }
}