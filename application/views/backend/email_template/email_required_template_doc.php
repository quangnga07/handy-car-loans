<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" style="height: 200px;">
			<table width="700px">
				<tr>
					<td>
						<img alt="Header Image" src="<?php echo base_url() ?>assets/img/header-email.png" width="700" height="190" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: LucidaSans, Arial, Sans-serif; margin-top: 10px;">
	<tr>
		<td align="center">
			<table width="700px">
				<tr>
					<td width="75%">
						<h3 style="color: #c80825; font-size: 25px; margin: 30px 0 0 35px; font-weight: normal;">{heading}</h3>
						<h5 style="color: #599ce5; font-size: 15px; margin: 10px 0 30px 35px; font-weight: normal;">{sub_heading}</h5>
					</td>
					<td align="center">
						<img alt="Customer Support Image" src="<?php echo base_url() ?>assets/img/customer-support-small.png" />
					</td>
				</tr>
				<tr>
					<td width="75%" style="vertical-align: top;">
						<div style="padding: 35px; background-color: #eaebeb; color: #616060; font-size: 14px;">
							<p>Dear {name},</p>
							<p>Your application number is <span style="color: #529be7; font-size: 17px;">HCL{application_id}</span></p>
							<p>In order to process your application we require a copy of the folllowing documents:</p>
							<ol>
							{documents}
								<li>{document}</li>
							{/documents}
							</ol>
							<p>Remember our support staff are available 24/7 if you have any problems or questions.</p>
							<p>Kind regards,<br>Handy Car Loans</p>
							<div style="margin-top: 35px;">
								<a href="{url}">
									<img alt="Submit Documents" src="<?php echo base_url() ?>assets/img/email_doc_submit.png" style="text-decoration: underline; margin: 0 auto; display: block; width: 211px; height: 46px;" />
								</a>
							</div>
						</div>
					</td>
					<td style="vertical-align: top;">
						<div style="padding: 10px 30px;">
							<h5 style="font-size: 18px; color: #529be7; margin: 0; font-weight: normal;">NEED<br>ASSISTANCE?</h5>
							<p style="font-size: 11px; color: #7f7f7f;">You can contact our call centre 24 hours a day,<br /> 7 days a week on</p>
							<h5 style="font-size: 18px; color: #529be7; margin: 0; font-weight: normal;">1800 346 663</h5>
							<ul style="list-style: none; margin: 10px 0 0 0; padding: 0;">
								<li style="margin: 0 5px 0 0;"><a style="color: #7f7f7f; font-size: 11px; text-decoration: underline;" href="<?php echo base_url() ?>about-us">About Us</a></li>
								<!--li><a style="color: #7f7f7f; font-size: 11px; text-decoration: underline;" href="">Brokers</a></li-->
								<li style="margin: 0 5px 0 0;"><a style="color: #7f7f7f; font-size: 11px; text-decoration: underline;" href="<?php echo base_url() ?>">Privacy Policy</a></li>
								<li style="margin: 0 5px 0 0;"><a style="color: #7f7f7f; font-size: 11px; text-decoration: underline;" href="<?php echo base_url() ?>contact-us">Contacting Us</a></li>
							</ul>
							<ul style="list-style: none; margin: 10px 0 0 0; padding: 0;">
								<li style="float: left; margin: 0 5px 0 0;">
									<a href="http://www.facebook.com">
										<img alt="Facebook" src="<?php echo base_url() ?>assets/img/facebook-icon-for-email.png" style="width: 20px; height: 19px;" />
									</a>
								</li>
								<li style="float: left; margin: 0 5px 0 0;">
									<a href="http://www.twitter.com">
										<img alt="Twitter" src="<?php echo base_url() ?>assets/img/twitter-icon-for-email.png" style="width: 20px; height: 19px;" />
									</a>
								</li>
								<li style="float: left; margin: 0 5px 0 0;">
									<a href="http://www.youtube.com">
										<img alt="Youtube" src="<?php echo base_url() ?>assets/img/youtube-icon-for-email.png" style="width: 20px; height: 19px;"  />
									</a>
								</li>
							</ul>
							<div style="clear: both;"></div>
							<p style="font-size: 11px; color: #7f7f7f;">Handy Car Loans is <br>owned and operated by <br>Finance One Pty Ltd  <br>ACN 139 719 903  <br>ABN 80 139 719 903</p>
							<img src="<?php echo base_url() ?>assets/img/email_sidebar_icon.png" style="margin-top:20px;" />
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>