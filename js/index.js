//code for login menu to fade in and out when clicked
$(document).ready(function(){
  var arrow = $(".arrow-up");
  var form = $(".login-form");
  var status = false;
  $("#login").click(function(event){
    event.preventDefault();
    if(status == false){
      arrow.fadeIn();
      form.fadeIn();
      status = true;
    }else{
      arrow.fadeOut();
      form.fadeOut();
      status = false;
    }
  })
})

function redirect(np)
{
	window.location.hash = np;
	
}

//code below for SPA
var pages = ["#home", "#collection", "#contact" ,"#about" ,"#allitems" ,"#shopping-bag","#details", "#account-page","#register-page","#Add-Jewel","#Add-Painting","#Add-Staff", "#help-page"];
var curPage = pages[0];

$(document).ready(function(){

   // if the hash is one of page2 to page3,
   // render the page
   var newPage = getPage(window.location.hash);
   render(newPage);

   // click event handler:
   // 1) prevent loading of the new url
   // 2) may trigger hashchange event
   $('nav a').click(function(e){
       e.preventDefault();
       var newPage = $(this).attr('href');
       window.location.hash=newPage;
   });

   // hashchange event handler:
   // convert the hash to one of the three
   // page names and render the page
   $(window).on('hashchange', function(){
       var newPage = getPage(window.location.hash);
       render(newPage);
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
