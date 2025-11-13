<?php
$firstParaMsg = __tr("We received a login attempt for your account. Please use the following verification code to complete your login");
?>
<table cellspacing="0" cellpadding="0" width="600" class="w320" style="border-collapse: collapse !important; font-family: Helvetica, Arial, sans-serif;">
	<tbody>
		<tr style="font-family: Helvetica, Arial, sans-serif;">
			<td class="header-lg" style="border-collapse: collapse; color: #4d4d4d; font-family: Helvetica, Arial, sans-serif; font-size: 32px; font-weight: 700; line-height: normal; padding: 35px 0 0; text-align: center;">
				<?= __tr('Two-Factor Authentication') ?>
			</td>
		</tr>
		<tr style="font-family: Helvetica, Arial, sans-serif;">
			<td class="free-text" style="border-collapse: collapse; color: #777777; font-family: Helvetica, Arial, sans-serif; font-size: 18px; line-height: 21px; padding: 10px 60px 0px; text-align: center; width: 100% !important;">
				<?= e($firstParaMsg) ?>
			</td>
		</tr>
		<tr>
			<td class="mini-container-right" style="border-collapse: collapse; color: #777777; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 21px; padding: 10px 14px 10px 15px; text-align: center; width: 278px;">
				<table cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse !important; font-family: Helvetica, Arial, sans-serif;">
					<tbody>
						<tr style="font-family: Helvetica, Arial, sans-serif;">
							<td class="mini-block-padding" style="border-collapse: collapse; color: #777777; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 21px; text-align: center;">
								<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse !important; font-family: Helvetica, Arial, sans-serif;">
									<tbody>
										<tr style="font-family: Helvetica, Arial, sans-serif;">
											<td class="mini-block" style="background-color: #ffffff; border: 1px solid #e5e5e5; border-collapse: collapse; border-radius: 5px; color: #777777; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 21px; padding: 12px 15px 15px; text-align: center; width: 253px;">
												<span class="header-sm" style="color: #4d4d4d; font-family : Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 1.3; padding: 5px 0;"><?= __tr('Verification Code') ?></span><br style="font-family:Helvetica, Arial, sans-serif;">
												<br>
												<div style="font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #5B3E96; padding: 10px 0;">
													<?= e($twoFactorCode) ?>
												</div>
												<br>
												<span style="color: #999; font-size: 12px;"><?= __tr('This code will expire in 10 minutes') ?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr style="font-family: Helvetica, Arial, sans-serif;">
			<td class="free-text" style="border-collapse: collapse; color: #777777; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 21px; padding: 20px 60px 10px; text-align: center; width: 100% !important;">
				<?= __tr('If you did not attempt to log in, please ignore this email or contact support if you have concerns about your account security.') ?>
			</td>
		</tr>
	</tbody>
</table>
