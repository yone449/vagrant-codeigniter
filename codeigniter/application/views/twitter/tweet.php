<html>
<head>
<title>ツイート画面</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?=base_url("index.php/js/message.js")?>"></script>
</head>
<body>


<script>
$(function(){
		var num=0;
		$.ajax({
			type: "POST",
				url: "twitter/new_tweet",
				data: {
						'num':num,
						'mailadd':'<?php echo $mailadd ?>',
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				cache:false,
				success: 
				function(data){
					$('ul').prepend(data);
					num=num+10;

				}
		});
	$("#tweetbtn").click(function(){
		$.ajax({
			type: "POST",
				url: "twitter/submit_tweet",
				data: {
					'tweettext':$("#tweettext").val(),
					'mailadd':'<?php echo $mailadd ?>',
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				cache:false,
				success: 
				function(data){
					if(data!=""){
						$('ul').prepend(data);
						alert('送信されました');
						num=num+1;

					}

				}
		});

	});
	$("#btn").click(function(){
		$.ajax({
			type: "POST",
				url: "twitter/new_tweet",
				data: {
					'num': num,
					'mailadd':'<?php echo $mailadd ?>',
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				cache:false,
				success: 
				function(data){
					$('ul').append(data);
					num=num+10;

				}
		});

	});
});
</script>


<textarea id="tweettext" name="tweettext" cols="50" rows="5">
</textarea>

<div id="tweetbtn"><input type="submit" name="tweetbutton" value="ツイート" /></div>

<ul>
</ul>

<div id="btn"><input type="submit" value="次の10件" /></div>

</form>

</body>
</html>
