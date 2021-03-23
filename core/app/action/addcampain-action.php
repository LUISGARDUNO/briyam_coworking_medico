<?php

if(count($_POST)>0){
  $product = new CampainData();
  $alpha = "abcdefghijklmnopqrstuvwxyz".strtoupper("abcdefghijklmnopqrstuvwxyz")."1234567890-_";
  $code ="";
  for($i=0;$i<9;$i++){ $code.= $alpha[rand(0,strlen($alpha)-1)]; }
  $product->code = $code;
  $product->replyemail = $_POST["replyemail"];
  $product->replyname = $_POST["replyname"];
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


  $prod= $product->add();






//print "<script>window.location='index.php?view=campains';</script>";


}


?>