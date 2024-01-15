<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotioncron extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('promotioncron_model','level_model','cron_model','level_model','player_model','message_model'));
	}
	
	public function promotion_cash_rebate_level(){
	    set_time_limit(0);
		$current_time = strtotime(date('Y-m-d H:i:00'));
		$today_day = date('N',$current_time);
		$today_hour = date('G',$current_time);
		$today_minute = date('i',$current_time);
		$dbprefix = $this->db->dbprefix;
		$Bdata = array();
		$promotion_genre_code = 'CRLV';
		$promotion_genre_data = $this->promotioncron_model->get_promotion_genre_data($promotion_genre_code);
		if(!empty($promotion_genre_data)){
			if($promotion_genre_data['sync_lock'] == STATUS_INACTIVE){
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_ACTIVE);
				$promotion_data_list = $this->promotioncron_model->promotion_data_list($promotion_genre_code);
				foreach($promotion_data_list as $promotion_data_list_row){
					$Bdata = array();
					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if(($promotion_data_list_row["calculate_day_type"] == $today_day) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
							if($promotion_data_list_row["calculate_hour"] == $today_hour){
								if($promotion_data_list_row["calculate_minute"] == $today_minute){
									$promotion_time = 0;
									$apply_sync_data = $this->promotioncron_model->get_promotion_result_logs($promotion_genre_code,PROMOTION_CRON_CALCULATE,$promotion_data_list_row['promotion_id']);
									if( ! empty($apply_sync_data))
									{
										$promotion_time = $apply_sync_data['promotion_time'];
									}
									$DBdataA = array(
										'promotion_id' => $promotion_data_list_row['promotion_id'],
										'promotion_genre_code' => $promotion_genre_code,
										'promotion_sync_type' => PROMOTION_CRON_CALCULATE,
										'promotion_time' => $promotion_time,
										'created_date' => time(),
									);

									if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('monday last week',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('sunday last week',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('first day of last month',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('last day of last month',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE){
										$start_date	= date('Y-01-01 00:00:00', strtotime('first day of last year',$current_time));
										$end_date	= date('Y-12-31 23:59:59', strtotime('last day of last year',$current_time));
									}else{
										$start_date	= date('Y-m-d 00:00:00', strtotime('yesterday',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('yesterday',$current_time));
									}

									$start_time = strtotime($start_date);
									$end_time = strtotime($end_date);
									if($end_time > $promotion_time){
										if($promotion_time > $start_time){
											$start_time = $promotion_time;
										}
										$DBdataA['promotion_time'] = $end_time;
										$all_player_turnover = array();
										$wager_all_player_turnover_live_casino = $this->promotioncron_model->get_all_player_turnover_by_game_type($start_time, $end_time, $promotion_data_list_row, GAME_LIVE_CASINO);
										$wager_all_player_turnover_all = $this->promotioncron_model->get_all_player_turnover_by_game_type($start_time, $end_time, $promotion_data_list_row, GAME_ALL);
										if(!empty($wager_all_player_turnover_live_casino) || !empty($wager_all_player_turnover_all)){
											$Bdata = array();
											//get player list
											$level_data =  $this->level_model->get_level_data();
							
											$last_player_id = 1000000000;
											$player_lists = array();
											$game_ids_data = array();
											$game_type_data = array();
											$player_query = $this->db->query("SELECT player_id FROM {$dbprefix}players ORDER BY player_id DESC LIMIT 1");
											if($player_query->num_rows() > 0) {
												$player_row = $player_query->row();
												$last_player_id = $player_row->player_id;
											}
											$player_query->free_result();

											$player_query = $this->db->query("SELECT player_id, username, points, level_id FROM {$dbprefix}players WHERE player_id <= ? ORDER BY player_id ASC", array($last_player_id));
											if($player_query->num_rows() > 0) {
												foreach($player_query->result() as $player_row){
													$level = (!empty($player_row->level_id) ? $player_row->level_id : 0);
													$player_lists[$player_row->player_id] = array(
														'player_id' => $player_row->player_id,
														'username' => $player_row->username,
														'level_id' => $level,
														'points' => $player_row->points,
														'turnover' => 0,
														'bonus' => 0, 
														'level' => array(),
														'is_bonus' => false,
														'is_level' => false,
													);

													if(!empty($level)){
														if(isset($level_data[$level])){
															$player_lists[$player_row->player_id]['is_level'] = true;
															$player_lists[$player_row->player_id]['level'] = $level_data[$level];
														}
													}

												}
											}

											if(!empty($wager_all_player_turnover_live_casino)){
												foreach($wager_all_player_turnover_live_casino as $casino_row){
													$bonus = 0;
													$rate = 0;
													$turnover = 0;
													if(!empty($casino_row['current_amount'])){
														$player_data = $player_lists[$casino_row['player_id']];
														if($player_lists[$casino_row['player_id']]['is_level']){
															$game_ids_data = array_values(array_filter(explode(',',$player_lists[$casino_row['player_id']]['level']['game_ids'])));
															if(!empty($game_ids_data)){
																if(in_array($casino_row['game_provider_type_code'], $game_ids_data))
					        									{
					        										$game_type_data = explode("_", $casino_row['game_provider_type_code']);
					        										if(sizeof($game_type_data) == 2){
					        											if(isset($player_lists[$casino_row['player_id']]['level']['level_rate_'.strtolower($game_type_data[1])])){
					        												$rate = $player_lists[$casino_row['player_id']]['level']['level_rate_'.strtolower($game_type_data[1])];
					        												if(!empty($rate)){
						        												$turnover = $casino_row['current_amount'];
						        												$bonus =  $rate * $turnover / 100;

						        												if(!empty($bonus)){
						        													$player_lists[$casino_row['player_id']]['is_bonus'] = true;
						        													$player_lists[$casino_row['player_id']]['bonus'] += $bonus;
						        													$player_lists[$casino_row['player_id']]['turnover'] += $turnover;
						        												}
						        											}
					        											}
					        											
					        										}
					        									}
															}
														}
													}
												}
											}

											if(!empty($wager_all_player_turnover_all)){
												foreach($wager_all_player_turnover_all as $casino_row){
													$bonus = 0;
													$rate = 0;
													$turnover = 0;
													if(!empty($casino_row['current_amount'])){
														$player_data = $player_lists[$casino_row['player_id']];
														if($player_lists[$casino_row['player_id']]['is_level']){
															$game_ids_data = array_values(array_filter(explode(',',$player_lists[$casino_row['player_id']]['level']['game_ids'])));
															if(!empty($game_ids_data)){
																if(in_array($casino_row['game_provider_type_code'], $game_ids_data))
					        									{
					        										$game_type_data = explode("_", $casino_row['game_provider_type_code']);
					        										if(sizeof($game_type_data) == 2){
					        											if(isset($player_lists[$casino_row['player_id']]['level']['level_rate_'.strtolower($game_type_data[1])])){
					        												$rate = $player_lists[$casino_row['player_id']]['level']['level_rate_'.strtolower($game_type_data[1])];
					        												if(!empty($rate)){
					        													$turnover = $casino_row['current_amount'];
						        												$bonus =  $rate * $turnover / 100;
						        												$player_lists[$casino_row['player_id']]['turnover'] += $turnover;
						        												if(!empty($bonus)){
						        													$player_lists[$casino_row['player_id']]['is_bonus'] = true;
						        													$player_lists[$casino_row['player_id']]['bonus'] += $bonus;
						        												}
					        												}
					        											}
					        											
					        										}
					        									}
															}
														}
													}
												}
											}

											if(!empty($player_lists)){
												foreach($player_lists as $player_lists_row){
													$amount = 0;
													$turnover = 0;
													$turnover_multiply = 1;
													$reward = 0;
													if($player_lists_row['is_bonus']){
														$amount = $player_lists_row['turnover'];
														$turnover = bcdiv($player_lists_row['bonus'] * $turnover_multiply,1,2);
														$reward = bcdiv($player_lists_row['bonus'],1,2);

														$PBdata = array(
															'deposit_id' => 0,
															'deposit_amount' => 0,
															'promotion_amount' => $amount,
															'current_amount' => 0,
															'achieve_amount' => $turnover,
															'bonus_multiply' => $turnover_multiply,
															'bonus_index' => 0,
															'bonus_level' => 0,
															'bonus_ids' => 0,
															'reward_amount' => $reward,
															'real_reward_amount' => $reward,
															'original_amount' => 0,
															'player_id'  => $player_lists_row['player_id'],
															'player_referrer_id' => '0',
															'promotion_id'  => $promotion_data_list_row['promotion_id'],
															'promotion_name'  => $promotion_data_list_row['promotion_name'],
															'url_path' => $promotion_data_list_row['url_path'],
															'promotion_seq'  => $promotion_data_list_row['promotion_seq'],
															'genre_code' => $promotion_data_list_row['genre_code'],
															'genre_name' => $promotion_data_list_row['genre_name'],
															'date_type' => $promotion_data_list_row['date_type'],
															'start_date' => $promotion_data_list_row['start_date'],
															'end_date' => $promotion_data_list_row['end_date'],
															'specific_day_week' => $promotion_data_list_row['specific_day_week'],
															'specific_day_day' => $promotion_data_list_row['specific_day_day'],
															'reward_on_apply' => $promotion_data_list_row['reward_on_apply'],
															'withdrawal_on_check' => $promotion_data_list_row['withdrawal_on_check'],
															'is_auto_complete' => $promotion_data_list_row['is_auto_complete'],
															'level' => $promotion_data_list_row['level'],
															'accumulate_deposit' => $promotion_data_list_row['accumulate_deposit'],
															'is_deposit_tied_promotion_count' => $promotion_data_list_row['is_deposit_tied_promotion_count'],
															'apply_type' => $promotion_data_list_row['apply_type'],
															'date_expirate_type' => $promotion_data_list_row['date_expirate_type'],
															'times_limit_type' => $promotion_data_list_row['times_limit_type'],
															'is_apply_on_first_day_of_times_limit_type' => $promotion_data_list_row['is_apply_on_first_day_of_times_limit_type'],
															'is_starting_of_the_day' => $promotion_data_list_row['is_starting_of_the_day'],
															'claim_type' => $promotion_data_list_row['claim_type'],
															'calculate_day_type' => $promotion_data_list_row['calculate_day_type'],
															'calculate_hour' => $promotion_data_list_row['calculate_hour'],
															'calculate_minute' => $promotion_data_list_row['calculate_minute'],
															'reward_day_type' => $promotion_data_list_row['reward_day_type'],
															'reward_hour' => $promotion_data_list_row['reward_hour'],
															'reward_minute' => $promotion_data_list_row['reward_minute'],
															'first_deposit' => $promotion_data_list_row['first_deposit'],
															'daily_first_deposit' => $promotion_data_list_row['daily_first_deposit'],
															'min_deposit' => $promotion_data_list_row['min_deposit'],
															'max_deposit' => $promotion_data_list_row['max_deposit'],
															'calculate_type' => $promotion_data_list_row['calculate_type'],
															'complete_wallet_left' => $promotion_data_list_row['complete_wallet_left'],
															'bonus_range_type' => $promotion_data_list_row['bonus_range_type'],
															'bonus_type' => $promotion_data_list_row['bonus_type'],
															'turnover_multiply' => $promotion_data_list_row['turnover_multiply'],
															'rebate_percentage' => $promotion_data_list_row['rebate_percentage'],
															'max_rebate' => $promotion_data_list_row['max_rebate'],
															'rebate_amount' => $promotion_data_list_row['rebate_amount'],
															'game_ids' => $promotion_data_list_row['game_ids'],
															'game_ids_all' => $promotion_data_list_row['game_ids_all'],
															'live_casino_type' => $promotion_data_list_row['live_casino_type'],
															'is_level' => $promotion_data_list_row['is_level'],
															'is_banner' => $promotion_data_list_row['is_banner'],
															'balance_less' => $promotion_data_list_row['balance_less'],
															'active' => $promotion_data_list_row['active'],
															'status' => STATUS_PENDING,
															'created_by' => $this->session->userdata('username'),
															'created_date' => time(),
															'updated_date' => time()
														);
														array_push($Bdata, $PBdata);
													}
												}
											}

											if( ! empty($Bdata))
											{
												$this->db->insert_batch('player_promotion', $Bdata);
											}
											$this->db->insert('promotion_result_logs', $DBdataA);
											unset($wager_all_player_turnover_live_casino);
											unset($wager_all_player_turnover_all);
											unset($player_lists);
											unset($level_data);
										}
									}
								}
							}
						}
					}
					
					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if($promotion_data_list_row['claim_type'] == PROMOTION_USER_TYPE_SYSTEM){
							if(($promotion_data_list_row["reward_day_type"] == $today_day) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
								if($promotion_data_list_row["reward_hour"] == $today_hour){
									if($promotion_data_list_row["reward_minute"] == $today_minute){
										$all_pending_promotion = $this->promotioncron_model->get_all_pending_promotion($promotion_data_list_row['promotion_id']);
										if(!empty($all_pending_promotion)){
											$player_list = $this->promotioncron_model->get_player_list_array();
											foreach($all_pending_promotion as $all_pending_promotion_row){
												
												if($all_pending_promotion_row['reward_on_apply'] == STATUS_ACTIVE){
													if($all_pending_promotion_row['is_reward'] != STATUS_APPROVE){
														$all_pending_promotion_row['reward_amount'] = (double) $all_pending_promotion_row['reward_amount'];
														$insert_wallet_data = array(
															"player_id" => $all_pending_promotion_row['player_id'],
															"username" => $player_list[$all_pending_promotion_row['player_id']]['username'],
															"amount" => $all_pending_promotion_row['reward_amount'],
														);
														$player = array(
															'username' => $player_list[$all_pending_promotion_row['player_id']]['username'],
															'points' => $player_list[$all_pending_promotion_row['player_id']]['points'],
														);

														$array = array(
															'promotion_name' => $all_pending_promotion_row['promotion_name'],
															'remark' => $this->input->post('remark', TRUE),
														);
														$player_list[$all_pending_promotion_row['player_id']]['points'] += $insert_wallet_data['amount'];
														$this->promotioncron_model->update_player_wallet($insert_wallet_data);
														$this->promotioncron_model->insert_cash_transfer_report($player, $insert_wallet_data['amount'], TRANSFER_PROMOTION, $array);
														$this->promotioncron_model->update_player_promotion_reward_claim($all_pending_promotion_row,0);

														$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_PROMOTION_REBATE);
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
																					$reward = $player_data['amount'];

																					$replace_string_array = array(
																						SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
																						SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
																						SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD => $insert_wallet_data['amount'],
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
												$this->promotioncron_model->update_entitle_player_promotion($all_pending_promotion_row);
											}
										}
									}
								}
							}
						}
					}
				}
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_INACTIVE);
			}
		}
	}

	public function promotion_cash_rebate(){
		set_time_limit(0);
		$current_time = strtotime(date('Y-m-d H:i:00'));
		$today_day = date('N',$current_time);
		$today_hour = date('G',$current_time);
		$today_minute = date('i',$current_time);

		$promotion_genre_code = 'CR';
		$promotion_genre_data = $this->promotioncron_model->get_promotion_genre_data($promotion_genre_code);
		if(!empty($promotion_genre_data)){
			if($promotion_genre_data['sync_lock'] == STATUS_INACTIVE){
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_ACTIVE);
				$promotion_data_list = $this->promotioncron_model->promotion_data_list($promotion_genre_code);

				foreach($promotion_data_list as $promotion_data_list_row){
					$Bdata = array();
					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if(($promotion_data_list_row["calculate_day_type"] == $today_day) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
							if($promotion_data_list_row["calculate_hour"] == $today_hour){
								if($promotion_data_list_row["calculate_minute"] == $today_minute){
									//apply give
									$promotion_time = 0;
									$apply_sync_data = $this->promotioncron_model->get_promotion_result_logs($promotion_genre_code,PROMOTION_CRON_CALCULATE,$promotion_data_list_row['promotion_id']);
									if( ! empty($apply_sync_data))
									{
										$promotion_time = $apply_sync_data['promotion_time'];
									}
									$DBdataA = array(
										'promotion_id' => $promotion_data_list_row['promotion_id'],
										'promotion_genre_code' => $promotion_genre_code,
										'promotion_sync_type' => PROMOTION_CRON_CALCULATE,
										'promotion_time' => $promotion_time,
										'created_date' => time(),
									);

									if($promotion_data_list_row['bonus_range_type'] == PROMOTION_BONUS_RANGE_TYPE_LEVEL){
										$bonus_range_data = $this->promotioncron_model->get_promotion_bonus_range_data($promotion_data_list_row['promotion_id']);
									}else{
										$bonus_range_data = array();
									}

									if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('monday last week',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('sunday last week',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('first day of last month',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('last day of last month',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE){
										$start_date	= date('Y-01-01 00:00:00', strtotime('first day of last year',$current_time));
										$end_date	= date('Y-12-31 23:59:59', strtotime('last day of last year',$current_time));
									}else{
										$start_date	= date('Y-m-d 00:00:00', strtotime('yesterday',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('yesterday',$current_time));
									}

									$start_time = strtotime($start_date);
									$end_time = strtotime($end_date);

									if($end_time > $promotion_time){
										if($promotion_time > $start_time){
											$start_time = $promotion_time;
										}
										$DBdataA['promotion_time'] = $end_time;
										$all_player_turnover = array();
										$wager_all_player_turnover_live_casino = $this->promotioncron_model->get_all_player_turnover($start_time, $end_time, $promotion_data_list_row, GAME_LIVE_CASINO);
										$wager_all_player_turnover_all = $this->promotioncron_model->get_all_player_turnover($start_time, $end_time, $promotion_data_list_row, GAME_ALL);
										if(!empty($wager_all_player_turnover_live_casino)){
											foreach($wager_all_player_turnover_live_casino as $wager_all_player_turnover_live_casino_row){
												$all_player_turnover[$wager_all_player_turnover_live_casino_row['player_id']]['current_amount'] += $wager_all_player_turnover_live_casino_row['current_amount'];
												$all_player_turnover[$wager_all_player_turnover_live_casino_row['player_id']]['player_id'] = $wager_all_player_turnover_live_casino_row['player_id'];
											}
										}

										if(!empty($wager_all_player_turnover_all)){
											foreach($wager_all_player_turnover_all as $wager_all_player_turnover_all_row){
												$all_player_turnover[$wager_all_player_turnover_all_row['player_id']]['current_amount'] += $wager_all_player_turnover_all_row['current_amount'];
												$all_player_turnover[$wager_all_player_turnover_all_row['player_id']]['player_id'] = $wager_all_player_turnover_all_row['player_id'];
											}
										}
										if(!empty($all_player_turnover)){
											foreach($all_player_turnover as $all_player_turnover_row){
												$amount = $all_player_turnover_row['current_amount']; 
												$turnover = 0;
												$turnover_multiply = 0;
												$reward = 0;
												$bonus_index = 0;
												$bonus_level = 0;
												if($promotion_data_list_row['bonus_range_type'] == PROMOTION_BONUS_RANGE_TYPE_LEVEL){
													if(!empty($bonus_range_data)){
														foreach($bonus_range_data as $bonus_range_data_row){
															if($amount >= $bonus_range_data_row['amount_from']){
																$bonus_index = $bonus_range_data_row['bonus_index'];
																$bonus_level = $bonus_range_data_row['bonus_level'];
																$turnover_multiply = $bonus_range_data_row['turnover_multiply'];
															}else{
																break;
															}
														}
													}
													if(!empty($bonus_index)){
														if($promotion_data_list_row['bonus_type'] == PROMOTION_BONUS_TYPE_PERCENTAGE){
															$reward = bcdiv(($amount* $bonus_range_data[$bonus_index]['percentage']) / 100,1,2);
															if($reward > $bonus_range_data[$bonus_index]['max_amount']){
																$reward = $bonus_range_data[$bonus_index]['max_amount'];
															}
														}else{
															$reward = $bonus_range_data[$bonus_index]['bonus_amount'];
														}
													}
												}else{
													$turnover_multiply = $promotion_data_list_row['turnover_multiply'];
													if($promotion_data_list_row['bonus_type'] == PROMOTION_BONUS_TYPE_PERCENTAGE){
														$reward = bcdiv(($amount* $promotion_data_list_row['rebate_percentage']) / 100,1,2);
														if($reward > $promotion_data_list_row['max_rebate']){
															$reward = $promotion_data_list_row['max_rebate'];
														}
													}else{
														$reward = $promotion_data_list_row['rebate_amount'];
													}
												}
												$turnover = $reward * $turnover_multiply;
												if($reward > 0){
													$PBdata = array(
														'deposit_id' => 0,
														'deposit_amount' => 0,
														'promotion_amount' => $amount,
														'current_amount' => 0,
														'achieve_amount' => $turnover,
														'bonus_multiply' => $turnover_multiply,
														'bonus_index' => $bonus_index,
														'bonus_level' => $bonus_level,
														'bonus_ids' => $promotion_data_list_row['bonus_ids'],
														'reward_amount' => $reward,
														'real_reward_amount' => $reward,
														'original_amount' => 0,
														'player_id'  => $all_player_turnover_row['player_id'],
														'player_referrer_id' => '0',
														'promotion_id'  => $promotion_data_list_row['promotion_id'],
														'promotion_name'  => $promotion_data_list_row['promotion_name'],
														'url_path' => $promotion_data_list_row['url_path'],
														'promotion_seq'  => $promotion_data_list_row['promotion_seq'],
														'genre_code' => $promotion_data_list_row['genre_code'],
														'genre_name' => $promotion_data_list_row['genre_name'],
														'date_type' => $promotion_data_list_row['date_type'],
														'start_date' => $promotion_data_list_row['start_date'],
														'end_date' => $promotion_data_list_row['end_date'],
														'specific_day_week' => $promotion_data_list_row['specific_day_week'],
														'specific_day_day' => $promotion_data_list_row['specific_day_day'],
														'reward_on_apply' => $promotion_data_list_row['reward_on_apply'],
														'withdrawal_on_check' => $promotion_data_list_row['withdrawal_on_check'],
														'is_auto_complete' => $promotion_data_list_row['is_auto_complete'],
														'level' => $promotion_data_list_row['level'],
														'accumulate_deposit' => $promotion_data_list_row['accumulate_deposit'],
														'is_deposit_tied_promotion_count' => $promotion_data_list_row['is_deposit_tied_promotion_count'],
														'apply_type' => $promotion_data_list_row['apply_type'],
														'date_expirate_type' => $promotion_data_list_row['date_expirate_type'],
														'times_limit_type' => $promotion_data_list_row['times_limit_type'],
														'is_apply_on_first_day_of_times_limit_type' => $promotion_data_list_row['is_apply_on_first_day_of_times_limit_type'],
														'is_starting_of_the_day' => $promotion_data_list_row['is_starting_of_the_day'],
														'claim_type' => $promotion_data_list_row['claim_type'],
														'calculate_day_type' => $promotion_data_list_row['calculate_day_type'],
														'calculate_hour' => $promotion_data_list_row['calculate_hour'],
														'calculate_minute' => $promotion_data_list_row['calculate_minute'],
														'reward_day_type' => $promotion_data_list_row['reward_day_type'],
														'reward_hour' => $promotion_data_list_row['reward_hour'],
														'reward_minute' => $promotion_data_list_row['reward_minute'],
														'first_deposit' => $promotion_data_list_row['first_deposit'],
														'daily_first_deposit' => $promotion_data_list_row['daily_first_deposit'],
														'min_deposit' => $promotion_data_list_row['min_deposit'],
														'max_deposit' => $promotion_data_list_row['max_deposit'],
														'calculate_type' => $promotion_data_list_row['calculate_type'],
														'complete_wallet_left' => $promotion_data_list_row['complete_wallet_left'],
														'bonus_range_type' => $promotion_data_list_row['bonus_range_type'],
														'bonus_type' => $promotion_data_list_row['bonus_type'],
														'turnover_multiply' => $promotion_data_list_row['turnover_multiply'],
														'rebate_percentage' => $promotion_data_list_row['rebate_percentage'],
														'max_rebate' => $promotion_data_list_row['max_rebate'],
														'rebate_amount' => $promotion_data_list_row['rebate_amount'],
														'game_ids' => $promotion_data_list_row['game_ids'],
														'game_ids_all' => $promotion_data_list_row['game_ids_all'],
														'live_casino_type' => $promotion_data_list_row['live_casino_type'],
														'is_level' => $promotion_data_list_row['is_level'],
														'is_banner' => $promotion_data_list_row['is_banner'],
														'balance_less' => $promotion_data_list_row['balance_less'],
														'active' => $promotion_data_list_row['active'],
														'status' => STATUS_PENDING,
														'created_by' => $this->session->userdata('username'),
														'created_date' => time(),
														'updated_date' => time()
													);
													array_push($Bdata, $PBdata);
												}
											}
										}
										if( ! empty($Bdata))
										{
											$this->db->insert_batch('player_promotion', $Bdata);
										}
										$this->db->insert('promotion_result_logs', $DBdataA);
										unset($all_player_turnover);
									}
								}
							}
						}	
					}
					
					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if($promotion_data_list_row['claim_type'] == PROMOTION_USER_TYPE_SYSTEM){
							if(($promotion_data_list_row["reward_day_type"] == $today_day) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
								if($promotion_data_list_row["reward_hour"] == $today_hour){
									if($promotion_data_list_row["reward_minute"] == $today_minute){
										$all_pending_promotion = $this->promotioncron_model->get_all_pending_promotion($promotion_data_list_row['promotion_id']);
										$player_list = $this->promotioncron_model->get_player_list_array();
										if(!empty($all_pending_promotion)){
											foreach($all_pending_promotion as $all_pending_promotion_row){
												if($all_pending_promotion_row['reward_on_apply'] == STATUS_ACTIVE){
													if($all_pending_promotion_row['is_reward'] != STATUS_APPROVE){
														$all_pending_promotion_row['reward_amount'] = (double) $all_pending_promotion_row['reward_amount'];
														$insert_wallet_data = array(
															"player_id" => $all_pending_promotion_row['player_id'],
															"username" => $player_list[$all_pending_promotion_row['player_id']]['username'],
															"amount" => $all_pending_promotion_row['reward_amount'],
														);
														$player = array(
															'username' => $player_list[$all_pending_promotion_row['player_id']]['username'],
															'points' => $player_list[$all_pending_promotion_row['player_id']]['points'],
														);
														$array = array(
															'promotion_name' => $all_pending_promotion_row['promotion_name'],
															'remark' => $this->input->post('remark', TRUE),
														);
														$player_list[$all_pending_promotion_row['player_id']]['points'] += $insert_wallet_data['amount'];
														$this->promotioncron_model->update_player_wallet($insert_wallet_data);
														$this->promotioncron_model->insert_cash_transfer_report($player, $insert_wallet_data['amount'], TRANSFER_PROMOTION,$array);
														$this->promotioncron_model->update_player_promotion_reward_claim($all_pending_promotion_row,0);
													}
												}
												$this->promotioncron_model->update_entitle_player_promotion($all_pending_promotion_row);
											}
										}
									}
								}
							}
						}
					}
					
					sleep(3);
				}
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_INACTIVE);
			}
		}
	}

	public function promotion_level(){
		set_time_limit(0);
		$current_time = strtotime(date('Y-m-d H:i:00'));
		$today_day = date('N',$current_time);
		$today_hour = date('G',$current_time);
		$today_minute = date('i',$current_time);
		$dbprefix = $this->db->dbprefix;
		$Bdata = array();
		$promotion_genre_code = 'LE';
		$promotion_genre_data = $this->promotioncron_model->get_promotion_genre_data($promotion_genre_code);
		if(!empty($promotion_genre_data)){
			if($promotion_genre_data['sync_lock'] == STATUS_INACTIVE){
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_ACTIVE);
				$promotion_data_list = $this->promotioncron_model->promotion_data_list($promotion_genre_code);
				foreach($promotion_data_list as $promotion_data_list_row){
					$Bdata = array();
					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if(($promotion_data_list_row["calculate_day_type"] == $today_day) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
							if($promotion_data_list_row["calculate_hour"] == $today_hour){
								if($promotion_data_list_row["calculate_minute"] == $today_minute){
									$promotion_time = 0;
									$apply_sync_data = $this->promotioncron_model->get_promotion_result_logs($promotion_genre_code,PROMOTION_CRON_CALCULATE,$promotion_data_list_row['promotion_id']);
									if( ! empty($apply_sync_data))
									{
										$promotion_time = $apply_sync_data['promotion_time'];
									}
									$DBdataA = array(
										'promotion_id' => $promotion_data_list_row['promotion_id'],
										'promotion_genre_code' => $promotion_genre_code,
										'promotion_sync_type' => PROMOTION_CRON_CALCULATE,
										'promotion_time' => $promotion_time,
										'created_date' => time(),
									);

									if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('monday last week',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('sunday last week',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE){
										$start_date	= date('Y-m-d 00:00:00', strtotime('first day of last month',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('last day of last month',$current_time));
									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE){
										$start_date	= date('Y-01-01 00:00:00', strtotime('first day of last year',$current_time));
										$end_date	= date('Y-12-31 23:59:59', strtotime('last day of last year',$current_time));
									}else{
										$start_date	= date('Y-m-d 00:00:00', strtotime('yesterday',$current_time));
										$end_date	= date('Y-m-d 23:59:59', strtotime('yesterday',$current_time));
									}

									$start_time = strtotime($start_date);
									$end_time = strtotime($end_date);
									if($end_time > $promotion_time){
										if($promotion_time > $start_time){
											$start_time = $promotion_time;
										}
										$DBdataA['promotion_time'] = $end_time;
									}

									$dbprefix = $this->db->dbprefix;
									$playerDBdata = array();
									$player_new_ranking = array();
									$calculation_data = $promotion_data_list_row;

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

										$this->db->insert('promotion_result_logs', $DBdataA);
										unset($playerDBdata);
										unset($player_lists);
										unset($profit_array);
										unset($profit_lc_array); 
										unset($level_lists);
									}
								}
							}
						}
					}

					if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
						if($promotion_data_list_row['claim_type'] == PROMOTION_USER_TYPE_SYSTEM){
							if(($promotion_data_list_row["reward_day_type"] == $today_day) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
								if($promotion_data_list_row["reward_hour"] == $today_hour){
									if($promotion_data_list_row["reward_minute"] == $today_minute){
										$schedule_data = $this->level_model->get_schedule_pending_data();
										if(!empty($schedule_data) && sizeof($schedule_data)>0){
											$level_data =  $this->level_model->get_level_data();
											$calculation_data = $promotion_data_list_row;
											foreach($schedule_data as $schedule_data_row){
												$allData = $this->level_model->get_all_level_log_pending_data($schedule_data_row['schedule_id']);
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

												$this->level_model->update_schedule_status($schedule_data_row,STATUS_APPROVE);
												$this->level_model->update_all_level_log($schedule_data_row['schedule_id'],STATUS_APPROVE);
												unset($player_lists);
												unset($allData);
											}
										}
									}
								}
							}
						}
					}
					sleep(3);
				}
				$this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_INACTIVE);
			}
		}
	}
	
	public function promotion_weekly_reward(){
	    set_time_limit(0);
		$current_time = strtotime(date('Y-m-d H:i:00'));
		$today_day = date('N',$current_time);
		$today_hour = date('G',$current_time);
		$today_minute = date('i',$current_time);
		$dbprefix = $this->db->dbprefix;
		$Bdata = array();
		$promotion_genre_code = 'WRLV';
		$promotion_genre_data = $this->promotioncron_model->get_promotion_genre_data($promotion_genre_code);
		if(!empty($promotion_genre_data)){   
		    if($promotion_genre_data['sync_lock'] == STATUS_INACTIVE){
		        $this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_ACTIVE);
		        $promotion_data_list = $this->promotioncron_model->promotion_data_list($promotion_genre_code);
		        if(!empty($promotion_data_list)){
		            foreach($promotion_data_list as $promotion_data_list_row){
		                $Bdata = array();
					    if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
					        if(($promotion_data_list_row["calculate_day_type"] == $today_day) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["calculate_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
    							if($promotion_data_list_row["calculate_hour"] == $today_hour){
    								if($promotion_data_list_row["calculate_minute"] == $today_minute){
    									$promotion_time = 0;
    									$apply_sync_data = $this->promotioncron_model->get_promotion_result_logs($promotion_genre_code,PROMOTION_CRON_CALCULATE,$promotion_data_list_row['promotion_id']);
    									if( ! empty($apply_sync_data))
    									{
    										$promotion_time = $apply_sync_data['promotion_time'];
    									}
    									$DBdataA = array(
    										'promotion_id' => $promotion_data_list_row['promotion_id'],
    										'promotion_genre_code' => $promotion_genre_code,
    										'promotion_sync_type' => PROMOTION_CRON_CALCULATE,
    										'promotion_time' => $promotion_time,
    										'created_date' => time(),
    									);
    
    									if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE){
    										$start_date	= date('Y-m-d 00:00:00', strtotime('monday last week',$current_time));
    										$end_date	= date('Y-m-d 23:59:59', strtotime('sunday last week',$current_time));
    									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE){
    										$start_date	= date('Y-m-d 00:00:00', strtotime('first day of last month',$current_time));
    										$end_date	= date('Y-m-d 23:59:59', strtotime('last day of last month',$current_time));
    									}else if($promotion_data_list_row['times_limit_type'] == PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE){
    										$start_date	= date('Y-01-01 00:00:00', strtotime('first day of last year',$current_time));
    										$end_date	= date('Y-12-31 23:59:59', strtotime('last day of last year',$current_time));
    									}else{
    										$start_date	= date('Y-m-d 00:00:00', strtotime('yesterday',$current_time));
    										$end_date	= date('Y-m-d 23:59:59', strtotime('yesterday',$current_time));
    									}
    
    									$start_time = strtotime($start_date);
    									$end_time = strtotime($end_date);
    									if($end_time > $promotion_time){
    										if($promotion_time > $start_time){
    											$start_time = $promotion_time;
    										}
    										$start_time = 0;
    										$DBdataA['promotion_time'] = $end_time;
    										$all_player_turnover = array();
    										$wager_all_player_turnover_live_casino = $this->promotioncron_model->get_all_player_turnover_by_game_type($start_time, $end_time, $promotion_data_list_row, GAME_LIVE_CASINO);
    										$wager_all_player_turnover_all = $this->promotioncron_model->get_all_player_turnover_by_game_type($start_time, $end_time, $promotion_data_list_row, GAME_ALL);
    										if(!empty($wager_all_player_turnover_live_casino) || !empty($wager_all_player_turnover_all)){
    											$Bdata = array();
    											//get player list
    											$level_data =  $this->level_model->get_level_data();
    							
    											$last_player_id = 1000000000;
    											$player_lists = array();
    											$game_ids_data = array();
    											$game_type_data = array();
    											$player_query = $this->db->query("SELECT player_id FROM {$dbprefix}players ORDER BY player_id DESC LIMIT 1");
    											if($player_query->num_rows() > 0) {
    												$player_row = $player_query->row();
    												$last_player_id = $player_row->player_id;
    											}
    											$player_query->free_result();
    
    											$player_query = $this->db->query("SELECT player_id, username, points, level_id FROM {$dbprefix}players WHERE player_id <= ? ORDER BY player_id ASC", array($last_player_id));
    											if($player_query->num_rows() > 0) {
    												foreach($player_query->result() as $player_row){
    													$level = (!empty($player_row->level_id) ? $player_row->level_id : 0);
    													$player_lists[$player_row->player_id] = array(
    														'player_id' => $player_row->player_id,
    														'username' => $player_row->username,
    														'level_id' => $level,
    														'points' => $player_row->points,
    														'turnover' => 0,
    														'bonus' => 0,
    														'level' => array(),
    														'is_bonus' => false,
    														'is_level' => false,
    													);
    
    													if(!empty($level)){
    														if(isset($level_data[$level])){
    															$player_lists[$player_row->player_id]['is_level'] = true;
    															$player_lists[$player_row->player_id]['level'] = $level_data[$level];
    														}
    													}
    
    												}
    											}
    
    											if(!empty($wager_all_player_turnover_live_casino)){
    												foreach($wager_all_player_turnover_live_casino as $casino_row){
    													$bonus = 0;
    													$rate = 0;
    													$turnover = 0;
    													if(!empty($casino_row['current_amount'])){
    														$player_data = $player_lists[$casino_row['player_id']];
    														if($player_lists[$casino_row['player_id']]['is_level']){
    															$game_ids_data = array_values(array_filter(explode(',',$player_lists[$casino_row['player_id']]['level']['game_ids'])));
    															if(!empty($game_ids_data)){
    																if(in_array($casino_row['game_provider_type_code'], $game_ids_data))
    					        									{
    					        									    $turnover = $casino_row['current_amount'];
    					        									    $player_lists[$casino_row['player_id']]['turnover'] += $turnover;
    					        									}
    															}
    														}
    													}
    												}
    											}
    
    											if(!empty($wager_all_player_turnover_all)){
    												foreach($wager_all_player_turnover_all as $casino_row){
    													$bonus = 0;
    													$rate = 0;
    													$turnover = 0;
    													if(!empty($casino_row['current_amount'])){
    														$player_data = $player_lists[$casino_row['player_id']];
    														if($player_lists[$casino_row['player_id']]['is_level']){
    															$game_ids_data = array_values(array_filter(explode(',',$player_lists[$casino_row['player_id']]['level']['game_ids'])));
    															if(!empty($game_ids_data)){
    																if(in_array($casino_row['game_provider_type_code'], $game_ids_data))
    					        									{
    					        										$turnover = $casino_row['current_amount'];
    					        									    $player_lists[$casino_row['player_id']]['turnover'] += $turnover;
    					        									}
    															}
    														}
    													}
    												}
    											}
                                                
                                                
                                                foreach($player_lists as $player_lists_row){
                                                    if($player_lists_row['turnover'] >= $player_lists_row['level']['weekly_reward_turn']){
                                                        $player_lists[$player_lists_row['player_id']]['is_bonus'] = true;
                                                        $player_lists[$player_lists_row['player_id']]['bonus'] = $player_lists_row['level']['weekly_reward'];
                                                    }
                                                }
                                                
                                                $total_all_deposit_by_date_player = array();
                                                $total_all_deposit_by_date = $this->cron_model->get_total_win_loss_report($start_time, $end_time);
                                                foreach($total_all_deposit_by_date as $total_all_deposit_by_date_row){
                                                    $total_all_deposit_by_date_player[$total_all_deposit_by_date_row['player_id']] = $total_all_deposit_by_date_row['deposit_offline_amount'] + $total_all_deposit_by_date_row['deposit_online_amount'] + $total_all_deposit_by_date_row['deposit_point_amount'];
                                                }
                                                
                                                
                                                if(!empty($player_lists)){
    												foreach($player_lists as $player_lists_row){
    													$amount = 0;
    													$turnover = 0;
    													$turnover_multiply = $promotion_data_list_row['turnover_multiply'];
    													$reward = 0;
    													if($player_lists_row['is_bonus']){
    													    if(isset($total_all_deposit_by_date_player[$player_lists_row['player_id']]) && ($total_all_deposit_by_date_player[$player_lists_row['player_id']] > 0)){
    													        $amount = $player_lists_row['turnover'];
        														$turnover = bcdiv($player_lists_row['bonus'] * $turnover_multiply,1,2);
        														$reward = bcdiv($player_lists_row['bonus'],1,2);
        														
        														$PBdata = array(
        															'deposit_id' => 0,
        															'deposit_amount' => 0,
        															'promotion_amount' => $amount,
        															'current_amount' => 0,
        															'achieve_amount' => $turnover,
        															'bonus_multiply' => $turnover_multiply,
        															'bonus_index' => 0,
        															'bonus_level' => 0,
        															'bonus_ids' => 0,
        															'reward_amount' => $reward,
        															'real_reward_amount' => $reward,
        															'original_amount' => 0,
        															'player_id'  => $player_lists_row['player_id'],
        															'player_referrer_id' => '0',
        															'promotion_id'  => $promotion_data_list_row['promotion_id'],
        															'promotion_name'  => $promotion_data_list_row['promotion_name'],
        															'url_path' => $promotion_data_list_row['url_path'],
        															'promotion_seq'  => $promotion_data_list_row['promotion_seq'],
        															'genre_code' => $promotion_data_list_row['genre_code'],
        															'genre_name' => $promotion_data_list_row['genre_name'],
        															'date_type' => $promotion_data_list_row['date_type'],
        															'start_date' => $promotion_data_list_row['start_date'],
        															'end_date' => $promotion_data_list_row['end_date'],
        															'specific_day_week' => $promotion_data_list_row['specific_day_week'],
        															'specific_day_day' => $promotion_data_list_row['specific_day_day'],
        															'reward_on_apply' => $promotion_data_list_row['reward_on_apply'],
        															'withdrawal_on_check' => $promotion_data_list_row['withdrawal_on_check'],
        															'is_auto_complete' => $promotion_data_list_row['is_auto_complete'],
        															'level' => $promotion_data_list_row['level'],
        															'accumulate_deposit' => $promotion_data_list_row['accumulate_deposit'],
        															'is_deposit_tied_promotion_count' => $promotion_data_list_row['is_deposit_tied_promotion_count'],
        															'apply_type' => $promotion_data_list_row['apply_type'],
        															'date_expirate_type' => $promotion_data_list_row['date_expirate_type'],
        															'times_limit_type' => $promotion_data_list_row['times_limit_type'],
        															'is_apply_on_first_day_of_times_limit_type' => $promotion_data_list_row['is_apply_on_first_day_of_times_limit_type'],
        															'is_starting_of_the_day' => $promotion_data_list_row['is_starting_of_the_day'],
        															'claim_type' => $promotion_data_list_row['claim_type'],
        															'calculate_day_type' => $promotion_data_list_row['calculate_day_type'],
        															'calculate_hour' => $promotion_data_list_row['calculate_hour'],
        															'calculate_minute' => $promotion_data_list_row['calculate_minute'],
        															'reward_day_type' => $promotion_data_list_row['reward_day_type'],
        															'reward_hour' => $promotion_data_list_row['reward_hour'],
        															'reward_minute' => $promotion_data_list_row['reward_minute'],
        															'first_deposit' => $promotion_data_list_row['first_deposit'],
        															'daily_first_deposit' => $promotion_data_list_row['daily_first_deposit'],
        															'min_deposit' => $promotion_data_list_row['min_deposit'],
        															'max_deposit' => $promotion_data_list_row['max_deposit'],
        															'calculate_type' => $promotion_data_list_row['calculate_type'],
        															'complete_wallet_left' => $promotion_data_list_row['complete_wallet_left'],
        															'bonus_range_type' => $promotion_data_list_row['bonus_range_type'],
        															'bonus_type' => $promotion_data_list_row['bonus_type'],
        															'turnover_multiply' => $promotion_data_list_row['turnover_multiply'],
        															'rebate_percentage' => $promotion_data_list_row['rebate_percentage'],
        															'max_rebate' => $promotion_data_list_row['max_rebate'],
        															'rebate_amount' => $promotion_data_list_row['rebate_amount'],
        															'game_ids' => $promotion_data_list_row['game_ids'],
        															'game_ids_all' => $promotion_data_list_row['game_ids_all'],
        															'live_casino_type' => $promotion_data_list_row['live_casino_type'],
        															'is_level' => $promotion_data_list_row['is_level'],
        															'is_banner' => $promotion_data_list_row['is_banner'],
        															'balance_less' => $promotion_data_list_row['balance_less'],
        															'active' => $promotion_data_list_row['active'],
        															'status' => STATUS_PENDING,
        															'created_by' => $this->session->userdata('username'),
        															'created_date' => time(),
        															'updated_date' => time()
        														);
        														array_push($Bdata, $PBdata);   
    													    }
    													}
    												}
                                                }
                                                
                                                if( ! empty($Bdata))
    											{
    												$this->db->insert_batch('player_promotion', $Bdata);
    											}
    											$this->db->insert('promotion_result_logs', $DBdataA);
    											unset($wager_all_player_turnover_live_casino);
    											unset($wager_all_player_turnover_all);
    											unset($player_lists);
    											unset($level_data);
    										}
    									}
    								}
    							}
    						}
					    }
					    if($promotion_data_list_row["calculate_type"] != PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT){
    						if($promotion_data_list_row['claim_type'] == PROMOTION_USER_TYPE_SYSTEM){
    							if(($promotion_data_list_row["reward_day_type"] == $today_day) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYDAY) || ($promotion_data_list_row["reward_day_type"] == PROMOTION_DAY_TYPE_EVERYTIME)){
    								if($promotion_data_list_row["reward_hour"] == $today_hour){
    									if($promotion_data_list_row["reward_minute"] == $today_minute){
    										$all_pending_promotion = $this->promotioncron_model->get_all_pending_promotion($promotion_data_list_row['promotion_id']);
    										if(!empty($all_pending_promotion)){
    											$player_list = $this->promotioncron_model->get_player_list_array();
    											foreach($all_pending_promotion as $all_pending_promotion_row){
    												
    												if($all_pending_promotion_row['reward_on_apply'] == STATUS_ACTIVE){
    													if($all_pending_promotion_row['is_reward'] != STATUS_APPROVE){
    														$all_pending_promotion_row['reward_amount'] = (double) $all_pending_promotion_row['reward_amount'];
    														$insert_wallet_data = array(
    															"player_id" => $all_pending_promotion_row['player_id'],
    															"username" => $player_list[$all_pending_promotion_row['player_id']]['username'],
    															"amount" => $all_pending_promotion_row['reward_amount'],
    														);
    														$player = array(
    															'username' => $player_list[$all_pending_promotion_row['player_id']]['username'],
    															'points' => $player_list[$all_pending_promotion_row['player_id']]['points'],
    														);
    
    														$array = array(
    															'promotion_name' => $all_pending_promotion_row['promotion_name'],
    															'remark' => $this->input->post('remark', TRUE),
    														);
    														$player_list[$all_pending_promotion_row['player_id']]['points'] += $insert_wallet_data['amount'];
    														$this->promotioncron_model->update_player_wallet($insert_wallet_data);
    														$this->promotioncron_model->insert_cash_transfer_report($player, $insert_wallet_data['amount'], TRANSFER_PROMOTION, $array);
    														$this->promotioncron_model->update_player_promotion_reward_claim($all_pending_promotion_row,0);
    
    														$system_message_data = $this->message_model->get_message_data_by_templete(SYSTEM_MESSAGE_PLATFORM_PROMOTION_REBATE);
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
    																					$reward = $player_data['amount'];
    
    																					$replace_string_array = array(
    																						SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME => $username,
    																						SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM => get_platform_language_name($v),
    																						SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD => $insert_wallet_data['amount'],
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
    												$this->promotioncron_model->update_entitle_player_promotion($all_pending_promotion_row);
    											}
    										}
    									}
    								}
    							}
    						}
    					}
		            }
		        }
		        $this->promotioncron_model->update_promotion_cron_sync_lock($promotion_genre_code,STATUS_INACTIVE);
		    }
		}
	}	
}