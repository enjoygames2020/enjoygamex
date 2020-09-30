<?php

	function p($str){
		print $str;
   }

	function isResponseForm(){
		return strstr(getRequestURL() ,"/thread/");
    }

	function getRequestURL(){
		return $_SERVER["REQUEST_URI"];
    }

	function isNewThreadForm(){
		return strstr(getRequestURL() ,"/new/");
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

	function getFullThread(){
		
		$sql = "SELECT threadId,title
			  	  FROM bbs_thread
			 	 WHERE 1 AND disabledflg <> 1 
		  	  ORDER BY updatedy DESC,threadId ";

		
		$stmt = getDbh()->prepare($sql);
		
		$stmt->execute();
		
		$result = $stmt->fetchAll();
		
		return $result;
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

	function outThreadLists($tItem,$sideFlg = NULL){

		p('
			<a style = "text-decoration: none;" href="/title/'.$tItem["threadId"].'/" class="transmission">
	
			'."".$tItem["title"]."/".'
			</a>
		');
    }

	function getResponseCount($threadId){
		/* スレ内のレス件数取得 */
		$sql = "SELECT count(*) FROM bbs_message WHERE disabledflg <> 1 AND threadId=:threadId";
		$stmt = getDbh()->prepare($sql);
		$stmt->bindParam(':threadId', $threadId ,PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		
		return $count;
    }

	function getTrimString($string, $trimLength){
		$count = mb_strlen($string);
		$string = mb_substr($string ,0 ,$trimLength);
		if($count > $trimLength){ $string = $string.'...'; }
		return $string;
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
	
	function getThreadCount(){
		
		$sql = "SELECT Count(*) FROM bbs_thread WHERE disabledflg not in(1)";
		$stmt = getDbh()->prepare($sql);
		$stmt->execute();
		
		$totalThreadCount = $stmt->fetchColumn();
	
		return $totalThreadCount;
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