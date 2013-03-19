<div class="span12">
    <div class="widget-box">

        <div class="widget-title">
            <span class="icon">
                <i class="icon-envelope"></i>
            </span>
            <h5>Fail Message</h5>
        </div>

        <div class="widget-content nopadding">
            <div id="personal_message_panel" style="display: none;">
                <div class="alert alert-success">
                    Changes were saved successfully.
                </div>
            </div>

           	<form action="<?php echo site_url('/admin/configure/save_preset_message/one/tab1')?>" method="POST" class="form-horizontal presetform">
				<input type="hidden" name="id_one" value="<?php echo $messages[0]->id; ?>">
				<input type="hidden" name="type_tab1_one" value="notice"/>
				<div class="control-group">
					<label class="control-label">Heading</label>
					<div class="controls">
						<input type="text" name="heading_one" value="<?php echo $messages[0]->heading; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Message</label>
					<div class="controls">
						<textarea name="message_one" style="height: 100px;"><?php echo $messages[0]->message; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
        </div>
    </div>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-envelope"></i>
            </span>
            <h5>Success Message</h5>
        </div>
        <div class="widget-content nopadding">
           	<form action="<?php echo site_url('/admin/configure/save_preset_message/two/tab1')?>" method="POST" class="form-horizontal presetform">
				<input type="hidden" name="id_two" value="<?php echo $messages[1]->id; ?>">
				<input type="hidden" name="type_tab1_two" value="success"/>
				<div class="control-group">
					<label class="control-label">Heading</label>
					<div class="controls">
						<input type="text" name="heading_two" value="<?php echo $messages[1]->heading; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Message</label>
					<div class="controls">
						<textarea name="message_two" style="height: 100px;"><?php echo $messages[1]->message; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
        </div>
    </div>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-envelope"></i>
            </span>
            <h5>Defer/Cancel Message</h5>
        </div>
        <div class="widget-content nopadding">
           	<form action="<?php echo site_url('/admin/configure/save_preset_message/three/tab1')?>" method="POST" class="form-horizontal presetform">
				<input type="hidden" name="id_three" value="<?php echo $messages[2]->id; ?>">
				<input type="hidden" name="type_tab1_three" value="error" />
				<div class="control-group">
					<label class="control-label">Heading</label>
					<div class="controls">
						<input type="text" name="heading_three" value="<?php echo $messages[2]->heading; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Message</label>
					<div class="controls">
						<textarea name="message_three" style="height: 100px;"><?php echo $messages[2]->message; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>