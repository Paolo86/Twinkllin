function displayDetails(theid,tableName)
	{
	//console.log("Function called");
	
	window.location.hash="details";
	
 	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById('phpResult').innerHTML= this.responseText;
				render("#details");
								 }
						 }
	xhr.open("GET", 'server/details.php?t=' + tableName + '&id=' + theid, true);
	xhr.send();

	}	

function buyNow(theid,tableName,user)
{
//console.log("buy now user " + user);
if(user!=0)
{
var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
				alert("Thanks for your purchase!");
					window.location.hash="collection";
				
								 }
						 }
	xhr.open("GET", 'server/purchase.php?t=' + tableName + '&id=' + theid, true);
	xhr.send();
}
else
{
alert("Plase log in to purchase.");
}


}

function logout()
{
	//console.log('Logout called');
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
				
								
									var login = document.getElementById("loginmenu");
									var logout = document.getElementById("logoutmenu");

									login.style.display = "block";
									logout.style.display = "none";
									window.location.hash="home";
				
								 }
						 }
	xhr.open("GET", 'server/logout.php', true);
	xhr.send();
	
}

function loginCheck()
{
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
								if(this.responseText!=0)
								{
								//console.log('Logged in as ' + this.responseText);
									var login = document.getElementById("loginmenu");
									var logout = document.getElementById("logoutmenu");
								
									var welcome = document.getElementById("welcome_statement");
									welcome.innerHTML = "Logged in as " + this.responseText;

									login.style.display = "none";
									logout.style.display = "block";
								}
								
								 }
						 }
	xhr.open("GET", 'server/loginCheck.php', true);
	xhr.send();
	
}

function login()
{

var user = document.getElementById("userid").value;
var psw = document.getElementById("psw").value;

if(user != '' && psw != '')
{

 var request = $.ajax({
    type: "POST",
    url: "server/login.php",
    data: {'userid': user, 'psw': psw},
    dataType: "text"
});

request.done(function(msg) {
	
	if(msg == 1)
	{
	//
	window.location.reload();
	window.location.hash="home";
	
	}
	else
	{
	alert("Username or password incorrect");
	}
});

request.fail(function(jqXHR, textStatus) {
  // console.log( "Request failed: " + textStatus );
});}

}




function updateUserAttributes()
{

	
	allNewAttributes.forEach(function (newAttribute) {
   
  // console.log("New att: table " + newAttribute['table'] + " id: " + newAttribute['id'] + 
  // " column: " + newAttribute['column'] + " new value: " + newAttribute['newvalue'] + " PK name: " + newAttribute['pkname']);
	
	var data = {
			  table: newAttribute['table'],
   			  newvalue: newAttribute['newvalue']  ,
			  column: newAttribute['column'],
			  id: newAttribute['id'] ,
			  pkname: newAttribute['pkname']		
    			
			};
			
			$.ajax({
 		   type: "POST",
  		  url: "server/updateDB.php",
   		 data: data,
   		  success: function(response) { 
		
			
            if(response == 1)
			{
			//alert("Data updated");
			toAccount();
				  
			 }
					
	
            },
            error: function(xhr, status, error){
    
            }		});

	});
	
	alert("Data updated");
	allNewAttributes = [];
	
}
//Class attribute
function attribute() {
 
}

var allNewAttributes = [];

function changeAttribute(idColumn, unique, tablename, pkname)
{

	var column = idColumn.split("-")[1];
	
	var newAttribute = new attribute();
	newAttribute.id = unique;
	newAttribute.pkname = pkname;
	newAttribute.table = tablename;
	newAttribute.column = column;
	newAttribute.newvalue = document.getElementById(idColumn).value;
	
	/*console.log("New attribute:\n");
	console.log("ID: " + newAttribute['id'] + "\n");
	console.log("Table: " + newAttribute['table'] + "\n");
	console.log("PK Column name: " + newAttribute['pkname'] + "\n");
	console.log("Column: " + newAttribute['column'] + "\n");
	console.log("Value to insert: " + newAttribute['newvalue'] + "\n");*/
	
	
	
	allNewAttributes.push(newAttribute);


}



function addJewel()
{

	var title = document.getElementById('addjewel_titleInput').value;
	var details = document.getElementById('addjewel_detailsInput').value;
	var category = document.getElementById('addjewel_categoryInput').value;
	var price = document.getElementById('addjewel_priceInput').value;
	var imageLink = document.getElementById('addjewel_linkInput').value;
	var stock = document.getElementById('addjewel_stockInput').value;
	
	var result = true;
	if(title == "")
	{
		alert("Plase add a title");
		result = false;
		
	}
		if(details == "")
	{
		alert("Plase add some details (Ex. Size 13)");
		result = false;
		
	}
		if(category == "")
	{
		alert("Plase add a category (Ex. Ring)");
		result = false;
		
	}
		if(price == "")
	{
		alert("Plase add a price (500). No need to specify the $ sign.");
		result = false;
		
	}
	//Check that price is a number
	var isnum = /^\d+$/.test(price);
	if(isnum == false)
	{
		alert("Price should be a number");
		result = false;
	}
	
	price = "$" + price;
	
	if(stock == "")
	{
		alert("Plase add a the stock (quantity available)");
		result = false;
		
	}
	
	isnum = /^\d+$/.test(stock);
	if(isnum == false)
	{
		alert("Stock should be a number");
		result = false;
	}
	
	
	
	if(imageLink == "")
	{
		alert("The image link was not specified. No image will be displayed.");
	}
	
	
	if(result == false)
		return;
	
	var data = {
			  "table": "jewels",
   			  "title": title ,
  			  "details": details,
			  "category": category,
			  "price": price,
			  "link": imageLink,
			  "stock": stock
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/addToDB.php",
   		 data: data,
   		  success: function(response) { 
		  
		  	  if(response ==1)
			  alert("Item added");
		  else
			  alert("Something went wrong :( ");
		  
			toAccount();
			
             
			
            },
            error: function(xhr, status, error){
               // console.log(xhr); 
            }		});
	

}

function removeFromDB(id,table,pkcolumnname)
{
	
	//console.log("Remove from " + table + " where " + pkcolumnname + " = " + id);
	
	var data = {
			  "table": table,
   			  "pkname": pkcolumnname ,
			  "id": id 			
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/removeFromDB.php",
   		 data: data,
   		  success: function(response) { 
		  
		  if(response ==1)
			  alert("Process completed");
		  else
			  alert("Something went wrong :( ");
		  if(table != 'users')
			toAccount();
		else
		{
			logout();
			toPage("home");
		}
             
			
            },
            error: function(xhr, status, error){
              //  console.log(xhr); 
            }		});
}

function addStaff()
{

	var username = document.getElementById('addstaff_usernameInput').value;
	var firstname = document.getElementById('addstaff_firstnameInput').value;
	var lastname = document.getElementById('addstaff_lastnameInput').value;
	var psw = document.getElementById('addstaff_pswInput').value;

	var result = true;
	if(username == "")
	{
		alert("Plase add a username");
		result = false;
		
	}
		if(firstname == "")
	{
		alert("Plase add a first name");
		result = false;
		
	}
		if(lastname == "")
	{
		alert("Plase add a last name");
		result = false;
		
	}
		if(psw == "")
	{
		alert("Plase add a password.");
		result = false;
		
	}
	
	
	
	if(result == false)
		return;
	
	var data = {
			  "table": "users",
   			  "username": username ,
			  "firstname": firstname,
  			  "lastname": lastname,
			  "psw": psw
			
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/addToDB.php",
   		 data: data,
   		  success: function(response) { 
		  
		   if(response ==1)
			  alert("Staff member added");
		  else
			  alert("Something went wrong :( ");
		  
			toAccount();
			
             
			
            },
            error: function(xhr, status, error){
              //  console.log(xhr); 
            }		});
	

}


function addPainting()
{

	var title = document.getElementById('addpan_titleInput').value;
	var size = document.getElementById('addpan_sizeInput').value;
	var year = document.getElementById('addpan_yearInput').value;
	var category = document.getElementById('addpan_categoryInput').value;
	var price = document.getElementById('addpan_priceInput').value;
	var imageLink = document.getElementById('addpan_linkInput').value;
	var stock = document.getElementById('addpan_stockInput').value;
	
	var result = true;
	if(title == "")
	{
		alert("Plase add a title");
		result = false;
		
	}
		if(size == "")
	{
		alert("Plase add the size (Ex. 50x90)");
		result = false;
		
	}
		if(category == "")
	{
		alert("Plase add a category (Ex. Ring)");
		result = false;
		
	}
	
	if(year == "")
	{
		alert("Plase add a year.");
		result = false;
		
	}
	
	//Check that price is a number
	var isnum = /^\d+$/.test(year);
	if(isnum == false)
	{
		alert("Year should be a number");
		result = false;
	}
	
	if(isnum == true && year.length > 4)
	{
		alert("Year should be 4 digits.");
		result = false;
		
	}
	
	if(isnum == true && year.length == 4)
	{
		var d = new Date();
		if(year > d.getFullYear())
		{
			alert("Future year is not valid.");
			result = false;
		}
		
	}
	
		if(price == "")
	{
		alert("Plase add a price (500). No need to specify the $ sign.");
		result = false;
		
	}
	//Check that price is a number
	isnum = /^\d+$/.test(price);
	if(isnum == false)
	{
		alert("Price should be a number");
		result = false;
	}
	
	price = "$" + price;
	
	if(stock == "")
	{
		alert("Plase add a the stock (quantity available)");
		result = false;
		
	}
	
	isnum = /^\d+$/.test(stock);
	if(isnum == false)
	{
		alert("Stock should be a number");
		result = false;
	}
	
	
	
	if(imageLink == "")
	{
		alert("The image link was not specified. No image will be displayed.");
	}
	
	
	if(result == false)
		return;
	
	
	var data = {
			  "table": "paintings",
   			  "title": title ,
			  "year": year,
  			  "size": size,
			  "category": category,
			  "price": price,
			  "link": imageLink,
			  "stock": stock
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/addToDB.php",
   		 data: data,
   		  success: function(response) { 
		  
		 if(response ==1)
			  alert("Item added");
		  else
			  alert("Something went wrong :( ");
		  
			toAccount();
			
             
			
            },
            error: function(xhr, status, error){
               // console.log(xhr); 
            }		});
	

}



function toPage(page)
{
	
window.location.hash=page;	
}

function toAccount()
{
	
	window.location.hash="account-page";
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {											

								//console.log('Resutnred ' + this.responseText);
								document.getElementById('accountDetails').innerHTML= this.responseText;
								
							
				
								 }
						 }
	xhr.open("GET", 'server/getAccount.php', true);
	xhr.send();
}

function search(val)
{

	
var searchInput = document.getElementById("searchInput").value;
if(searchInput == "")
return;


window.location.hash="details";
var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById('phpResult').innerHTML= this.responseText;
						
								 }
						 }
	xhr.open("GET", 'server/search.php?search=' + searchInput, true);
	xhr.send();


}

function registerUser()
{
	
	//console.log("Registration sent");
	var firstname = document.getElementById('reg_firstnameInput').value;
	var lastname = document.getElementById('reg_lastnameInput').value;
	var username = document.getElementById('reg_usernameInput').value;
	var psw = document.getElementById('reg_pswInput').value;
	var result = true;
	if(firstname == "")
		{
			alert("Please enter your name");
			result = false;
		}
		
		if(lastname == "")
		{
			alert("Please enter your last name");
			result = false;
		}
		if(username == "")
		{
			alert("Please enter your registration username");
			result = false;
		}
		if(psw == "")
		{
			alert("Please enter your password");
			result = false;
		}
		
		if(result)
		{
		var data = {
   			  "firstname": firstname ,
  			  "lastname": lastname,
			  "username": username,
			  "psw": psw
    			
			};

		$.ajax({
 		   type: "POST",
  		  url: "server/registerUser.php",
   		 data: data,
   		  success: function(response) { 
		 // console.log(response);
			if(response == 1)
                alert("Registration completed succesfully"); 
			else
				alert("Something went wrong! Try using a different username"); 
            },
            error: function(xhr, status, error){
              //  console.log(xhr); 
            }		});
	
		}
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
	
function getAll()
	{
		console.log("Get al l called");
	$.post("server/db.php",{tname: "jewels"},function(data,status){
		
		$("#phpResult").hide();
		$("#phpResult").html(data).fadeIn(500);
	});
	}
