<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
$dataC = $dataCotizacion->row(0);
$nombreAsesor = $dataC->primer_nombre . ' ' . $dataC->segundo_nombre . ' ' . $dataC->primer_apellido . ' ' . $dataC->segundo_apellido;
?>

<body>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px ;">
		<tr>
			<td width="50%" align="center"></td>
			<td width="50%" align="right">
				<table style="font-size: 12px ;">
					<tr>
						<td align="right"><span align="left">Número cotización: <?= $dataCotizacion->row(0)->id_cotizacion ?></span>

						</td>
					</tr>
					<tr>
						<td align="right"><span align="left">Fecha cotización: <?= Date('Y-m-d') ?> </span>

						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px ;">
		<tr>
			<td width="100%" colspan="2" align="center">
				<table width="100%" border="1" style="border-collapse:collapse; font-size: 12px ;">
					<tr>
						<td width="100%" colspan="3" align="center" class="trColor">Información del asesor</td>
					</tr>
					<tr class="tdColor">
						<td width="45%" align="center">Asesor</td>
						<td width="45%" align="center">Correo</td>
						<td width="10%" align="center">Telefono</td>
					</tr>
					<tr>
						<td width="45%" align="center"><?= $nombreAsesor ?></td>
						<td width="45%" align="center"><?= $dataC->email_emp ?></td>
						<td width="10%" align="center"><?= $dataC->telefono_emp ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br />
	<table border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px ;">
		<tr>
			<td width="100%" colspan="2" align="center">
				<table width="100%" border="1" style="border-collapse:collapse;font-size: 12px ;">
					<tr>
						<td width="100%" colspan="3" align="center" class="trColor">Datos del cliente</td>
					</tr>
					<tr class="tdColor">
						<td width="45%" align="center">Cliente</td>
						<td width="45%" align="center">Correo</td>
						<td width="10%" align="center">Telefono</td>
					</tr>
					<tr>
						<td width="45%" align="center"><?= $dataC->nombre_cliente ?></td>
						<td width="45%" align="center"><?= $dataC->correo_cli ?></td>
						<td width="10%" align="center"><?= $dataC->telefono_cli ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br />
	<table width="100%" border="1" style="border-collapse:collapse;font-size: 12px ;">
		<tr>
			<td width="100%" colspan="3" align="center" class="trColor">PRODUCTOS</td>
		</tr>
		<tr class="tdColor">
			<td width="10%" align="center">CANT</td>
			<td width="60%" align="center">PRODUCTO</td>
			<td width="30%" align="center">VALOR</td>
		</tr>
		<?php
		if ($dataCotizacionDetalle->num_rows() > 0) {
			$suma_total = 0;
			foreach ($dataCotizacionDetalle->result() as $row) {

				$valor_product = $row->cant_producto * $row->precio_producto;
				$suma_total += $valor_product;
				echo '<tr>
					<td width="10%" align="center">' . $row->cant_producto . '</td>
					<td width="60%" align="left">' . $row->referencia . '</td>
					<td width="30%" align="right">$' . number_format($valor_product, 0, '.', ',') . '</td>
				</tr>';
			}
		}
		?>
	</table>
	<table width="100%" border="1" style="border-collapse:collapse;font-size: 12px ;">
		<tr bgcolor="#999999" align="right">
			<td width="70%" colspan="2" align="right">Valor total cotización</td>
			<td width="30%" align="right">$<?= number_format($suma_total, 0, '.', ',') ?></td>
		</tr>
	</table>
	<p style="font-size: 12px ;"><strong>Solicitud cliente: </strong><?= $observacion ?></p>
	<br>
	<p style="font-size: 12px ;"><strong>Observación del asesor: </strong><?= $dataC->observacion ?></p>
</body>

</html>