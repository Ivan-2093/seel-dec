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
						<strong style="font-size: 20px;">Hola <?php echo $name_user ?></strong>,
                        <br/><br/>
                        Gracias por confiar en SEELDEC S.A. Te agradeceríamos que nos dieras 5 minutos o menos para responder una breve encuesta y compartirnos cómo fue tu experiencia con nosotros.
					</td>
				</tr>
				<tr>
					<td style="font-family: 'Open Sans', Arial, sans-serif;
															font-size: 16px;
															line-height: 30px;
															color: #000000;
														" valign="top" align="center">
                        <form action="<?=base_url()?>EncuestasController" method="post" target="_blank">
                            <input type="hidden" name="id_negocio" value="<?= $id_negocio ?>"/>
                            <button style="text-decoration: none" type="submit" class="">¡Te escuchamos aquí!</button>
                        </form>	
                    </td>
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
						
						<br/><br/>
						Gracias, el equipo de SEELDEC
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
<?php $this->load->view('mails/footer'); ?>