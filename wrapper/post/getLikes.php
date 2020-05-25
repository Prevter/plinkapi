<?php
	require_once("../config.php");
	if(isset($_GET["slug"]) && !empty($_GET["slug"]) && isset($_GET["limit"]) && !empty($_GET["limit"])){
        $slug = $_GET["slug"];
        if(isset($_GET["page"]) && !empty($_GET["slug"])){
            $page = $_GET["page"];    
        }
        else{
            $page = 1;
        }
		$limit = $_GET["limit"];
		$curl = curl_init();
		$headers = array(
			'Authorization: Token '.$token
		);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
 	   curl_setopt($curl, CURLOPT_URL, "https://plink.tech/post/".$slug."/like/?limit=".$limit."&page=".$page);
  	  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
   	 curl_close($curl);
        $arr = json_decode($result);
        //echo $result;
   	 $likes = array();
    	foreach($arr->results as $like){
    		$lk = array(
				"username" => $like->owner->username,
                "user_slug" => $like->owner->slug,
                "slug" => $like->slug,
            );
			array_push($likes,$lk);
    	}
    	echo json_encode($likes, JSON_UNESCAPED_UNICODE);
    }
    else{
    	exit("slug or limit not defined!");
    }
?>