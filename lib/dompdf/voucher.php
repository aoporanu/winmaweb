<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <style type="text/css">
      body {
        margin: 0px;
        padding: 0px;
				font: 13px/1.231 arial,helvetica,clean,sans-serif;
      }
      p{
        margin: 0px;
        padding: 0px;
      }

      .vMain {
        width: 210mm;
        height: 128.5mm;
				border: 2px solid #318794;
        color: #000;
        font-family: verdana;
				margin: auto;
				border-top-left-radius: 5px;
				border-top-right-radius: 5px;
      }
			.logo {
				/*				background: url("/images/site/header-logo-box2.png") no-repeat scroll left top transparent;*/
				height: 75px;
				width: auto;
				border-top-left-radius: 5px;
				border-top-right-radius: 5px;
				background-color: #333;
			}
			.logo a {
				color: #fff;
				display: block;
				font-size: 25px;
				letter-spacing: -1px;
				padding: 20px 0 5px 200px;
				text-decoration: none;
				position: relative;
				right: -370px;
				width: 260px;
			}
			.content {
				margin: 20px 40px 0px 40px;
				font-size: 16px;
			}

			.c_sections {
				width: 40%;
				font-size: 18px;
			}
			.left {
				float: left;
			}
			.right {
				float: right;
			}

			.c_sections ul li {
				margin: 3px 0px;
				list-style: none;
				display: block;
				width: 100%;
				clear: both;
			}

			.c_sections ul li div.s_left {
				float: left;
				width: 100px;
			}
			.clear {
				clear: both;
				font-size: 1px;
				line-height: 0px;
				height: 0px;
			}
			.wmw_text {
				width: 100%;
				float: left;
			}

			.hr {
				width: 36.5%;
				float: left;
			}
			.wmw_text span {
				text-decoration: line-through;
			}

			.title {
				color: #FFF;
				font-size: 30px;
				padding-left: 130mm;
				padding-bottom: 40mm;
			}

			.image_row {
				width: 100%;
				text-decoration: line-through;
			}
    </style>
  </head>
  <body>
    <div class="vMain">
			<div class="logo">
				<img src="<?php echo ROOT_PATH; ?>/images/site/header-logo-box2.png" width="100px" height="70px" style="padding-top: 5px;" />
				<span class="title">WMW Voucher</span>
			</div>
      <div class="content">
				<table width="100%">
					<tr>
						<td class="c_sections">
							<table width="100%;">
								<tr>
									<td style="font-size: 20px; color: #318794; text-align: center; padding-bottom: 10px; padding-top: 20px;" colspan="3"><?php echo $coupon['name']; ?></td>
								</tr>
								<tr>
									<td style="font-size: 20px; color: #318794; text-align: center; padding-bottom: 10px" colspan="3"><?php echo ($coupon['friend'] == 1 ? $coupon['Friend']['first_name'] . ' ' . $coupon['Friend']['last_name'] : $coupon['Owner']['first_name'] . ' ' . $coupon['Owner']['last_name']); ?></td>
								</tr>
								<tr>
									<td style="font-size: 20px; color: #ef7b23; text-align: center; padding-bottom: 10px" colspan="3"><?php echo $cost; ?></td>
								</tr>
								<tr>
									<td style="font-size: 17px; color: #318794; text-align: center; padding-bottom: 10px;" colspan="3">Created on:&nbsp;<?php echo $date_start; ?></td>
								</tr>
								<tr>
									<td style="font-size: 17px; color: #318794; text-align: center; padding-bottom: 18px;" colspan="3">Expires on:&nbsp;<?php echo $date_end; ?></td>
								</tr>

								<tr>
<!--									<td align="center">
										<table style="border-bottom: 1px solid #ccc;" width="100%;" height="10px">
											<tr>
												<td style="font-size: 10px; color: #fff;">a</td>
											</tr>
										</table>
										<table width="100%">

										</table>
										<div style="width: 100%; border-bottom: 1px solid #ccc; height: 15px;"></div>
									</td>-->
									<td align="center" colspan="3">
										<p style="margin: 0 auto; width: 100%;">
											<img src="<?php echo ROOT_PATH; ?>/images/voucher_image.png" height="70px" width="700mm" /></span>
										</p>
									</td>
<!--									<td align="center">
										<table style="border-bottom: 1px solid #ccc;" width="100%;" height="10px">
											<tr>
												<td style="font-size: 10px; color: #fff;">a</td>
											</tr>
										</table>
										<table width="100%">

										</table>
										<div style="width: 100%; border-bottom: 1px solid #ccc; height: 15px;"></div>
									</td>-->
								</tr>
								<tr>
									<td style="font-size: 12px; color: #318794" valign="top">
										<table>
											<tr>
												<td style="font-size: 12px; color: #318794;"><?php echo $coupon['code']; ?></td>
											</tr>
											<tr>
												<td>
													<img src="<?php echo ROOT_PATH; ?>/images/barcode.JPG" width="130px" height="70px" />
												</td>
											</tr>
											<tr>
												<td style="font-size: 12px; color: #318794"><?php echo $coupon['code2']; ?></td>
											</tr>
										</table>
									</td>
									<td style="font-size: 10px; color: #318794; width: 3%;">&nbsp;</td>
									<td valign="top" rowspan="2" style="color: #318794; font-size: 10px;"><div style="border-left: 1px solid #333; padding-left: 3px; margin-left: -113px;">The following are your terms and conditions<br />1. Print voucher.<br />2. Present voucher to the merchant.<br />3. Tip generously on the full bill amount!</div></td>
								</tr>
                <tr>
									<td style="font-size: 10px; color: #318794" valign="top">&nbsp;</td>
									<td style="font-size: 7px; color: #318794; width: 25%;">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
    </div>
  </body>
	<html>