<?php
	require_once("../config.php");
	if(isset($_GET["slug"]) && !empty($_GET["slug"]) && isset($_GET["post"]) && !empty($_GET["post"])){
		$slug = $_GET["slug"];
		$post = $_GET["post"];
		$curl = curl_init();
		$headers = array(
			'Authorization: Token '.$token
		);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
 	   curl_setopt($curl, CURLOPT_URL, "https://plink.tech/posts/".$slug."/?page=".$post."&limit=1");
  	  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  	  $result = curl_exec($curl);
   	 curl_close($curl);
   	 $posts = json_decode($result);
		//echo $result;
		foreach($posts->results as $arr){
    		$post = array(
				"slug" => $arr->slug,
				"content" => $arr->content,
				"image" => $arr->image,
				"comments" => $arr->comments_count,
				"likes" => $arr->likes,
				"reposts" => $arr->reposts_count,
				"time" => $arr->created,
				"username" => $arr->owner->username,
				"user_slug" => $arr->owner->slug,
			);
			echo json_encode($post, JSON_UNESCAPED_UNICODE);
			break;
    	}
    }
    else{
    	exit("slug or post not defined!");
    }
?>