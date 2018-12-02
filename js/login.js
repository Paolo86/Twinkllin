function showLogIn()
{
	$('#loginModal').modal('show');
}

function logInUser()
{
	
	var user = $("#loginUsername").val().trim();
	var psw = $("#loginPsw").val().trim();
	
	if(!isFieldEmpty('loginUsername') && !isFieldEmpty('loginPsw'))
	{
		var d = 
		{
			username: user,
			psw: psw
			
		};
		$.post('server/logIn.php',d,function(data,status){
			
			if(status == 'success')
			{
				
				var info = JSON.parse(data);
				
				if(info.success)
				{
					$(".logInButton").hide();
					$(".loggedInButton").show();
					$(".loginNameText").text(info.info);
					console.log("LOGGED");
					
				}
				else
				{
				$("#modalTitle").html("Error");
				$("#modalBody").html(info.info);
				$("#modalButton").attr("onclick","");
				$("#genericModal").modal('show');
				}
			}
			else
			{			
				$("#modalButton").attr("onclick","");
				$("#modalTitle").html("Error");
				$("#modalBody").html("Internal error occurred. Please try again later.");
				$("#genericModal").modal('show');
			}
			
			
		});
	}
}