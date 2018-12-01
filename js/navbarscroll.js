var isShrunk = false;

var height = $("#myTopnav").height();	
$("#spacer").height(height);

window.onscroll = function()
{
	if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      // console.log("BOTTOM");
   }


	var scroll = document.documentElement.scrollTop;

	var sticky = document.getElementById("stickyNav");
	var logo = document.getElementById("logoImg");

	if(scroll > 20 && !isShrunk)
	{
		
	    isShrunk = true;
	


	$(logo).animate({width: "0pt",height: "0pt"});		
		
	
	}
	else if(scroll < 20 && isShrunk)
	{

		isShrunk = false;
	
		$(logo).animate({width: "10%",height: "10%"},function(){
			var height = $("#myTopnav").height();
		//console.log("Collapsed " + height);
		$("#spacer").height(height);
			
		});
		
		
		
	}
	
	
}

