<?php
if(!empty($_POST)){
$campain = CampainData::getById($_POST["campain_id"]);
$lists = CampainListData::getAllByCampainId($campain->id);
$basehost= ConfigurationData::getByPreffix("base_host")->val;
foreach ($lists as $list) {
	$clients = PersonData::getAllByListId($list->list_id);
	foreach($clients as $client){
		$url1 = $basehost."?action=view&cco=".$campain->code."&ccl=".$client->code."&href=1";
		$url2 = $basehost."?action=view&cco=".$campain->code."&ccl=".$client->code."&href=2";
		$themessage = '
		<meta content="es-mx" http-equiv="Content-Language" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<body>
		<center>
		<a href="'.$url1.'"><img src="'."storage/imgs/".$campain->img1.'"></a>
		<br>
		<a href="'.$url2.'"><img src="'."storage/imgs/".$campain->img2.'"></a>
		'.htmlentities($campain->html1).'
		</center>
		</body>   ';

		mail("$campain->replyemail",
		     "Nuevo registro",
		     "$themessage",
			 "From: $campain->replyemail\nReply-To: $campain->replyemail\nContent-Type: text/html; charset=ISO-8859-1");
	}
}

$campain->status_id=3; // finalizado
$campain->update_status();

Core::redir("./?view=campains");

}



?>