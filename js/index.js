function checkRefresh()
{
	if(window.location.hash == "#search")
		window.location.hash = "#collection";
	
	if(window.location.hash == "#collection")
		getAll(true);
	
	if(window.location.hash == "#details")
	{
		var lastID = localStorage.getItem("lastID");
		displayDetails(lastID);
	}
	
	if(window.location.hash == "#account")
	{
		fillUpAccountForm();
	}
		
}

function toHome()
{
	
	window.location.href = "index.html";
}

function redirect(np)
{
	window.location.hash = np;	
	
}

//code below for SPA
var pages = ["#home", "#collection", "#contact" ,"#details",'#register-page',"#account","#search"];
var curPage = pages[0];

$(document).ready(function(){
	
	//window.scrollTo(0, 0);
	
	//Set up spacer height
	var height = $("#myTopnav").height();	
	$("#spacer").height(height);
	

   // if the hash is one of page2 to page3,
   // render the page
   var newPage = getPage(window.location.hash);
   render(newPage);

   // click event handler:
   // 1) prevent loading of the new url
   // 2) may trigger hashchange event
   $('.inner-page-link').click(function(e){
       e.preventDefault();
       var newPage = $(this).attr('href');
	   
	   if(newPage == window.location.hash ) return;
	   
	   if(newPage == "") //If clicked on link (which has no href
		   newPage = window.location.hash;
		   
		if(newPage == "#contact" )
			{
			clearContactFields();
			}
       window.location.hash=newPage;
   });

   // hashchange event handler:
   // convert the hash to one of the three
   // page names and render the page
   $(window).on('hashchange', function(){
       var newPage = getPage(window.location.hash);
       render(newPage);
	   
	   if(newPage == "#collection")
	   {
		   getAll(false);
		   //console.log("Get all called");
	   }
	   
	    if(newPage == "#account")
	   {
		   fillUpAccountForm();
		   //console.log("Get all called");
	   }
		   
	 
   });

});

// render the new page if it is different
// from the current page
function render(newPage){

    if (newPage == curPage) return;

    $(curPage).hide();
    $(newPage).show();
    curPage = newPage;

    var myString = curPage;
    var newString = myString.substr(1);
    document.title= 'Twinkllin | ' + newString; // gets the current page and changes page title
}

// convert the hash to one of the three page names
// other hash values are converted to page[0] (ie, page1)
function getPage(hash){
   var i = pages.indexOf(window.location.hash);
   return i < 1 ? pages[0] : pages[i];
}
