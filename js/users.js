var inputError = [];




function registerUser()
{
	
	clearInputErrors();
	var firstname = document.getElementById('reg_firstnameInput').value;

	var lastname = document.getElementById('reg_lastnameInput').value;
	var username = document.getElementById('reg_usernameInput').value;
	var email = document.getElementById('reg_emailInput').value;
	var confpsw = document.getElementById('reg_confpswInput').value;
	var psw = document.getElementById('reg_pswInput').value;
	var result = true;
	
	
	
	if(username == "")
		{	
		inputError.push("Username cannot be empty");
		}
	
	if(firstname == "")
		{
			inputError.push("Firstname cannot be empty");
		}
		
	if(lastname == "")
		{
			inputError.push("Lastname cannot be empty");
		}
	if(email == "")
		{
			inputError.push("Firstname cannot be empty");
		}

	if(psw == "")
		{
			inputError.push("Password cannot be empty");
		}
	else if(psw.length < 8)
		inputError.push("Password must be at least 8 characters");
	
	var confirmation = $("#reg_confpswInput").val();
	
	if(confirmation != psw)
		inputError.push("Passwords don't match");
	
	
		
	if(inputError.length != 0)
			displayErrors();	
	else		
	{
		var data = 
		{
			username: username,
			firstname: firstname,
			lastname: lastname,
			email: email,
			psw: psw,
		
			
		};
		//send to php
		$.post("server/registerUser.php",data,function(data, status){
			
			
			if(status == "success")
			{
				//Create response object to send back
				//console.log(data);
				var resp = JSON.parse(data);
				
		
			if(resp.success)
			{
				
				$('#modalTitle').html('Registration successful');
				$("#modalTitle").css("background-color","#11ff11aa");
			}
			else
			{
				
				$('#modalTitle').html('Registration failed');
				$("#modalTitle").css("background-color","#ff1111aa");
			}
				$('#modalBody').html(resp.info);
				$('#genericModal').modal('show');
				
				
				
			
				
			}
			
		});
	}
		
}

function checkConfirmPassword()
{
	var current = $("#reg_confpswInput").val();
	var psw = $("#reg_pswInput").val();
	

	if(current === psw)
		$("#confirmContainer").attr("class","form-group no-error");
	else
		$("#confirmContainer").attr("class","form-group has-error");
	
}

function clearAllRegistration()
{
	clearInputErrors();
	document.getElementById("registerForm").reset();
	
}

function clearInputErrors()
{
	$("#errors").remove();
}


function displayErrors()
{
	var errors = document.getElementById("errors");
	
	if(errors)
		clearInputErrors();
	
	$("#register-page").prepend('<div id="errors"> </div>');		
	
	var i = 0;
	while(inputError.length > 0){
	var msg = 	inputError.pop();	
		$("#errors").prepend('<div class="alert alert-warning" role="alert">' + msg+ '</div>');
	}
	
	
}

function checkEmptyField(id,containerid)
{
	
	var current = $("#" + id).val();
	
	

	if(current == "")
		$("#" + containerid).attr("class","form-group has-error");
	else
		$("#" + containerid).attr("class","form-group no-error");
	
}

function recoverPassword()
{
	
	var email = $("#reg_emailInput").val();
	
	if(email!="")
	{
		$.post("server/recoverPassword.php",{email: email},function(data,status){
			
			if(status=='success')
			{
					var resp = JSON.parse(data);
				
					if(resp.success)
					{
					$('#modalTitle').html('Email sent');
					$("#modalTitle").css("background-color","#11ff11aa");
				
					
					}
					else
					{
						
					$('#modalTitle').html('Error');
					$("#modalTitle").css("background-color","#ff1111aa");
					
					
					}
					$('#modalBody').html(resp.info);
					$('#genericModal').modal('show');
					console.log(data);
			}
			
			
		});
	
		
	}
	
}