<?php
		$this->load->view('frontend/includes/header', $header_data);
		$this->load->view('frontend/' . $page, $content_data);
		$this->load->view('frontend/includes/footer', $footer_data);
?>
