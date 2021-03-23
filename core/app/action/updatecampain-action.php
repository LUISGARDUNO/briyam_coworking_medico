<?php

if(count($_POST)>0){
	$product = CampainData::getById($_POST["campain_id"]);

	$product->title = $_POST["title"];
	$product->description = $_POST["description"];
	$product->url1 = $_POST["url1"];
	$product->url2 = $_POST["url2"];
	$product->html1 = $_POST["html1"];

	$product->user_id = $_SESSION["user_id"];

	if(isset($_FILES["img1"])){
		$image = new Upload($_FILES["img1"]);
		if($image->uploaded){
			$image->Process("storage/imgs/");
			if($image->processed){
				$product->img1 = $image->file_dst_name;
			}
		}
	}

	if(isset($_FILES["img2"])){
		$image = new Upload($_FILES["img2"]);
		if($image->uploaded){
			$image->Process("storage/imgs/");
			if($image->processed){
				$product->img2 = $image->file_dst_name;
			}
		}
	}
	$product->update();


	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editcampain&id=$_POST[campain_id]';</script>";


}


?>