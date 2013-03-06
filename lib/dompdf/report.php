<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<style type="text/css">
			body {
				margin: 0;
				padding: 0;
				font: 13px arial, helvetica, clean, sans-serif;
			}
			.vMain {
				width: 180mm;
				/*				height: 128.5mm;*/
				color: #000;
				margin: 0 auto;
				margin-top: 20mm;
				margin-bottom: 20mm;
			}

			.thickBorder th {
				border-bottom: 2px double #000;
				font-weight: 600;
				font-size: 14px;
			}
		</style>
	</head>
	<body>
		<div class="vMain">
			<table width="100%">
				<tr>
					<td style="text-align: left; font: 18px sans-serif; font-weight: 600;"><?php echo $show; ?> Report</td>
					<td style="text-align: right; font: 18px sans-serif; font-weight: 600;"><?php echo date('Y-m-d H:i:s'); ?></td>
				</tr>
			</table>
			<table width="100%">
				<tr class="thickBorder">
					<th>Transaction ID</th>
					<th>Date</th>
					<th>Full Payment</th>
					<th>Status</th>
					<th>Receiver</th>
					<th>Transaction Type</th>
					<th>Account balance</th>
				</tr>
				<?php foreach ($to_csv as $csv) { ?>
					<tr>
						<td align="center" colspan="1"><?php echo $csv[0]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[1]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[2]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[3]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[4]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[5]; ?></td>
						<td align="center" colspan="1"><?php echo $csv[6]; ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>