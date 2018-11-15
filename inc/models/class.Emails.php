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

		public function reservation($id) {

			include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load

			global $wpdb;

			//Table vars
            $treservation = $wpdb->prefix . 'ecw_reservations';
			$tcategory = $wpdb->prefix . 'ecw_categories';
			$tservice = $wpdb->prefix . 'ecw_services';
			$temployee = $wpdb->prefix . 'ecw_employees';
			
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

            $sql = "SELECT $treservation.*, $tservice.title AS service_title, $tcategory.title AS category_title, $temployee.name AS employee_name, $temployee.lastname AS employee_lastname FROM $treservation 
					INNER JOIN $tcategory ON $treservation.category_id = $tcategory.id
					INNER JOIN $tservice ON $treservation.service_id = $tservice.id
					INNER JOIN $temployee ON $treservation.employee_id = $temployee.id
					WHERE $treservation.id = '$id'
					";

			$query = $wpdb->get_results($sql);

			if($query) {

				include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/PHPMailer.php');
				include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/SMTP.php');
            	include(dirname(__FILE__, 2) . '/libs/PHPMailer/src/Exception.php');
            	
            	//Date vars
    			$smonths = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    			$emonths = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            	$dt = new DateTime($query[0]->reservation_date);
				$fdt = $dt->format('F d, Y');
				$date = str_ireplace($emonths, $smonths, $fdt);
                
                $mail = new PHPMailer\PHPMailer\PHPMailer();  // Passing `true` enables exceptions

                //Server settings
                $mail->SMTPDebug = 2;
                //$mail->isSMTP();
                $mail->Host = $smtpHost;
                $mail->SMTPAuth = false;
            
                //Recipients
                $mail->addAddress($query[0]->person_email); // Add a recipient
                $mail->addCC($adminEmail); // Reply to admin
                $mail->setFrom($adminEmail, $mailName);
            
                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $mailSubject;
                
                $mail->Body = '<html><body>';

                $mail->Body .= '<div style="width: 100%; background-color: #f2f2f2; padding-bottom: 20px; padding-top: 20px;">
								<div style="background-color: #fff; border-radius: 10px; overflow: hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; box-sizing: border-box;  margin-left: auto; margin-right: auto; width: 600px;">
									<!--Header email-->
									<div style="background-color: #1864a0; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 30px;">
										<a href="#" target="_blank">
											<img style="display: block; margin-left: auto; margin-right: auto; max-height: 60px;" src="https://www.comercialweb.com.co/images/nuevas/logocomercialweb.png" />
										</a>
									</div>';

				$mail->Body .= '<div style="color: #AAAAAA; font-size: 16px; line-height: normal; padding: 50px; font-family: Arial;">
									<div style="padding-bottom: 10px;">
										<p style="font-size: 18px; margin-top: 0px; text-align: left;">' . htmlentities(esc_html("Se registró exitosamente la cita para el")) . ' <b>' .  $date . '</b>.</p>
										<p style="font-size: 16px; text-align: left;">' . htmlentities(esc_html('A countinuación se muestran los datos de la reserva. Si existe algún error por favor comunicarse al correo escrito al final de este correo electrónico.')) . '</p>
									</div>';

				$mail->Body .= '<div style="padding-bottom: 10px;">';

				$mail->Body .= '<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse;">';
									
				$mail->Body .=	'<tr>
									<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Información de la reserva:')) . '
									</th>
								</tr>';

				$mail->Body .=	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Fecha:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' .  htmlentities(esc_html($date)) . '</td>
								</tr>';

				$mail->Body .=	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Hora:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities($query[0]->reservation_hour) . '</td>
								</tr>';

				$mail->Body .=	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Servicio:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->service_title)) . '</td>
								</tr>';

				$mail->Body .=	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Categoría:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->category_title)) . '</td>
								</tr>';

				$mail->Body .=	'<tr>
									<th style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Empleado:')) . '
									</th>
									<td style="border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->employee_name)) . ' ' . htmlentities(esc_html($query[0]->employee_lastname)) . '</td>
								</tr>';
								
				$mail->Body .=	'</table>';

				$mail->Body .=	'<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse; margin-top: 20px;">';
								
				$mail->Body .= 	'<tr>
									<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Información personal:')) . '
									</th>
								</tr>';

				$mail->Body .= 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Nombre completo:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->person_name)) . '</td>
								</tr>';

				$mail->Body .= 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Teléfono / Celular:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->person_phone)) . '</td>
								</tr>';

				$mail->Body .= 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										' . htmlentities(esc_html('Correo electrónico:')) . '
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . htmlentities(esc_html($query[0]->person_email)) . '</td>
								</tr>';

				if($query[0]->aditional_notes !== '' && $query[0]->aditional_notes !== null) {
					$mail->Body .= 	'<tr>
										<th colspan="2" style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px 20px 10px; text-align: left;">
											' . htmlentities(esc_html('Notas adicionales:')) . '
										</th>
									</tr>';
					$mail->Body .= 	'<tr>
										<td colspan="2" style="font-size: 16px; padding: 10px 20px 20px; text-align: left;">' . htmlentities(esc_html($query[0]->aditional_notes)) . '</td>
									</tr>';
				}
								
				$mail->Body .=	'</table>
								</div>
								</div>';

				$mail->Body .=	'<div style="border-top: 1px solid #ccc; color: #AAAAAA; font-family: Arial; padding: 30px; text-align: center;">';

				$mail->Body .=	'<p style="margin: 0px auto 10px;">' . htmlentities(esc_html('© ')) . date('Y') . '</p>';
								
				$mail->Body .=	'<p style="margin: 0px;">
									<a href="' . $home_url . '" target="_blank" style="color: #AAAAAA;">' . htmlentities(esc_html($sitename)) . '</a>
								</p>';

				$mail->Body .=	'</div>
								</div>
								</div>';
            
                $mail->Body .= '</body></html>';
            
                if($mail->send()) {
                    return true;
                } else {
                	$resp['error'] = $mail->ErrorInfo;
                	return $resp;
                }
				
			} else {
				return false;
			}

		}

	}

 ?>