<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Registration email sender function
 */
if(! function_exists('userRegistrationEmail')){
	function userRegistrationEmail($userID, $userPassword){
        $ci =& get_instance();
		$ci->load->library('email');
		$ci->load->model('user');
        $con = array(
            'id' => $userID
        );
        $user = $ci->user->getRows($con);
		
		$mailContent = '<div bgcolor="#f8f8f8" style="background-color:#f8f8f8;margin:0;padding:0">
			<table cellpadding="0" cellspacing="0" height="100%" width="100%">
			<tbody>
				<tr>
					<td align="center" bgcolor="#f8f8f8" style="padding-top:2px;padding-left:0;padding-right:0;min-width:600px" valign="top">
					<center>
					<table cellpadding="0" cellspacing="0" width="600">
						<tbody>
							<tr>
								<td style="padding-top:20px;padding-bottom:22px;float:left" valign="top"><img alt="digitalplex" border="0" src="'.base_url().'assets/images/logo.png" style="margin:0;display:block"></td>
							</tr>
						</tbody>
					</table>
		
					<hr align="center" color="#E7E7E7" size="1px" width="600">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td align="center" bgcolor="#f8f8f8" style="padding-left:10px;padding-right:10px" valign="top">
								<table cellpadding="0" cellspacing="0" width="600">
									<tbody>
										<tr>
											<td>
											<table cellpadding="0" cellspacing="0" width="100%">
												<tbody>
													<tr>
														<td align="left" style="padding:30px 0;padding-top:25px;padding-bottom:15px;font-size:16px;line-height:25px;color:#565a5c;font-weight:normal;font-family:Helvetica Neue,Helvetica,Arial,sans-serif" valign="top">
														<p style="margin-top:5px;margin-bottom:12px;font-weight:bold;font-size:20px">Hi '.$user['first_name'].',</p>
		
														<p style="margin-top:5px;margin-bottom:12px">Thank you for your new account creation. We are excited to see you on board.</p>
		
														<p style="margin-top:5px;margin-bottom:12px">Here are your login details:</p>
		
														<p style="margin-top:5px;margin-bottom:12px"><strong>Email:</strong> '.$user['email'].'<br>
														<strong>Password:</strong> '.$userPassword.'</p>
		
														<p style="margin-top:5px;margin-bottom:12px">If you run into any issues while logging in or access member panel, please reply to this email and we will be happy to assist.</p>
		
														<p style="margin-top:5px;margin-bottom:12px">Thanks again for choosing CodexWorld and we wish you success.</p>
		
														<p style="margin-top:5px;margin-bottom:12px">Regards<br>
														CodexWorld Team</p>
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
						</tbody>
					</table>
					</center>
					</td>
				</tr>
			</tbody>
		</table></div>';
        
        $config['mailtype'] = 'html';
        $ci->email->initialize($config);
        $ci->email->to($user['email']);
        $ci->email->from('info@codex.com', 'CodexWorld');
        $ci->email->subject('Welcome to CodexWorld | Account Login Details');
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}

/*
 * Reset new password email sender function
 */
if(! function_exists('forgotPassEmail')){
	function forgotPassEmail($userEmail){
        $ci =& get_instance();
		$ci->load->library('email');
		$ci->load->model('user');
        $con['returnType'] = 'single';
        $con['where'] = array(
            'email' => $userEmail
        );
        $user = $ci->user->getRows($con);
        $resetPassLink = base_url().'users/resetPassword/'.$user['forgot_pass_identity'];
        $mailContent = '<p>Dear <strong>'.$user['first_name'].'</strong>,</p>
        <p>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.</p>
        <p>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a></p>
        <p>Let us know at contact@example.com in case of any query or feedback.</p>
        <p>Regards,<br/><strong>Team CodexWorld</strong></p>';
        
        $config['mailtype'] = 'html';
        $ci->email->initialize($config);
        $ci->email->to($user['email']);
        $ci->email->from('info@codex.com', 'CodexWorld');
        $ci->email->subject('Password Update Request | CodexWorld');
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}

/*
 * Account verification email sender function
 */
if(! function_exists('emailVerification')){
	function emailVerification($userID){
        $ci =& get_instance();
		$ci->load->library('email');
		$ci->load->model('user');
        $con = array(
            'id' => $userID
        );
        $user = $ci->user->getRows($con);
        $emailVerifyLink = base_url().'users/verifyEmail/'.$user['activation_code'];
        $mailContent = '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-radius:6px;background-color:#ffffff;padding-top:15px;border-collapse:separate">
			<tbody>
				<tr>
					<td style="color:#616471;font-weight:400;text-align:left;line-height:190%;padding-top:15px;padding-right:40px;padding-bottom:30px;padding-left:40px;font-size:15px">
					<h1 style="font-weight:500;font-size:22px;letter-spacing:-1px;line-height:115%;margin:18px 0 0;padding:0;text-align:left;color:#3c7bb6">Email Confirmation</h1>
					<br>
					Thank you for signing up with CodexWorld! Please confirm your email address by clicking the link below.
					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
					<tbody>
						<tr>
							<td align="center" valign="middle" style="padding-top:25px;padding-right:15px;padding-bottom:25px;padding-left:15px">
								<table border="0" cellpadding="0" cellspacing="0" style="border-radius:.25em;background-color:#4582e8;border-collapse:separate">
								<tbody>
									<tr>
										<td align="center" valign="middle" style="border-radius:.25em;background-color:#4582e8;font-weight:400;min-width:180px;font-size:16px;line-height:100%;padding-top:18px;padding-right:30px;padding-bottom:18px;padding-left:30px;color:#ffffff">
											<a href="'.$emailVerifyLink.'" style="font-weight:500;color:#ffffff;text-decoration:none">Confirm Email</a>
										</td>
									</tr>
								</tbody>
								</table>
							</td>
						</tr>
					</tbody>
					</table>
					We look forward to serving you,<br><strong>CodexWorld Team</strong>
					</td>
				</tr>
			</tbody>
		</table>';

        $config['mailtype'] = 'html';
        $ci->email->initialize($config);
        $ci->email->to($user['email']);
        $ci->email->from('info@codex.com', 'CodexWorld');
        $ci->email->subject('Please Confirm Your Email | CodexWorld');
        $ci->email->message($mailContent);
		$ci->email->send();
        return true;
    }
}