<div id="content">
	<div id="content-header">
		<h1>Notifications</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="current">Notifications</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
                        	<i class="icon-envelope"></i>
						</span>
						<h5>Email Notifications</h5>
					</div>
					<div class="widget-content activity-content nopadding">
						<ul class="activity-list email">
						<?php if(isset($messages)): ?>
							<?php foreach($messages as $msg): ?>
							<li>
								<a data-url="<?php echo site_url('admin/notification/delete_notification'); ?>" data-id="<?php echo $msg->id; ?>" data-type="message" href="<?php echo site_url('admin/client/record/'.$this->urlparser->encode( $msg->user_id )."#email-box"); ?>">
                                    <i class="icon-user"></i>
                                    New email from <strong><?php echo $msg->fname . " " . $msg->lname; ?></strong>
                                    <span><?php echo date('d-m-Y h:ia', strtotime($msg->time_sent)); ?></span>
                                </a>
                            </li>
                        	<?php endforeach; ?>
                        <?php else: ?>
                        	<div style="padding: 10px;">
                        		<span>No Notifications</span>
                        	</div>
                        <?php endif; ?>
						</ul>
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
                        	<i class="icon-file"></i>
						</span>
						<h5>Document Notifications</h5>
					</div>
					<div class="widget-content activity-content nopadding">
						<ul class="activity-list documents">
						<?php if(isset($documents)): ?>
							<?php foreach($documents as $document): ?>
							<li>
								<a data-url="<?php echo site_url('admin/notification/delete_notification'); ?>" data-id="<?php echo $document->id; ?>" data-type="document" href="<?php echo site_url('admin/client/record/'.$this->urlparser->encode( $document->users_application_id )); ?>">
                                	<i class="icon-user"></i>
                                	Applicant: <strong><?php echo $document->fname." ".$document->lname; ?></strong> has <strong><?php echo $document->message; ?></strong>
                               		<span><?php echo date('d-m-Y h:ia', strtotime($document->date_sent)); ?></span>
                               	</a>
                            </li>
                        	<?php endforeach; ?>
                        <?php else: ?>
                        	<div style="padding: 10px;">
                        		<span>No Notifications</span>
                        	</div>
                        <?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>