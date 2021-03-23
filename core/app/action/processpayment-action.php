<?php

$re = ReservationData::getById($_GET["id"]);
//$p = PriceData::getById($re->price_id);
	$paypal_business = ConfigurationData::getByPreffix("paypal_business")->val;
	$paypal_currency = ConfigurationData::getByPreffix("paypal_currency")->val;
	$paypal_cursymbol = ConfigurationData::getByPreffix("paypal_cursymbol")->val;
	$paypal_location = ConfigurationData::getByPreffix("paypal_location")->val;
	$paypal_returnurl = ConfigurationData::getByPreffix("paypal_returnurl")->val;
	$paypal_returntxt = ConfigurationData::getByPreffix("paypal_returntxt")->val;
	$paypal_cancelurl = ConfigurationData::getByPreffix("paypal_cancelurl")->val;

	// complete the return and cancel URL

	$paypal_returnurl .= "&id=".$re->id;
	$paypal_cancelurl .= "&id=".$re->id;

	// from wc
	// https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=evilnapsis%40gmail.com&no_note=1&currency_code=USD&charset=utf-8&rm=1&upload=1&return=http%3A%2F%2Flocalhost%2Fwp%2Fcheckout%2Forder-received%2F76%3Fkey%3Dwc_order_567671a554da3%26%23038%3Butm_nooverride%3D1&cancel_return=http%3A%2F%2Flocalhost%2Fwp%2Fcart%2F%3Fcancel_order%3Dtrue%26%23038%3Border%3Dwc_order_567671a554da3%26%23038%3Border_id%3D76%26%23038%3Bredirect%26%23038%3B_wpnonce%3Dd2d1c85888&page_style=&paymentaction=sale&bn=WooThemes_Cart&invoice=WC-76&custom=%7B%22order_id%22%3A76%2C%22order_key%22%3A%22wc_order_567671a554da3%22%7D&notify_url=http%3A%2F%2Flocalhost%2Fwp%2Fwc-api%2FWC_Gateway_Paypal%2F&first_name=Agustin&last_name=Ramos&company=&address1=Cardenas&address2=&city=Cardenas&state=CA&zip=86680&country=US&email=evilnapsis%40gmail.com&night_phone_a=222&night_phone_b=0&night_phone_c=0&day_phone_a=222&day_phone_b=0&day_phone_c=0&no_shipping=1&item_name_1=Laptop+HP&quantity_1=1&amount_1=100.00&item_number_1=&tax_cart=0.00
	// https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=&no_note=1&currency_code=USD&charset=utf-8&rm=1&upload=1&business=&return=http%3A%2F%2Flocalhost%2Fkatana-pro%2F%3Faction%3Dppdone%26id%3D0%26k%3DSJj6_c7ClhF&cancel_return=http%3A%2F%2Flocalhost%2Fkatana-pro%2F%3Faction%3Dppcancel%26id%3D0%26k%3DSJj6_c7ClhF&page_style=&paymentaction=sale&bn=katanapro_cart&invoice=KP-0
	
//https://www.paypal.com/webapps/hermes?token=9YS24545BM057913V&useraction=commit&rm=1&mfid=1497406891685_b47e83e948242#/checkout/login

	$ppurl = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart";
	$ppurl .= "&business=".$paypal_business;
	$ppurl .= "&no_note=1";
	$ppurl .= "&currency_code=".$paypal_currency;
	$ppurl .= "&charset=utf-8&rm=1&upload=1";
	$ppurl .= "&business=".$paypal_business;
	$ppurl .= "&return=".urlencode($paypal_returnurl);
	$ppurl .= "&cancel_return=".urlencode($paypal_cancelurl);
	$ppurl .= "&page_style=&paymentaction=sale&bn=bmp_cart&invoice=KP-$re->id";
//	echo $ppurl;


	$i=1;
	$total=0;
//	print_r($_SESSION["cart"]);
//if(!isset($_SESSION["coupon"])){
//	foreach ($_SESSION["cart"] as $c) {
	//	$product = ProductData::getById($c["product_id"]);
	//	$c["product_id"];
	//	$q = $c["q"];
		$ppurl.="&item_name_1=".urlencode("Cita medica #".$re->id)."&quantity_1=1&amount_1=".($re->price)."&item_number_1=";
	//	$i++;
	//	$total+=$product->price*$q;
//	}
//}



	$ppurl.= "&tax_cart=0.00";
//echo $ppurl;
//	echo urldecode("http%3A%2F%2Flocalhost%2Fwp%2Fcheckout%2Forder-received%2F76%3Fkey%3Dwc_order_567671a554da3%26%23038%3Butm_nooverride%3D1");
//	$ppurl .= "&business=".$paypal_business;
//unset($_SESSION["cart"]);
//unset($_SESSION["coupon"]);

Core::redir($ppurl);

?>