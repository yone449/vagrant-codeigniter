$(function(){
		var num=0;
		$.ajax({
			type: "POST",
				url: "twitter/new_tweet",
				data: {
						'num':num,
						'mailadd':mailadd,
						csrf_test_name: csrf_hash
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
						'mailadd':mailadd,
						csrf_test_name: csrf_hash
				},
				cache:false,
				success: 
				function(data){
					if(data!=""){
						$('#tweet_contents').prepend(data);
						$("#tweettext").val("");
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
						'mailadd':mailadd,
						csrf_test_name: csrf_hash
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
