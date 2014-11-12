<html>
<head>
<title>ツイート画面</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

<style type="text/css">

div {
}
textarea {
width: 100%;
}
</style>

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
					$('#tweet_contents').prepend(data);
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
						$('#tweet_contents').prepend(data);
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
					$('#tweet_contents').append(data);
					num=num+10;

				}
		});

	});
});
</script>

<p><?php echo $username ?>さん</p><div align='right'><a href="<?php echo site_url("twitter/logout") ?>">ログアウト</a>
</div>
<br>

<div style="width:500; position: relative; top: 0; left:100px;">
<textarea id="tweettext" name="tweettext"  rows="5">
</textarea>

<div id="tweetbtn"><input type="submit" name="tweetbutton" value="ツイート" /></div>
<div id="tweet_contents">
</div>

<div id="btn"><input type="submit" value="次の10件" /></div>
</div>

</form>

</body>
</html>
