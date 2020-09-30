<script type="text/javascript">

$(document).ready(function(){



	$('#send').click(function(){
		
		var data = {
			user : $('#user').val(),
			comment : $('#comment').val(),
			threadId : $('#threadId').val()
		};
		
		$.ajax({
			type: "POST",
			url: "/src/server/threadInsert.php",
			data: data,
			async:false,
			


			success: function(data, dataType){
				if(data =='noUser'){
					alert('名前が入力されていません。');
				}else if(data =='noComment'){
					alert('送信しました。ありがとうございます。');
				}else{
					alert('送信しました。ありがとうございます。');
					location.href="/title/" + $('#threadId').val() + "/";
				}
			},
			


			error: function(XMLHttpRequest, textStatus, errorThrown){
			
				alert('Error : ' + errorThrown);
			}
		});
		 

		return false;
	});
});
</script>
