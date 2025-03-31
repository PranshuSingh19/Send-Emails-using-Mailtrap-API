// Looking to send emails in production? Check out our Email API/SMTP product!
function mailtrap($phpmailer) {
	$phpmailer->isSMTP();
	$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 2525;
	$phpmailer->Username = '69d6defc111b92';
	$phpmailer->Password = 'cee880038d1d7e';
  }
add_action('phpmailer_init', 'mailtrap');
