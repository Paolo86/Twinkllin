//Globals
var editMode = false;

function fillUpAccountForm()
{	
	//Page is loaded, hide save button
	switchEditMode(false);
	
	
		//Get logged in user (if there is)
	$.post('server/checkLogin.php',function(data,status){
		
		if(status=='success')
		{
			
			var resp= JSON.parse(data);
			
			if(resp.success)
				{
				var user = JSON.parse(resp.info);
				$("#acc_usernameInput").val(user.username);
				$("#acc_firstnameInput").val(user.firstname);
				$("#acc_lastnameInput").val(user.lastname);
				$("#acc_emailInput").val(user.email);
				
				}
			else
				{
				
				}		
	
		}
		
	});	
}

function deleteAccountRequest()
{
	
	$("#modalTitle").html("Are you sure you want to delete your account?");
	$("#modalBody").html("Press OK to proceed, close this window to cancel.");
	$("#modalButton").attr("onclick","deleteAccountForGood()");
	$("#genericModal").modal('show');
}

function deleteAccountForGood()
{
	$("#genericModal").modal('hide');
	logOut();
	$.post('server/deleteAccount.php',{username: $("#acc_usernameInput").val()},function(data,status){
		
		if(status == 'success')
		{
		$("#modalTitle").html("Account deleted.");
		$("#modalBody").html("Your account was successfully deleted.");
		$("#modalButton").attr("onclick","redirect('home')");
		$("#genericModal").modal('show');
		}
	else
		{}
		
	});
	
}

function switchEditMode(mode)
{
	editMode = mode;
	if(editMode)
	{
		$("#nonEditbutton").hide();
	$("#editbutton").show();
	$("#acc_usernameInput").attr("readonly",false);
	$("#acc_firstnameInput").attr("readonly",false);
	$("#acc_lastnameInput").attr("readonly",false);
	$("#acc_emailInput").attr("readonly",false);
	
	
	
	
	}
	else
	{
	$("#nonEditbutton").show();
	$("#editbutton").hide();
	$("#acc_usernameInput").attr("readonly",true);
	$("#acc_firstnameInput").attr("readonly",true);
	$("#acc_lastnameInput").attr("readonly",true);
	$("#acc_emailInput").attr("readonly",true);
	}
}

var orig_name;
var orig_surname;
var orig_email;
var orig_username;

function editAccount()
{
	
	switchEditMode(true);
	
	orig_username = $("#acc_usernameInput").val();
	orig_name = $("#acc_firstnameInput").val();
	orig_surname = $("#acc_lastnameInput").val();
	orig_email=	$("#acc_emailInput").val();	
	
	
}

function discardChanges()
{
	$("#acc_usernameInput").val(orig_username);
	$("#acc_firstnameInput").val(orig_name);
	$("#acc_lastnameInput").val(orig_surname);
	$("#acc_emailInput").val(orig_email);
	switchEditMode(false);
}

function saveChanges()
{
	var username = $("#acc_usernameInput").val();
	var firstname = $("#acc_firstnameInput").val();
	var lastname = $("#acc_lastnameInput").val();
	var email=	$("#acc_emailInput").val();	
	
	var d = 
	{
		originaluser: orig_username,
		newusername: username,
		newfirstname: firstname,
		newlastname: lastname,
		newemail: email		
	};
	
	$.post('server/updateUserDetails.php',d,function(data,status){
		
		if(status='success')
		{
			console.log(data);
			var response = JSON.parse(data);
			
			if(response.success)
			{
			console.log("All good");
			
			orig_username = username;
			orig_name = firstname;
			orig_surname = lastname;
			orig_email= email;
			switchEditMode(false);
			window.location.reload(); //Refresh page, not sure this is a good thing but i need it to change the button name (top right)
			
			}
			else
			{
				console.log("All fail");	
			}
		}
		else
		{}
		
	});
	
}