window.onscroll = function()
{
	console.log("Doc scroll top " + document.documentElement.scrollTop);
	var scroll = document.documentElement.scrollTop;
	
	if(scroll > 50)
	{
		
		var sticky = document.getElementById("stickyNav");
		var logo = document.getElementById("logoImg");
		sticky.style.padding = "0pt";
		logo.style.width = "0pt";
		logo.style.width = "0%";
	}
	else
	{
		var sticky = document.getElementById("stickyNav");
		var logo = document.getElementById("logoImg");
		
		sticky.style.padding = "10pt";
		logo.style.width = "10%";
		logo.style.height = "10%";
	}
	
}