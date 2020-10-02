<section>
	
	<div>

		<label>お名前</label><br>

		<input type = "text" id = "user" placeholder = "名前入力">

	</div>
	
	<div>

		<label>コメント</label><br>

    	<textarea id = "comment" rows = 8 cols = 50 placeholder = "コメント入力"></textarea>

		<input type = "hidden" id = "threadId" value = "<?php print $threadId ?>">

		<button style = "margin-left:29px;"type = "button" id = "send">書き込む</button>

	</div>

</section>

