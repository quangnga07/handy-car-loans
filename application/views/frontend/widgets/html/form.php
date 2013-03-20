<div class="widgetform">
	<label>HTML</label><button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();">Edit</button>
	<div class="form" style="display:none;">
		<form method="post" action="<?php echo base_url(); ?>/admin/cms/save_widget">
		<textarea name="html"></textarea>
		<button class="btn btn-success btn-mini" onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Save</button>
		</form>
	</div>

</div>