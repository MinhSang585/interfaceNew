<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="<?php echo get_language_code('iso');?>">
<head>
	<?php $this->load->view('parts/head_meta');?>
</head>
<body>
	<div class="wrapper">
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid mt-2">
				<div class="row">
					<!-- left column -->
					<div class="col-12">
						<!-- jquery validation -->
						<div class="card card-primary">
							<!-- form start -->
							<?php echo form_open('role/update', array('id' => 'user_role-form', 'name' => 'user_role-form', 'class' => 'form-horizontal'));?>
								<div class="card-body">
									<div class="form-group row">
										<label for="role_name" class="col-5 col-form-label"><?php echo $this->lang->line('label_name');?></label>
										<div class="col-7">
											<input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo (isset($role_name) ? $role_name : '');?>" maxlength="16">
										</div>
									</div>
									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('label_remark');?></label>
										<div class="col-7">
											<textarea class="form-control" id="remark" name="remark" rows="3"><?php echo (isset($remark) ? $remark : '');?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="active" class="col-5 col-form-label"><?php echo $this->lang->line('label_status');?></label>
										<div class="col-7">
											<input type="checkbox" id="active" name="active" value="1" <?php echo ((isset($active) && $active == STATUS_ACTIVE) ? 'checked' : '');?> data-bootstrap-switch data-off-color="secondary" data-on-color="success">
										</div>
									</div>
									
									<div class="form-group row">
										<label for="created_by" class="col-5 col-form-label"><?php echo $this->lang->line('label_created_by');?></label>
										<div class="col-7">
											<label class="col-form-label font-weight-normal"><?php echo (( ! empty($created_by)) ? $created_by : '-');?></label>
										</div>
									</div>
									<div class="form-group row">
										<label for="created_date" class="col-5 col-form-label"><?php echo $this->lang->line('label_created_date');?></label>
										<div class="col-7">
											<label class="col-form-label font-weight-normal"><?php echo (($created_date > 0) ? date('Y-m-d H:i:s', $created_date) : '-');?></label>
										</div>
									</div>

									<div class="form-group row">
										<?php if($permissions[PERMISSION_HOME]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_HOME]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_HOME;?> checkbox_option" type="<?php echo (($permissions[PERMISSION_HOME]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_HOME;?>" name="permissions[]" value="<?php echo PERMISSION_HOME;?>" <?php echo (($permissions[PERMISSION_HOME]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_HOME]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_HOME;?>">
														<?php echo $this->lang->line('title_home');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_SUB_ACCOUNT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_SUB_ACCOUNT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SUB_ACCOUNT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>">
														<?php echo $this->lang->line('title_sub_account');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SUB_ACCOUNT_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_ACCOUNT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SUB_ACCOUNT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_SUB_ACCOUNT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_ACCOUNT_ADD;?>" <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_SUB_ACCOUNT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SUB_ACCOUNT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_ACCOUNT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SUB_ACCOUNT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_SUB_ACCOUNT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_ACCOUNT_UPDATE;?>" <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_SUB_ACCOUNT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CHANGE_PASSWORD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>" name="permissions[]" value="<?php echo PERMISSION_CHANGE_PASSWORD;?>" <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>">
														<?php echo $this->lang->line('title_change_password');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PERMISSION_SETUP;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_PERMISSION_SETUP;?>" name="permissions[]" value="<?php echo PERMISSION_PERMISSION_SETUP;?>" <?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_VIEW;?>_<?php echo PERMISSION_PERMISSION_SETUP;?>">
														<?php echo $this->lang->line('title_set_permissions');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_USER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_USER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_USER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_USER_VIEW;?>" <?php echo (($permissions[PERMISSION_USER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>">
														<?php echo $this->lang->line('title_user');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_USER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_USER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_USER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_USER_ADD;?>" <?php echo (($permissions[PERMISSION_USER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_USER_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_USER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_USER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_USER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_USER_UPDATE;?>" <?php echo (($permissions[PERMISSION_USER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_USER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PERMISSION_SETUP;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_PERMISSION_SETUP;?>" name="permissions[]" value="<?php echo PERMISSION_PERMISSION_SETUP;?>" <?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PERMISSION_SETUP]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_PERMISSION_SETUP;?>">
														<?php echo $this->lang->line('title_set_permissions');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CHANGE_PASSWORD;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>" name="permissions[]" value="<?php echo PERMISSION_CHANGE_PASSWORD;?>" <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>">
														<?php echo $this->lang->line('title_change_password');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>">
														<?php echo $this->lang->line('button_deposit_points');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>" <?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_VIEW;?>_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>">
														<?php echo $this->lang->line('button_withdraw_points');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_PLAYER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>">
														<?php echo $this->lang->line('title_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VIEW_PLAYER_TURNOVER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_VIEW_PLAYER_TURNOVER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>" name="permissions[]" value="<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>" <?php echo (($permissions[PERMISSION_VIEW_PLAYER_TURNOVER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VIEW_PLAYER_TURNOVER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>">
														<?php echo $this->lang->line('label_withdrawal_turnover');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_ADJUST_PLAYER_TURNOVER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>" type="<?php echo (($permissions[PERMISSION_ADJUST_PLAYER_TURNOVER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>_<?php echo PERMISSION_ADJUST_PLAYER_TURNOVER;?>" name="permissions[]" value="<?php echo PERMISSION_ADJUST_PLAYER_TURNOVER;?>" <?php echo (($permissions[PERMISSION_ADJUST_PLAYER_TURNOVER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ADJUST_PLAYER_TURNOVER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_TURNOVER;?>_<?php echo PERMISSION_ADJUST_PLAYER_TURNOVER;?>">
														<?php echo $this->lang->line('title_player_turnover_adjustment');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE;?>">
														<?php echo $this->lang->line('button_calculate_promotion_turnover');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VIEW_PLAYER_CONTACT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_CONTACT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_CONTACT;?>" name="permissions[]" value="<?php echo PERMISSION_VIEW_PLAYER_CONTACT;?>" <?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_CONTACT;?>">
														<?php echo $this->lang->line('button_view');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VIEW_PLAYER_CONTACT_V2]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_CONTACT_V2;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT_V2]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_CONTACT_V2;?>" name="permissions[]" value="<?php echo PERMISSION_VIEW_PLAYER_CONTACT_V2;?>" <?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT_V2]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VIEW_PLAYER_CONTACT_V2]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_CONTACT_V2;?>">
														<?php echo $this->lang->line('button_view');?> V2 &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VIEW_PLAYER_WALLET]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_VIEW_PLAYER_WALLET]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>" name="permissions[]" value="<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>" <?php echo (($permissions[PERMISSION_VIEW_PLAYER_WALLET]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VIEW_PLAYER_WALLET]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>">
														<?php echo $this->lang->line('title_player_wallet');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_GAME_TRANSFER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_GAME_TRANSFER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>_<?php echo PERMISSION_PLAYER_GAME_TRANSFER;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_GAME_TRANSFER;?>" <?php echo (($permissions[PERMISSION_PLAYER_GAME_TRANSFER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_GAME_TRANSFER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>_<?php echo PERMISSION_PLAYER_GAME_TRANSFER;?>">
														<?php echo $this->lang->line('title_player_wallet_transfer');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_KICK_PLAYER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>" type="<?php echo (($permissions[PERMISSION_KICK_PLAYER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>_<?php echo PERMISSION_KICK_PLAYER;?>" name="permissions[]" value="<?php echo PERMISSION_KICK_PLAYER;?>" <?php echo (($permissions[PERMISSION_KICK_PLAYER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_KICK_PLAYER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_VIEW_PLAYER_WALLET;?>_<?php echo PERMISSION_KICK_PLAYER;?>">
														<?php echo $this->lang->line('title_kick_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CHANGE_PASSWORD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>" name="permissions[]" value="<?php echo PERMISSION_CHANGE_PASSWORD;?>" <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>">
														<?php echo $this->lang->line('title_change_password');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_POINT_TO_DOWNLINE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_POINT_TO_DOWNLINE;?>">
														<?php echo $this->lang->line('button_deposit_points');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>" <?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE;?>">
														<?php echo $this->lang->line('button_withdraw_points');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_POINT_ADJUSTMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_POINT_ADJUSTMENT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_POINT_ADJUSTMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_POINT_ADJUSTMENT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_POINT_ADJUSTMENT;?>" <?php echo (($permissions[PERMISSION_PLAYER_POINT_ADJUSTMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_POINT_ADJUSTMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_POINT_ADJUSTMENT;?>">
														<?php echo $this->lang->line('button_point_adjustment');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_ADD;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_ADD;?>">
														<?php echo $this->lang->line('button_deposit_offline');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_ADD;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_ADD;?>">
														<?php echo $this->lang->line('button_withdrawal_offline');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_APPROVE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_APPROVE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_APPROVE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_APPROVE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_APPROVE_ADD;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_APPROVE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_APPROVE_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_DEPOSIT_APPROVE_ADD;?>">
														<?php echo $this->lang->line('button_deposit_offline');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_APPROVE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_APPROVE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_APPROVE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_APPROVE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_APPROVE_ADD;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_APPROVE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_APPROVE_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_APPROVE_ADD;?>">
														<?php echo $this->lang->line('button_withdrawal_offline');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REWARD_DEDUCT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REWARD_DEDUCT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_REWARD_DEDUCT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_REWARD_DEDUCT;?>" name="permissions[]" value="<?php echo PERMISSION_REWARD_DEDUCT;?>" <?php echo (($permissions[PERMISSION_REWARD_DEDUCT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REWARD_DEDUCT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_REWARD_DEDUCT;?>">
														<?php echo $this->lang->line('button_reward_deduct');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>" <?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>">
														<?php echo $this->lang->line('button_player_daily_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>">
														<?php echo $this->lang->line('player_bank_list');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>">
														<?php echo $this->lang->line('button_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>" <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>">
														<?php echo $this->lang->line('title_player_bank_image');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>">
														<?php echo $this->lang->line('button_edit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>">
														<?php echo $this->lang->line('button_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>">
														<?php echo $this->lang->line('title_wallet_transaction_pending');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>" <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WHITELIST_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WHITELIST_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WHITELIST_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WHITELIST_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_WHITELIST_ADD;?>" <?php echo (($permissions[PERMISSION_WHITELIST_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WHITELIST_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_WHITELIST_ADD;?>">
														<?php echo $this->lang->line('button_add_whitelist');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_KICK_PLAYER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_KICK_PLAYER;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_KICK_PLAYER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_KICK_PLAYER;?>" name="permissions[]" value="<?php echo PERMISSION_KICK_PLAYER;?>" <?php echo (($permissions[PERMISSION_KICK_PLAYER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_KICK_PLAYER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_KICK_PLAYER;?>">
														<?php echo $this->lang->line('button_kick_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO;?>" <?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO;?>">
														<?php echo $this->lang->line('button_additional_info');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO;?>" <?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO;?>">
														<?php echo $this->lang->line('button_additional_detail_info');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('button_promotion_unsattle');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>  sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('button_promotion_unsattle');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_REPORT_EXPORT_EXCEL;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('label_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_MODIFY]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_MODIFY;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_MODIFY]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_MODIFY;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_MODIFY;?>" <?php echo (($permissions[PERMISSION_TAG_MODIFY]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_MODIFY]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_MODIFY;?>">
														<?php echo $this->lang->line('label_tag_modify');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_MODIFY]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_MODIFY;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_MODIFY]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_MODIFY;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_MODIFY;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_MODIFY]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_MODIFY]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_MODIFY;?>">
														<?php echo $this->lang->line('label_tag_player_modify');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>">
														<?php echo $this->lang->line('player_label_setup');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_ADD;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_DELETE;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?> sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>">
														<?php echo $this->lang->line('label_update_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_PLAYER_MOBILE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_MOBILE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_MOBILE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_MOBILE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_MOBILE;?>" <?php echo (($permissions[PERMISSION_PLAYER_MOBILE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_MOBILE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_MOBILE;?>">
														<?php echo $this->lang->line('label_mobile');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_LINE_ID]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_LINE_ID;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_LINE_ID]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_LINE_ID;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_LINE_ID;?>" <?php echo (($permissions[PERMISSION_PLAYER_LINE_ID]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_LINE_ID]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_LINE_ID;?>">
														<?php echo $this->lang->line('im_line');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_NICKNAME]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_NICKNAME;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_NICKNAME]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_NICKNAME;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_NICKNAME;?>" <?php echo (($permissions[PERMISSION_PLAYER_NICKNAME]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_NICKNAME]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_NICKNAME;?>">
														<?php echo $this->lang->line('label_nickname');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_EMAIL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_EMAIL;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_EMAIL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_EMAIL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_EMAIL;?>" <?php echo (($permissions[PERMISSION_PLAYER_EMAIL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_EMAIL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_EMAIL;?>">
														<?php echo $this->lang->line('label_email');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_ACCOUNT_NAME]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_ACCOUNT_NAME;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_ACCOUNT_NAME]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_ACCOUNT_NAME;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_ACCOUNT_NAME;?>" <?php echo (($permissions[PERMISSION_PLAYER_ACCOUNT_NAME]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_ACCOUNT_NAME]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_VIEW;?>_<?php echo PERMISSION_PLAYER_ACCOUNT_NAME;?>">
														<?php echo $this->lang->line('label_bank_account_name');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_PLAYER_AGENT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_AGENT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_AGENT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_AGENT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_AGENT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>">
														<?php echo $this->lang->line('title_player_agent');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_LIST_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_LIST_EXPORT_EXCEL;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_LIST_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_LIST_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_LIST_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_LIST_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('label_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_AGENT_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_AGENT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_AGENT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_AGENT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_AGENT_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_AGENT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_AGENT_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_AGENT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_AGENT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_AGENT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_AGENT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_AGENT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_AGENT_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_AGENT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_AGENT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_PLAYER_AGENT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CHANGE_PASSWORD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>" name="permissions[]" value="<?php echo PERMISSION_CHANGE_PASSWORD;?>" <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CHANGE_PASSWORD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_CHANGE_PASSWORD;?>">
														<?php echo $this->lang->line('title_change_password');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_transaction_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>" name="permissions[]" value="<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>" <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>">
														<?php echo $this->lang->line('title_win_loss_report_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_AGENT_PLAYER_USER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_AGENT_PLAYER_USER_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_AGENT_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_BANK_AGENT_PLAYER_USER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_AGENT_PLAYER_USER_VIEW;?>" <?php echo (($permissions[PERMISSION_BANK_AGENT_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_AGENT_PLAYER_USER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_BANK_AGENT_PLAYER_USER_VIEW;?>">
														<?php echo $this->lang->line('title_bank_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW;?>" <?php echo (($permissions[PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW;?>">
														<?php echo $this->lang->line('title_deposit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LOGIN_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LOGIN_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LOGIN_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_LOGIN_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_LOGIN_REPORT;?>" <?php echo (($permissions[PERMISSION_LOGIN_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LOGIN_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_AGENT_VIEW;?>_<?php echo PERMISSION_LOGIN_REPORT;?>">
														<?php echo $this->lang->line('title_login_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_VIEW;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>">
														<?php echo $this->lang->line('title_deposit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_VIEW_ALL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_VIEW_ALL;?> checkbox_option sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_VIEW_ALL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_VIEW_ALL;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_VIEW_ALL;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_VIEW_ALL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_VIEW_ALL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_VIEW_ALL;?>">
														<?php echo $this->lang->line('label_all');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_UPDATE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('title_player_promotion');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?> sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?> sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_DEPOSIT_VIEW;?> sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>">
														<?php echo $this->lang->line('button_bet_detail');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_VIEW;?>_<?php echo PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('label_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_WITHDRAWAL_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WITHDRAWAL_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_HOME;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>">
														<?php echo $this->lang->line('title_withdrawal');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_VIEW_ALL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_VIEW_ALL;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW_ALL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_VIEW_ALL;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_VIEW_ALL;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW_ALL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_VIEW_ALL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_VIEW_ALL;?>">
														<?php echo $this->lang->line('label_all');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_UPDATE;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('button_promotion_unsattle');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>  sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('button_edit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>" <?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_DAILY_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_PLAYER_DAILY_REPORT;?>">
														<?php echo $this->lang->line('button_player_daily_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('label_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<!-- 
										<?php if($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>">
														<?php echo $this->lang->line('title_bank_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_ADD;?>">
														<?php echo $this->lang->line('button_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>" <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_IMAGE;?>">
														<?php echo $this->lang->line('title_player_bank_image');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_UPDATE;?>">
														<?php echo $this->lang->line('button_edit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?> sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>" type="<?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>" <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_PLAYER_USER_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_BANK_PLAYER_USER_DELETE;?>">
														<?php echo $this->lang->line('button_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?> sub_permissions_<?php echo PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_PLAYER_USER_VIEW;?>_<?php echo PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE;?>">
														<?php echo $this->lang->line('title_withdrawal_count_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										-->
										<!-- <?php if($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>">
														<?php echo $this->lang->line('title_player_bonus');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_ADD;?>">
														<?php echo $this->lang->line('button_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>">
														<?php echo $this->lang->line('button_edit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>	
										<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('title_player_promotion');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>">
														<?php echo $this->lang->line('label_add_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>">
														<?php echo $this->lang->line('label_update_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>">
														<?php echo $this->lang->line('button_bet_detail');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?> -->
										<?php if($permissions[PERMISSION_WIN_LOSS_REPORT]['upline'] == TRUE || $permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == TRUE || $permissions[PERMISSION_YEARLY_REPORT]['upline'] == TRUE || $permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == TRUE || $permissions[PERMISSION_POINT_TRANSACTION_REPORT]['upline'] == TRUE || $permissions[PERMISSION_CASH_TRANSACTION_REPORT]['upline'] == TRUE || $permissions[PERMISSION_REWARD_TRANSACTION_REPORT]['upline'] == TRUE || $permissions[PERMISSION_VERIFY_CODE_REPORT]['upline'] == TRUE || $permissions[PERMISSION_WALLET_TRANSACTION_REPORT]['upline'] == TRUE || $permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == TRUE || $permissions[PERMISSION_LOGIN_REPORT]['upline'] == TRUE || $permissions[PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT]['upline'] == TRUE || $permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT]['upline'] == TRUE || $permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('title_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WIN_LOSS_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WIN_LOSS_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_WIN_LOSS_REPORT;?>" <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT;?>">
														<?php echo $this->lang->line('title_win_loss_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_WIN_LOSS_REPORT;?>" type="<?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>" name="permissions[]" value="<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>" <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WIN_LOSS_REPORT_PLAYER]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>">
														<?php echo $this->lang->line('title_win_loss_report_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>" type="<?php echo (($permissions[PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>_<?php echo PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WIN_LOSS_REPORT_PLAYER;?>_<?php echo PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_YEARLY_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_YEARLY_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_YEARLY_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_YEARLY_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_YEARLY_REPORT;?>" <?php echo (($permissions[PERMISSION_YEARLY_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_YEARLY_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_YEARLY_REPORT;?>">
														<?php echo $this->lang->line('title_yearly_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_YEARLY_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_YEARLY_REPORT;?>" type="<?php echo (($permissions[PERMISSION_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_YEARLY_REPORT;?>_<?php echo PERMISSION_YEARLY_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_YEARLY_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_YEARLY_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_YEARLY_REPORT;?>_<?php echo PERMISSION_YEARLY_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>" <?php echo (($permissions[PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>">
														<?php echo $this->lang->line('title_withdraw_verify_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>_<?php echo PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT;?>_<?php echo PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>" <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>">
														<?php echo $this->lang->line('title_register_deposit_rate_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>" type="<?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>" <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>">
														<?php echo $this->lang->line('title_register_deposit_rate_yearly_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>" type="<?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT;?>_<?php echo PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_transaction_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_TRANSACTION_REPORT;?>" type="<?php echo (($permissions[PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>_<?php echo PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TRANSACTION_REPORT;?>_<?php echo PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_POINT_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_POINT_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_POINT_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_POINT_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_point_transaction_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_POINT_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_POINT_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>" type="<?php echo (($permissions[PERMISSION_POINT_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>_<?php echo PERMISSION_POINT_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_POINT_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_POINT_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_POINT_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_POINT_TRANSACTION_REPORT;?>_<?php echo PERMISSION_POINT_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CASH_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_CASH_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_CASH_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CASH_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_cash_transaction_report_newBO');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CASH_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CASH_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>" type="<?php echo (($permissions[PERMISSION_CASH_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>_<?php echo PERMISSION_CASH_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_CASH_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_CASH_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CASH_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_CASH_TRANSACTION_REPORT;?>_<?php echo PERMISSION_CASH_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REWARD_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_REWARD_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_REWARD_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REWARD_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_reward_transaction_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REWARD_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REWARD_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>" type="<?php echo (($permissions[PERMISSION_REWARD_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>_<?php echo PERMISSION_REWARD_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_REWARD_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_REWARD_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REWARD_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_REWARD_TRANSACTION_REPORT;?>_<?php echo PERMISSION_REWARD_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VERIFY_CODE_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VERIFY_CODE_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_VERIFY_CODE_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_VERIFY_CODE_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_VERIFY_CODE_REPORT;?>" <?php echo (($permissions[PERMISSION_VERIFY_CODE_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VERIFY_CODE_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_VERIFY_CODE_REPORT;?>">
														<?php echo $this->lang->line('title_verify_code_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_VERIFY_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_VERIFY_CODE_REPORT;?>" type="<?php echo (($permissions[PERMISSION_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_VERIFY_CODE_REPORT;?>_<?php echo PERMISSION_VERIFY_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_VERIFY_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_VERIFY_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_VERIFY_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_VERIFY_CODE_REPORT;?>_<?php echo PERMISSION_VERIFY_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WALLET_TRANSACTION_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>" <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>">
														<?php echo $this->lang->line('title_wallet_transaction_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WALLET_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>" type="<?php echo (($permissions[PERMISSION_WALLET_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>_<?php echo PERMISSION_WALLET_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_WALLET_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_WALLET_TRANSACTION_REPORT;?>_<?php echo PERMISSION_WALLET_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_RISK_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_RISK_REPORT;?>" <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>">
														<?php echo $this->lang->line('title_player_risk_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>_<?php echo PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PROCESS_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PROCESS_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_TAG_PROCESS_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TAG_PROCESS_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PROCESS_REPORT;?>" <?php echo (($permissions[PERMISSION_TAG_PROCESS_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PROCESS_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_TAG_PROCESS_REPORT;?>">
														<?php echo $this->lang->line('title_tag_process_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LOGIN_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LOGIN_REPORT;?> checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>" type="<?php echo (($permissions[PERMISSION_LOGIN_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_LOGIN_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_LOGIN_REPORT;?>" <?php echo (($permissions[PERMISSION_LOGIN_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LOGIN_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_LOGIN_REPORT;?>">
														<?php echo $this->lang->line('title_login_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL;?> main_permissions checkbox_option sub_permissions_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?> sub_permissions_<?php echo PERMISSION_LOGIN_REPORT;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_LOGIN_REPORT;?>_<?php echo PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REPORT_EXPORT_EXCEL;?>_<?php echo PERMISSION_LOGIN_REPORT;?>_<?php echo PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_REWARD_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_REWARD_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REWARD_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_REWARD_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REWARD_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_REWARD_VIEW;?>" <?php echo (($permissions[PERMISSION_REWARD_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REWARD_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REWARD_VIEW;?>">
														<?php echo $this->lang->line('title_reward');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_REWARD_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_REWARD_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_REWARD_VIEW;?>" type="<?php echo (($permissions[PERMISSION_REWARD_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_REWARD_VIEW;?>_<?php echo PERMISSION_REWARD_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_REWARD_UPDATE;?>" <?php echo (($permissions[PERMISSION_REWARD_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_REWARD_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_REWARD_VIEW;?>_<?php echo PERMISSION_REWARD_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<!-- <?php if($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>">
														<?php echo $this->lang->line('title_wallet_transaction_pending');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>" <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_VIEW;?>_<?php echo PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?> -->
										<?php if($permissions[PERMISSION_FINGERPRINT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_FINGERPRINT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_FINGERPRINT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_FINGERPRINT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_FINGERPRINT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_FINGERPRINT_VIEW;?>" <?php echo (($permissions[PERMISSION_FINGERPRINT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_FINGERPRINT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_FINGERPRINT_VIEW;?>">
														<?php echo $this->lang->line('title_fingerprint');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_BLACKLIST_VIEW]['upline'] == TRUE || $permissions[PERMISSION_BLACKLIST_REPORT]['upline'] == TRUE || $permissions[PERMISSION_BLACKLIST_IMPORT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BLACKLIST_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLACKLIST_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_VIEW;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>">
														<?php echo $this->lang->line('title_blacklist');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLACKLIST_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_ADD;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLACKLIST_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_UPDATE;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLACKLIST_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_DELETE;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_VIEW;?>_<?php echo PERMISSION_BLACKLIST_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_BLACKLIST_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_REPORT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLACKLIST_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_REPORT;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_REPORT;?>">
														<?php echo $this->lang->line('title_blacklist_report');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_BLACKLIST_REPORT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_REPORT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_REPORT;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_REPORT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_REPORT;?>_<?php echo PERMISSION_BLACKLIST_REPORT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_REPORT_UPDATE;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_REPORT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_REPORT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_REPORT;?>_<?php echo PERMISSION_BLACKLIST_REPORT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>


												<?php if($permissions[PERMISSION_BLACKLIST_IMPORT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>">
														<?php echo $this->lang->line('title_blacklist_import');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_BLACKLIST_IMPORT_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_IMPORT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_IMPORT_ADD;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLACKLIST_IMPORT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_IMPORT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_IMPORT_UPDATE;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLACKLIST_IMPORT_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_IMPORT_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_IMPORT_DELETE;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_IMPORT_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_IMPORT_VIEW;?>_<?php echo PERMISSION_BLACKLIST_IMPORT_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_WHITELIST_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WHITELIST_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WHITELIST_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WHITELIST_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_WHITELIST_VIEW;?>" <?php echo (($permissions[PERMISSION_WHITELIST_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WHITELIST_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>">
														<?php echo $this->lang->line('title_whitelist');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_WHITELIST_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WHITELIST_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_WHITELIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WHITELIST_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_WHITELIST_ADD;?>" <?php echo (($permissions[PERMISSION_WHITELIST_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WHITELIST_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WHITELIST_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WHITELIST_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WHITELIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WHITELIST_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_WHITELIST_UPDATE;?>" <?php echo (($permissions[PERMISSION_WHITELIST_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WHITELIST_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WHITELIST_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WHITELIST_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WHITELIST_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WHITELIST_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_WHITELIST_DELETE;?>" <?php echo (($permissions[PERMISSION_WHITELIST_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WHITELIST_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WHITELIST_VIEW;?>_<?php echo PERMISSION_WHITELIST_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_VIEW]['upline'] == TRUE || $permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>">
														<?php echo $this->lang->line('title_message');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_ADD;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_UPDATE;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_DELETE;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_USER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_USER_ADD;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_ADD;?>">
														<?php echo $this->lang->line('button_send_message');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
											<div class="form-group row">
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>">
														<?php echo $this->lang->line('title_message_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT;?>">
														<?php echo $this->lang->line('label_view');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_USER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_USER_UPDATE;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SYSTEM_MESSAGE_USER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_SYSTEM_MESSAGE_USER_DELETE;?>" <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SYSTEM_MESSAGE_USER_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_VIEW;?>_<?php echo PERMISSION_SYSTEM_MESSAGE_USER_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_ADMIN_LOG_VIEW]['upline'] == TRUE || $permissions[PERMISSION_SUB_ACCOUNT_LOG_VIEW]['upline'] == TRUE || $permissions[PERMISSION_ADMIN_PLAYER_LOG_VIEW]['upline'] == TRUE || $permissions[PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_ADMIN_LOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ADMIN_LOG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_ADMIN_LOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ADMIN_LOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_ADMIN_LOG_VIEW;?>" <?php echo (($permissions[PERMISSION_ADMIN_LOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ADMIN_LOG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ADMIN_LOG_VIEW;?>">
														<?php echo $this->lang->line('title_admin_log');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SUB_ACCOUNT_LOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_ACCOUNT_LOG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SUB_ACCOUNT_LOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_LOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_ACCOUNT_LOG_VIEW;?>" <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_LOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_LOG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_LOG_VIEW;?>">
														<?php echo $this->lang->line('title_sub_account_log');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_ADMIN_PLAYER_LOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ADMIN_PLAYER_LOG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_ADMIN_PLAYER_LOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ADMIN_PLAYER_LOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_ADMIN_PLAYER_LOG_VIEW;?>" <?php echo (($permissions[PERMISSION_ADMIN_PLAYER_LOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ADMIN_PLAYER_LOG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ADMIN_PLAYER_LOG_VIEW;?>">
														<?php echo $this->lang->line('title_admin_player_log');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW;?>" <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW;?>">
														<?php echo $this->lang->line('title_sub_account_player_log');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_BLOG_VIEW]['upline'] == TRUE || $permissions[PERMISSION_BLOG_CATEGORY_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BLOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_VIEW;?>" <?php echo (($permissions[PERMISSION_BLOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_VIEW;?>">
														<?php echo $this->lang->line('label_blog');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_FRONTEND_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_FRONTEND_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_FRONTEND_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_FRONTEND_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_FRONTEND_VIEW;?>" <?php echo (($permissions[PERMISSION_BLOG_FRONTEND_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_FRONTEND_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_FRONTEND_VIEW;?>">
														<?php echo $this->lang->line('label_view');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_ADD;?>" <?php echo (($permissions[PERMISSION_BLOG_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_UPDATE;?>" <?php echo (($permissions[PERMISSION_BLOG_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_DELETE;?>" <?php echo (($permissions[PERMISSION_BLOG_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_VIEW;?>_<?php echo PERMISSION_BLOG_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_CATEGORY_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLOG_CATEGORY_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>" <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>">
														<?php echo $this->lang->line('title_blog_category');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_CATEGORY_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_CATEGORY_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_CATEGORY_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_CATEGORY_ADD;?>" <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_CATEGORY_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_CATEGORY_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_CATEGORY_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_CATEGORY_UPDATE;?>" <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BLOG_CATEGORY_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLOG_CATEGORY_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BLOG_CATEGORY_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BLOG_CATEGORY_DELETE;?>" <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLOG_CATEGORY_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLOG_CATEGORY_VIEW;?>_<?php echo PERMISSION_BLOG_CATEGORY_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
									</div>
									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('title_system_setting');?></label>
									</div>
									<div class="form-group row">
										<?php if($permissions[PERMISSION_AVATAR_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_AVATAR_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_AVATAR_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_AVATAR_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_AVATAR_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_AVATAR_VIEW;?>" <?php echo (($permissions[PERMISSION_AVATAR_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_AVATAR_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_AVATAR_VIEW;?>">
														<?php echo $this->lang->line('title_avatar');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_AVATAR_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_AVATAR_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_AVATAR_VIEW;?>" type="<?php echo (($permissions[PERMISSION_AVATAR_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_AVATAR_ADD;?>" <?php echo (($permissions[PERMISSION_AVATAR_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_AVATAR_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_AVATAR_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_AVATAR_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_AVATAR_VIEW;?>" type="<?php echo (($permissions[PERMISSION_AVATAR_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_AVATAR_UPDATE;?>" <?php echo (($permissions[PERMISSION_AVATAR_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_AVATAR_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_AVATAR_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_AVATAR_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_AVATAR_VIEW;?>" type="<?php echo (($permissions[PERMISSION_AVATAR_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_AVATAR_DELETE;?>" <?php echo (($permissions[PERMISSION_AVATAR_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_AVATAR_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_AVATAR_VIEW;?>_<?php echo PERMISSION_AVATAR_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										
										<?php if($permissions[PERMISSION_CURRENCIES_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_CURRENCIES_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CURRENCIES_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_CURRENCIES_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_CURRENCIES_VIEW;?>" <?php echo (($permissions[PERMISSION_CURRENCIES_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CURRENCIES_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>">
														<?php echo $this->lang->line('title_currencies');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CURRENCIES_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CURRENCIES_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_CURRENCIES_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CURRENCIES_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_CURRENCIES_ADD;?>" <?php echo (($permissions[PERMISSION_CURRENCIES_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CURRENCIES_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CURRENCIES_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CURRENCIES_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_CURRENCIES_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CURRENCIES_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_CURRENCIES_UPDATE;?>" <?php echo (($permissions[PERMISSION_CURRENCIES_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CURRENCIES_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CURRENCIES_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CURRENCIES_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_CURRENCIES_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CURRENCIES_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_CURRENCIES_DELETE;?>" <?php echo (($permissions[PERMISSION_CURRENCIES_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CURRENCIES_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CURRENCIES_VIEW;?>_<?php echo PERMISSION_CURRENCIES_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_GAME_MAINTENANCE_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_GAME_MAINTENANCE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>" <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>">
														<?php echo $this->lang->line('title_game_maintenance');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_GAME_MAINTENANCE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GAME_MAINTENANCE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_GAME_MAINTENANCE_ADD;?>" <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_GAME_MAINTENANCE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GAME_MAINTENANCE_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_GAME_MAINTENANCE_UPDATE;?>" <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_GAME_MAINTENANCE_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GAME_MAINTENANCE_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_GAME_MAINTENANCE_DELETE;?>" <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GAME_MAINTENANCE_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GAME_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_GAME_MAINTENANCE_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_USER_ROLE_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_USER_ROLE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_ROLE_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_USER_ROLE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_USER_ROLE_VIEW;?>" <?php echo (($permissions[PERMISSION_USER_ROLE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_ROLE_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>">
														<?php echo $this->lang->line('title_user_role');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_USER_ROLE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_ROLE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_ROLE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_USER_ROLE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_USER_ROLE_ADD;?>" <?php echo (($permissions[PERMISSION_USER_ROLE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_ROLE_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_USER_ROLE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_ROLE_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_ROLE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_USER_ROLE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_USER_ROLE_UPDATE;?>" <?php echo (($permissions[PERMISSION_USER_ROLE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_ROLE_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_USER_ROLE_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_USER_ROLE_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_USER_ROLE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_USER_ROLE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_USER_ROLE_DELETE;?>" <?php echo (($permissions[PERMISSION_USER_ROLE_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_USER_ROLE_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_USER_ROLE_VIEW;?>_<?php echo PERMISSION_USER_ROLE_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_MATCH_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_MATCH_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_MATCH_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_MATCH_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_MATCH_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_MATCH_VIEW;?>" <?php echo (($permissions[PERMISSION_MATCH_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_MATCH_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MATCH_VIEW;?>">
														<?php echo $this->lang->line('title_match');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_MATCH_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_MATCH_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_MATCH_VIEW;?>" type="<?php echo (($permissions[PERMISSION_MATCH_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_MATCH_ADD;?>" <?php echo (($permissions[PERMISSION_MATCH_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_MATCH_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_MATCH_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_MATCH_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_MATCH_VIEW;?>" type="<?php echo (($permissions[PERMISSION_MATCH_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_MATCH_UPDATE;?>" <?php echo (($permissions[PERMISSION_MATCH_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_MATCH_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_MATCH_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_MATCH_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_MATCH_VIEW;?>" type="<?php echo (($permissions[PERMISSION_MATCH_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_MATCH_DELETE;?>" <?php echo (($permissions[PERMISSION_MATCH_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_MATCH_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MATCH_VIEW;?>_<?php echo PERMISSION_MATCH_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_MISCELLANEOUS_UPDATE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_MISCELLANEOUS_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_MISCELLANEOUS_UPDATE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_MISCELLANEOUS_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_MISCELLANEOUS_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_MISCELLANEOUS_UPDATE;?>" <?php echo (($permissions[PERMISSION_MISCELLANEOUS_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_MISCELLANEOUS_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MISCELLANEOUS_UPDATE;?>">
														<?php echo $this->lang->line('title_miscellaneous');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										
										<?php if($permissions[PERMISSION_CONTENT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_CONTENT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTENT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_CONTENT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTENT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_CONTENT_VIEW;?>" <?php echo (($permissions[PERMISSION_CONTENT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTENT_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTENT_VIEW;?>">
														<?php echo $this->lang->line('title_content');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CONTENT_FRONTEND_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTENT_FRONTEND_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_CONTENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CONTENT_FRONTEND_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_FRONTEND_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_CONTENT_FRONTEND_VIEW;?>" <?php echo (($permissions[PERMISSION_CONTENT_FRONTEND_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTENT_FRONTEND_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_FRONTEND_VIEW;?>">
														<?php echo $this->lang->line('label_view');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CONTENT_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTENT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_CONTENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CONTENT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_CONTENT_ADD;?>" <?php echo (($permissions[PERMISSION_CONTENT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTENT_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CONTENT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTENT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_CONTENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CONTENT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_CONTENT_UPDATE;?>" <?php echo (($permissions[PERMISSION_CONTENT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTENT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CONTENT_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTENT_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_CONTENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CONTENT_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_CONTENT_DELETE;?>" <?php echo (($permissions[PERMISSION_CONTENT_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTENT_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTENT_VIEW;?>_<?php echo PERMISSION_CONTENT_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_TAG_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_TAG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_TAG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_VIEW;?>" <?php echo (($permissions[PERMISSION_TAG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_VIEW;?>">
														<?php echo $this->lang->line('title_tag');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_ADD;?>" <?php echo (($permissions[PERMISSION_TAG_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_UPDATE;?>" <?php echo (($permissions[PERMISSION_TAG_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_DELETE;?>" <?php echo (($permissions[PERMISSION_TAG_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_VIEW;?>_<?php echo PERMISSION_TAG_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<!-- 
										<?php if($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_VIEW]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>">
														<?php echo $this->lang->line('title_tag_player');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_ADD;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_ADD]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_DELETE;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?> checkbox_option sub_permissions_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>" name="permissions[]" value="<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>" <?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_TAG_PLAYER_BULK_MODIFY]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_TAG_PLAYER_VIEW;?>_<?php echo PERMISSION_TAG_PLAYER_BULK_MODIFY;?>">
														<?php echo $this->lang->line('label_update_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?> 
										-->
									</div>
									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('title_announcement');?></label>
									</div>
									<div class="form-group row">
										<?php if($permissions[PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_deposit_offline');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_deposit_online');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_deposit_credit_card');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_deposit_hypermart');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_withdrawal');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_BLACKLIST_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BLACKLIST_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BLACKLIST_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BLACKLIST_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BLACKLIST_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_BLACKLIST_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_BLACKLIST_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BLACKLIST_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BLACKLIST_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_blacklist');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_RISK_REPORT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_RISK_REPORT;?>" <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_RISK_REPORT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_RISK_REPORT;?>">
														<?php echo $this->lang->line('announcement_risk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT;?>" <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT;?>">
														<?php echo $this->lang->line('announcement_player_bank_image');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
									</div>

									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('reward_management_category');?></label>
									</div>
									<div class="form-group row">
										<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('title_player_promotion');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_ADD;?>">
														<?php echo $this->lang->line('label_add_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BULK_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BULK_UPDATE;?>">
														<?php echo $this->lang->line('label_update_bulk');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_BET_DETAIL]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_BET_DETAIL;?>">
														<?php echo $this->lang->line('button_bet_detail');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>" <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_PROMOTION_VIEW;?>_<?php echo PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL;?>">
														<?php echo $this->lang->line('button_export');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>">
														<?php echo $this->lang->line('title_player_bonus');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BONUS_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_ADD;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_ADD;?>">
														<?php echo $this->lang->line('button_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>" <?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PLAYER_BONUS_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PLAYER_BONUS_VIEW;?>_<?php echo PERMISSION_PLAYER_BONUS_UPDATE;?>">
														<?php echo $this->lang->line('button_edit');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>	

										<?php if($permissions[PERMISSION_PROMOTION_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PROMOTION_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PROMOTION_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PROMOTION_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PROMOTION_VIEW;?>" <?php echo (($permissions[PERMISSION_PROMOTION_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PROMOTION_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>">
														<?php echo $this->lang->line('title_promotion');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PROMOTION_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PROMOTION_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PROMOTION_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PROMOTION_ADD;?>" <?php echo (($permissions[PERMISSION_PROMOTION_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PROMOTION_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PROMOTION_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PROMOTION_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PROMOTION_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PROMOTION_UPDATE;?>" <?php echo (($permissions[PERMISSION_PROMOTION_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PROMOTION_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PROMOTION_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PROMOTION_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PROMOTION_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PROMOTION_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_PROMOTION_DELETE;?>" <?php echo (($permissions[PERMISSION_PROMOTION_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PROMOTION_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PROMOTION_VIEW;?>_<?php echo PERMISSION_PROMOTION_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_BONUS_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BONUS_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BONUS_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BONUS_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BONUS_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_VIEW;?>" <?php echo (($permissions[PERMISSION_BONUS_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BONUS_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BONUS_VIEW;?>">
														<?php echo $this->lang->line('title_bonus');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BONUS_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BONUS_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BONUS_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_ADD;?>" <?php echo (($permissions[PERMISSION_BONUS_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BONUS_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BONUS_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BONUS_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BONUS_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_UPDATE;?>" <?php echo (($permissions[PERMISSION_BONUS_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BONUS_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BONUS_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BONUS_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BONUS_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BONUS_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BONUS_DELETE;?>" <?php echo (($permissions[PERMISSION_BONUS_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BONUS_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BONUS_VIEW;?>_<?php echo PERMISSION_BONUS_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_LEVEL_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_LEVEL_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_LEVEL_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_VIEW;?>" <?php echo (($permissions[PERMISSION_LEVEL_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>">
														<?php echo $this->lang->line('vip_setup');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LEVEL_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_ADD;?>" <?php echo (($permissions[PERMISSION_LEVEL_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LEVEL_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_UPDATE;?>" <?php echo (($permissions[PERMISSION_LEVEL_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LEVEL_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_DELETE;?>" <?php echo (($permissions[PERMISSION_LEVEL_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_LEVEL_EXECUTE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>">
														<?php echo $this->lang->line('title_player_rating_job');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_LEVEL_EXECUTE_ADD]['checked'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?> sub_permissions_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_EXECUTE_ADD;?>" <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_LEVEL_EXECUTE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?> sub_permissions_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_EXECUTE_UPDATE;?>" <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_EXECUTE_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_UPDATE;?>">
														<?php echo $this->lang->line('button_approve');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_LEVEL_LOG_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 60px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?> sub_permissions_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_LOG_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_LOG_VIEW;?>" <?php echo (($permissions[PERMISSION_LEVEL_LOG_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_LOG_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_VIEW;?>">
														<?php echo $this->lang->line('button_log');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>

												<?php if($permissions[PERMISSION_LEVEL_LOG_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 90px;">
													├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?> permission_<?php echo PERMISSION_LEVEL_LOG_VIEW;?> checkbox_option sub_permissions_<?php echo PERMISSION_LEVEL_VIEW;?> sub_permissions_<?php echo PERMISSION_LEVEL_LOG_VIEW;?> sub_permissions_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_LEVEL_LOG_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_LOG_UPDATE;?>" <?php echo (($permissions[PERMISSION_LEVEL_LOG_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_LOG_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_VIEW;?>_<?php echo PERMISSION_LEVEL_EXECUTE_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_VIEW;?>_<?php echo PERMISSION_LEVEL_LOG_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

									</div>

									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('title_payment_bank');?></label>
									</div>
									<div class="form-group row">
									<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_VIEW]['upline'] == TRUE || $permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW]['upline'] == TRUE || $permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline'] == TRUE || $permissions[PERMISSION_GROUP_VIEW]['upline'] == TRUE || $permissions[PERMISSION_BANK_VIEW]['upline'] == TRUE || $permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>">
														<?php echo $this->lang->line('title_payment_gateway');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_UPDATE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_DELETE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
											
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>">
														<?php echo $this->lang->line('title_payment_limit_setup');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>

											<div class="form-group row">
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>">
														<?php echo $this->lang->line('title_payment_gateway_maintenance');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
											
											<div class="form-group row">
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>">
														<?php echo $this->lang->line('title_payment_gateway_player_amount');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>" type="<?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE;?>" <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW;?>_<?php echo PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>">
														<?php echo $this->lang->line('title_withdrawal_fee_setting');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_ADD;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_DELETE;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_FEE_RATE_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_VIEW;?>_<?php echo PERMISSION_WITHDRAWAL_FEE_RATE_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>

											<div class="form-group row">
												<?php if($permissions[PERMISSION_GROUP_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GROUP_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_GROUP_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GROUP_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_GROUP_VIEW;?>" <?php echo (($permissions[PERMISSION_GROUP_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GROUP_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GROUP_VIEW;?>">
														<?php echo $this->lang->line('title_group');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_GROUP_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GROUP_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_GROUP_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GROUP_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_GROUP_ADD;?>" <?php echo (($permissions[PERMISSION_GROUP_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GROUP_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_GROUP_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GROUP_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_GROUP_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GROUP_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_GROUP_UPDATE;?>" <?php echo (($permissions[PERMISSION_GROUP_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GROUP_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_GROUP_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_GROUP_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_GROUP_VIEW;?>" type="<?php echo (($permissions[PERMISSION_GROUP_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_GROUP_DELETE;?>" <?php echo (($permissions[PERMISSION_GROUP_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_GROUP_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_GROUP_VIEW;?>_<?php echo PERMISSION_GROUP_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_BANK_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BANK_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BANK_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_VIEW;?>" <?php echo (($permissions[PERMISSION_BANK_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_VIEW;?>">
														<?php echo $this->lang->line('title_bank');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_BANK_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_ADD;?>" <?php echo (($permissions[PERMISSION_BANK_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_BANK_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_UPDATE;?>" <?php echo (($permissions[PERMISSION_BANK_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_DELETE;?>" <?php echo (($permissions[PERMISSION_BANK_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_VIEW;?>_<?php echo PERMISSION_BANK_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>" <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>">
														<?php echo $this->lang->line('title_bank_account');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<!-- <?php if($permissions[PERMISSION_BANK_ACCOUNT_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_ACCOUNT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_ACCOUNT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_ACCOUNT_ADD;?>" <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?> -->
												<?php if($permissions[PERMISSION_BANK_ACCOUNT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_ACCOUNT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_ACCOUNT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_ACCOUNT_UPDATE;?>" <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANK_ACCOUNT_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_ACCOUNT_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANK_ACCOUNT_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_ACCOUNT_DELETE;?>" <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_ACCOUNT_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_ACCOUNT_VIEW;?>_<?php echo PERMISSION_BANK_ACCOUNT_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_GROUP_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											
										</div>
										<?php endif;?>

									</div>

									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('title_cms');?></label>
									</div>
									<div class="form-group row">
									<?php if($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline'] == TRUE || $permissions[PERMISSION_MARQUEE_VIEW]['upline'] == TRUE || $permissions[PERMISSION_SUB_GAME_VIEW]['upline'] == TRUE || $permissions[PERMISSION_BANNER_VIEW]['upline'] == TRUE || $permissions[PERMISSION_CONTACT_VIEW]['upline'] == TRUE|| $permissions[PERMISSION_SEO_VIEW]['upline'] == TRUE):?>
										
										<?php if($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>" <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>">
														<?php echo $this->lang->line('title_announcement');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_ANNOUNCEMENT_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ANNOUNCEMENT_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_ANNOUNCEMENT_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_ANNOUNCEMENT_ADD;?>" <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_ANNOUNCEMENT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ANNOUNCEMENT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_ANNOUNCEMENT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_ANNOUNCEMENT_UPDATE;?>" <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_ANNOUNCEMENT_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_ANNOUNCEMENT_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_ANNOUNCEMENT_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_ANNOUNCEMENT_DELETE;?>" <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_ANNOUNCEMENT_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_ANNOUNCEMENT_VIEW;?>_<?php echo PERMISSION_ANNOUNCEMENT_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<!-- This is MARQUEE -->
										<?php if ($permissions[PERMISSION_MARQUEE_VIEW]['upline'] == TRUE) : ?>

											<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">

												<div class="form-group row">

													<?php if ($permissions[PERMISSION_MARQUEE_VIEW]['upline'] == TRUE) : ?>

														<div class="form-group clearfix col-12">

															<div class="custom-control custom-checkbox d-inline">

																<input class="custom-control-input permission_<?php echo PERMISSION_MARQUEE_VIEW; ?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_MARQUEE_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox'); ?>" id="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>" name="permissions[]" value="<?php echo PERMISSION_MARQUEE_VIEW; ?>" <?php echo (($permissions[PERMISSION_MARQUEE_VIEW]['upline'] == FALSE) ? 'disabled' : ''); ?> <?php echo (($permissions[PERMISSION_MARQUEE_VIEW]['upline']) ? 'checked' : ''); ?>>

																<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>">

																	<?php echo $this->lang->line('title_marquee'); ?> &nbsp;

																</label>

															</div>

														</div>

													<?php endif; ?>

													<?php if ($permissions[PERMISSION_MARQUEE_ADD]['selected'] == TRUE) : ?>

														<div class="form-group clearfix col-12" style="padding-left: 30px;">

															├ <div class="custom-control custom-checkbox d-inline">

																<input class="custom-control-input permission_<?php echo PERMISSION_MARQUEE_ADD; ?> checkbox_option sub_permissions_<?php echo PERMISSION_MARQUEE_VIEW; ?>" type="<?php echo (($permissions[PERMISSION_MARQUEE_ADD]['upline'] == FALSE) ? 'button' : 'checkbox'); ?>" id="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_ADD; ?>" name="permissions[]" value="<?php echo PERMISSION_MARQUEE_ADD; ?>" <?php echo (($permissions[PERMISSION_MARQUEE_ADD]['upline'] == FALSE) ? 'disabled' : ''); ?> <?php echo (($permissions[PERMISSION_MARQUEE_ADD]['upline']) ? 'checked' : ''); ?>>

																<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_ADD; ?>">

																	<?php echo $this->lang->line('label_add'); ?> &nbsp;

																</label>

															</div>

														</div>

													<?php endif; ?>

													<?php if ($permissions[PERMISSION_MARQUEE_UPDATE]['upline'] == TRUE) : ?>

														<div class="form-group clearfix col-12" style="padding-left: 30px;">

															├ <div class="custom-control custom-checkbox d-inline">

																<input class="custom-control-input permission_<?php echo PERMISSION_MARQUEE_UPDATE; ?> checkbox_option sub_permissions_<?php echo PERMISSION_MARQUEE_VIEW; ?>" type="<?php echo (($permissions[PERMISSION_MARQUEE_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox'); ?>" id="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_UPDATE; ?>" name="permissions[]" value="<?php echo PERMISSION_MARQUEE_UPDATE; ?>" <?php echo (($permissions[PERMISSION_MARQUEE_UPDATE]['upline'] == FALSE) ? 'disabled' : ''); ?> <?php echo (($permissions[PERMISSION_MARQUEE_UPDATE]['selected']) ? 'checked' : ''); ?>>

																<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_UPDATE; ?>">

																	<?php echo $this->lang->line('label_update'); ?> &nbsp;

																</label>

															</div>

														</div>

													<?php endif; ?>

													<?php if ($permissions[PERMISSION_MARQUEE_DELETE]['upline'] == TRUE) : ?>

														<div class="form-group clearfix col-12" style="padding-left: 30px;">

															├ <div class="custom-control custom-checkbox d-inline">

																<input class="custom-control-input permission_<?php echo PERMISSION_MARQUEE_DELETE; ?> checkbox_option sub_permissions_<?php echo PERMISSION_MARQUEE_VIEW; ?>" type="<?php echo (($permissions[PERMISSION_MARQUEE_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox'); ?>" id="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_DELETE; ?>" name="permissions[]" value="<?php echo PERMISSION_MARQUEE_DELETE; ?>" <?php echo (($permissions[PERMISSION_MARQUEE_DELETE]['upline'] == FALSE) ? 'disabled' : ''); ?> <?php echo (($permissions[PERMISSION_MARQUEE_DELETE]['selected']) ? 'checked' : ''); ?>>

																<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_MARQUEE_VIEW; ?>_<?php echo PERMISSION_MARQUEE_DELETE; ?>">

																	<?php echo $this->lang->line('label_delete'); ?> &nbsp;

																</label>

															</div>

														</div>

													<?php endif; ?>

												</div>

											</div>

										<?php endif; ?>
										<!-- This is End MARQUEE -->

										<!-- This is Start Sub Game -->
										<?php if($permissions[PERMISSION_SUB_GAME_VIEW]['upline'] == TRUE):?>

										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">

											<div class="form-group row">

											<?php if($permissions[PERMISSION_SUB_GAME_VIEW]['upline'] == TRUE):?>

												<div class="form-group clearfix col-12">

													<div class="custom-control custom-checkbox d-inline">

														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_GAME_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SUB_GAME_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_GAME_VIEW;?>" <?php echo (($permissions[PERMISSION_SUB_GAME_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_GAME_VIEW]['upline']) ? 'checked' : '');?>>

														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>">

														<?php echo $this->lang->line('title_sub_game');?> &nbsp; 

														</label>

													</div>

												</div>

												<?php endif;?>

												<?php if($permissions[PERMISSION_SUB_GAME_ADD]['selected'] == TRUE):?>

												<div class="form-group clearfix col-12" style="padding-left: 30px;">

													├ <div class="custom-control custom-checkbox d-inline">

														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_GAME_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_GAME_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SUB_GAME_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_GAME_ADD;?>" <?php echo (($permissions[PERMISSION_SUB_GAME_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_GAME_ADD]['upline']) ? 'checked' : '');?>>

														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_ADD;?>">

														<?php echo $this->lang->line('label_add');?> &nbsp; 

														</label>

													</div>

												</div>

												<?php endif;?>

												<?php if($permissions[PERMISSION_SUB_GAME_UPDATE]['upline'] == TRUE):?>

												<div class="form-group clearfix col-12" style="padding-left: 30px;">

													├ <div class="custom-control custom-checkbox d-inline">

														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_GAME_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_GAME_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SUB_GAME_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_GAME_UPDATE;?>" <?php echo (($permissions[PERMISSION_SUB_GAME_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_GAME_UPDATE]['selected']) ? 'checked' : '');?>>

														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_UPDATE;?>">

														<?php echo $this->lang->line('label_update');?> &nbsp; 

														</label>

													</div>

												</div>

												<?php endif;?>

												<?php if($permissions[PERMISSION_SUB_GAME_DELETE]['upline'] == TRUE):?>

												<div class="form-group clearfix col-12" style="padding-left: 30px;">

													├ <div class="custom-control custom-checkbox d-inline">

														<input class="custom-control-input permission_<?php echo PERMISSION_SUB_GAME_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SUB_GAME_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SUB_GAME_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_SUB_GAME_DELETE;?>" <?php echo (($permissions[PERMISSION_SUB_GAME_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SUB_GAME_DELETE]['selected']) ? 'checked' : '');?>>

														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SUB_GAME_VIEW;?>_<?php echo PERMISSION_SUB_GAME_DELETE;?>">

														<?php echo $this->lang->line('label_delete');?> &nbsp; 

														</label>

													</div>

												</div>

												<?php endif;?>

											</div>

										</div>

										<?php endif; ?>
										<!-- This is End Sub Game -->
										
										<?php if($permissions[PERMISSION_BANNER_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BANNER_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANNER_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BANNER_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANNER_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_BANNER_VIEW;?>" <?php echo (($permissions[PERMISSION_BANNER_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANNER_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANNER_VIEW;?>">
														<?php echo $this->lang->line('title_banner');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANNER_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANNER_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANNER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANNER_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_BANNER_ADD;?>" <?php echo (($permissions[PERMISSION_BANNER_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANNER_ADD]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANNER_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANNER_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANNER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANNER_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_BANNER_UPDATE;?>" <?php echo (($permissions[PERMISSION_BANNER_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANNER_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_BANNER_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANNER_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_BANNER_VIEW;?>" type="<?php echo (($permissions[PERMISSION_BANNER_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_BANNER_DELETE;?>" <?php echo (($permissions[PERMISSION_BANNER_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANNER_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANNER_VIEW;?>_<?php echo PERMISSION_BANNER_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										
										<?php if($permissions[PERMISSION_CONTACT_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_CONTACT_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTACT_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_CONTACT_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTACT_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_CONTACT_VIEW;?>" <?php echo (($permissions[PERMISSION_CONTACT_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTACT_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTACT_VIEW;?>">
														<?php echo $this->lang->line('title_contact');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_CONTACT_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_CONTACT_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_CONTACT_VIEW;?>" type="<?php echo (($permissions[PERMISSION_CONTACT_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_CONTACT_VIEW;?>_<?php echo PERMISSION_CONTACT_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_CONTACT_UPDATE;?>" <?php echo (($permissions[PERMISSION_CONTACT_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_CONTACT_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_CONTACT_VIEW;?>_<?php echo PERMISSION_BANNER_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

										<?php if($permissions[PERMISSION_SEO_VIEW]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3 pt-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_SEO_VIEW]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SEO_VIEW;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_SEO_VIEW]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SEO_VIEW;?>" name="permissions[]" value="<?php echo PERMISSION_SEO_VIEW;?>" <?php echo (($permissions[PERMISSION_SEO_VIEW]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SEO_VIEW]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SEO_VIEW;?>">
														<?php echo $this->lang->line('title_seo');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SEO_ADD]['selected'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SEO_ADD;?> checkbox_option sub_permissions_<?php echo PERMISSION_SEO_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SEO_ADD]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_ADD;?>" name="permissions[]" value="<?php echo PERMISSION_SEO_ADD;?>" <?php echo (($permissions[PERMISSION_SEO_ADD]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SEO_UPDATE]['upline']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_ADD;?>">
														<?php echo $this->lang->line('label_add');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SEO_UPDATE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SEO_UPDATE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SEO_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SEO_UPDATE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_UPDATE;?>" name="permissions[]" value="<?php echo PERMISSION_SEO_UPDATE;?>" <?php echo (($permissions[PERMISSION_SEO_UPDATE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SEO_UPDATE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_UPDATE;?>">
														<?php echo $this->lang->line('label_update');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
												<?php if($permissions[PERMISSION_SEO_DELETE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12" style="padding-left: 30px;">
													 ├ <div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_SEO_DELETE;?> checkbox_option sub_permissions_<?php echo PERMISSION_SEO_VIEW;?>" type="<?php echo (($permissions[PERMISSION_SEO_DELETE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_DELETE;?>" name="permissions[]" value="<?php echo PERMISSION_SEO_DELETE;?>" <?php echo (($permissions[PERMISSION_SEO_DELETE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_SEO_DELETE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_SEO_VIEW;?>_<?php echo PERMISSION_SEO_DELETE;?>">
														<?php echo $this->lang->line('label_delete');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>

									<?php endif;?>
									</div>

									<div class="form-group row">
										<label for="remark" class="col-5 col-form-label"><?php echo $this->lang->line('title_special');?></label>
									</div>
									<div class="form-group row">
										<?php if($permissions[PERMISSION_DEPOSIT_OFFLINE_NOTICE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_OFFLINE_NOTICE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_NOTICE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_NOTICE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_NOTICE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_OFFLINE_NOTICE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_NOTICE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_OFFLINE_NOTICE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_OFFLINE_NOTICE;?>">
														<?php echo $this->lang->line('label_deposit_notice');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_ONLINE_NOTICE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_ONLINE_NOTICE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_ONLINE_NOTICE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_NOTICE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_ONLINE_NOTICE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_ONLINE_NOTICE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_NOTICE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_ONLINE_NOTICE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_ONLINE_NOTICE;?>">
														<?php echo $this->lang->line('label_online_deposit_notice');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE;?>">
														<?php echo $this->lang->line('label_credit_card_deposit_notice');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_DEPOSIT_HYPERMARKET_NOTICE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_DEPOSIT_HYPERMARKET_NOTICE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_NOTICE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_NOTICE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_NOTICE;?>" name="permissions[]" value="<?php echo PERMISSION_DEPOSIT_HYPERMARKET_NOTICE;?>" <?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_NOTICE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_DEPOSIT_HYPERMARKET_NOTICE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_DEPOSIT_HYPERMARKET_NOTICE;?>">
														<?php echo $this->lang->line('label_hypermart_deposit_notice');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_WITHDRAWAL_OFFLINE_NOTICE]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_WITHDRAWAL_OFFLINE_NOTICE]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_NOTICE;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_NOTICE]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_NOTICE;?>" name="permissions[]" value="<?php echo PERMISSION_WITHDRAWAL_OFFLINE_NOTICE;?>" <?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_NOTICE]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_WITHDRAWAL_OFFLINE_NOTICE]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_WITHDRAWAL_OFFLINE_NOTICE;?>">
														<?php echo $this->lang->line('label_withdrawal_notice');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_RISK_MANAGEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_RISK_MANAGEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_RISK_MANAGEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_RISK_MANAGEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_RISK_MANAGEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_RISK_MANAGEMENT;?>" <?php echo (($permissions[PERMISSION_RISK_MANAGEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_RISK_MANAGEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_RISK_MANAGEMENT;?>">
														<?php echo $this->lang->line('label_risk_management');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_FINGERPRINT_MANAGEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_FINGERPRINT_MANAGEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_FINGERPRINT_MANAGEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_FINGERPRINT_MANAGEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_FINGERPRINT_MANAGEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_FINGERPRINT_MANAGEMENT;?>" <?php echo (($permissions[PERMISSION_FINGERPRINT_MANAGEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_FINGERPRINT_MANAGEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_FINGERPRINT_MANAGEMENT;?>">
														<?php echo $this->lang->line('title_fingerprint');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_LEVEL_MANAGEMENT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_LEVEL_MANAGEMENT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_LEVEL_MANAGEMENT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_LEVEL_MANAGEMENT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_LEVEL_MANAGEMENT;?>" name="permissions[]" value="<?php echo PERMISSION_LEVEL_MANAGEMENT;?>" <?php echo (($permissions[PERMISSION_LEVEL_MANAGEMENT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_LEVEL_MANAGEMENT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_LEVEL_MANAGEMENT;?>">
														<?php echo $this->lang->line('title_level');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
										<?php if($permissions[PERMISSION_BANK_VERIFY_SUBMIT]['upline'] == TRUE):?>
										<div class="form-group clearfix col-12 col-sm-6 col-md-4 col-lg-3">
											<div class="form-group row">
												<?php if($permissions[PERMISSION_BANK_VERIFY_SUBMIT]['upline'] == TRUE):?>
												<div class="form-group clearfix col-12">
													<div class="custom-control custom-checkbox d-inline">
														<input class="custom-control-input permission_<?php echo PERMISSION_BANK_VERIFY_SUBMIT;?> checkbox_option main_permissions" type="<?php echo (($permissions[PERMISSION_BANK_VERIFY_SUBMIT]['upline'] == FALSE) ? 'button' : 'checkbox');?>" id="permission_<?php echo PERMISSION_BANK_VERIFY_SUBMIT;?>" name="permissions[]" value="<?php echo PERMISSION_BANK_VERIFY_SUBMIT;?>" <?php echo (($permissions[PERMISSION_BANK_VERIFY_SUBMIT]['upline'] == FALSE) ? 'disabled' : '');?> <?php echo (($permissions[PERMISSION_BANK_VERIFY_SUBMIT]['selected']) ? 'checked' : '');?>>
														<label class="custom-control-label font-weight-normal" for="permission_<?php echo PERMISSION_BANK_VERIFY_SUBMIT;?>">
														<?php echo $this->lang->line('label_bank_withdrawal_verify');?> &nbsp; 
														</label>
													</div>
												</div>
												<?php endif;?>
											</div>
										</div>
										<?php endif;?>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer row">
									<div class="col-5">
										<input type="hidden" id="user_role_id" name="user_role_id" value="<?php echo (isset($user_role_id) ? $user_role_id : '');?>">
										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('button_submit');?></button>
										<button type="button" id="button-cancel" class="btn btn-default ml-2"><?php echo $this->lang->line('button_cancel');?></button>
									</div>
									<div class="col-7 text-left pt-1">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input permission_<?php echo PERMISSION_HOME;?>" type="checkbox" id="checkall">
											<label for="checkall" class="custom-control-label font-weight-normal"><?php echo $this->lang->line('label_select_all');?></label>
										</div>
									</div>							
								</div>
								<!-- /.card-footer -->
							<?php echo form_close();?>
						</div>
						<!-- /.card -->
					</div>
					<!--/.col (left) -->
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<?php $this->load->view('parts/footer_js');?>

	<script type="text/javascript">
		$(document).ready(function() {
			var is_allowed = true;
			var form = $('#user_role-form');
			
			var index = parent.layer.getFrameIndex(window.name);
			
			$('#button-cancel').click(function() {
				parent.layer.close(index);
			});
			
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			});

			$.validator.setDefaults({
				submitHandler: function () {
					if(is_allowed == true) {
						is_allowed = false;
						
						$.ajax({url: form.attr('action'),
							data: form.serialize(),
							type: 'post',                  
							async: 'true',
							beforeSend: function() {
								layer.load(1);
							},
							complete: function() {
								layer.closeAll('loading');
								is_allowed = true;
							},
							success: function (data) {
								var json = JSON.parse(JSON.stringify(data));
								var message = '';
								var msg_icon = 2;
								
								parent.$('meta[name=csrf_token]').attr('content', json.csrfHash);
								$("input[name='" + json.csrfTokenName + "']").val(json.csrfHash);
								
								if(json.status == '<?php echo EXIT_SUCCESS;?>') {
									message = json.msg;
									msg_icon = 1;
									parent.$('#uc1_' + json.response.id).html(json.response.role_name);
									parent.$('#uc2_' + json.response.id).html(json.response.active);																		parent.$('#uc6_' + json.response.id).html(json.response.level);
									parent.$('#uc5_' + json.response.id).html(json.response.remark);
									parent.$('#uc3_' + json.response.id).html(json.response.updated_by);
									parent.$('#uc4_' + json.response.id).html(json.response.updated_date);
									if(json.response.active_code == '<?php echo STATUS_ACTIVE;?>') {
										parent.$('#uc2_' + json.response.id).removeClass('bg-secondary').addClass('bg-success');
									}
									else {
										parent.$('#uc2_' + json.response.id).removeClass('bg-success').addClass('bg-secondary');
									}
									parent.layer.close(index);
								}
								else {
									if(json.msg.role_name_error != '') {
										message = json.msg.role_name_error;
									}
									else if(json.msg.general_error != '') {
										message = json.msg.general_error;
									}
								}
								
								parent.layer.alert(message, {icon: msg_icon, title: '<?php echo $this->lang->line('label_info');?>', btn: '<?php echo $this->lang->line('button_close');?>'});
							},
							error: function (request,error){
							}
						});  
					}
				}
			});
			
			form.validate({
				rules: {
					role_name: {
						required: true
					},					level: {												required: true,						digits: true											},
				},
				messages: {
					role_name: {
						required: "<?php echo $this->lang->line('error_enter_name');?>",
					},					level: {						required: "<?php echo str_replace('%s', strtolower($this->lang->line('label_level')), $this->lang->line('error_select_level'));?>",						digits: "<?php echo str_replace('%s', strtolower($this->lang->line('label_level')), $this->lang->line('error_only_digits_allowed'));?>",					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}
			});
			


			$('#checkall').click(function(){
    			if($(this).is(':checked')){
    				$('.checkbox_option').prop( "checked", true);
    			}else{
    				$('.checkbox_option').prop( "checked", false);
    			}
    		});

    		$('.main_permissions').click(function(){
    			var id = $(this).val();
    			if($(this).is(':checked')){
    				$('.sub_permissions_'+id).prop( "checked", true);
    				$('.permission_'+id).prop( "checked", true);
    			}else{
    				$('.sub_permissions_'+id).prop( "checked", false);
    				$('.permission_'+id).prop( "checked", false);
    			}
    		});

    		$('.checkbox_option').click(function(){
    			var id = $(this).val();
    			if($(this).is(':checked')){
    				$('.permission_'+id).prop( "checked", true);
    			}else{
    				$('.permission_'+id).prop( "checked", false);
    			}
    		});
		});
	</script>
</body>
</html>