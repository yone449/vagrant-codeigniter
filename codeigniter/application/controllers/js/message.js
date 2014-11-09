$(document).ready(function(){   

	$("#btn").click(function()
		{       
			$.ajax({
				type: "POST",
			url:  "twitter/post_action", 
			data: {textbox: $("#textbox").val()},
			dataType: "text",  
			cache:false,
			success: 
				function(data){
					alert(data);  //as a debugging message.

				}

			});// you have missed this bracket
			return false;
		});
});
