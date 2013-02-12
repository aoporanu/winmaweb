<?php
//$sku_rand = rand(10000,99999);
//$fileName = $sku_rand.'.pdf';
//$filePath = ROOT_PATH.'/lib/dompdf/vouchers/';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <style type="text/css">
      body {
        margin: 0px;
        padding: 0px;
      }
      p{
        margin: 0px;
        padding: 0px;
      }

      .vMain {
        width: 1050px;
        height: 517px;
        padding-top: 275px;
        padding-left: 100px;
        background-image: url('/lib/dompdf/bg-voucher1.png');
        background-repeat: no-repeat;
        color: #80D4F7;
        font-family: verdana;
      }
      .vBidderName {
        font-size: 24px;
        color: #4273B8;
      }
      .vPersons {
        padding-top: 45px;
        font-size: 24px;
        color: #4272B9;
      }
      .vOfferName1 {
        padding-left: 628px;
        padding-top: -70px;
        font-size: 24px;
        font-weight: bold;
        color: #00ADEE;
      }
      .vOfferName2 {
        padding-left: 628px;
        padding-top: -40px;
        height: 30px;
        font-size: 24px;
        font-weight: bold;
        color: #6BCFF6;
      }
      .vOfferName3 {
        padding-left: 628px;
        padding-top: -10px;
        height: 30px;
        font-size: 24px;
        font-weight: bold;
        color: #6BCFF6;
      }
      .vName {
        padding-left: 628px;
        padding-top: 55px;
        font-size: 13px;
        font-weight: bold;
        color: #00ADEE;
      }
      .vNameP {
        padding-left: 628px;
        padding-top: -22px;
        font-size: 13px;
        font-weight: bold;
        color: #00ADEE;
      }
      .vPrice {
        padding-top: 65px;
        font-size: 24px;
        color: #4272B9;
      }
      .vPriceP {
        padding-top: 65px;
        font-size: 24px;
        color: #4272B9;
      }
      .vDescription {
        width: 570px;
        padding-top: 98px;
        font-size: 11px;
        text-align: justify;
        height: 70px;
        overflow: hidden;
        color: #838487;
      }
      .vDescriptionP {
        width: 570px;
        padding-top: 98px;
        font-size: 11px;
        text-align: justify;
        height: 70px;
        overflow: hidden;
        color: #838487;
      }
      .vCode {
        padding-top: 8px;
        padding-left: 785px;
        font-size: 13px;
        font-weight: bold;
        color: #00ADEE;
      }
      .vCodeP {
        padding-top: 8px;
        padding-left: 785px;
        font-size: 13px;
        font-weight: bold;
        color: #00ADEE;
      }
      .vAddress {
        padding-top: -68px;
        padding-left: 690px;
        font-size: 10px;
        text-align: justify;
        height: 50px;
        overflow: hidden;
        color: #838487;
      }
      .vDateAdded {
        padding-top: -24px;
        padding-left: 690px;
        font-size: 10px;
        text-align: justify;
        height: 50px;
        overflow: hidden;
        color: #838487;
      }
      .vAddressP {
        padding-top: -75px;
        padding-left: 690px;
        font-size: 10px;
        text-align: justify;
        height: 50px;
        overflow: hidden;
        color: #838487;
      }
      .vDateAddedP {
        padding-top: -30px;
        padding-left: 690px;
        font-size: 10px;
        text-align: justify;
        height: 50px;
        overflow: hidden;
        color: #838487;
      }
    </style>
  </head>
  <body>
    <div class="vMain">
      <?php 
      $offer_name = utf8_decode(trim(html_entity_decode($row['auction_name'])));
      $offer_name1 = $coupon['name'];
      $offer_name = trim(str_replace($offer_name1, '', $offer_name));
      if (strlen($offer_name) > 0){
        $offer_name2 = trim(splitString($offer_name, 20));
        $offer_name = trim(str_replace($offer_name2, '', $offer_name));
        if (strlen($offer_name) > 0){
          $offer_name3 = $offer_name;
        }
        else{
          $offer_name3 = '&nbsp;';
        }
      }
      
      $voucher_description = utf8_decode(trim(html_entity_decode($row['voucher_description'])));
      $voucher_description = '';
      
      $supplier_name = utf8_decode(trim(html_entity_decode($row['supplier_name'])));
      ?>
        <div class="vBidderName"><?php echo $row['bidder_name']; ?></div>
        <div class="vOfferName1"><?php echo $offer_name1; ?></div>
        <div class="vOfferName2"><?php echo $offer_name2; ?></div>
        <div class="vOfferName3"><?php echo $offer_name3; ?></div>
        <?php if ($row['auction_number_of_persons'] > 1) { ?>
        <div class="vPersons"><?php echo $row['auction_number_of_persons']; ?> personen</div>
        <div class="vNameP"><?php echo $supplier_name; ?></div>
        <div class="vPriceP">&#8364; <?php echo $row['price']; ?></div>
        <div class="vDescriptionP"><?php echo $voucher_description; ?></div>
        <div class="vAddressP"><?php echo $row['voucher_address']; ?></div>
        <div class="vDateAddedP"><?php echo date('Y-m-d', strtotime($row['date_added'])); ?></div>
        <div class="vCodeP"><?php echo $row['auction_sku'].$sku_rand; ?></div>
        <?php } else{  ?>
        <div class="vName"><?php echo $supplier_name; ?></div>
        <div class="vPrice">&#8364; <?php echo $row['price']; ?></div>
        <div class="vDescription"><?php echo $voucher_description; ?></div>
        <div class="vAddress"><?php echo $row['voucher_address']; ?></div>
        <div class="vDateAdded"><?php echo date('Y-m-d', strtotime($row['date_added'])); ?></div>
        <div class="vCode"><?php echo $row['auction_sku'].$sku_rand; ?></div>
        <?php } ?>
    </div>
  </body>
<html>