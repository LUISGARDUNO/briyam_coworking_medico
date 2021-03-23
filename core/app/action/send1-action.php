<?php

$msg = new MsgData();
$msg->content = $_POST["content"];
$msg->file = "";
if(isset($_FILES["file"])){
	$upload = new Upload($_FILES["file"]);
	if($upload->uploaded){
		$upload->Process("storage/files/");
		if($upload->processed){
			$msg->file = $upload->file_dst_name;
		}
	}
}

$msg->pacient_id = $_SESSION["pacient_id"];
$msg->medic_id = $_POST["medic_id"]; // 
$msg->kind= 1;
$msg->add();

Core::redir("./?view=openchat&medic_id=".$_POST["medic_id"]);
?>