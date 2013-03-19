<div id="middle">
			<div class="container">
				<div class="row">
					<div class="span12">
						<div id="middle-content">
							<div id="smallcar-img"></div>
							<h1>Documents Required</h1>
							<h2>to complete your application</h2>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="main">
			<div class="container">
				<div class="row">
					<div class="span9">
						<h2>Welcome Back</h2>
						<p>In order to complete your application, we require Proof of Identity documents. You can supply these using any of the methods provided below. Our Automatic Document Uploader is the fastest and simplest method.</p>
					</div>
				</div>
				<div class="row">
					<div class="span12">
						<div id="application-form" class="clearfix">
							<div id="steps-container">
								<div class="step-field">
									<div id="doc-sq">
										<div>
											<?php
											foreach( $user as $row ):
											?>
											<p>Applicant Name:</p>
											<h3><?php echo $row->fname.' '.$row->mname.' '.$row->lname; ?></h3>
											<br>
											<p>Your Application ID:</p>
											<h3>HCL<?php echo $row->id; ?></h3>
											<input type="hidden" id="user_id" value="<?php echo $row->id; ?>" />
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
							<div id="doc-form">
								<form>
									<div class="doc-steps-container">
										<h3>Step 1</h3>
										<p>I am supplying my document by:</p>
										<p>
											<span><input type="checkbox" name="supply" class="supply" value="Upload" /> Easy Document Uploader (below)</span>
											<span><input type="checkbox" name="supply" class="supply" value="Fax" /> Fax</span>
											<span><input type="checkbox" name="supply" class="supply" value="Post" /> Post</span>
										</p>
									</div>
									<div class="doc-steps-container print-doc-request">
										<h3>Step 2</h3>
										<p>Please supply identity documents as listed:</p>
										<input type="hidden" id="template" value="<?php echo $template_id; ?>" />
										<?php if( $template_id == 4): ?>
										<p>
											<label><input type="checkbox" name="doc_type[]" class="doc" value="Drivers License" /> Drivers License</label>
											<label><input type="checkbox" name="doc_type[]" class="doc" value="Passport" /> Passport</label>
											<label><input type="checkbox" name="doc_type[]" class="doc" value="Birth Certificate" /> Birth Certificate</label>
											<label><input type="checkbox" name="doc_type[]" class="doc" value="Rent ledger" /> Rent ledger</label>
										</p>
										<div class="doc-input-fields">
											<label><input type="checkbox" class="doc" />Other</label>
											<label><input type="text" name="others[]" class="doc-text" /></label>

											<label><input type="checkbox" class="doc" />Other</label>
											<label><input type="text" name="others[]" class="doc-text" /></label>

											<label><input type="checkbox" class="doc" />Other</label>
											<label><input type="text" name="others[]" class="doc-text" /></label>
										</div>
										<?php else: ?>
										<ol id="doc_request">
											<?php foreach($doc_log as $doc): ?>
											<li><?php echo $doc; ?></li>
											<?php endforeach; ?>
										</ol>
										<?php endif;?>
									</div>
									<div class="doc-steps-container">
										<h3>Step 3</h3>
										<p>Upload your documents:</p>
										<div class="top-doc-selection clearfix">
											<div class="tab-extender"></div>
											<div class="select-doc">
												<h4>Easy<br> Document<br>Uploader</h4>
											</div>
											<span class="doc-or">OR</span>
											<div class="select-doc">
												<h4>Fax To</h4>
												<span class="doc-middle">(07) 4723 5044</span>
												<a href="<?php echo site_url('doc_upload/print_fax_cover');?>" class="submit-other" id="<?php echo $user[0]->id;?>" target="_blank">Print cover sheet</a>
											</div>
											<span class="doc-or">OR</span>
											<div class="select-doc nomarginright">
												<h4 style="margin: 1px 0 8px;">Post to</h4>
												<p class="doc-small">Handy Car Loans<br>PO Box 900<br>Kirwan QLD 4215</p>
												<a href="<?php echo site_url('doc_upload/print_post_cover');?>" class="submit-other" id="<?php echo $user[0]->id;?>" target="_blank">Print cover sheet</a>
											</div>
										</div>
										<div id="uploader-container">
											<p style="margin-top: -12px;">Upload documents directly from your computer.</p>
											<p class="up-small">Allowed file types: jpg, jpeg, png, gif, doc, bmp, pdf. Maximum file size 2MB.</p>
											<button id="select-file" class="btn btn-primary" style="float: right; margin-top: -37px;"> Select Files </button>
											<div class="upload-box">
												<div class="jq-uploader" id="upload">
													<!-- Uploader Here -->
												</div>
												<div class="files-to-upload">
													<ul>
														<!-- li will show if files are uploaded  -->
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="hide">
										<input type="hidden" id="url" value="<?php echo site_url('doc_upload/upload_docs');?>" />
										<input type="hidden" id="path" value="<?php echo base_url();?>uploads" />
										<input type="hidden" id="filepath" name="filepath" />
										<input type="hidden" id="removepath" name="removepath" value="<?php echo site_url('doc_upload/remove_file'); ?>" />
										<input type="hidden" id="dbsavepath" name="dbsavepath" value="<?php echo site_url('doc_upload/save_upload'); ?>" />
										<input type="hidden" id="base_url" value="<?php echo site_url('/index');?>" />
									</div>
									<button type="submit" id="sumbit_doc" class="btn btn-success btn-large" style="padding: 10px 40px">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>