<?php if($template=='defaulttemplate'||$template=='fulwidthtemplate'):?>
<div class="row">
	<div class="span12">
		<div class="section">
			<div class="row">
<?php endif; ?>

			<?php echo $page_content->content;?>


<?php if($template=='defaulttemplate'||$template=='fulwidthtemplate'):?>
			</div>
<?php endif; ?>

			<div class="row">
				<?php foreach($page_widgets as $widget):
						if($widget->area=='middle'):
						?>

						<div class="<?php echo $widget->widget_class;?>">
								<?php echo $widget->widget_content;?>
						</div>

				 <?php
					    endif;
					    endforeach;?>
<?php if($template=='defaulttemplate'||$template=='fulwidthtemplate'):?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>