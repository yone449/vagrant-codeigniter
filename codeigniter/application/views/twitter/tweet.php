<html>
<head>
<title>ツイート画面</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>



<ul>
<?php foreach ($tweets as $row) { ?>
	<li>
	<?php echo $row['UserName']; ?>さん:<?php echo $row['Date']; ?>
	</li>
	<?php echo $row['TweetText']; ?>
<?php } ?>
</ul>

<script>
$(function(){
	$("#btn").click(function(){
		$('ul').append('<li>AAAAAA</li>');
//		$.ajax({
//			type: "POST",
//				url: "twitter/post_action"
//				data: {'textbox': $("#textbox").val()},
//				dataType: "text",  
//				cache:false,
//				success: 
//				function(data){
//					alert(data);  //as a debugging message.
//
//				}
//
//			return false;
//		})
	});
});
</script>


<input id="textbox" type="text" name="textbox">
<div id="btn"><input type="submit" value="次の10件" /></div>

</form>

</body>
</html>
