<?
echo "test"; 
	$to = "vamsi6985@aol.com"; // this is your Email address
    $from = "prakash@konsear.com"; // this is the sender's Email address
    $subject = "Form submission";
    $message = 	"<table width='100%' align='center' style='background-color: #f0f0f0;'>
								<tr>
									<td>
										<br/><br/><br/>
										<table width='500px' align='center'>
											<tr>
												<td align='center'>
													<span align='center'></span>
													<hr/>
												</td>
											</tr>
											<tr>
												<td>
													<p style='text-align: center;'>Hello vamsi,</p><br/><br/>
													<br/>
													<p style='text-align: center;'>Click the button below to login into your Konsear account.</p><br/> 
													
												</td>
											</tr>
											<tr>
												<td>
													Username :
													vamsi6985@aol.com
												</td>
											</tr>
											<tr>
												<td>
													Password :
													abc<br/><br/><br/><br/>
												</td>
											</tr>
											<tr>
												<td align='center'>
													<hr/>
													Konsear App
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
								<br/><br/>";
 $message = "test";
	$mailheaders = "MIME-Version: 1.0\n";
	$mailheaders .= "Content-type: text/plain; charset=iso-8859-1\n";
	$mailheaders .= "X-Priority: 3\n";
	$mailheaders .= "X-MSMail-Priority: Normal\n";
	$mailheaders .= "X-Mailer: php\n";
	$mailheaders .= "From: <$from>\n";
	$mailheaders .= "Reply-to: <$from>\n";
	$mailheaders .= "Return-path: <$from>\n";
    mail($to,$subject,$message,$mailheaders);
    ?>