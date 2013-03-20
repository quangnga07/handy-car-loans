<div id="sidebar" class="clearfix">
	<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
	<ul>
		<li>
			<a href="<?php echo site_url('admin');?>"><i class="icon icon-home"></i> <span>Dashboard</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/search');?>"><i class="icon icon-search"></i> <span>Search</span></a>
		</li>
        <li>
			<a href="<?php echo site_url('admin/notification'); ?>">
				<i class="icon icon-exclamation-sign"></i> 
				<span>My Notifications</span>
				<?php echo ($this->session->userdata('notify_count') != 0)? '<span class="label label-important">'.$this->session->userdata('notify_count').'</span>' : '';?>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/incomplete_application');?>"><i class="icon icon-list-alt"></i> <span>1. Incomplete</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/required_documents');?>"><i class="icon icon-list-alt"></i> <span>2. Documents Required</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/staff_processing');?>"><i class="icon icon-list-alt"></i> <span>3. Staff Processing</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/supervisor_approval');?>"><i class="icon icon-list-alt"></i> <span>4. Supervisor Approval</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/archived');?>"><i class="icon icon-list-alt"></i> <span>5. Archive</span></a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/marketing_queue');?>"><i class="icon icon-list-alt"></i> <span>6. Marketing Queue</span></a>
		</li>

        <!--ACCESS CONTROL-->
        <?php //if($this->session->userdata['user_level'] != 3): ?>
        <br/><br/><br/>
        <!--<li class="submenu">-->
			<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							$check = false;
							if($access_controls[2]->supervisor == 1 || $access_controls[3]->supervisor == 1 || $access_controls[4]->supervisor == 1){
								echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-user"></i> <span>Users</span></a>';
								echo '	<ul>';
								$check = true;
							}
							if(isset($access_controls) && $access_controls[2]->supervisor == 1){
								echo '<li><a href="'.site_url('admin/create_user').'">Account Setup</a></li>';
							}
							if(isset($access_controls) && $access_controls[3]->supervisor == 1){
								echo '<li><a href="'.site_url('admin/access_controls').'">Access Controls </a></li>';
							}
							if(isset($access_controls) && $access_controls[4]->supervisor == 1){
								echo '<li><a href="'.site_url('admin/access_log').'">Access Log</a></li>';
							}
							if($check){
								echo '	</ul>';
								echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							$check = false;
							if($access_controls[2]->staff == 1 || $access_controls[3]->staff == 1 || $access_controls[4]->staff == 1){
								echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-user"></i> <span>Users</span></a>';
								echo '	<ul>';
								$check = true;
							}
							if($access_controls[2]->staff == 1){
								echo '<li><a href="'.site_url('admin/create_user').'">Account Setup</a></li>';
							}
							if($access_controls[3]->staff == 1){
								echo '<li><a href="'.site_url('admin/access_controls').'">Access Controls </a></li>';
							}
							if($access_controls[4]->staff == 1){
								echo '<li><a href="'.site_url('admin/access_log').'">Access Log</a></li>';
							}
							if($check){
								echo '	</ul>';
								echo '</li>';
							}
						}
					}
                }else{
                echo '<li class="submenu">'; 
                    echo '<a href="#"><i class="icon icon-user"></i> <span>Users</span></a>';
                    echo '	<ul>';
                    echo '		<li><a href="'.site_url('admin/create_user').'">Account Setup</a></li>';
                    echo '		<li><a href="'.site_url('admin/access_controls').'">Access Controls </a></li>';
                    echo '		<li><a href="'.site_url('admin/access_log').'">Access Log</a></li>';
                    echo '	</ul>';
                echo '</li>';
                }
            ?>
        <!--</li>
        <li class="submenu">-->
        	<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							$check = false;
							if($access_controls[5]->supervisor == 1 || $access_controls[6]->supervisor == 1 || $access_controls[7]->supervisor == 1 || $access_controls[8]->supervisor == 1 || $access_controls[9]->supervisor == 1){
								echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-wrench"></i> <span>Settings</span></a>';
								echo '	<ul>';
								$check = true;
							}
							if(isset($access_controls) && $access_controls[5]->supervisor == 1){
								echo '		<li><a href="'.site_url('admin/configure_fields').'">Field Control</a></li>';
							}
							if(isset($access_controls) && $access_controls[6]->supervisor == 1){
								echo '		<li><a href="'.site_url('admin/scores').'">Score & Rank </a></li>';
							}
							if(isset($access_controls) && $access_controls[7]->supervisor == 1){
								echo '		<li><a href="'.site_url('admin/configure/pre_set_messages').'">Pre-Set Messages</a></li>';
							}
							if(isset($access_controls) && $access_controls[8]->supervisor == 1){
								echo '		<li><a href="'.site_url('admin/configure/email_template').'">Email Templates</a></li>';
							}
							if(isset($access_controls) && $access_controls[9]->supervisor == 1){
								echo '		<li><a href="'.site_url('admin/terms').'">T&C Version Control</a></li>';
							}
							if($check){
								echo '	</ul>';
								echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							$check = false;
							if($access_controls[5]->staff == 1 || $access_controls[6]->staff == 1 || $access_controls[7]->staff == 1 || $access_controls[8]->staff == 1 || $access_controls[9]->staff == 1){
								echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-wrench"></i> <span>Settings</span></a>';
								echo '	<ul>';
								$check = true;
							}
							if(isset($access_controls) && $access_controls[5]->staff == 1){
								echo '		<li><a href="'.site_url('admin/configure_fields').'">Field Control</a></li>';
							}
							if(isset($access_controls) && $access_controls[6]->staff == 1){
								echo '		<li><a href="'.site_url('admin/scores').'">Score & Rank </a></li>';
							}
							if(isset($access_controls) && $access_controls[7]->staff == 1){
								echo '		<li><a href="'.site_url('admin/configure/pre_set_messages').'">Pre-Set Messages</a></li>';
							}
							if(isset($access_controls) && $access_controls[8]->staff == 1){
								echo '		<li><a href="'.site_url('admin/configure/email_template').'">Email Templates</a></li>';
							}
							if(isset($access_controls) && $access_controls[9]->staff == 1){
								echo '		<li><a href="'.site_url('admin/terms').'">T&C Version Control</a></li>';
							}
							if($check){
								echo '	</ul>';
								echo '</li>';
							}
						}
					}
                }else{
                echo '<li class="submenu">';
                    echo '<a href="#"><i class="icon icon-wrench"></i> <span>Settings</span></a>';
                    echo '	<ul>';
                    echo '		<li><a href="'.site_url('admin/configure_fields').'">Field Control</a></li>';
                    echo '		<li><a href="'.site_url('admin/scores').'">Score & Rank </a></li>';
                    echo '		<li><a href="'.site_url('admin/configure/pre_set_messages').'">Pre-Set Messages</a></li>';
					echo '		<li><a href="'.site_url('admin/configure/email_template').'">Email Templates</a></li>';
					echo '		<li><a href="'.site_url('admin/terms').'">T&C Version Control</a></li>';
                    echo '	</ul>';
                echo '</li>';
                }
            ?>
        <!--</li>
        <li class="submenu">-->
        	<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							if($access_controls[10]->supervisor == 1){
							echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-globe"></i> <span>APIs</span></a>';
								echo '	<ul>';
								echo '		<li><a href="'.site_url('admin/sms_config').'">ReachTel SMS</a></li>';
                    			echo '		<li><a href="'.site_url('admin/min_it').'">Min-It</a></li>';
								echo '	</ul>';
							echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							if($access_controls[10]->staff == 1){
							echo '<li class="submenu">';
								echo '<a href="#"><i class="icon icon-globe"></i> <span>APIs</span></a>';
								echo '	<ul>';
								echo '		<li><a href="'.site_url('admin/sms_config').'">ReachTel SMS</a></li>';
                    			echo '		<li><a href="'.site_url('admin/min_it').'">Min-It</a></li>';
								echo '	</ul>';
							echo '</li>';
							}
						}
					}
                }else{
                echo '<li class="submenu">';
                    echo '<a href="#"><i class="icon icon-globe"></i> <span>APIs</span></a>';
                    echo '	<ul>';
                    echo '		<li><a href="'.site_url('admin/sms_config').'">ReachTel SMS</a></li>';
                    echo '		<li><a href="'.site_url('admin/min_it').'">Min-It</a></li>';
                    echo '	</ul>';
                echo '</li>';
                }
            ?>
        <!--</li>
        <li class="submenu">-->
        	<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							if($access_controls[11]->supervisor == 1){
							echo '<li class="submenu">';
								echo '<a href="'.site_url('admin/cms').'" onclick="return window.location = \''.site_url('admin/cms').'\'"><i class="icon icon-th-list"></i> <span>CMS</span></a>';
								echo '	<ul>';
								echo '		<li><a href="'.site_url('admin/cms').'">Dashboard</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/add_page').'">Add Page</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/widget_control').'">Widget Control</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/menu_control').'">Menu Control</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/manage_files').'">Media Library</a></li>';
								echo '	</ul>';
							echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							if($access_controls[11]->staff == 1){
							echo '<li class="submenu">';
								echo '<a href="'.site_url('admin/cms').'" onclick="return window.location = \''.site_url('admin/cms').'\'"><i class="icon icon-th-list"></i> <span>CMS</span></a>';
								echo '	<ul>';
								echo '		<li><a href="'.site_url('admin/cms').'">Dashboard</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/add_page').'">Add Page</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/widget_control').'">Widget Control</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/menu_control').'">Menu Control</a></li>';
								echo '		<li><a href="'.site_url('admin/cms/manage_files').'">Media Library</a></li>';
								echo '	</ul>';
							echo '</li>';
							}
						}
					}
                }else{
                echo '<li class="submenu">';
                    echo '<a href="'.site_url('admin/cms').'" onclick="return window.location = \''.site_url('admin/cms').'\'"><i class="icon icon-th-list"></i><span>CMS</span></a>';
                    echo '	<ul>';
                    echo '		<li><a href="'.site_url('admin/cms').'">Dashboard</a></li>';
                    echo '		<li><a href="'.site_url('admin/cms/add_page').'">Add Page</a></li>';

					echo '		<li><a href="'.site_url('admin/cms/widget_control').'">Widget Control</a></li>';
                    echo '		<li><a href="'.site_url('admin/cms/menu_control').'">Menu Control</a></li>';
                    echo '		<li><a href="'.site_url('admin/cms/manage_files').'">Media Library</a></li>';
                    echo '	</ul>';
                echo '</li>';
                }
            ?>
        <!--</li>
        <li>-->
        	<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							if($access_controls[12]->supervisor == 1){
							echo '<li>';
								echo '<a href="#"><i class="icon icon-th"></i> <span>Blog</span></a>';
							echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							if($access_controls[12]->staff == 1){
							echo '<li>';
								echo '<a href="#"><i class="icon icon-th"></i> <span>Blog</span></a>';
							echo '</li>';
							}
						}
					}
                }else{
                echo '<li>';
                    echo '<a href="#"><i class="icon icon-th"></i> <span>Blog</span></a>';
                echo '</li>';
                }
            ?>
		<!--</li>
        <li>-->
        	<?php
                if($this->session->userdata['user_level'] != 1){
					if(isset($access_controls)){
						if($this->session->userdata['user_level'] == 2){
							if($access_controls[13]->supervisor == 1){
							echo '<li>';
								echo '<a href="#"><i class="icon icon-folder-open"></i> <span>Web Stats</span></a>';
							echo '</li>';
							}
						}elseif($this->session->userdata['user_level'] == 3){
							if($access_controls[13]->staff == 1){
							echo '<li>';
								echo '<a href="#"><i class="icon icon-folder-open"></i> <span>Web Stats</span></a>';
							echo '</li>';
							}
						}
					}
                }else{
                echo '<li>';
                    echo '<a href="#"><i class="icon icon-folder-open"></i> <span>Web Stats</span></a>';
                echo '</li>';
                }
            ?>
		<!--</li>-->
		<?php //endif; ?>
        <!--END ACCESS CONTROL-->

	</ul>
</div>