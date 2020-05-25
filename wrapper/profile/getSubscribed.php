<?php
	require_once("../config.php");
	///contacts/[slug]/?page=1&limit=200
	if(isset($_GET["slug"]) && !empty($_GET["slug"])){
		$slug = $_GET["slug"];
		$curl = curl_init();
		$headers = array(
			'Authorization: Token '.$token
		);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
 	   curl_setopt($curl, CURLOPT_URL, "https://plink.tech/contacts/".$slug."/?page=1&limit=200");
  	  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  	  $result = curl_exec($curl);
   	 curl_close($curl);
   	 $arr = json_decode($result);
    	$users = array();
    	foreach($arr->results as $acc){
    		$usr = array(
				"username" => $acc->username,
				"slug" => $acc->slug
			);
			array_push($users,$usr);
    	}
    	echo json_encode($users);
    }
    else{
    	exit("slug not defined!");
    }
?>