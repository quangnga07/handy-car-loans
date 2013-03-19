<div id="content">
	<div id="content-header">
		<h1>Home Page Contents</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="current">Home Page Contents</a>
	</div>
	<div class="container-fluid">
		
<div class="container-fluid">
        <div class="row-fluid">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="fs1">
                    	<form id="home_page_form" method="post">
                        <table class="table table-bordered ">
                        	<tbody>
							<tr><td>
                        		<table>
                                    <tbody>
                                            <tr><td colspan="2"><strong>Header</strong></td></tr>
                                            <tr>
                                                <td> Header Headline</td>
	                                            <td> Header Tagline</td>
	                                        </tr>
                                            <tr>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->header_headline);?>" id="" name="header_headline" />
                                                </td>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->header_tagline);?>" id="" name="header_tagline" />
                                                </td>
                                            </tr>                                                
                                    </tbody>
                                    </table>                        
                         	
                            	</td>
                                <td>
                        		<table >
                                    <tbody>
                                            <tr><td colspan="2"><strong>Mini Application</strong></td></tr>
                                            <tr>
                                                <td> Mini Application Headline</td>
	                                            <td> Mini Application Find Out More URL</td>
	                                        </tr>
                                            <tr>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->mini_app_headline);?>" id="" name="mini_app_headline" />
                                                </td>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->mini_app_url);?>" id="" name="mini_app_url" />
                                                </td>
                                            </tr>                                                
                                    </tbody>
                                    </table>                                 
                                
                                </td>
                                
                                </tr>
			    
								<tr><td colspan="2">
                        		<table >
                                    <tbody>
                                            <tr><td colspan="2"><strong>Main Contents</strong></td></tr>
                                            <tr>
                                                <td> Headline</td>
	                                            <td> Text</td>
	                                        </tr>
                                            <tr>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->main_content_headline);?>" id="" name="main_content_headline" />
                                                </td>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->main_content_text);?>" id="" name="main_content_text" />
                                                </td>
                                            </tr>                                                
                                    </tbody>
                                    </table>                        
                         	
                            	</td></tr>    
								<tr>
                                	<td>
                        			<table >
                                    
                                            <tr><td colspan="2"><strong>Four Easy Steps</strong></td></tr>

                                            <tr>
                                                <td>
                                                   1. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->step1);?>" id="" name="step1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   2. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->step2);?>" id="" name="step2" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   3. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->step3);?>" id="" name="step3" />
                                                </td>
                                            </tr>                                            <tr>
                                                <td>
                                                   4. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->step4);?>" id="" name="step4" />
                                                </td>
                                            </tr>                                                                                            
                                                                                            
                                    
                                    	</table>                        
                         	
                            		</td>
									<td>
                        			<table >
                                    
                                            <tr><td colspan="2"><strong>How we help</strong></td></tr>
											<tr><td>Icon URL</td><td>Text</td></tr>
                                            <tr>
                                                <td>
                                                   1. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help1_ico_url);?>" id="" name="help1_ico_url" />
                                                </td>
    											<td>
                                                   	  <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help1_ico_text);?>" id="" name="help1_ico_text" />
                                                </td>                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                   2. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help2_ico_url);?>" id="" name="help2_ico_url" />
                                                </td>
    											<td>
                                                   	  <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help2_ico_text);?>" id="" name="help2_ico_text" />
                                                </td>                                             </tr>
                                            <tr>
                                                <td>
                                                   3. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help3_ico_url);?>" id="" name="help3_ico_url" />
                                                </td>
    											<td>
                                                   	  <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help3_ico_text);?>" id="" name="help3_ico_text" />
                                                </td>                                             </tr>                                            <tr>
                                                <td>
                                                   4. <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help4_ico_url);?>" id="" name="help4_ico_url" />
                                                </td>
    											<td>
                                                   	  <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->help4_ico_text);?>" id="" name="help4_ico_text" />
                                                </td>                                             </tr>                                                                                            
                                                                                            
                                    
                                    	</table>                        
                         	
                            		</td>                                
                                
                                </tr>     
								<tr>
                                <td>
                        		<table >
                                    <tbody>
                                            <tr><td colspan="2"><strong>Call to Action</strong></td></tr>
                                            <tr>
                                                <td> Headline</td>
	                                            <td> Text</td>
	                                        </tr>
                                            <tr>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->call_action_headline);?>" id="" name="call_action_headline" />
                                                </td>
                                                <td>
                                                    <input class="personal_order" type="text" value="<?php echo($home_page_contents[0]->call_action_text);?>" id="" name="call_action_text" />
                                                </td>
                                            </tr>                                                
                                    </tbody>
                                    </table>                        
                            	</td>
                                <td>
                        		<table >
                                    <tbody>
                                            <tr><td colspan="2"><strong>Home Page Disclaimer Text</strong></td></tr>
                                            <tr>
                                                <td> Disclaimer Text</td>
	                                            <td> <textarea class="personal_order" type="text"  name="disclaimer_text"><?php echo($home_page_contents[0]->disclaimer_text);?></textarea></td>
	                                        </tr>
                                               
                                    </tbody>
                                    </table>                        
                            	</td>

                                
                                </tr>                                
                                <tr>
                                    <td colspan="2">
                                        <input class="personal_order" type="button" value="Update Contents" id="update_contents" name="" />
                                    </td>
                                </tr>                                                                                            
                           	</tbody>
                           </table>      
                           </form>   
                    </div>

                </div>
            </div>
        </div>
        <script type="text/javascript">
            var url = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script>
			$('#update_contents').live('click',function(){
				var home_page_form = $('#home_page_form').serialize() ;
				var request = $.ajax({
					url: "<?php echo(site_url("admin/ajax_homepage_contents"));?>",
					type: "POST",
					data: home_page_form,
					dataType: "json",
					success: function(data) {alert(data.message);}
				});

			});
		</script> 
        
        <div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
                        </div>
                        </div>		

		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>