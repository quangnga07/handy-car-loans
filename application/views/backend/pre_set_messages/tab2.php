<div class="span12">
    <div class="widget-box">

        <div class="widget-title">
            <span class="icon">
                <i class="icon-envelope"></i>
            </span>
            <h5>Message 1</h5>
        </div>

        <div class="widget-content nopadding">
            <div id="personal_message_panel" style="display: none;">
                <div class="alert alert-success">
                    Changes were saved successfully.
                </div>
            </div>

           	<form action="<?php echo site_url('/admin/configure/save_preset_message/one/tab2')?>" method="POST" class="form-horizontal presetform">
				<div class="control-group">
					<label class="control-label">Type</label>
					<div class="controls">
						<input type="hidden" name="id_one" value="<?php echo $messages[0]->id; ?>">
						<input type="hidden" class="radio_tab2_one" value="<?php echo $messages[0]->type; ?>">
						<label class="inline"> <input type="radio" name="type_tab2_one" value="warning" /> Warning </label>
						<label class="inline"> <input type="radio" name="type_tab2_one" value="success" /> Success </label>
						<label class="inline inline-errror"> <input type="radio" name="type_tab2_one" value="error" /> Error </label>
						<label class="inline"> <input type="radio" name="type_tab2_one" value="notice" /> Notice </label>
					</div>
				</div>
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
            <h5>Message 2</h5>
        </div>
        <div class="widget-content nopadding">
           	<form action="<?php echo site_url('/admin/configure/save_preset_message/two/tab2')?>" method="POST" class="form-horizontal presetform">
				<div class="control-group">
					<label class="control-label">Type</label>
					<div class="controls">
						<input type="hidden" name="id_two" value="<?php echo $messages[1]->id; ?>">
						<input type="hidden" class="radio_tab2_two" value="<?php echo $messages[1]->type; ?>">
						<label class="inline"> <input type="radio" name="type_tab2_two" value="warning" /> Warning </label>
						<label class="inline"> <input type="radio" name="type_tab2_two" value="success" /> Success </label>
						<label class="inline inline-errror"> <input type="radio" name="type_tab2_two" value="error" /> Error </label>
						<label class="inline"> <input type="radio" name="type_tab2_two" value="notice" /> Notice </label>
					</div>
				</div>
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
            <h5>Message 3</h5>
        </div>
        <div class="widget-content nopadding">
           	<form action="<?php echo site_url('/admin/configure/save_preset_message/three/tab2')?>" method="POST" class="form-horizontal presetform">
				<div class="control-group">
					<label class="control-label">Type</label>
					<div class="controls">
						<input type="hidden" name="id_three" value="<?php echo $messages[2]->id; ?>">
						<input type="hidden" class="radio_tab2_three" value="<?php echo $messages[2]->type; ?>">
						<label class="inline"> <input type="radio" name="type_tab2_three" value="warning" /> Warning </label>
						<label class="inline"> <input type="radio" name="type_tab2_three" value="success" /> Success </label>
						<label class="inline inline-errror"> <input type="radio" name="type_tab2_three" value="error" /> Error </label>
						<label class="inline"> <input type="radio" name="type_tab2_three" value="notice" /> Notice </label>
					</div>
				</div>
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

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-envelope"></i>
            </span>
            <h5>Message 4</h5>
        </div>
        <div class="widget-content nopadding">
           	<form action="<?php echo site_url('/admin/configure/save_preset_message/four/tab2')?>" method="POST" class="form-horizontal presetform">
				<div class="control-group">
					<label class="control-label">Type</label>
					<div class="controls">
						<input type="hidden" name="id_four" value="<?php echo $messages[3]->id; ?>">
						<input type="hidden" class="radio_tab2_four" value="<?php echo $messages[3]->type; ?>">
						<label class="inline"> <input type="radio" name="type_tab2_four" value="warning" /> Warning </label>
						<label class="inline"> <input type="radio" name="type_tab2_four" value="success" /> Success </label>
						<label class="inline inline-errror"> <input type="radio" name="type_tab2_four" value="error" /> Error </label>
						<label class="inline"> <input type="radio" name="type_tab2_four" value="notice" /> Notice </label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Heading</label>
					<div class="controls">
						<input type="text" name="heading_four" value="<?php echo $messages[3]->heading; ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Message</label>
					<div class="controls">
						<textarea name="message_four" style="height: 100px;"><?php echo $messages[3]->message; ?></textarea>
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