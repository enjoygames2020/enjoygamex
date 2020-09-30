<?php
	/* ページングのために取得。すべてのスレッド数 */
	$totalThreadNumber = getThreadCount(); //C
	
	/* 1ページ当たりの表示数 */
    $displayNumber = 5 ;
    
	/* ページ数の算出。 ceil関数は小数点の切り捨て */
	$maxPageNumber = ceil($totalThreadNumber/$displayNumber);

	$urlArray = explode('/', getRequestUrl());
	
	/** 現在のページ番号を取得 */
    $currentPageNumber = $urlArray[1];
    
    if($currentPageNumber == ""){
		/* ページが指定されていないとき（初訪問時） */
		$currentPageNumber = 1;
		/* コンテンツ配列内のいくつ目から取り出すかを指定する数字 */
		$displayStartNumber = 0;
	}else{
		/* ページの指定があったとき（ページングリンクからの遷移） */
		$displayStartNumber = ($currentPageNumber -1) * $displayNumber;
    }
    	/** 現在表示中の情報を案内するメッセージを生成する */
	if($totalThreadNumber <> 0){
		/** 〇件目からの〇を取得 */
		$currentStartCount = '<p>'.($displayStartNumber + 1).'～'; //A

		if($currentPageNumber == $maxPageNumber){
			/** △件目までの△を取得（最終ページの場合） */
			$pagingCount = $totalThreadNumber; //B
		}else {
			/** △件目までの△を取得（最終ページではない場合） */
			$pagingCount = (($displayStartNumber) + $displayNumber); //B
		}

		$pagingMessage = $currentStartCount.$pagingCount.'/'.$totalThreadNumber.'スレッド中</p>'; //A + B + C

	}else if($totalThreadNumber == 0){
		$pagingMessage = '<p>現在登録されているデータはありません</p>';
    }
    p($pagingMessage);
    ?>
?>