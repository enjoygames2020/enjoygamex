<section>

<p style = "font-size:30px;text-align:center;padding-top:20px;">コメント一覧</p>

<div style = "margin-top:60px;border:ridge;width:744px;margin-left:auto;margin-right:auto;
			  border-radius:13px;font-size:20px;font-family:UAの初期値;">

	<p>
		<?php

			$responseList = titleThread($threadId);

			foreach($responseList as $responses){
				outputResponses($responses);		
			}
			
		?>
	</p>

	<ul> 

		<li style = "list-style:none;">
			
		<?php
		
			$responseLists = getResponseLists($threadId);
			
			foreach($responseLists as $response){
				outputResponse($response);		
			}
		
		?>

		</li>
	</ul>	

	<input type="hidden" id="threadId" value="<?php p($threadId); ?>">

</div>

</section>

<div style = "border-top:ridge;margin-top:90px;"></div>

	<p style = "font-size:28px;text-align:center;">→コメントはこちらから←</p>

		<div style = "padding-left:600px;border-bottom:ridge;width:1000px;padding-bottom:40px;">

			<?php

				include_once($webroot."/src/parts/form.php");

				include_once("script.php");

			?>

		</div>
		
</div>
	
