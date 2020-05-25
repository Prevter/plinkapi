<?php
	require_once("../config.php");
	if(isset($_GET["slug"]) && !empty($_GET["slug"])){
		$slug = $_GET["slug"];
		$curl = curl_init();
		$headers = array(
			'Authorization: Token '.$token
		);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
 	   curl_setopt($curl, CURLOPT_URL, "https://plink.tech/user/".$slug."/");
  	  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  	  $result = curl_exec($curl);
   	 curl_close($curl);
   	 $arr = json_decode($result);
    	$usr = array(
			"username" => $arr->username,
			"slug" => $arr->slug,
			"avatar" => $arr->avatar,
			"fols" => $arr->followers_count,
			"subs" => $arr->following_count
		);
    	echo json_encode($usr);
    }
    else{
    	exit("slug not defined!");
    }
?>