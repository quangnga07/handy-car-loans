<?php
		$this->load->view('frontend/includes/header', $header_data);
		$this->load->view('frontend/includes/middle_content', $content_data);
?>
<div id="main">
	<div class="container">
		<div class="row">
			<div class="span3">
				<?php foreach($page_widgets as $widget):
				if($widget->area=='left'):
				?>
				<div class="well">
					<div class="right-widget">
					<?php echo $widget->widget_content;?>
					</div>
				</div>
			    <?php
			    endif;
			    endforeach;?>
			</div>
			<div class="span9">
			<?php
			if($fileexist){
			$this->load->view('frontend/' . $page, $content_data);
			}
			else{
				$this->load->view('frontend/default', $content_data);
			}
			?>
			</div>


		</div>
	</div>
</div>
<?php
$this->load->view('frontend/includes/footer', $footer_data);
?>