<?php $this->load->view('mails/header') ?>
<tr>
	<td style="padding: 35px 70px 30px; background-color: #90EE90;" class="em_padd" valign="top" align="center">
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
			<tbody>
				<tr>
					<td style="font-family: 'Open Sans', Arial, sans-serif;
															font-size: 16px;
															line-height: 30px;
															color: #000000;
														" valign="top" align="left">
						Hola <?php echo $name_user ?>,<br /><br />

						Recientemente ha solicitado: <br /><br />

					</td>
				</tr>
				<tr>
					<td style=" width: 6px" width="6">&nbsp;</td>
				</tr>
				<tr>
					<td style="width: 6px" width="6">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-family: 'Open Sans', Arial, sans-serif;
															font-size: 16px;
															line-height: 30px;
															color: #000000;
														" valign="top" align="left">
						A continuación encontrarás la cotización del servicio<br />
						<br /><br />
						Gracias, el equipo de SEELDEC
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
<?php $this->load->view('mails/footer'); ?>