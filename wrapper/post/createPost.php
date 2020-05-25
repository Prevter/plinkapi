<?php
	require_once("../config.php");
	if(isset($_GET["content"]) && !empty($_GET["content"])){
        $delimiter = '-------------'.uniqid();
        $text = $_GET["content"];
        $post = array('content'=>$text);
        $headers = array(
            'Authorization: Token '.$token,
            'Content-Type: multipart/form-data; boundary=' . $delimiter,
        );
        $ch = curl_init();
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
 	    curl_setopt($ch, CURLOPT_URL, "https://plink.tech/posts/");
  	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);      
        curl_exec($ch);
    }
    else{
    	exit("content not defined!");
    }
?>