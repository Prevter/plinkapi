<?php
	require_once("../config.php");
	$curl = curl_init();
	$headers = array(
		'Authorization: Token '.$token
	);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_URL, "https://plink.tech/user/");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;
?>