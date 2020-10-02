<?php 

	$webroot = $_SERVER['DOCUMENT_ROOT'];

	include_once($webroot."/src/common/function.php");
	$dbh = getDbh();

	header("Content-type: text/plain; charset=UTF-8");
	date_default_timezone_set('Asia/Tokyo');

?>

<?php
	
	$user = $_POST['user'];
	$user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    
	$comment = $_POST['comment'];
	$comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');

	$threadId = $_POST['threadId'];


	$blank = array('　',' ');
	$checkUser = str_replace($blank, "", $user);
	$checkComment = str_replace($blank, "", $comment);

	
	if($checkUser == ""){
		p('noUser');
		return;
	}
 	if($checkComment == ""){
		p('noComment');
		return;
	}

    try{
		$dbh->beginTransaction();
		
			$sql="INSERT INTO bbs_thread(user,comment,threadId) VALUES (:user,:comment,:threadId)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user', $user, PDO::PARAM_STR);
			$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
			$stmt->bindParam(':threadId', $threadId, PDO::PARAM_STR);
			$stmt->execute();
		
        $dbh->commit();

			$sql="SELECT MAX(threadId) FROM bbs_thread";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$maxThreadId = $stmt->fetchColumn();
		} catch (Exception $e) {
			$dbh->rollBack();
			echo "失敗しました。" . $e->getMessage();
	}

	p($maxThreadId);
	
?>