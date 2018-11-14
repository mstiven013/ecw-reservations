<div style="width: 100%; background-color: #f2f2f2; padding-bottom: 20px; padding-top: 20px;">
	<div style="background-color: #fff; border-radius: 10px; overflow: hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; box-sizing: border-box;  margin-left: auto; margin-right: auto; width: 600px;">
		<!--Header email-->
		<div style="background-color: #1864a0; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 30px;">
			<a href="http://kipoc.com" target="_blank">
				<img style="display: block; margin-left: auto; margin-right: auto; max-height: 60px;" src="https://www.comercialweb.com.co/images/nuevas/logocomercialweb.png" />
			</a>
		</div>
		<!--Body email-->
		<div style="color: #AAAAAA; font-size: 16px; line-height: normal; padding: 50px; font-family: Arial;">
			<div style="padding-bottom: 10px;">
				<p style="font-size: 18px; margin-top: 0px; text-align: left;">Se registró exitosamente la cita para el <b><?php echo $newDate; ?></b>.</p>
				<p style="font-size: 16px; text-align: left;">A countinuación se muestran los datos de la reserva. Si existe algún error por favor comunicarse al correo escrito al final de este correo electrónico.</p>
			</div>
			<div style="padding-bottom: 10px;">
				<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse;">
					<tr>
						<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
							Información de la reserva:
						</th>
					</tr>
					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Fecha:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							<?php echo $newDate; ?>
						</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Hora:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">Hora</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Servicio:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">Servicio</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Categoría:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">Categoría</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Empleado:
						</th>
						<td style="border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">Empleado</td>
					</tr>
				</table>
				<table width="100%" align="center" style="color: #AAAAAA; border-collapse: collapse; margin-top: 20px;">
					<tr>
						<th colspan="2" style="color: #1864a0; border-bottom: 1px solid #e4e4e4; font-size: 18px; padding: 20px; text-align: left;">
							Información personal:
						</th>
					</tr>
					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Nombre completo:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Nombre completo
						</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Teléfono / Celular:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Teléfono / Celular
						</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Correo electrónico:
						</th>
						<td style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Correo electrónico
						</td>
					</tr>

					<tr>
						<th style="color: #6b6b6b; border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Notas adicionales:
						</th>
						<td style="border-top: 1px solid #e4e4e4; font-size: 16px; padding: 20px; text-align: left;">
							Notas adicionales
						</td>
					</tr>
				</table>
			</div>
		</div>

		<!--Footer email-->
		<div style="border-top: 1px solid #ccc; color: #AAAAAA; font-family: Arial; padding: 30px; text-align: center;">
			<p style="margin-top: 0px;">
				<a style="color: #AAAAAA;">Condiciones de servicio & Política de privacidad</a>
			</p>
			<p style="margin: 0px auto 10px;">© <?php echo date('Y'); ?></p>
			<p style="margin: 0px;">
				<a href="http://kipoc.com" target="_blank" style="color: #AAAAAA;">Nombre del sitio</a>
			</p>
		</div>

	</div>
</div>