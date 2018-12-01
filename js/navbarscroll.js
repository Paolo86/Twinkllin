var isShrunk = false;



window.onscroll = function()
{
	if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      // console.log("BOTTOM");
   }


	var scroll = document.documentElement.scrollTop;

	var sticky = document.getElementById("stickyNav");
	var logo = document.getElementById("logoImg");

	if(scroll > 50 && !isShrunk)
	{
		
	    isShrunk = true;
	


		$(logo).animate({width: "0%",height: "0%"},function(){
		
			
		});		
		
	
	}
	else if(scroll < 50 && isShrunk)
	{

		isShrunk = false;
	
		$(logo).animate({width: "10%",height: "10%"},function(){
			var height = $("#myTopnav").height();
		//console.log("Collapsed " + height);
		$("#spacer").height(height);
			
		});
		
		
		
	}
	
	
}

