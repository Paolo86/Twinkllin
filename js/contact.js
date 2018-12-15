function clearContactFields()
{
	
	$("#nameInput").val("");
	$("#surnameInput").val("");
	$("#emailInput").val("");
	$("#subjectInput").val("");
	$("#message").val("");
}

function sendEmail()
	{
		
		var result = true;
		var name = document.getElementById("nameInput").value;
		var surname = document.getElementById("surnameInput").value;
		var email = document.getElementById("emailInput").value;
		var message = document.getElementById("message").value;
		
		if(name == "")
		{
			alert("Please enter your name");
			result = false;
		}
		
		if(surname == "")
		{
			alert("Please enter your last name");
			result = false;
		}
		if(email == "")
		{
			alert("Please enter your email address");
			result = false;
		}
		if(message == "")
		{
			alert("Please enter your message");
			result = false;
		}
		
		if(result)
		{
		var data = {
   			  "message": message ,
  			  "email": email,
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/email.php",
   		 data: data,
   		  success: function(response) { 
                alert("Message sent from " + response); 
            },
            error: function(xhr, status, error){
                console.log(xhr); 
            }		});
	
		}
	
		
		
	}