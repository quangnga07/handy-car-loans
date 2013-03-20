<div id="content">
	<div id="content-header">
		<h1>Terms &amp; Conditions Version Control</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="tip-bottom">Setting</a>
		<a href="<?php echo site_url('admin/terms');?>" class="current">Terms &amp; Conditions Version Control</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-certificate"></i>
						</span>
						<h5>Terms and Conditions version number</h5>
					</div>
                    <form id="tc-form" action="<?php echo site_url('admin/update_terms');?>" method="POST">
                    <div class="widget-content">
                    	<div style="width:290px; overflow:hidden"><h4>Current version on Front end: </h4></div>
                        <input type="hidden" name="updateTerms" value="yes" />
                        <span style="width:300px; float:left; margin-left:290px; margin-top:-35px">
                            <input type="hidden" id="version_used" value="<?php echo site_url('admin/update_used_term');?>" />
                            <select id="term_current" name="tc-current">
                                <option value="-1">Select Term Version</option>
                                <?php
                                for($i = 0; $i < count($terms); $i++){
                                    $select = '';
                                    if($terms[$i]['id'] == $term_current['value']) $select = 'selected="selected"';
                                    echo '<option value = "'.$terms[$i]['id'].'" ' .$select.'>Version '. $terms[$i]['id'] .'</option>';
                                }
                                ?>
                            </select>
						</span>
                    </div>
                    
                    
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Version</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$str = '';
									for($i = 0; $i < count($terms); $i++){
										$str .= '<tr>';
										$str .= '	<td>Version '. $terms[$i]['id'] .'</td>';
										$str .= '	<td>'. date("jS F Y @ g:i A",strtotime($terms[$i]['date'])) .'</td>';
										//$str .= '	<td><a href="javascript:open_term_popup('.$terms[$i]['id'].')">view</a></td>';
                                        $str .= '   <td class="taskOptions"><a href="#" class="vew_term" id="'. $terms[$i]['id'] .'">view</a><div style="display: none"> '.$terms[$i]['content'].' </div></td>';
										$str .= '</tr>';
									}
									echo $str;
								?>
                            </tbody>
                        </table>							
                    </div>
                </div>
                
            	<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-certificate"></i>
						</span>
						<h5>Set Terms and Conditions Text</h5>
                        <div style="float:right">
                        	<span id="term_version_slb" style="float:right; padding-right:15px; margin-top:3px"></span>
                            <span class="label label-info">Preview Version</span>
                        </div>
					</div>
                    <div class="widget-content">
                        <div class="terms-edit">
                            <?php
                            $content = '';
                            for ($i=0; $i < count($terms); $i++) { 
                                if( $term_current['value'] == $terms[$i]['id'] ) {
                                    $content = $terms[$i]['content'];
                                }
                            }
                            ?>
                            <textarea id="term_content" name="tc-content" style="width:98.5%; min-height:550px;" spellcheck="false"></textarea>
                            <?php echo display_ckeditor($ckeditor); ?>
                        </div>
                   	</div>
              	</div>  
                <p style="padding:10px 10px 10px 0px;"> <!-- onclick="return submit_term()" -->
                    <button type="sumbit" id="tc-btn" class="btn" data-loading-text="Savin changes..." >Save Changes</button>
                    <button type="reset" class="btn">Clear</button>
                </p>
                </form> 
			</div>
		</div>
		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>

<!--
<div id="term_popup_dlg" style="display:none">  onclick="close_popup()" -->
    <!--<div style="position:fixed; width:100%; height:100%; top:0px; left:0px; background-color:#000; opacity:0.5; z-index:554;" id="close_popup" ></div>
    <div id="term_popup" style="position:absolute; width:900px; min-height:580px; top:50px; left:50%; margin-left:-450px; z-index:555; background-color:#FFF; padding:20px; border-radius:5px;"></div>
</div>
-->

<div id="term_popup_dlg" style="display: none;" class="modal hide fade in" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="display: block;">
    <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
        <h3 id="myModalLabel" style="font-size: 24.5px;">Terms of Use</h3>
    </div>
    <div class="modal-body">
    
    </div>
    <div class="modal-footer">
        <button class="btn" aria-hidden="true" data-dismiss="modal">Close</button>
    </div>
</div>