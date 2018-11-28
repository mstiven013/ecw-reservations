<?php 

	$resp = [];

	class Emails {

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . 'ecw_emails'; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(200) AUTO_INCREMENT PRIMARY KEY,
						subject VARCHAR(100) NOT NULL,
						message VARCHAR(100) NOT NULL,
						email_from VARCHAR(200) NOT NULL,
						email_to VARCHAR(200) NOT NULL
					) CHARACTER SET utf8;";

			$wpdb->query($sql);

		}

		public function get_all() {

			//Get all services model

		}

		public function reservation($user_email, $email_template) {

			include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load

			global $wpdb;
			
			//Site vars
			$sitename = get_bloginfo('name');
			$home_url = get_home_url();

			//Admin options vars
			$adminEmail = '';
			$mailName = '';
			$mailSubject = '';
			$smtpHost = '';

			//Create $adminEmail var
			if(get_option('ecwr_mail_email') && get_option('ecwr_mail_email') !== '' && get_option('ecwr_mail_email') !== ' ') {
				$adminEmail = esc_attr( get_option('ecwr_mail_email') );
			} else {
				$adminEmail = esc_attr( get_option('admin_email') );
			}

			//Create $mailName var
			if(get_option('ecwr_mail_name') && get_option('ecwr_mail_name') !== '' && get_option('ecwr_mail_name') !== ' ') {
				$mailName = esc_attr( get_option('ecwr_mail_name') );
			} else {
				$mailName = 'Reservas - ' . $sitename;
			}

			//Create $mailSubject var
			if(get_option('ecwr_mail_subject') && get_option('ecwr_mail_subject') !== '' && get_option('ecwr_mail_subject') !== ' ') {
				$mailSubject = esc_attr( get_option('ecwr_mail_subject') );
			} else {
				$mailSubject = 'Registro exitoso: cita para ' . $date;
			}

			//Create $smtpHost var
			if(get_option('ecwr_smtp_host') && get_option('ecwr_smtp_host') !== '' && get_option('ecwr_smtp_host') !== ' ') {
				$smtpHost = esc_attr( get_option('ecwr_smtp_host') );
			} else {
				$smtpHost = 'localhost';
			}

			include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/PHPMailer.php');
			include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/SMTP.php');
        	include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/Exception.php');
            
            $mail = new PHPMailer\PHPMailer\PHPMailer();  // Passing `true` enables exceptions

            //Server settings
            $mail->SMTPDebug = 2;
            //$mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = false;
        
            //Recipients
            $mail->addAddress($user_email); // Add a recipient
            $mail->addCC($adminEmail); // Reply to admin
            $mail->setFrom($adminEmail, $mailName);
        
            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $mailSubject;
            
            $mail->Body = '<html><body>';

            $mail->Body .= $email_template;
        
            $mail->Body .= '</body></html>';
        
            if($mail->send()) {
                return true;
            } else {
            	$resp['error'] = $mail->ErrorInfo;
            	return $resp;
            }

		}

	}

 ?>