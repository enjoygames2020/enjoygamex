<?php

	function p($str){
		print $str;
   }

	function getRequestURL(){
		return $_SERVER["REQUEST_URI"];
    }

	function getDbh(){
		$dsn='mysql:dbname=test;host=127.0.0.1';
		$user='root';
		$pass='';
		try{
			$dbh = new PDO($dsn,$user,$pass);
			$dbh->query('SET NAMES utf8');
		}catch(PDOException $e){
			p('Error:'.$e->getMessage());
			p('データベースへの接続に失敗しました。時間をおいて再度お越し下さい。');
			die();
		}
		return $dbh;
    }

	function getFullTitle(){
		
		$sql = "SELECT threadId,title
			  	  FROM bbs_title
			 	 WHERE 1 ";

		$stmt = getDbh()->prepare($sql);
		
		$stmt->execute();
		
		$results = $stmt->fetchAll();
		
		return $results;
	}
	
	function titleThread($threadId){

		$sql = "SELECT 
					title
				FROM 
					bbs_title
				WHERE 
					threadId = :threadId
				ORDER BY 
					threadId";
		$stmt = getDbh()->prepare($sql);
		$stmt->bindParam(':threadId', $threadId, PDO::PARAM_STR);
		$stmt->execute();
		$responseList = $stmt->fetchAll();
		
		return $responseList;
	}

	function outThreadLists($tItem){

		p('
			<a style = "text-decoration: none;" href="/title/'.$tItem["threadId"].'/" class="transmission">
	
			'."".$tItem["title"]."/".'
			</a>
		');
    }

	function getThreadInformation(){
		
		$urlArray = explode('/', getRequestURL());
		$threadId = $urlArray[2];
		
		$sql = 'SELECT threadId
		FROM bbs_title	  
		WHERE threadId = :threadId';

		$stmt = getDbh()->prepare($sql);
		$stmt->bindParam(':threadId', $threadId, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	function getResponseLists($threadId){

		$sql = "SELECT 
					threadId,user,comment,updatedy
				FROM 
					bbs_thread
				WHERE 
					threadId = :threadId
				ORDER BY 
					threadId";
		$stmt = getDbh()->prepare($sql);
		$stmt->bindParam(':threadId', $threadId, PDO::PARAM_STR);
		$stmt->execute();
		$responseLists = $stmt->fetchAll();
		return $responseLists;
	}

	function outputResponse($r){
		/* 情報を変数に格納 */
		$user = $r["user"];
		$comment = $r["comment"];
		$updatedy = $r["updatedy"];
		
		p('
			<div class="response">
			'.$user.'<br>
			'.$comment.date('(Y/m/d) H:i', strtotime($updatedy)).'<br>
			<br>
			</div>
			<span style="clear:both";></span>
		');
	}

	function outputResponses($r){
		/* 情報を変数に格納 */
		$title = $r["title"];
		
		p('
			<span style = "font-size:31px;padding-left:35px;padding-bottom:20px;">
			'.$title.'
			</span>
		');
	}
	
?>

