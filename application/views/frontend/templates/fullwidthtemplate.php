<?php
		$this->load->view('frontend/includes/header', $header_data);
		$this->load->view('frontend/includes/middle_content', $content_data);
?>
<div id="main">
	<div class="container">
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
<?php
$this->load->view('frontend/includes/footer', $footer_data);
?>