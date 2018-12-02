var inputError = [];




function registerUser()
{
	
	clearInputErrors();
	
	//Trim all
	var inputs = $('#registrationForm :input');
	
	$(inputs).each(function(){
		
		//Trim all
		$(this).val($(this).val().trim());
		var label = $("label[for='"+this.id+"']");
	
		
		if(isFieldEmpty($(this).attr("id")))
			inputError.push($(label).text() + " cannot be empty");
		else
		{
			if(hasWhiteSpace($(this).val()))
				inputError.push($(label).text() + " cannot contain white spaces");
		}		
		
	});
	
	
	
	if(!isFieldMinLengthOK('reg_pswInput',8))
		inputError.push("Password must be at least 8 characters");
	
	if(!areFieldsMatching('reg_pswInput','reg_confpswInput'))
			inputError.push("Passwords don't match");
	
			
	if(inputError.length != 0)
			displayErrors();	
	else		
	{
		var data = 
		{
			username: $("#reg_usernameInput").val(),
			firstname: $("#reg_firstnameInput").val(),
			lastname: $("#reg_lastnameInput").val(),
			email: $("#reg_emailInput").val(),
			psw: $("#reg_pswInput").val()		
			
		};
		
		//send to php
		$.post("server/registerUser.php",data,function(data, status){
			console.log(data);			
			
			if(status == "success")
			{
				//Create response object to send back
				//console.log(data);
				var resp = JSON.parse(data);
				
		
			if(resp.success)
			{
				
				$('#modalTitle').html('Registration successful');
			
			}
			else
			{
				
				$('#modalTitle').html('Registration failed');
		
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
		$("#confirmContainer").attr("class","no-error");
	else
		$("#confirmContainer").attr("class","has-error");
	
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