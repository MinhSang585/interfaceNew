<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('level_model','player_model','miscellaneous_model','game_model','promotion_model','cron_model','message_model'));
		
		$is_logged_in = $this->is_logged_in();
		if( ! empty($is_logged_in)) 
		{
			echo '<script type="text/javascript">parent.location.href = "' . site_url($is_logged_in) . '";</script>';
		}
	}

	public function index(){
		if(permission_validation(PERMISSION_LEVEL_VIEW) == TRUE)
		{
			$this->save_current_url('level');
			$data['page_title'] = $this->lang->line('title_ranking');
			$data = quick_search();
			$this->load->view('level_view', $data);
		}
		else
		{
			redirect('home');
		}
	}

	public function listing(){
		if(permission_validation(PERMISSION_LEVEL_VIEW) == TRUE)
		{
			$limit = trim($this->input->post('length', TRUE));
			$start = trim($this->input->post("start", TRUE));
			$order = $this->input->post("order", TRUE);
			$game_type = get_game_type_all();
			$columns = array(
				0 => 'level_id',
				1 => 'level_name',
				2 => 'level_number',
				3 => 'level_deposit_amount_from',
				4 => 'level_deposit_amount_to',
				5 => 'level_target_amount_from',
				6 => 'level_target_amount_to',
				7 => 'level_reward_amount',
				8 => 'level_rate_sb',
				9 => 'level_rate_lc',
				10 => 'level_rate_sl',
				11 => 'level_rate_fh',
				12 => 'level_rate_es',
				13 => 'level_rate_bg',
				14 => 'level_rate_lt',
				15 => 'level_rate_kn',
				16 => 'level_rate_vs',
				17 => 'level_rate_pk',
				18 => 'level_rate_cf',
				19 => 'level_rate_ot',
				20 => 'updated_by',
				21 => 'updated_date',
				22 => 'level_default',
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
				$dir = "asc";
			}
			
			if( ! isset($columns[$col]))
			{
				$order = $columns[1];
			}
			else
			{
				$order = $columns[$col];
			}

			$query = array(
					'select' => implode(',', $columns),
					'table' => 'level',
					'limit' => $limit,
					'start' => $start,
					'order' => $order,
					'dir' => $dir,
			);
			$posts =  $this->general_model->all_posts($query);
			$totalFiltered = $this->general_model->all_posts_count($query);
			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$post_array = (array)$post;
					$total_player = $this->level_model->count_level_total($post->level_number);
					$row = array();
					$row[] = $post->level_id;
					$row[] = '<span id="uc1_' . $post->level_id . '">' . $post->level_name . '</span>';
					$row[] = $post->level_number;
					$row[] = $total_player;
					$row[] = '<span id="uc2_' . $post->level_id . '">' . number_format($post->level_deposit_amount_from,'2','.',',') . '</span>';
					$row[] = '<span id="uc3_' . $post->level_id . '">' . number_format($post->level_deposit_amount_to,'2','.',',') . '</span>';
					$row[] = '<span id="uc4_' . $post->level_id . '">' . number_format($post->level_target_amount_from,'2','.',',') . '</span>';
					$row[] = '<span id="uc5_' . $post->level_id . '">' . number_format($post->level_target_amount_to,'2','.',',') . '</span>';
					$row[] = '<span id="uc6_' . $post->level_id . '">' . number_format($post->level_reward_amount,'2','.',',') . '</span>';
					$row[] = '<span id="uc9_' . $post->level_id . '">' . (($post_array['level_rate_sb']>0)?number_format($post_array['level_rate_sb'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc10_' . $post->level_id . '">' . (($post_array['level_rate_lc']>0)?number_format($post_array['level_rate_lc'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc11_' . $post->level_id . '">' . (($post_array['level_rate_sl']>0)?number_format($post_array['level_rate_sl'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc12_' . $post->level_id . '">' . (($post_array['level_rate_fh']>0)?number_format($post_array['level_rate_fh'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc13_' . $post->level_id . '">' . (($post_array['level_rate_es']>0)?number_format($post_array['level_rate_es'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc14_' . $post->level_id . '">' . (($post_array['level_rate_bg']>0)?number_format($post_array['level_rate_bg'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc15_' . $post->level_id . '">' . (($post_array['level_rate_lt']>0)?number_format($post_array['level_rate_lt'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc16_' . $post->level_id . '">' . (($post_array['level_rate_kn']>0)?number_format($post_array['level_rate_kn'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc17_' . $post->level_id . '">' . (($post_array['level_rate_vs']>0)?number_format($post_array['level_rate_vs'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc18_' . $post->level_id . '">' . (($post_array['level_rate_pk']>0)?number_format($post_array['level_rate_pk'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc19_' . $post->level_id . '">' . (($post_array['level_rate_cf']>0)?number_format($post_array['level_rate_cf'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc20_' . $post->level_id . '">' . (($post_array['level_rate_ot']>0)?number_format($post_array['level_rate_ot'],'2','.',',') : 'x') . '</span>';
					$row[] = '<span id="uc7_' . $post->level_id . '">' . (( ! empty($post->updated_by)) ? $post->updated_by : '-') . '</span>';
					$row[] = '<span id="uc8_' . $post->level_id . '">' . (($post->updated_date > 0) ? date('Y-m-d H:i:s', $post->updated_date) : '-') . '</span>';
					$button = '';
					if(permission_validation(PERMISSION_LEVEL_UPDATE) == TRUE)
					{
						$button .= '<i onclick="updateData(' . $post->level_id . ')" class="fas fa-edit nav-icon text-primary" title="' . $this->lang->line('button_web_banner')  . '"></i> &nbsp;&nbsp; ';
					}
					if(permission_validation(PERMISSION_LEVEL_DELETE) == TRUE)
					{
						if($post->level_default == STATUS_NO){
							$button .= '<i onclick="deleteData(' . $post->level_id . ')" class="fas fa-trash nav-icon text-danger" title="' . $this->lang->line('button_delete')  . '"></i>';
						}
					}

					if(permission_validation(PERMISSION_LEVEL_UPDATE) == TRUE || permission_validation(PERMISSION_LEVEL_DELETE) == TRUE){
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

	public function add(){
		if(permission_validation(PERMISSION_LEVEL_ADD) == TRUE)
		{
			$data['game_provider_list'] = $this->game_model->get_game_list();
			$this->load->view('level_add',$data);
		}
		else
		{
			redirect('home');
		}
	}

	public function submit(){
		if(permission_validation(PERMISSION_LEVEL_ADD) == TRUE)
		{
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => array(
					'level_number_error' => '',
					'upgrade_type_error' => '',
					'downgrade_type_error' => '',
					'maintain_membership_limit_error' => '',
					'calculate_type_error' => '',
					'general_error' => ''
				), 		
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);
			//Set form rules
			$config = array(
				array(
						'field' => 'level_number',
						'label' => strtolower($this->lang->line('label_ranking_number')),
						'rules' => 'trim|required|is_unique[level.level_number]|max_length[32]',
						'errors' => array(
								'required' => $this->lang->line('error_enter_ranking_number'),
								'is_unique' => $this->lang->line('error_ranking_number_already_exits'),
								'max_length' => $this->lang->line('error_invalid_ranking_number'),
						)
				),
				array(
						'field' => 'upgrade_type',
						'label' => strtolower($this->lang->line('label_type')),
						'rules' => 'trim|required',
						'errors' => array(
							'required' => $this->lang->line('error_select_type'),
						)
				),
				array(
						'field' => 'downgrade_type',
						'label' => strtolower($this->lang->line('label_type')),
						'rules' => 'trim|required',
						'errors' => array(
							'required' => $this->lang->line('error_select_type'),
						)
				),
				array(
					'field' => 'maintain_membership_limit',
					'label' => strtolower($this->lang->line('label_maintain_membership_limit')),
					'rules' => 'trim|required|integer',
					'errors' => array(
						'required' => $this->lang->line('error_only_digits_allowed'),
						'integer' => $this->lang->line('error_only_digits_allowed')
					)
				),
				/*
				array(
					'field' => 'calculate_type',
					'label' => strtolower($this->lang->line('label_calculate_type')),
					'rules' => 'trim|required',
					'errors' => array(
						'required' => $this->lang->line('error_select_calculate_type'),
					)
				),
				*/
			);	
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == TRUE)
			{
				$allow_to_add = TRUE;
				$config['upload_path'] = LEVEL_PATH;
				$config['max_size'] = LEVEL_FILE_SIZE;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['overwrite'] = TRUE;
				
				$this->load->library('upload', $config);
				$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
				if(sizeof($lang)>0){
					foreach($lang as $k => $v){
						if(isset($_FILES['web_banner_'.$v]['size']) && $_FILES['web_banner_'.$v]['size'] > 0)
						{
							$new_name = time().rand(1000,9999).".".pathinfo($_FILES["web_banner_".$v]['name'], PATHINFO_EXTENSION);
							$config['file_name']  = $new_name;
							$this->upload->initialize($config);
							if( ! $this->upload->do_upload('web_banner_'.$v)) 
							{
								$json['msg']['general_error'] = $this->lang->line('error_invalid_filetype');
								$allow_to_add = FALSE;
							}else{
								$_FILES["web_banner_".$v]['name'] = $new_name;
							}
						}

						if($allow_to_add == TRUE)
						{
							if(isset($_FILES['mobile_banner_'.$v]['size']) && $_FILES['mobile_banner_'.$v]['size'] > 0)
							{
								$new_name = time().rand(1000,9999).".".pathinfo($_FILES["mobile_banner_".$v]['name'], PATHINFO_EXTENSION);
								$config['file_name'] = $new_name;
								$this->upload->initialize($config);
								if( ! $this->upload->do_upload('mobile_banner_'.$v)) 
								{
									$json['msg']['general_error'] = $this->lang->line('error_invalid_filetype');
									$allow_to_add = FALSE;
								}
								else{
									$_FILES["mobile_banner_".$v]['name'] = $new_name;
								}
							}
						}
					}
				}

				if($allow_to_add == TRUE)
				{
					//Database update
					$this->db->trans_start();
					$newData = $this->level_model->add_level();
					$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
					if(sizeof($lang)>0){
						foreach($lang as $k => $v){
							$this->level_model->add_level_content($newData['level_id'],$v);
						}
					}
					if($this->session->userdata('user_group') == USER_GROUP_USER) 
					{
						$this->user_model->insert_log(LOG_LEVEL_ADD, $newData);
					}
					else
					{
						$this->account_model->insert_log(LOG_LEVEL_ADD, $newData);
					}
					
					$this->db->trans_complete();
					
					if ($this->db->trans_status() === TRUE)
					{
						$json['status'] = EXIT_SUCCESS;
						$json['msg'] = $this->lang->line('success_added');
					}
					else
					{
						$json['msg']['general_error'] = $this->lang->line('error_failed_to_add');
					}
				}
			}else{
				$json['msg']['level_number_error'] = form_error('level_number');
				$json['msg']['upgrade_type_error'] = form_error('upgrade_type');
				$json['msg']['downgrade_type_error'] = form_error('downgrade_type');
				$json['msg']['maintain_membership_limit_error'] = form_error('maintain_membership_limit');
				$json['msg']['calculate_type_error'] = form_error('calculate_type');
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

	public function edit($id=null){
		if(permission_validation(PERMISSION_LEVEL_UPDATE) == TRUE)
		{
			$data['level'] = $this->level_model->get_level_data_by_id($id);
			if(!empty($data['level'])){
				$data['level_lang'] = $this->level_model->get_level_lang_data($id);
				$data['game_provider_list'] = $this->game_model->get_game_list();
				$this->load->view('level_update',$data);
			}else{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}
	}

	public function update(){
		if(permission_validation(PERMISSION_LEVEL_UPDATE) == TRUE)
		{
			//Initial output data
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => array(
					'upgrade_type_error' => '',
					'downgrade_type_error' => '',
					'maintain_membership_limit_error' => '',
					'calculate_type_error' => '',
					'general_error' => ''
				), 		
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);

			//Set form rules
			$config = array(
				array(
						'field' => 'level_id',
						'label' => strtolower($this->lang->line('label_ranking_name')),
						'rules' => 'trim|required',
						'errors' => array(
								'required' => $this->lang->line('error_enter_ranking_number')
						)
				),
				array(
						'field' => 'upgrade_type',
						'label' => strtolower($this->lang->line('label_type')),
						'rules' => 'trim|required',
						'errors' => array(
							'required' => $this->lang->line('error_select_type'),
						)
				),
				array(
						'field' => 'downgrade_type',
						'label' => strtolower($this->lang->line('label_type')),
						'rules' => 'trim|required',
						'errors' => array(
							'required' => $this->lang->line('error_select_type'),
						)
				),
				array(
					'field' => 'maintain_membership_limit',
					'label' => strtolower($this->lang->line('label_maintain_membership_limit')),
					'rules' => 'trim|required|integer',
					'errors' => array(
						'required' => $this->lang->line('error_only_digits_allowed'),
						'integer' => $this->lang->line('error_only_digits_allowed')
					)
				),
				/*
				array(
					'field' => 'calculate_type',
					'label' => strtolower($this->lang->line('label_calculate_type')),
					'rules' => 'trim|required',
					'errors' => array(
						'required' => $this->lang->line('error_select_calculate_type'),
					)
				),
				*/
			);		
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			//Form validation
			if ($this->form_validation->run() == TRUE)
			{
				$level_id = trim($this->input->post('level_id', TRUE));
				$oldData = $this->level_model->get_level_data_by_id($level_id);
				$oldLangData = $this->level_model->get_level_lang_data($level_id);
				$oldData['lang'] = json_encode($oldLangData);
				if( ! empty($oldData))
				{
					$allow_to_update = TRUE;
					$config['upload_path'] = LEVEL_PATH;
					$config['max_size'] = LEVEL_FILE_SIZE;
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['overwrite'] = TRUE;
					
					$this->load->library('upload', $config);
					
					$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
					if(sizeof($lang)>0){
						foreach($lang as $k => $v){
							if(isset($_FILES['web_banner_'.$v]['size']) && $_FILES['web_banner_'.$v]['size'] > 0)
							{
								$new_name = time().rand(1000,9999).".".pathinfo($_FILES["web_banner_".$v]['name'], PATHINFO_EXTENSION);
								$config['file_name']  = $new_name;
								$this->upload->initialize($config);
								if( ! $this->upload->do_upload('web_banner_'.$v)) 
								{
									$json['msg']['general_error'] = $this->lang->line('error_invalid_filetype');
									$allow_to_update = FALSE;
								}else{
									$_FILES["web_banner_".$v]['name'] = $new_name;
								}
							}

							if($allow_to_update == TRUE)
							{
								if(isset($_FILES['mobile_banner_'.$v]['size']) && $_FILES['mobile_banner_'.$v]['size'] > 0)
								{
									$new_name = time().rand(1000,9999).".".pathinfo($_FILES["mobile_banner_".$v]['name'], PATHINFO_EXTENSION);
									$config['file_name'] = $new_name;
									$this->upload->initialize($config);
									if( ! $this->upload->do_upload('mobile_banner_'.$v)) 
									{
										$json['msg']['general_error'] = $this->lang->line('error_invalid_filetype');
										$allow_to_update = FALSE;
									}
									else{
										$_FILES["mobile_banner_".$v]['name'] = $new_name;
									}
								}
							}
						}
					}
					if($allow_to_update == TRUE)
					{
						//Database update
						$this->db->trans_start();
						$newData = $this->level_model->update_level($level_id);
						$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
						if(sizeof($lang)>0){
							$oldDataLang = $this->level_model->get_level_lang_data($newData['level_id']);
							foreach($lang as $k => $v){
								if(isset($oldDataLang[$v])){
									$this->level_model->update_level_content($newData['level_id'],$v);
								}else{
									$this->level_model->add_level_content($newData['level_id'],$v);
								}
							}
						}
						$newDataLang = $this->level_model->get_level_lang_data($newData['level_id']);
						$newData['lang'] = $newDataLang;
						if($this->session->userdata('user_group') == USER_GROUP_USER) 
						{
							$this->user_model->insert_log(LOG_LEVEL_UPDATE, $newData, $oldData);
						}
						else
						{
							$this->account_model->insert_log(LOG_LEVEL_UPDATE, $newData, $oldData);
						}
						$this->db->trans_complete();
						if ($this->db->trans_status() === TRUE)
						{
							$json['status'] = EXIT_SUCCESS;
							$json['msg'] = $this->lang->line('success_updated');
							
							//Prepare for ajax update
							$json['response'] = array(
								'id' => $newData['level_id'],
								'updated_by' => $newData['updated_by'],
								'updated_date' => date('Y-m-d H:i:s', $newData['updated_date']),
							);
						}
						else
						{
							$json['msg']['general_error'] = $this->lang->line('error_failed_to_update');
						}
					}else{
						$json['msg']['general_error'] = $this->lang->line('error_failed_to_update');
					}
				}else{
					$json['msg']['general_error'] = $this->lang->line('error_failed_to_update');
				}
			}else{
				$json['msg']['general_error'] = form_error('level_id');
				$json['msg']['upgrade_type_error'] = form_error('upgrade_type');
				$json['msg']['downgrade_type_error'] = form_error('downgrade_type');
				$json['msg']['maintain_membership_limit'] = form_error('maintain_membership_limit');
				$json['msg']['calculate_type_error'] = form_error('calculate_type');
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

	public function delete(){
		//Initial output data
		$json = array(
			'status' => EXIT_ERROR, 
			'msg' => ''
		);
		if(permission_validation(PERMISSION_LEVEL_DELETE) == TRUE)
		{
			$level_id = $this->uri->segment(3);
			$oldData = $this->level_model->get_level_data_by_id($level_id);
			$oldLangData = $this->level_model->get_level_lang_data($level_id);
			$newData = $this->level_model->get_default_level_data();
			$oldData['lang'] = json_encode($oldLangData);
			if(!empty($oldData) && ($oldData['level_default']!=STATUS_YES))
			{
				//Database update
				$this->db->trans_start();
				$this->level_model->delete_level($level_id);
				$this->level_model->delete_level_lang($level_id);
				$this->level_model->delete_level_log_by_level_id($level_id);

				if($this->session->userdata('user_group') == USER_GROUP_USER) 
				{
					$this->user_model->insert_log(LOG_LEVEL_DELETE, $oldData);
				}
				else
				{
					$this->account_model->insert_log(LOG_LEVEL_DELETE, $oldData);
				}
				$this->db->trans_complete();
				if ($this->db->trans_status() === TRUE)
				{
					$json['status'] = EXIT_SUCCESS;
					$json['msg'] = $this->lang->line('success_deleted');
				}
				else
				{
					$json['msg'] = $this->lang->line('error_failed_to_delete');
				}
			}
			else
			{
				$json['msg'] = $this->lang->line('error_failed_to_delete');
			}	
			//Output
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();
		}else{
			redirect('home');
		}
	}

	public function level_execute_submit(){
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_ADD) == TRUE)
		{
			//Initial output data
			$json = array(
				'status' => EXIT_ERROR, 
				'msg' => array(
					'from_date_error' => '',
					'to_date_error' => '',
					'remark_error' => '',
					'general_error' => '',
				), 		
				'csrfTokenName' => $this->security->get_csrf_token_name(), 
				'csrfHash' => $this->security->get_csrf_hash()
			);

			$config = array(
				array(
						'field' => 'from_date',
						'label' => strtolower($this->lang->line('label_from_date')),
						'rules' => 'trim|required|callback_date_check',
						'errors' => array(
							'required' => $this->lang->line('error_invalid_date_format'),
							'date_check' => $this->lang->line('error_invalid_date_format')
					)
				),
				array(
						'field' => 'to_date',
						'label' => strtolower($this->lang->line('label_to_date')),
						'rules' => 'trim|required|callback_date_check',
						'errors' => array(
							'required' => $this->lang->line('error_invalid_date_format'),
							'date_check' => $this->lang->line('error_invalid_date_format')
					)
				),
				array(
						'field' => 'remark',
						'label' => strtolower($this->lang->line('label_remark')),
						'rules' => 'trim|required|min_length[1]|max_length[128]',
						'errors' => array(
							'required' => $this->lang->line('error_enter_remark'),
							'min_length' => $this->lang->line('error_enter_remark'),
							'max_length' => $this->lang->line('error_enter_remark'),
					)
				)
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('', '');
			//Form validation
			if ($this->form_validation->run() == TRUE)
			{
				$promotion_code = 'LE';
				$promotion_data = $this->level_model->get_admin_promotion_by_genre_code($promotion_code);
				if(!empty($promotion_data)){
					if(sizeof($promotion_data) == 1){
						$calculation_data = $promotion_data[0];
						$start_date	= $this->input->post('from_date', TRUE).' 00:00:00';
						$end_date	= $this->input->post('to_date', TRUE).' 23:59:59';
						$dbprefix = $this->db->dbprefix;
						$profit_array = array();
						$deposit_array = array();
						$start_time = strtotime($start_date); 
						$end_time = strtotime($end_date);
						$playerDBdata = array();
						$player_new_ranking = array();
						$schedule_data = $this->cron_model->add_schedule($start_time,$end_time);
						if(!empty($schedule_data)){
							$last_player_id = 1000000000;
							$last_level_id = 1000000000;
							//Prepare member list
							$player_lists = array();
							$level_lists = array();

							$player_query = $this->db->query("SELECT player_id FROM {$dbprefix}players ORDER BY player_id DESC LIMIT 1");
							if($player_query->num_rows() > 0) {
								$player_row = $player_query->row();
								$last_player_id = $player_row->player_id;
							}
							$player_query->free_result();

							$level_query = $this->db->query("SELECT level_id FROM {$dbprefix}level ORDER BY level_id DESC LIMIT 1");
							if($level_query->num_rows() > 0) {
								$level_row = $level_query->row();
								$last_level_id = $level_row->level_id;
							}
							$level_query->free_result();

							$player_query = $this->db->query("SELECT player_id, username, points, level_id, level_ids, level_maintain FROM {$dbprefix}players WHERE player_id <= ? ORDER BY player_id ASC", array($last_player_id));
							if($player_query->num_rows() > 0) {
								foreach($player_query->result() as $player_row) {
									$player_lists[$player_row->player_id] = array(
										'player_id' => $player_row->player_id,
										'username' => $player_row->username,
										'level_id' => (!empty($player_row->level_id) ? $player_row->level_id : 0),
										'level_ids' => $player_row->level_ids,
										'level_maintain' => (!empty($player_row->level_maintain) ? $player_row->level_maintain : 0),
										'next_level_id' => 0,
										'points' => $player_row->points,
										'deposit_amount' => 0,
										'game_provider_code' => "",
										'game_type_code' => "",
										'amount' => 0,
										'group_data' => array(),
										'is_calculate' => false,
										'is_maintain' => STATUS_NO,
										'movement' => false,
									);
								}
							}
							$player_query->free_result();

							$level_query = $this->db->query("SELECT level_id, level_number, upgrade_type, level_deposit_amount_from, level_deposit_amount_to, level_target_amount_from, level_target_amount_to, downgrade_type, maintain_membership_limit, maintain_membership_deposit_amount, maintain_membership_target_amount FROM {$dbprefix}level WHERE level_id <= ? ORDER BY level_number ASC", array($last_level_id));
							if($level_query->num_rows() > 0) {
								foreach($level_query->result() as $level_row) {
									$level_lists[$level_row->level_number] = array(
										'level_id' => $level_row->level_id,
										'level_number' => $level_row->level_number,
										'upgrade_type' => $level_row->upgrade_type,
										'level_deposit_amount_from' => $level_row->level_deposit_amount_from,
										'level_deposit_amount_to' => $level_row->level_deposit_amount_to,
										'level_target_amount_from' => $level_row->level_target_amount_from,
										'level_target_amount_to' => $level_row->level_target_amount_to,
										'downgrade_type' => $level_row->downgrade_type,
										'maintain_membership_limit' => $level_row->maintain_membership_limit,
										'maintain_membership_deposit_amount' => $level_row->maintain_membership_deposit_amount,
										'maintain_membership_target_amount' => $level_row->maintain_membership_target_amount,
									);
								}
							}
							$level_query->free_result();

							$deposit_query = $this
								->db
								->select_sum('deposit_amount')
								->select('player_id')
								->where('total_win_loss_report.report_date >= ', $start_time)
								->where('total_win_loss_report.report_date <= ', $end_time)
								->group_by('total_win_loss_report.player_id')
								->get('total_win_loss_report');
							if($deposit_query->num_rows() > 0)
							{
								$deposit_array = $deposit_query->result_array();
							}
							$deposit_query->free_result();

							if($deposit_array > 0){
								foreach($deposit_array as $deposit_array_row){
									if(!empty($deposit_array_row['deposit_amount'])){
										$player_lists[$deposit_array_row['player_id']]['deposit_amount'] = $deposit_array_row['deposit_amount'];
									}
								}	
							}
							
							$profit_array = $this->cron_model->get_total_amount_level($calculation_data,$start_time,$end_time,GAME_ALL);
							$profit_lc_array = $this->cron_model->get_total_amount_level($calculation_data,$start_time,$end_time,GAME_LIVE_CASINO);
							
							//Summarise all data;
							if(sizeof($profit_array) > 0){
								foreach($profit_array as $profit_array_row){
									if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_provider_code']] += $profit_array_row['current_amount']; 
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_GAME){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_type_code']] += $profit_array_row['current_amount'];
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER_SAME_GAME){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_provider_code']][$profit_array_row['game_type_code']] += $profit_array_row['current_amount'];
									}else{
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][0] += $profit_array_row['current_amount'];
										$player_lists[$profit_array_row['player_id']]['amount'] += $profit_array_row['current_amount'];
									}
								}
							}

							//Summarise live casino data;
							if(sizeof($profit_lc_array) > 0){
								foreach($profit_lc_array as $profit_array_row){
									if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_provider_code']] += $profit_array_row['current_amount']; 
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_GAME){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_type_code']] += $profit_array_row['current_amount'];
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER_SAME_GAME){
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][$profit_array_row['game_provider_code']][$profit_array_row['game_type_code']] += $profit_array_row['current_amount'];
									}else{
										$player_lists[$profit_array_row['player_id']]['is_calculate'] = true;
										$player_lists[$profit_array_row['player_id']]['group_data'][0] += $profit_array_row['current_amount'];
										$player_lists[$profit_array_row['player_id']]['amount'] += $profit_array_row['current_amount'];
									}
								}
							}


							foreach($player_lists as $player_lists_row){
								$level = 0;
								if($player_lists_row['is_calculate']){
									//ad($player_lists_row);
									if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER){
										if(sizeof($player_lists[$player_lists_row['player_id']]['group_data']) > 0){
											foreach($player_lists[$player_lists_row['player_id']]['group_data'] as $key => $value){
												if($value > $player_lists[$player_lists_row['player_id']]['amount']){
													$player_lists[$player_lists_row['player_id']]['game_provider_code'] = $key;
													$player_lists[$player_lists_row['player_id']]['game_type_code'] = 0;
													$player_lists[$player_lists_row['player_id']]['amount'] = $value;
												}
											}
										}
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_GAME){
										if(sizeof($player_lists[$player_lists_row['player_id']]['group_data']) > 0){
											foreach($player_lists[$player_lists_row['player_id']]['group_data'] as $key => $value){
												if($value > $player_lists[$player_lists_row['player_id']]['amount']){
													$player_lists[$player_lists_row['player_id']]['game_provider_code'] = 0;
													$player_lists[$player_lists_row['player_id']]['game_type_code'] = $key;
													$player_lists[$player_lists_row['player_id']]['amount'] = $value;
												}
											}
										}
									}else if($calculation_data['target_type'] == LEVEL_TARGET_SAME_PROVIDER_SAME_GAME){
										if(sizeof($player_lists[$player_lists_row['player_id']]['group_data']) > 0){
											foreach($player_lists[$player_lists_row['player_id']]['group_data'] as $game_provider => $game_provider_game_type_data){
												if(sizeof($game_provider_game_type_data) > 0){
													foreach($game_provider_game_type_data as $game_provider_game_type => $value){
														if($value > $player_lists[$player_lists_row['player_id']]['amount']){
															$player_lists[$player_lists_row['player_id']]['game_provider_code'] = $game_provider;
															$player_lists[$player_lists_row['player_id']]['game_type_code'] = $game_provider_game_type;
															$player_lists[$player_lists_row['player_id']]['amount'] = $value;
														}
													}
												}
											}
										}
									}else{
										
									}
								}
							}

							//setting current player level
							if(!empty($level_lists) && sizeof($level_lists) > 0){
								if(!empty($player_lists) && sizeof($player_lists)>0){
									foreach($player_lists as $player_lists_row){
										if($player_lists_row['is_calculate']){
											foreach($level_lists as $level_lists_row){
												if($level_lists_row['upgrade_type'] == LEVEL_UPGRADE_DEPOSIT){
													if($player_lists_row['deposit_amount'] >= $level_lists_row['level_deposit_amount_from']){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $level_lists_row['level_number'];
													}
												}else if($level_lists_row['upgrade_type'] == LEVEL_UPGRADE_TARGET){
													if($player_lists_row['amount'] >= $level_lists_row['level_target_amount_from']){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $level_lists_row['level_number'];
													}
												}else{
													if(($player_lists_row['deposit_amount'] >= $level_lists_row['level_deposit_amount_from']) && ($player_lists_row['amount'] >= $level_lists_row['level_target_amount_from'])){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $level_lists_row['level_number'];
													}
												}
											}
										}
									}
								}
							}

							//decision either upgreade or downgrade or mantain
							//echo "decision upgrade or downgrade";
							if(!empty($player_lists) && sizeof($player_lists)>0){
								foreach($player_lists as $player_lists_row){
									if($player_lists_row['is_calculate']){
										if($player_lists[$player_lists_row['player_id']]['next_level_id'] > $player_lists[$player_lists_row['player_id']]['level_id']){
											$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_UP;
										}else if($player_lists[$player_lists_row['player_id']]['next_level_id'] == $player_lists[$player_lists_row['player_id']]['level_id']){
											$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
										}else{
											if(isset($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']])){
												if($level_lists[$player_lists_row['level_id']]['downgrade_type'] == LEVEL_DOWNGRADE_DEPOSIT){
													if($player_lists_row['deposit_amount'] >= $level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_deposit_amount']){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
													}else{
														if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
															$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
															$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
														}else{
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
														}
													}
												}else if($level_lists[$player_lists_row['level_id']]['downgrade_type'] == LEVEL_DOWNGRADE_TARGET){
													if($player_lists_row['amount'] >= $level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_target_amount']){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
													}else{
														if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
															$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
															$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
														}else{
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
														}
													}
												}else{
													if(($player_lists_row['deposit_amount'] >= $level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_deposit_amount']) && ($player_lists_row['amount'] >= $level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_target_amount'])){
														$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
													}else{
														if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
															$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
															$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
														}else{
															$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
														}
													}
												}
											}
										}
									}else{
										if($player_lists[$player_lists_row['player_id']]['level_id'] > 2){
											$player_lists[$player_lists_row['player_id']]['next_level_id'] = 2;
										}

										if(isset($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']])){
											if($level_lists[$player_lists_row['level_id']]['downgrade_type'] == LEVEL_DOWNGRADE_DEPOSIT){
												if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
													$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
													$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
													$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
												}else{
													if($player_lists[$player_lists_row['player_id']]['level_id'] == $player_lists[$player_lists_row['player_id']]['next_level_id']){
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;	
													}else{
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
													}
												}
											}else if($level_lists[$player_lists_row['level_id']]['downgrade_type'] == LEVEL_DOWNGRADE_TARGET){
												if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
													$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
													$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
													$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
												}else{
													if($player_lists[$player_lists_row['player_id']]['level_id'] == $player_lists[$player_lists_row['player_id']]['next_level_id']){
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;	
													}else{
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
													}
												}
											}else{
												if($level_lists[$player_lists[$player_lists_row['player_id']]['level_id']]['maintain_membership_limit'] >= ($player_lists[$player_lists_row['player_id']]['level_maintain']+1)){
													$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'];
													$player_lists[$player_lists_row['player_id']]['is_maintain'] = STATUS_YES;
													$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;
												}else{
													if($player_lists[$player_lists_row['player_id']]['level_id'] == $player_lists[$player_lists_row['player_id']]['next_level_id']){
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_NONE;	
													}else{
														$player_lists[$player_lists_row['player_id']]['movement'] = LEVEL_MOVEMENT_DOWN;
													}
												}
											}
										}
									}
									
									if($player_lists[$player_lists_row['player_id']]['movement'] == LEVEL_MOVEMENT_DOWN){
										if($player_lists[$player_lists_row['player_id']]['level_id'] > 2){
											$player_lists[$player_lists_row['player_id']]['next_level_id'] = $player_lists[$player_lists_row['player_id']]['level_id'] -1;
										}
									}
								}
							}

							if(!empty($player_lists) && sizeof($player_lists)>0){
								foreach($player_lists as $player_lists_row){
									if($player_lists_row['next_level_id'] != 0){
										$playerDBdataRow = array(
											'schedule_id' => $schedule_data['schedule_id'],
											'player_id' => $player_lists_row['player_id'],
											'username' => $player_lists_row['username'],
											'game_provider_code' => $player_lists_row['game_provider_code'],
											'game_type_code' => $player_lists_row['game_type_code'],
											'schedule_start' => $start_time,
											'schedule_end' => $end_time,
											'accumulate_deposit' => $player_lists_row['deposit_amount'],
											'accumulate_target' => $player_lists_row['amount'],
											'player_rating_old' => 0,
											'player_rating_old_number' => $player_lists_row['level_id'],
											'player_rating_new' => 0,
											'player_rating_new_number' => $player_lists_row['next_level_id'],
											'is_maintain' => $player_lists_row['is_maintain'],
											'movement' => $player_lists_row['movement'],
											'status' => STATUS_PENDING,
										);

										array_push($playerDBdata, $playerDBdataRow);
									}
								}
							}

							if(!empty($playerDBdata)){
								$this->db->insert_batch('level_log', $playerDBdata);
							}
						}

						if($this->session->userdata('user_group') == USER_GROUP_USER) 
						{
							$this->user_model->insert_log(LOG_LEVEL_EXECUTE_ADD, $schedule_data);
						}
						else
						{
							$this->account_model->insert_log(LOG_LEVEL_EXECUTE_ADD, $schedule_data);
						}

						$json['status'] = EXIT_SUCCESS;
						$json['msg'] = $this->lang->line('success_added');
					}else{
						$json['msg'] = $this->lang->line('error_failed_to_add');
					}
				}
				else{
					$json['msg']['general_error'] = $this->lang->line('error_promotion_not_available');
				}
			}
			else 
			{
				$json['msg']['from_date_error'] = form_error('from_date');
				$json['msg']['to_date_error'] = form_error('to_date');
				$json['msg']['remark_error'] = form_error('remark');
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
	
	public function level_execute(){
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_VIEW) == TRUE)
		{
			$this->save_current_url('level');
			$data = quick_search();
			$data['page_title'] = $this->lang->line('title_ranking_execute');
			$this->load->view('level_execute_view', $data);
		}
		else
		{
			redirect('home');
		}
	}

	public function level_execute_search()
	{
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_VIEW) == TRUE)
		{
			//Initial output data
			$json = array(
					'status' => EXIT_ERROR, 
					'msg' => '',
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
									'to_date' => trim($this->input->post('to_date', TRUE))
								);
					
					$this->session->set_userdata('search_level_execute', $data);
					
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

	public function level_execute_listing(){
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_VIEW) == TRUE)
		{
			$limit = trim($this->input->post('length', TRUE));
			$start = trim($this->input->post("start", TRUE));
			$order = $this->input->post("order", TRUE);

			//Table Columns
			$columns = array( 
				0 => 'schedule_id',
				1 => 'schedule_start',
				2 => 'schedule_end',
				3 => 'status',
				4 => 'updated_by',
				5 => 'updated_date',
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

			$arr = $this->session->userdata('search_level_execute');
			$where = '';
			/*
			if( ! empty($arr['from_date']) &&  ! empty($arr['to_date']))
			{
				$where .= 'WHERE schedule_start >= ' . strtotime($arr['from_date']);
				$where .= ' AND schedule_end >= ' . strtotime($arr['to_date']);
			}
			*/

			$select = implode(',', $columns);
			$dbprefix = $this->db->dbprefix;
			$posts = NULL;

			$query_string = "SELECT {$select} FROM {$dbprefix}level_schedule $where";
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
			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$level_up_count = $this->level_model->get_level_movement($post->schedule_id,LEVEL_MOVEMENT_UP);
					$level_down_count = $this->level_model->get_level_movement($post->schedule_id,LEVEL_MOVEMENT_DOWN);
					$level_pending = $this->level_model->get_level_status($post->schedule_id,STATUS_PENDING);
					$level_approve = $this->level_model->get_level_status($post->schedule_id,STATUS_APPROVE);
					$level_reject = $this->level_model->get_level_status($post->schedule_id,STATUS_CANCEL);
					$row = array();
					$row[] = $post->schedule_id;
					$row[] = (($post->schedule_start > 0) ? date('Y-m-d H:i:s', $post->schedule_start) : '-');
					$row[] = (($post->schedule_end > 0) ? date('Y-m-d H:i:s', $post->schedule_end) : '-');
					$row[] = $level_up_count;
					$row[] = $level_down_count;
					$row[] = $level_pending;
					$row[] = $level_approve;
					$row[] = $level_reject;
					switch($post->status)
					{
						case STATUS_APPROVE: $row[] = '<span class="badge bg-success" id="uc1_' . $post->schedule_id . '">' . $this->lang->line('status_approved') . '</span>'; break;
						case STATUS_CANCEL: $row[] = '<span class="badge bg-danger" id="uc1_' . $post->schedule_id . '">' . $this->lang->line('status_cancelled') . '</span>'; break;
						default: $row[] = '<span class="badge bg-secondary" id="uc1_' . $post->schedule_id . '">' . $this->lang->line('status_pending') . '</span>'; break;
					}
					$row[] = '<span id="uc2_' . $post->schedule_id . '">' . ( ! empty($post->remark) ? $post->remark : '-') . '</span>';
					$row[] = '<span id="uc3_' . $post->schedule_id . '">' . (( ! empty($post->updated_by)) ? $post->updated_by : '-') . '</span>';
					$row[] = '<span id="uc4_' . $post->schedule_id . '">' . (($post->updated_date > 0) ? date('Y-m-d H:i:s', $post->updated_date) : '-') . '</span>';
					
					$button = '';
					
					if(permission_validation(PERMISSION_LEVEL_EXECUTE_UPDATE) == TRUE)
					{
						if($post->status == STATUS_PENDING){
							$button .= '<i onclick="approveData(' . $post->schedule_id . ')" class="fas fa-check nav-icon text-success" title="' . $this->lang->line('button_approve')  . '"></i> &nbsp;&nbsp; ';
						}
					}
					if(permission_validation(PERMISSION_LEVEL_LOG_VIEW) == TRUE)
					{
						$button .= '<i onclick="viewLogData(' . $post->schedule_id . ')" class="fas fa-clipboard-list nav-icon text-info" title="' . $this->lang->line('button_log')  . '"></i> &nbsp;&nbsp; ';
					}
					if(permission_validation(PERMISSION_LEVEL_EXECUTE_UPDATE) == TRUE || permission_validation(PERMISSION_LEVEL_LOG_VIEW) == TRUE){
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
		else
		{
			redirect('home');
		}
	}

	public function level_execute_approve(){
		$json = array(
			'status' => EXIT_ERROR, 
			'msg' => ''
		);
					
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_UPDATE) == TRUE)
		{
			$schedule_id = $this->uri->segment(3);
			$promotion_code = 'LE';
			$dbprefix = $this->db->dbprefix;
			$oldDataSchedule = $this->level_model->get_schedule_data($schedule_id);
			$level_data =  $this->level_model->get_level_data();
			$promotion_data = $this->level_model->get_admin_promotion_by_genre_code($promotion_code);
			$log_id = 0;
			if(!empty($promotion_data)){
				if(sizeof($promotion_data) == 1){
					$calculation_data = $promotion_data[0];
					if( ! empty($oldDataSchedule) && !empty($level_data) && !empty($calculation_data) && ($oldDataSchedule['status'] == STATUS_PENDING))
					{
						$allData = $this->level_model->get_all_level_log_pending_data($schedule_id);
						if(!empty($allData)){
							$last_player_id = 1000000000;

							$player_query = $this->db->query("SELECT player_id FROM {$dbprefix}players ORDER BY player_id DESC LIMIT 1");
							if($player_query->num_rows() > 0) {
								$player_row = $player_query->row();
								$last_player_id = $player_row->player_id;
							}
							$player_query->free_result();

							$player_query = $this->db->query("SELECT player_id, username, points, level_ids FROM {$dbprefix}players WHERE player_id <= ? ORDER BY player_id ASC", array($last_player_id));
							if($player_query->num_rows() > 0) {
								foreach($player_query->result() as $player_row) {
									$player_lists[$player_row->player_id] = array(
										'player_id' => $player_row->player_id,
										'username' => $player_row->username,
										'level_ids' => $player_row->level_ids,
										'points' => $player_row->points,
									);
								}
							}

							foreach($allData as $oldData){
								if(isset($level_data[$oldData['player_rating_new_number']])){
									$log_id = $oldData['log_id'];
									$player_data = $player_lists[$oldData['player_id']];
									$new_level_data = $level_data[$oldData['player_rating_new_number']];
									
									if($oldData['movement'] == LEVEL_MOVEMENT_DOWN){
										$this->db->trans_start();
										$this->level_model->update_player_ranking($oldData);
										$this->level_model->reset_player_level_maintain($oldData);
										$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
										$this->db->trans_complete();
									}else if($oldData['movement'] == LEVEL_MOVEMENT_UP){
										$previous_level_reward_array = array_values(array_filter(explode(',',$player_data['level_ids'])));
										$reward_amount = $new_level_data['level_reward_amount'];
										$player_data['amount'] = bcdiv($reward_amount,1,2);
										$this->db->trans_start();
										if( ! in_array($new_level_data['level_number'], $previous_level_reward_array))
				        				{
				        					//reward
				        					//no reward
				        					$player_data['amount'] = bcdiv($reward_amount,1,2);
				        					if($player_data['amount'] > 0){
				        						if($calculation_data['reward_on_apply'] == STATUS_INACTIVE){
													$this->level_model->add_lvling_player_promotion($player_data,$calculation_data,$player_data['amount'],STATUS_PENDING,$new_level_data['level_number']);
												}else{
													$array = array(
														'promotion_name' => $calculation_data['promotion_name'],
														'remark' => $this->input->post('remark', TRUE),
													);

													$this->player_model->update_player_wallet($player_data);
													$this->level_model->add_lvling_player_promotion($player_data,$calculation_data,$player_data['amount'],STATUS_APPROVE,$new_level_data['level_number']);
													$this->general_model->insert_cash_transfer_report($player_data, $player_data['amount'], TRANSFER_PROMOTION,$array);


													$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_PROMOTION_LEVEL);
													if(!empty($system_message_data)){
														$system_message_id = $system_message_data['system_message_id']; 
														$oldLangData = $this->message_model->get_message_lang_data($system_message_id);
														$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
														$create_time = time();
														$username = $player_data['username'];
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
																				$reward = $player_data['amount'];

																				$replace_string_array = array(
																					SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
																					SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
																					SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD => $reward,
																					SYSTEM_MESSAGE_PLATFORM_VALUE_LEVEL => $new_level_data['level_number'] -1,
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
				        					$this->level_model->update_player_ranking($oldData);
				        					$this->level_model->reset_player_level_maintain($oldData);
				        					$this->level_model->update_player_ranking_ids($player_data,$oldData);
				        					$this->level_model->update_level_log($log_id,$reward_amount,STATUS_APPROVE);
				        				}else{
				        					//no reward
				        					$this->level_model->update_player_ranking($oldData);
				        					$this->level_model->reset_player_level_maintain($oldData);
				        					$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
				        				}
				        				$this->db->trans_complete();
									}else{
										//LEVEL_MOVEMENT_NONE
										$this->db->trans_start();
										if($oldData['is_maintain']){
											$this->level_model->increase_player_level_maintain($oldData);
										}else{
											$this->level_model->reset_player_level_maintain($oldData);
										}
										$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
										$this->db->trans_complete();
									}
								}
							}
						}
						$this->level_model->update_schedule_status($oldDataSchedule,STATUS_APPROVE);
						$this->level_model->update_all_level_log($schedule_id,STATUS_APPROVE);
						$newData = $this->level_model->get_schedule_data($schedule_id);
						if($this->session->userdata('user_group') == USER_GROUP_USER) 
						{
							$this->user_model->insert_log(LOG_LEVEL_UPDATE, $newData, $oldDataSchedule);
						}
						else
						{
							$this->account_model->insert_log(LOG_LEVEL_UPDATE, $newData, $oldDataSchedule);
						}
						$this->db->trans_complete();
						if ($this->db->trans_status() === TRUE)
						{
							$json['status'] = EXIT_SUCCESS;
							$json['msg'] = $this->lang->line('success_approve');
						}
						else
						{
							$json['msg'] = $this->lang->line('error_failed_to_approve');
						}
					}
					else
					{
						$json['msg'] = $this->lang->line('error_failed_to_approve');
					}	
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
		else
		{
			redirect('home');
		}
	}

	public function level_log(){
		if(permission_validation(PERMISSION_LEVEL_LOG_VIEW) == TRUE)
		{
			$schedule_id = $this->uri->segment(3);
			$oldData = $this->level_model->get_schedule_data($schedule_id);
			if(!empty($oldData)){
				$this->session->unset_userdata('search_level_log');
				$data = array( 
					'schedule_id' => $schedule_id,
				);
				$this->session->set_userdata('search_level_log', $data);
				$this->load->view('level_log_view', $data);
			}else{
				redirect('home');
			}
		}else{
    		redirect('home');
    	}
	}

	public function level_log_listing(){
		if(permission_validation(PERMISSION_LEVEL_LOG_VIEW) == TRUE)
		{
			$arr = $this->session->userdata('search_level_log');
			if(!empty($arr)){
				$limit = trim($this->input->post('length', TRUE));
				$start = trim($this->input->post("start", TRUE));
				$order = $this->input->post("order", TRUE);
				$columns = array( 
					0 => 'log_id',
					1 => 'username',
					2 => 'schedule_start',
					3 => 'schedule_end',
					4 => 'accumulate_deposit',
					5 => 'game_provider_code',
					6 => 'game_type_code',
					7 => 'accumulate_target',
					8 => 'player_rating_old_number',
					9 => 'player_rating_new_number',
					10 => 'movement',
					11 => 'status',
					12 => 'updated_by',
					13 => 'updated_date',
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
				$where = 'WHERE movement != '.LEVEL_MOVEMENT_NONE;
				if( ! empty($arr['schedule_id']))
				{
					$where .= ' AND schedule_id = ' . $arr['schedule_id'];
				}
				$select = implode(',', $columns);
				$dbprefix = $this->db->dbprefix;
				$posts = NULL;
				$query_string = "SELECT {$select} FROM {$dbprefix}level_log $where";
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
					$level_lists = array();
					$level_query = $this->db->query("SELECT level_number,level_name FROM {$dbprefix}level WHERE level_id <= ? ORDER BY level_number ASC", array(10000));
					if($level_query->num_rows() > 0) {
						foreach($level_query->result() as $level_row) {
							$level_lists[$level_row->level_number] = $level_row->level_name;
						}
					}
					$level_query->free_result();

					foreach ($posts as $post)
					{
						$row = array();
						$row[] = $post->log_id;
						$row[] = $post->username;
						$row[] = (($post->schedule_start > 0) ? date('Y-m-d H:i:s', $post->schedule_start) : '-');
						$row[] = (($post->schedule_end > 0) ? date('Y-m-d H:i:s', $post->schedule_end) : '-');
						$row[] = $post->accumulate_deposit;
						$row[] = ((!empty($post->game_provider_code)) ? $this->lang->line('game_'.strtolower($post->game_provider_code)) : $this->lang->line('label_all_provider'));
						$row[] = ((!empty($post->game_type_code)) ? $this->lang->line('game_type_'.strtolower($post->game_type_code)) : $this->lang->line('label_all_game'));
						$row[] = $post->accumulate_target;
						$row[] = (isset($level_lists[$post->player_rating_old_number]) ? $level_lists[$post->player_rating_old_number] : $post->player_rating_old_number);
						$row[] = (isset($level_lists[$post->player_rating_new_number]) ? $level_lists[$post->player_rating_new_number] : $post->player_rating_new_number);
						switch($post->movement)
						{
							case LEVEL_MOVEMENT_UP: $row[] = '<i class="fas fa-caret-up nav-icon text-success"></i>';break;
							case LEVEL_MOVEMENT_DOWN: $row[] = '<i class="fas fa-caret-down nav-icon text-danger"></i>';break;
							default: $row[] = $row[] = '<i class="fas fa-exchange-alt nav-icon text-primary"></i>'; break;
						}
						switch($post->status)
						{
							case STATUS_APPROVE: $row[] = '<span class="badge bg-success" id="uc1_' . $post->log_id . '">' . $this->lang->line('status_approved') . '</span>'; break;
							case STATUS_CANCEL: $row[] = '<span class="badge bg-danger" id="uc1_' . $post->log_id . '">' . $this->lang->line('status_cancelled') . '</span>'; break;
							default: $row[] = '<span class="badge bg-secondary" id="uc1_' . $post->log_id . '">' . $this->lang->line('status_pending') . '</span>'; break;
						}
						$row[] = (($post->updated_date > 0) ? date('Y-m-d H:i:s', $post->updated_date) : '-');
						$row[] = ((!empty($post->updated_by)) ? $post->updated_by : '-');
						$button = '';
						if(permission_validation(PERMISSION_LEVEL_LOG_UPDATE) == TRUE)
						{
							if($post->status == STATUS_PENDING){
								$button .= '<i onclick="approveData(' . $post->log_id . ')" class="fas fa-check nav-icon text-success" title="' . $this->lang->line('button_approve')  . '"></i> &nbsp;&nbsp; ';
								$button .= '<i onclick="rejectData(' . $post->log_id . ')" class="fas fa-times nav-icon text-danger" title="' . $this->lang->line('button_reject')  . '"></i> &nbsp;&nbsp; ';
							}
						}

						if(permission_validation(PERMISSION_LEVEL_LOG_UPDATE) == TRUE)
						{
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
	}

	public function level_log_approve(){
		$json = array(
			'status' => EXIT_ERROR, 
			'msg' => ''
		);
					
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_UPDATE) == TRUE)
		{
			$log_id = $this->uri->segment(3);
			$promotion_code = 'LE';
			$oldData = $this->level_model->get_schedule_log_data($log_id);
			$level_data =  $this->level_model->get_level_data();
			$promotion_data = $this->level_model->get_admin_promotion_by_genre_code($promotion_code);
			if(!empty($promotion_data)){
				if(sizeof($promotion_data) == 1){
					$calculation_data = $promotion_data[0];
					if( ! empty($oldData) && !empty($level_data) && !empty($calculation_data) && ($oldData['status'] == STATUS_PENDING) && ($oldData['movement'] == LEVEL_MOVEMENT_DOWN || $oldData['movement'] == LEVEL_MOVEMENT_UP || $oldData['movement'] == LEVEL_MOVEMENT_NONE))
					{
						$player_data = $this->player_model->get_player_data($oldData['player_id']);
						if(!empty($player_data)){
							if(isset($level_data[$oldData['player_rating_new_number']])){
								if($oldData['movement'] == LEVEL_MOVEMENT_DOWN){
									$this->db->trans_start();
									$this->level_model->update_player_ranking($oldData);
									$this->level_model->reset_player_level_maintain($oldData);
									$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
									$newData = $this->level_model->get_schedule_log_data($log_id);
									if($this->session->userdata('user_group') == USER_GROUP_USER) 
									{
										$this->user_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
									else
									{
										$this->account_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
									$this->db->trans_complete();
									if ($this->db->trans_status() === TRUE)
									{
										$json['status'] = EXIT_SUCCESS;
										$json['msg'] = $this->lang->line('success_approve');
									}
									else
									{
										$json['msg'] = $this->lang->line('error_failed_to_approve');
									}
								}else if($oldData['movement'] == LEVEL_MOVEMENT_UP){
									$new_level_data = $level_data[$oldData['player_rating_new_number']];
									$previous_level_reward_array = array_values(array_filter(explode(',',$player_data['level_ids'])));
									$reward_amount = $new_level_data['level_reward_amount'];
									$player_data['amount'] = bcdiv($reward_amount,1,2);
									$this->db->trans_start();
									if( ! in_array($new_level_data['level_number'], $previous_level_reward_array))
			        				{
			        					//reward
			        					//no reward
			        					$player_data['amount'] = bcdiv($reward_amount,1,2);
			        					if($player_data['amount'] > 0){
			        						if($calculation_data['reward_on_apply'] == STATUS_INACTIVE){
												$this->level_model->add_lvling_player_promotion($player_data,$calculation_data,$player_data['amount'],STATUS_PENDING,$new_level_data['level_number']);
											}else{
												$array = array(
													'promotion_name' => $calculation_data['promotion_name'],
													'remark' => $this->input->post('remark', TRUE),
												);
												$this->player_model->update_player_wallet($player_data);
												$this->level_model->add_lvling_player_promotion($player_data,$calculation_data,$player_data['amount'],STATUS_APPROVE,$new_level_data['level_number']);
												$this->general_model->insert_cash_transfer_report($player_data, $player_data['amount'], TRANSFER_PROMOTION,$array);

												$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_PROMOTION_LEVEL);
												if(!empty($system_message_data)){
													$system_message_id = $system_message_data['system_message_id']; 
													$oldLangData = $this->message_model->get_message_lang_data($system_message_id);
													$lang = json_decode(PLAYER_SITE_LANGUAGES, TRUE);
													$create_time = time();
													$username = $player_data['username'];
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
																			$reward = $player_data['amount'];

																			$replace_string_array = array(
																				SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
																				SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
																				SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD => $reward,
																				SYSTEM_MESSAGE_PLATFORM_VALUE_LEVEL => $new_level_data['level_number'] -1,
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
			        					$this->level_model->update_player_ranking($oldData);
			        					$this->level_model->reset_player_level_maintain($oldData);
			        					$this->level_model->update_player_ranking_ids($player_data,$oldData);
			        					$this->level_model->update_level_log($log_id,$reward_amount,STATUS_APPROVE);
			        					$newData = $this->level_model->get_schedule_log_data($log_id);
			        				}else{
			        					//no reward
			        					$this->level_model->update_player_ranking($oldData);
			        					$this->level_model->reset_player_level_maintain($oldData);
			        					$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
			        					$newData = $this->level_model->get_schedule_log_data($log_id);
			        				}
									if($this->session->userdata('user_group') == USER_GROUP_USER) 
									{
										$this->user_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
									else
									{
										$this->account_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
			        				$this->db->trans_complete();
									if ($this->db->trans_status() === TRUE)
									{
										$json['status'] = EXIT_SUCCESS;
										$json['msg'] = $this->lang->line('success_approve');
									}
									else
									{
										$json['msg'] = $this->lang->line('error_failed_to_approve');
									}
								}else{
									//LEVEL_MOVEMENT_NONE
									$this->db->trans_start();
									if($oldData['is_maintain']){
										$this->level_model->increase_player_level_maintain($oldData);
									}else{
										$this->level_model->reset_player_level_maintain($oldData);
									}
									$this->level_model->update_level_log($log_id,0,STATUS_APPROVE);
									$newData = $this->level_model->get_schedule_log_data($log_id);
									if($this->session->userdata('user_group') == USER_GROUP_USER) 
									{
										$this->user_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
									else
									{
										$this->account_model->insert_log(LOG_LEVEL_SINGLE_APPROVE, $newData, $oldData);
									}
									$this->db->trans_complete();
									if ($this->db->trans_status() === TRUE)
									{
										$json['status'] = EXIT_SUCCESS;
										$json['msg'] = $this->lang->line('success_approve');
									}
									else
									{
										$json['msg'] = $this->lang->line('error_failed_to_approve');
									}
								}
							}else{
								$json['msg'] = $this->lang->line('error_failed_to_approve');
							}
						}else{
							$json['msg'] = $this->lang->line('error_failed_to_approve');
						}
					}
					else
					{
						$json['msg'] = $this->lang->line('error_failed_to_approve');
					}
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
		else
		{
			redirect('home');
		}
	}

	public function level_log_reject(){
		$json = array(
			'status' => EXIT_ERROR, 
			'msg' => ''
		);
					
		if(permission_validation(PERMISSION_LEVEL_EXECUTE_UPDATE) == TRUE)
		{
			$log_id = $this->uri->segment(3);
			$oldData = $this->level_model->get_schedule_log_data($log_id);
			if( ! empty($oldData) && ($oldData['status'] == STATUS_PENDING))
			{
				$this->db->trans_start();
				$accumulate_reward = array();
				$this->level_model->update_level_log($log_id,$accumulate_reward,STATUS_CANCEL);
				$newData = $this->level_model->get_schedule_log_data($log_id);
				if($this->session->userdata('user_group') == USER_GROUP_USER) 
				{
					$this->user_model->insert_log(LOG_LEVEL_SINGLE_REJECT, $newData, $oldData);
				}
				else
				{
					$this->account_model->insert_log(LOG_LEVEL_SINGLE_REJECT, $newData, $oldData);
				}
				$this->db->trans_complete();
				if ($this->db->trans_status() === TRUE)
				{
					$json['status'] = EXIT_SUCCESS;
					$json['msg'] = $this->lang->line('success_reject');
				}
				else
				{
					$json['msg'] = $this->lang->line('error_failed_to_reject');
				}
			}
			else
			{
				$json['msg'] = $this->lang->line('error_failed_to_reject');
			}	
			
			//Output
			$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($json))
					->_display();
					
			exit();	
		}
		else
		{
			redirect('home');
		}
	}
}