<?php 

	$info = [];

	class Emails {

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . 'ecw_emails'; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						subject VARCHAR(100) NOT NULL,
						message VARCHAR(1000) NOT NULL,
						from VARCHAR(200) NOT NULL,
						to VARCHAR(200) NOT NULL
					) CHARACTER SET utf8;";

			$wpdb->query($sql);

		}

		public function get_all() {

			//Get all services model

		}

		public function reservation($id) {

			require_once("../../../../../wp-load.php");

			global $wpdb;

            $treservation = $wpdb->prefix . 'ecw_reservations'; // Table name
			$tcategory = $wpdb->prefix . 'ecw_categories';
			$tservice = $wpdb->prefix . 'ecw_services';
			$temployee = $wpdb->prefix . 'ecw_employees';

			//Date vars
			$smonths = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
			$emonths = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

            $sql = "SELECT $treservation.*, $tservice.title AS service_title, $tcategory.title AS category_title, $temployee.name AS employee_name, $temployee.lastname AS employee_lastname FROM $treservation 
					INNER JOIN $tcategory ON $treservation.category_id = $tcategory.id
					INNER JOIN $tservice ON $treservation.service_id = $tservice.id
					INNER JOIN $temployee ON $treservation.employee_id = $temployee.id
					WHERE $treservation.id = '$id'
					";

			$query = $wpdb->get_results($sql);

			if($query) {

				require_once dirname(__FILE__, 2) . '/libs/PHPMailer/src/PHPMailer.php';
				require_once dirname(__FILE__, 2) . '/libs/PHPMailer/src/SMTP.php';
            	require_once dirname(__FILE__, 2) . '/libs/PHPMailer/src/Exception.php';

            	$dt = new DateTime($query[0]->reservation_date);
				$fdt = $dt->format('F d, Y');
				$date = str_ireplace($emonths, $smonths, $fdt);
                
                $mail = new PHPMailer\PHPMailer\PHPMailer();  // Passing `true` enables exceptions
                //Server settings
                $mail->SMTPDebug = 2; // Enable verbose debug output
                //$mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'mail.webussines.com.co';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = false;                               // Enable SMTP authentication
            
                //Recipients
                $mail->setFrom('diseno@webussines.com', 'Reservas');
                $mail->addAddress($query[0]->person_email); // Add a recipient
            
                //Content
                $mail->isHTML(true); // Set email format to HTML
                //$mail->AddEmbeddedImage('img/logo.png', 'logopng', 'logopng');
                $mail->Subject = 'Registro de nueva reserva';
                
                $mail->Body = '<html><body>';

                $mail->Body = '<div style="width: 100%; background-color: #f2f2f2; padding-bottom: 20px; padding-top: 20px;">
								<div style="background-color: #fff; border-radius: 10px; overflow: hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; box-sizing: border-box;  margin-left: auto; margin-right: auto; width: 600px;">
									<!--Header email-->
									<div style="background-color: #1864a0; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 30px;">
										<a href="#" target="_blank">
											<img style="display: block; margin-left: auto; margin-right: auto; max-height: 60px;" src="https://www.comercialweb.com.co/images/nuevas/logocomercialweb.png" />
										</a>
									</div>';

				$mail->Body = '<div style="color: #AAAAAA; font-size: 16px; line-height: normal; padding: 50px; font-family: Arial;">
									<div style="padding-bottom: 10px;">
										<p style="font-size: 18px; margin-top: 0px; text-align: left;">Se registró exitosamente la cita para el <b>' .  $date . '</b>.</p>
										<p style="font-size: 16px; text-align: left;">A countinuación se muestran los datos de la reserva. Si existe algún error por favor comunicarse al correo escrito al final de este correo electrónico.</p>
									</div>';

				$mail->Body = '<div style="padding-bottom: 10px;">';

				$mail->Body = '<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse;">';
									
				$mail->Body =	'<tr>
									<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
										Información de la reserva:
									</th>
								</tr>';

				$mail->Body =	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Fecha:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $newDate . '</td>
								</tr>';

				$mail->Body =	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Hora:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->reservation_hour . '</td>
								</tr>';

				$mail->Body =	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Servicio:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->service_title . '</td>
								</tr>';

				$mail->Body =	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Categoría:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->category_title . '</td>
								</tr>';

				$mail->Body =	'<tr>
									<th style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Empleado:
									</th>
									<td style="border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->employee_name . ' ' . $query[0]->employee_lastname . '</td>
								</tr>';
								
				$mail->Body =	'</table>';

				$mail->Body =	'<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse; margin-top: 20px;">';
								
				$mail->Body = 	'<tr>
									<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
										Información personal:
									</th>
								</tr>';

				$mail->Body = 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Nombre completo:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->person_name . '</td>
								</tr>';

				$mail->Body = 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Teléfono / Celular:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->person_phone . '</td>
								</tr>';

				$mail->Body = 	'<tr>
									<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
										Correo electrónico:
									</th>
									<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">' . $query[0]->person_email . '</td>
								</tr>';

				if($query[0]->aditional_notes !== '' && $query[0]->aditional_notes !== null) {
					$mail->Body = 	'<tr>
										<th style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
											Notas adicionales:
										</th>
										<td style="border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
											Notas adicionales
										</td>
									</tr>';
				}
								
				$mail->Body =	'</table>
								</div>
								</div>';

				$mail->Body =	'<div style="border-top: 1px solid #ccc; color: #AAAAAA; font-family: Arial; padding: 30px; text-align: center;">';
								
				$mail->Body =	'<p style="margin-top: 0px;">
									<a style="color: #AAAAAA;">Condiciones de servicio & Política de privacidad</a>
								</p>';

				$mail->Body =	'<p style="margin: 0px auto 10px;">© ' . date('Y') . '</p>';
								
				$mail->Body =	'<p style="margin: 0px;">
									<a href="' . get_home_url() . '" target="_blank" style="color: #AAAAAA;">' . bloginfo('name') . '</a>
								</p>';

				$mail->Body =	'</div>
								</div>
								</div>';
            
                $mail->Body .= '</body></html>';
            
                if($mail->send()) {
                    return $info;
                } else {
                	$info['error'] = $mail->ErrorInfo;
                	return $info;
                }
				
			} else {
				return false;
			}

		}

	}

 ?>