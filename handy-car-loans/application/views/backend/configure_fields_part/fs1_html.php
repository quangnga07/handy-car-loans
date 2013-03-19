<div class="span12">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-calendar"></i>
            </span>
            <h5>Personal Information Fields</h5>
        </div>
        <div class="widget-content nopadding">
            <div id="personal_message_panel" style="display: none;">
                <div class="alert alert-success">
                    Changes were saved successfully.
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30%">Field Name</th>
                        <th width="40%">Status</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($personal as $a): ?>
                        <tr>
                            <td><?php echo $a->label; ?></td>
                            <td>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_on'; ?>" value="1" <?php echo $a->status == 1 ? 'checked' : ''; ?> >
                                    ON 
                                </label>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_off'; ?>" value="0" <?php echo $a->status == 0 ? 'checked' : ''; ?>>
                                    OFF
                                </label>
                            </td>
                            <td class="taskOptions"><input class="personal_order" type="text" value="<?php echo $a->order; ?>" id="<?php echo $a->name . '_order'; ?>" name="<?php echo $a->name . '_order'; ?>" /></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>

    </div>

    <p  style="padding: 10px; float:right;"> 
        <button data-loading-text="Savin changes..." class="btn" type="button" id="personal_button">Save Changes</button>
    </p>
    <div style="clear:both;"></div>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-home"></i>
            </span>
            <h5>Address Details</h5>
        </div>
        <div id="address_message_panel" style="display: none;">
            <div class="alert alert-success">
                Changes were saved successfully.
            </div>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30%">Field Name</th>
                        <th width="40%">Status</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($address as $a): ?>
                        <tr>
                            <td><?php echo $a->label; ?></td>
                            <td>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_on'; ?>" value="1" <?php echo $a->status == 1 ? 'checked' : ''; ?> >
                                    ON 
                                </label>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_off'; ?>" value="0" <?php echo $a->status == 0 ? 'checked' : ''; ?>>
                                    OFF
                                </label>
                            </td>
                            <td class="taskOptions"><input type="text" value="<?php echo $a->order; ?>" id="<?php echo $a->name . '_order'; ?>" name="<?php echo $a->name . '_order'; ?>" /></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>	
        </div>
    </div>

    <p  style="padding: 10px; float:right;"> 
        <button data-loading-text="Savin changes..." class="btn" type="button" id="address_button">Save Changes</button>
    </p>
    <div style="clear:both;"></div>           

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-time"></i>
            </span>
            <h5>Contact Details</h5>
        </div>
        <div id="contact_message_panel" style="display: none;">
            <div class="alert alert-success">
                Changes were saved successfully.
            </div>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30%">Field Name</th>
                        <th width="40%">Status</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($contact as $a): ?>
                        <tr>
                            <td><?php echo $a->label; ?></td>
                            <td>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_on'; ?>" value="1" <?php echo $a->status == 1 ? 'checked' : ''; ?> >
                                    ON 
                                </label>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_off'; ?>" value="0" <?php echo $a->status == 0 ? 'checked' : ''; ?>>
                                    OFF
                                </label>
                            </td>
                            <td class="taskOptions"><input type="text" value="<?php echo $a->order; ?>" id="<?php echo $a->name . '_order'; ?>" name="<?php echo $a->name . '_order'; ?>" /></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>	
        </div>
    </div>

    <p  style="padding: 10px; float:right;"> 
        <button data-loading-text="Savin changes..." class="btn" type="button" id="contact_button">Save Changes</button>
    </p>
    <div style="clear:both;"></div>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-folder-open"></i>
            </span>
            <h5>Proposed Loan</h5>
        </div>
        <div id="loan_message_panel" style="display: none;">
            <div class="alert alert-success">
                Changes were saved successfully.
            </div>
        </div> 
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30%">Field Name</th>
                        <th width="40%">Status</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($loan as $a): ?>
                        <tr>
                            <td><?php echo $a->label; ?></td>
                            <td>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_on'; ?>" value="1" <?php echo $a->status == 1 ? 'checked' : ''; ?> >
                                    ON 
                                </label>
                                <label class="radio">
                                    <input type="radio" class="<?php echo $a->name . '_status'; ?>" name="<?php echo $a->name . '_status'; ?>" id="<?php echo $a->name . '_status_off'; ?>" value="0" <?php echo $a->status == 0 ? 'checked' : ''; ?>>
                                    OFF
                                </label>
                            </td>
                            <td class="taskOptions"><input type="text" value="<?php echo $a->order; ?>" id="<?php echo $a->name . '_order'; ?>" name="<?php echo $a->name . '_order'; ?>" /></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>	
        </div>
    </div>

    <p  style="padding: 10px; float:right;"> 
        <button data-loading-text="Savin changes..." class="btn" type="button" id="loan_button">Save Changes</button>
    </p>
    <div style="clear:both;"></div>       

</div>