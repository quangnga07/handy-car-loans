<h5>Latest Tweet</h5>
<?php $this->load->helper('date');?>
<?php foreach($tweets as $tweet): ?>
<?php $date = date( 'l jS F Y', strtotime($tweet->created_at) ); ?>
<p><?php echo $tweet->text; echo ' &nbsp;&nbsp;<a style="color:#5F5F5F; font-size: 9px;" href="'.'https://twitter.com/' . $username . '/status/' . $tweet->id_str.'">'.$date."</a>";?></p>
<?php endforeach; ?>