$(document).ready(function(){

	var cookieData = document.cookie;

	$.ajax({
		type: "POST",
		url: "getCookiedata.php",
		data: {
			cookieData: cookieData
		},	
		success: function (response) {
			if(response.status == true){
				console.log('Ajax successful');
				console.log(response);
			}
		}

    });


});

