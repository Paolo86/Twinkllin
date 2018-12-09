function showLogIn()
{
	$('#loginModal').modal('show');
}


function checkLogIn()
{
	$.post("server/checkLogIn.php",function(data,status){
		
		if(status=='success')
		{
			var response = JSON.parse(data);
			
			if(response.success)
			{
			
				var user = JSON.parse(response.info);
		
				sendLogin(user.username, user.psw);
			}
			else
			{
				//console.log("Nobody was logged");
			}
		}
	});
		
}

function logOut()
{
	$.post('server/logOut.php',function(data,status){	
	
		if(status=='success')
		{			
			$(".logInButton").show();
			$(".loggedInButton").hide();
			$(".loginNameText").text("");
		}
	});
	
}

function sendLogin(username, psw)
{
	var d = 
		{
			username: username,
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
					//console.log("LOGGED");
			
					
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

//Clear inputs when login modal closes
$('#loginModal').on('hidden.bs.modal', function () {
			//Clear input fields
					$("#loginUsername").val("");
					$("#loginPsw").val("");
});

function logInUser()
{
	
	var user = $("#loginUsername").val().trim();
	var psw = $("#loginPsw").val().trim();
	
	if(!isFieldEmpty('loginUsername') && !isFieldEmpty('loginPsw'))
	{
		sendLogin(user, psw);
		
	}
}