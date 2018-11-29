window.onscroll = function()
{
	
	var scroll = document.documentElement.scrollTop;

	var sticky = document.getElementById("stickyNav");
	var logo = document.getElementById("logoImg");

	if(scroll > 50)
	{
		
	
		sticky.style.padding = "2pt";
		logo.style.width = "0pt";
		logo.style.width = "0%";
		
		
	}
	else
	{
	
		
		sticky.style.padding = "10pt";
		logo.style.width = "10%";
		logo.style.height = "10%";
	}
	
	
}

