<html>
<head>
<title>ツイート画面</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?=base_url("index.php/js/message.js")?>"></script>
</head>
<body>



<ul>
</ul>

<script>
$(function(){
		var num=0;
	$("#btn").click(function(){
		$.ajax({
			type: "POST",
				url: "twitter/post_action",
				data: {
					'num': num,
					'mailadd':'<?php echo $mailadd ?>',
					'csrf_test_name': $('[name="csrf_test_name"]').val()
				},
				cache:false,
				success: 
				function(data){
					$('ul').append(data);

				}
		});

		num=num+10;
	});
});
</script>


<div id="btn"><input type="submit" value="次の10件" /></div>

</form>

</body>
</html>
